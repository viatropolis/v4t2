<?php class ViewController extends Controller {
	public $defaultAction = "list";
	public function actionChar($ID) {
		$model = Character::model()->findByPk($ID);
		if(isset($model)) {
			$this->render("char",array("model"=>$model,'CBT'=>new CBTranslator));
		} else throw new CException("Character not found.");
	}

	public function actionList($uID=null) {
		$model = new Character('search');
		if($uID!=null) {
			$model->uID=$uID;
			$model->search();
		}
	    if(isset($_GET['Character'])){
	        $model->attributes=$_GET['Character'];
			if($uID!=null) { $model->uID=$uID; }
	    }
	    $this->render('list', array(
	        'model'=>$model,
	        'CBT'=>new CBTranslator
	    ));
	}
} ?>