<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	
	<style type="text/css">
		#logo {
			float: left;
		}
		
		.user {
			float: right;
			padding: 10px 20px;
		}
		
		.user .photo {
			float: left;
		}
		
		.user .info {
			padding-left: 60px; 
			font-size: 80%;
		}
		
		.user .info p {
			margin: 0;
		}
		
		.user .info .name {
			font-size: 140%;
		}
	</style>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header" class="clearfix">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
		<?php		
			$session = Yii::app()->session;
			if (isset($session['vk'])) : ?>
		<div class="user clearfix">
			<?php $vk = $session['vk']; ?>
			<div class="photo">
				<a href="<?php echo $vk['url']; ?>">
				  <?php echo CHtml::image($vk['photo'], $vk['name']); ?>
				</a>
			</div>
			<div class="info">
				<p class="name"><?php echo CHtml::link($vk['name'], $vk['url']); ?></p>
				<p class="username">Username: <?php echo $vk['username']; ?></p>
				<p class="timezone">Timezone: <?php echo $vk['timezone']; ?></p>
			</div>
		</div>
		<?php endif; ?>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

<!-- GitHub.com --><a href="http://github.com/Nodge/yii-eauth"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://a248.e.akamai.net/assets.github.com/img/e6bef7a091f5f3138b8cd40bc3e114258dd68ddf/687474703a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f7265645f6161303030302e706e67" alt="Fork me on GitHub"></a><!-- /GitHub.com -->

</body>
</html>