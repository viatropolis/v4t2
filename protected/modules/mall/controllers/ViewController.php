<?php class ViewController extends Controller {

	public function actionIndex($id) {
		$channel = AJAXChatChannels::model()->findByPk($id);
		$this->render("index",array("channel"=>$channel));
	}

} ?>