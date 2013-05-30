<?php class SoundController extends Controller {

	public $soundpacks = array(
		'Default'=>array(
			"recive"=>'sound_1',
			"send"=>'sound_2',
			"enter"=>'sound_3',
			"leave"=>'sound_4',
			"chatbot"=>'sound_5',
			"error"=>'sound_6'
		),
		'DRE'=>array(
			"error"=>"Chatbot_Error",
			"chatbot"=>"Chatbot_Notice",
			"recive"=>"MSG_Receive",
			"send"=>"MSG_Sent",
			"enter"=>"USR_Login",
			"leave"=>"USR_Logout",
		)
	);
	
	public function actionAll() {
		echo json_encode($this->soundpacks);
	}
	
	public function actionPack($pname) {
		$sounds = $this->soundpacks[$pname];
		$name = $pname;
		$JSON=$sounds;
		$JSON["packName"]=$name;
		echo json_encode($JSON);
	}
	
	public function actionSave($pname) {
		Yii::app()->request->cookies["soundpickerPack"] = new CHttpCookie("soundpickerPack", $pname);
	}
	
	public function actionLoad() {
		if(isset($_COOKIE['soundpickerPack']))
			echo $_COOKIE['soundpickerPack'];
		else
			echo null;
	}

} ?>