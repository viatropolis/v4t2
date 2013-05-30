<?php class ThemepickerController extends Controller {

	public $themes = array();
	public $themeList=array();
	
	public function beforeAction($a) {
		$t = Themes::model()->findAll();
		// merge the drag0n theme into it.
		$t = array_merge(array(
			array(
				'id'=>'-1',
				'name'=>'Viatropolis',
				'gstart'=>null,
				'gend'=>null,
				'shadow'=>null
			)
		),$t);
		foreach($t as $theme) {
			$theme=(object)$theme;
			$this->themes[$theme->name] = array(
				'gstart'=>$theme->gstart,
				'gend'=>$theme->gend,
				'shadow'=>$theme->shadow
			);
			$this->themeList[$theme->id] = $theme->name;
		}
		return true;
	}
	
	public function actionSet($id,$for="site") {
		$baseSite = Yii::app()->theme->baseUrl."/css/drag0n.css.php";
		$baseChat = Yii::app()->getModule("chat")->assetsUrl."/css/drag0n.css.php";
		$theme = $this->themes[$this->themeList[$id]];
		if($this->themeList[$id]!="drag0n") {
			$query = "?";
			foreach($theme as $key=>$val) {
				if(!empty($val)) {
					$query .="$key=".urlencode($val)."&";
				}
			}
			if(!isset($theme['shadow'])) {
				$query .="shadow=$shd&";
			}
			$query = substr($query,0,-1);
			$stringSite = $baseSite.$query;
			$stringChat = $baseChat.$query;
		} else { 
			$stringSite = $baseSite;
			$stringChat = $baseChat;
		}
		Yii::app()->request->cookies["themepicker"] = new CHttpCookie("themepicker", $stringSite);
		Yii::app()->request->cookies["themepickerChat"] = new CHttpCookie("themepickerChat", $stringChat);
		Yii::app()->request->cookies["themepickerTheme"] = new CHttpCookie("themepickerTheme", $id);
		switch($for) {
			case "site": echo $stringSite; break;
			case "chat": echo $stringChat; break;
		}
	}
	
	public function actionGet() {
		echo json_encode($this->themeList);
	}
	
	public function actionDefault() {
		if(isset($_COOKIE["themepickerTheme"]))
			echo $_COOKIE["themepickerTheme"];
		else
			echo -1;
	}
	
} ?>