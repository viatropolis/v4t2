<?php class UploadController extends Controller {

	private $to;
	
	public function actionIndex() {
		if(!isset($_FILES['upd']))
			$this->render("upload");
		else {
			$path = Yii::getPathOfAlias("webroot.u");
			$newName = uniqid().".".pathinfo($_FILES['upd']['name'], PATHINFO_EXTENSION);
			if(!empty($_FILES['upd']['tmp_name']))
				move_uploaded_file($_FILES['upd']['tmp_name'], $path."/".$newName);
			else die("ERROR.");
			$this->render("uploaded",array('newName'=>$newName));
		}
	}

} ?>