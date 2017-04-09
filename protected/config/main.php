<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Yii EAuth extension demo',
	'theme'=>'classic',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.eoauth.*',
		'ext.eoauth.lib.*',
		'ext.eauth.*',
		'ext.eauth.services.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'eauth' => array(
			'class' => 'ext.eauth.EAuth',
			//'popup' => false,
			'services' => array(
				'google-oauth' => array(
					// register your app here: https://code.google.com/apis/console/
					'class' => 'GoogleOAuthService',
					'client_id' => '',
					'client_secret' => '',
					'title' => 'Google (OAuth2)',
				),
				'yandex-oauth' => array(
					// register your app here: https://oauth.yandex.ru/client/my
					'class' => 'YandexOAuthService',
					'client_id' => '',
					'client_secret' => '',
					'title' => 'Yandex (OAuth)',
				),
				'twitter' => array(
					// register your app here: https://dev.twitter.com/apps/new
					'class' => 'TwitterOAuthService',
					'key' => '',
					'secret' => '',
				),
				'linkedin' => array(
					// register your app here: https://www.linkedin.com/secure/developer
					'class' => 'LinkedinOAuthService',
					'key' => '',
					'secret' => '',
				),
				'facebook' => array(
					// register your app here: https://developers.facebook.com/apps/
					'class' => 'FacebookOAuthService',
					'client_id' => '',
					'client_secret' => '',
				),
				'yahoo' => array(
					'class' => 'YahooOpenIDService',
				),
				'steam' => array(
					'class' => 'SteamOpenIDService',
				),
				'live' => array(
					// register your app here: https://manage.dev.live.com/Applications/Index
					'class' => 'LiveOAuthService',
					'client_id' => '',
					'client_secret' => '',
				),
				'vkontakte' => array(
					// register your app here: https://vk.com/editapp?act=create&site=1
					'class' => 'VKontakteOAuthService',
					'client_id' => '',
					'client_secret' => '',
					'title' => 'VKontakte',
				),
				'mailru' => array(
					// register your app here: http://api.mail.ru/sites/my/add
					'class' => 'MailruOAuthService',
					'client_id' => '',
					'client_secret' => '',
				),
				'moikrug' => array(
					// register your app here: https://oauth.yandex.ru/client/my
					'class' => 'MoikrugOAuthService',
					'client_id' => '',
					'client_secret' => '',
					//'title' => 'Moi Krug',
				),
				'github' => array(
					// register your app here: https://github.com/settings/applications
					'class' => 'GitHubOAuthService',
					'client_id' => '',
					'client_secret' => '',
				),
				'odnoklassniki' => array(
                    // register your app here: http://www.odnoklassniki.ru/dk?st.cmd=appsInfoMyDevList&st._aid=Apps_Info_MyDev
                    'class' => 'OdnoklassnikiOAuthService',
                    'client_id' => '...',
                    'client_public' => '...',
                    'client_secret' => '...',
                    'title' => 'Odnokl.',
                ),
			),
		),
		'loid' => array(
			'class' => 'ext.lightopenid.loid',
		),
		'cache' => array(
			//'class' => 'CApcCache',
			'class' => 'CFileCache',
		),
		// uncomment the following to enable URLs in path-format
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => array(
				'' => 'site/index',
				'login/<service:(google|google-oauth|yandex|yandex-oauth|twitter|linkedin|vkontakte|facebook|steam|yahoo|mailru|moikrug|github|live|odnoklassniki)>' => 'site/login',
				'login' => 'site/login',
				'logout' => 'site/logout',
			),
		),
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);