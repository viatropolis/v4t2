<?php class ShoutboxController extends Controller {

	public function actionIndex() {
		$path=Yii::getPathOfAlias("chat")."/";
		define("AJAX_CHAT_PATH",$path);
		$url = "/chat/run/";
		define("AJAX_CHAT_URL",$url);
		if (is_file(AJAX_CHAT_PATH . 'lib/classes.php')) {
			include(AJAX_CHAT_PATH.'lib/classes.php');
			$ajaxChat = new CustomAJAXChatShoutBox;
			echo $ajaxChat->getShoutBoxContent();
		}
	}

} ?>