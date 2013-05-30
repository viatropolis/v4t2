<?php class LanguageController extends Controller {
	
	public $langs = array("en"=>'English',"de"=>'Deutsch');
	
	public function __construct(){
    	parent::__construct($this->id, $this->module);
    }
	
	public function actionGet() {
		echo json_encode($this->langs);
	}
	
	public function actionSet($lc) {
		Yii::app()->request->cookies['dragonsinn_chat_lang'] = new CHttpCookie('dragonsinn_chat_lang', $lc);
	}
	
	public function actionDefault($return=false) {
		if(!$return) {
			if(isset($_COOKIE['dragonsinn_chat_lang']))
				echo $_COOKIE['dragonsinn_chat_lang'];
			else
				echo json_encode("en");
		} else { 
			if(isset($_COOKIE['dragonsinn_chat_lang']))
				return $_COOKIE['dragonsinn_chat_lang'];
			else
				return "en";
		}
	}

} ?>