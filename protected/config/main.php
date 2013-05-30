<?php

// uncomment the following to define a path alias
//Yii::setPathOfAlias('bootstrap',Yii::getPathOfAlias("ext.bootstrap"));


// Debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>"Viatropolis",
	'theme'=>'drag0n',
	'sourceLanguage'=>'00',
	'language' => 'en',
	'defaultController'=>'Viatropolis',

	// preloading 'log' component
	'preload'=>array('log','less'), // 'bootstrap'

	// autoloading model and component classes
	'import'=>array(
		'application.modules.user.components.*',
		'application.modules.user.models.*',
		'application.models.*',
		'application.components.*',
		'application.controllers.*',
		'application.modules.charabase.*',
		'application.modules.charaBase.models.*',
		'application.modules.charaBase.components.*',
		'application.modules.mall.models.*',
		'application.modules.forum.models.*',
		'application.modules.charaBase.*',
	),
		
	'modules'=>array(
		//Singletons...
		'charaBase',
		'mall',
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'blauerblitz',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
            	'bootstrap.gii',
            ),
		),
		'user'=>array(
            # encrypting method (php hash function)
            'hash' => 'md5',
            # send activation email
            'sendActivationMail' => true,
            # allow access for non-activated users
            'loginNotActiv' => true,
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
            # automatically login from registration
            'autoLogin' => false,
            # registration path
            'registrationUrl' => array('/user/register'),
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
            # login form path
            'loginUrl' => array('/user/login'),
            # page after login
            'returnUrl' => array('/mall'),
            # page after logout
            'returnLogoutUrl' => array('/Viatropolis/index'),
        ),
		'hybridauth'=>array(
       		"baseUrl" => "http://".$_SERVER['SERVER_NAME']."/TEST/webroot/hybridauth/", 
			'withYiiUser' => true,
        	"providers" => array ( 
          		// openid providers
		        "OpenID" => array("enabled" => true),
        	    "Yahoo" => array ("enabled" => true),
		        "AOL"  => array ("enabled" => false),
        		"Google" => array ( 
        			"enabled" => false,
 		       		"keys"    => array ("id" => "", "secret" => "" ),
 		   	   		"scope"   => ""
           		),
  		      	"Facebook" => array ( 
  		   			"enabled" => true,
    	   			"keys"    => array ( "id" => "359491234141565", "secret" => "8b919bfb3f214d903a918362ef5cb681" ),
					// A comma-separated list of permissions you want to request from the user. See the Facebook docs for a full list of available permissions: http://developers.facebook.com/docs/reference/api/permissions.
        			"scope"   => "email,publish_stream", 
					// The display context to show the authentication page. Options are: page, popup, iframe, touch and wap. Read the Facebook docs for more details: http://developers.facebook.com/docs/reference/dialogs#display. Default: page
               		"display" => "page" 
    	        ),
           		"Twitter" => array ( 
               		"enabled" => false,
               		"keys"    => array ( "key" => "rPmGEE1Wvsf56BSyQaWXw", "secret" => "V4SK09O0cPOgkabsxR5AruBSNrc0b1tzoBeWkL7ew0" ) 
           		),
           		// windows live
           		"Live" => array ( 
               		"enabled" => false,
           			"keys"    => array ( "id" => "", "secret" => "" ) 
           		),
           		"MySpace" => array ( 
               		"enabled" => false,
               		"keys"    => array ( "key" => "", "secret" => "" ) 
           		),
           		"LinkedIn" => array ( 
               		"enabled" => false,
               		"keys"    => array ( "key" => "", "secret" => "" ) 
           		),
           		"Foursquare" => array (
               		"enabled" => false,
               		"keys"    => array ( "id" => "", "secret" => "" ) 
           		),
        	),
    	),
    	'mailbox'=>array( # http://www.yiiframework.com/extension/mailbox/
			'userClass' => 'User',
    		'userIdColumn' => 'id',
    		'usernameColumn' =>  'username',
    		'pageSize'=>50,
    		'userToUser'=>true,
    		'sendMsgs'=>true,
    		'sentbox'=>true,
    		'dragDelete'=>true,
    		'confirmDelete'=>1,
    		'recipientRead'=>true,
    		#'cssFile'=>'/css/msg.css'
    		#'menuPosition'=>'top',
    		'juiThemes'=>'widget',
    		'juiButtons'=>true,
    		'juiIcons'=>true,
    		'defaultSubject'=>"New Message...",
    		'editToField'=>true,
    		'linkUser'=>true,
    		#'newsUserId'=>1 <- must find out mine.	
      	),
      	#'forum'=>array(
		#	'class'=>'application.modules.yii-forum.YiiForumModule',		
		#	'dateReplaceWords'=>true,
		#	'threadsPerPage'=>20,
		#),
		'forum',
	),

	// application components
	'components'=>array(
		/*'cache'=>array(
            'class'=>'system.caching.CMemCache',
            'servers'=>array(
                array('host'=>'localhost', 'port'=>11211, 'weight'=>60),
            ),
        ),*/
		'widgetFactory'=>array(
			 'widgets'=>array(
				'CGridView'=>array(
					'cssFile'=>false
				),
				'CDetailView'=>array(
					'cssFile'=>false,
				),
				'GroupGridView'=>array(
					'cssFile'=>false
				),
			),
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>array('user/login'),
			#'logoutUrl'=>array("/main/index"),
		),
		// uncomment the following to enable URLs in path-format
		'coreMessages'=>array('basePath'=>'protected/messages'),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'char/<ID:\d+>'=>'charaBase/view/char',
				'chars'=>'charaBase/view/list',
				'chars/<uID:\d+>'=>'charaBase/view/list',
				'cpic/<ID:\d+>/<pid:\d+>'=>'charaBase/cpic/view',
				'Viatropolis/info/<p:\w+>'=>'Viatropolis/info',
				'user/<id:\d+>'=>'user/user/view',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=viatrop_ajaxchat2',
			'emulatePrepare' => true,
			'username' => 'viatrop_ajaxchat', #db username goes here
			'password' => '481592673', #db password goes here
			'charset' => 'utf8',
			'tablePrefix'=>'tbl_',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'Viatropolis/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				#array('class'=>'CWebLogRoute'),
			),
		),
    	'less'=>array(
	        'class'=>'ext.less.components.LessCompiler',
    	    'forceCompile'=>false, // indicates whether to force compiling
        	'paths'=>array(
            	'less/style.less'=>'css/style.css',
        	),
    	),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'info@viatropolis.com',
	),
);
