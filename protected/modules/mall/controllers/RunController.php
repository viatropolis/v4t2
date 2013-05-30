<?php
// Debug
ini_set('display_errors', 1);
error_reporting(E_ALL);
class RunController extends Controller {

	// access control
	public function filters() { return array( 'accessControl'); }
	public function accessRules() {
    	return array(
            array('allow',
                'actions'=>array('index'),
                'users'=>array('@'),
            ),
            array('deny',
                'actions'=>array('index'),
                'users'=>array('*'),
            ),
        );
    }

	
	// load the chat into Yii.
	public function actionIndex() {
		// Show all errors:
		error_reporting(E_ALL);
		// Path to the chat directory:
		define('AJAX_CHAT_PATH', Yii::getPathOfAlias("mall")."/");
		define('AJAX_CHAT_WEB', $this->module->assetsUrl);
		// Include custom libraries and initialization code:
		require(AJAX_CHAT_PATH.'lib/custom.php');
		// Include Class libraries:
		require(AJAX_CHAT_PATH.'lib/classes.php');
		// Initialize the chat:
		$ajaxChat = new CustomAJAXChat();
	}
	
}
