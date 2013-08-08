<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$serviceName = Yii::app()->request->getQuery('service');
		if (isset($serviceName)) {
			/** @var $eauth EAuthServiceBase */
			$eauth = Yii::app()->eauth->getIdentity($serviceName);
			$eauth->redirectUrl = Yii::app()->user->returnUrl;
			$eauth->cancelUrl = $this->createAbsoluteUrl('site/login');

			try {
				if ($eauth->authenticate()) {
					$identity = new EAuthUserIdentity($eauth);

					//				var_dump($eauth->getIsAuthenticated(), $eauth->getAttributes());

					// Успешный вход
					if ($identity->authenticate()) {
						Yii::app()->user->login($identity);
						//var_dump($identity->id, $identity->name, Yii::app()->user->id);exit;

						// Save attributes of the VK.com to display it in layouts/main.php
						if ($eauth->serviceName == 'vkontakte') {
							$session = Yii::app()->session;
							$session['vk'] = $eauth->attributes;
						}

						// Специальный редирект с закрытием popup окна
						$eauth->redirect();
					}
					else {
						// Закрываем popup окно и перенаправляем на cancelUrl
						$eauth->cancel();
					}
				}

				// Что-то пошло не так, перенаправляем на страницу входа
				$this->redirect(array('site/login'));
			}
			catch (EAuthException $e) {
				Yii::app()->user->setFlash('error', 'EAuthException: '.$e->getMessage());

				// Закрываем popup окно и принудительно перенаправляем на cancelUrl
//				$eauth->cancel();
				$eauth->redirect($eauth->getCancelUrl());
			}
		}


		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}