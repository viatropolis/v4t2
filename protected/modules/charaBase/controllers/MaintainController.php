<?php class MaintainController extends Controller {
	
	// access control
	public function filters() { return array( 'accessControl'); }
	public function accessRules() {
    	return array(
            array('allow',
                'actions'=>array('create','edit','delete'),
                'users'=>array('@'),
            ),
            array('deny',
                'actions'=>array('create','edit','delete'),
                'users'=>array('*'),
            ),
        );
    }
    
    // fun stuff
	public function actionCreate() {
		$model = new Character;
		if(!isset($_POST['Character'])) {
			Yii::app()->session['cpic'] = array();
			$this->render('form', array(
				'model'=>$model,
				'CBT'=>new CBTranslator,
			));
		} else {
			$data = $this->workout($model,$_POST,"save");
			if($data['success']==true){
				$this->render('created',array('model'=>$data['model']));
			} else {
				$this->render('form',array('model'=>$data['model'],'CBT'=>new CBTranslator));
			}
		}
	}
	
	public function actionEdit($ID) {
		$model = Character::model()->findByPk($ID);
		if(!isset($_POST['Character'])) {
			Yii::app()->session['cpic']=unserialize($model->cpic);
			$this->render('form', array(
				'model'=>$model,
				'CBT'=>new CBTranslator,
			));
		} else {
			$data = $this->workout($model,$_POST,"update");
			if($data['success']==true) {
				$this->render('created',array('model'=>$data['model']));
			} else {
				$this->render('form',array('model'=>$data['model'],'CBT'=>new CBTranslator));
			}
		}
	}
	
	public function actionDelete($ID,$delete=2) {
		$char = Character::model()->findByPk($ID);
		if($delete==2) {
			$this->render("delete",array('model'=>$char));
		} else {
			$pics = unserialize($char->cpic);
			foreach($pics as $pic) {
				$Cpic = CharacterPicture::model()->findByPk($pic);
				@unlink(Yii::getPathOfAlias("application.module.charaBase.cpic")."/".$char->cID."/".$Cpic->name);
				$Cpic->delete();
			}
			$char->delete();
			$this->redirect(array("/user/profile"));
		}
	}
	public function actionReset() { unset(Yii::app()->session['cpic']); echo "Unsettet CPIC session."; }
			
	private function workout($model,$POST,$type) { 
		$ps = $POST['Character']['scenario'];
		switch($ps) {
			case 0: $scenario = "pic-only"; break;
			case 1: $scenario = "simple"; break;
			case 2: $scenario = "detailed"; break;
			case 3: $scenario = "advanced"; break;
		}
		$model->scenario=$scenario;
		# self written mass assignment - it just works.
		foreach($POST['Character'] as $attribute=>$value) {
			$model->setAttribute($attribute,$value);
		}
		$model->uID = Yii::app()->user->id;
		$model->cpic = serialize(Yii::app()->session['cpic']);			
		unset(Yii::app()->session['cpic']);
		if($model->validate()) {
			$success=true;
			$cpath = Yii::getPathOfAlias("webroot.protected.modules.charaBase.cpic");
			$respath = $cpath.'/tmp/'.Yii::app()->session['cpicID']."/";
			$destpath = $cpath.'/'.$model->cID."/";
			@mkdir($destpath);
			$cmd = 'mv '.escapeshellarg($respath).'* '.escapeshellarg($destpath);
			system($cmd);
			$cmd = "rm -Rfd ".escapeshellarg($respath);
			system($cmd);
			unset(Yii::app()->session['cpicID']);
			
			$ACmsg = new AJAXChatMessages;
			if($type=="save"){
				$model->save();
				$ACmsg->chatbot('/charCrd '.json_encode(array(
					'user'=>Yii::app()->user->name,
					'uID'=>Yii::app()->user->id,
					'cID'=>$model->cID,
					'cname'=>$model->name
				)));
			} else if($type="update") {
				$model->update();
				$ACmsg->chatbot('/charUpd '.json_encode(array(
					'user'=>Yii::app()->user->name,
					'uID'=>Yii::app()->user->id,
					'cID'=>$model->cID,
					'cname'=>$model->name
				)));
			}
		} else die("Validation failed."); #$success=false;
		return array('model'=>$model,'success'=>$success);
	}
	
} ?>