<?php class ManageController extends Controller {

	/*public function filters() { return array( 'accessControl'); }
	public function accessRules() {
    	return array(
            array('deny',
                'actions'=>array('chat','blog','themes','sounds','chars'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions'=>array('chat','blog','themes','sounds','chars'),
                'users'=>array('@'),
            ),
        );
    }*/

	public function actionChat($do="view",$id=null) {
		DN::MakeBootstrap();
		$def = AJAXChatDefaults::model()->findByPk(0);
		$dp = new CActiveDataProvider("AJAXChatChannels",array(
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
		$model = new AJAXChatChannels;
		if($do=="view" || $do="add") {
			if(isset($_POST['AJAXChatChannels'])) {
				$model->attributes = $_POST['AJAXChatChannels'];
				if($model->save()) {
					$this->redirect("chat");
				}
			} else if(isset($_POST['AJAXChatDefaults'])) {
				$def->attributes = $_POST['AJAXChatDefaults'];
				#print_r($def);die();
				if($def->save()) {
					$this->redirect("chat");
				}
			}
		} else if($do="delete" && $id != null) {
			$model = AJAXChatChannels::model()->findByPk($id);
			if($model->save()) {
				$this->redirect("chat");
			}
		}
		$this->render("chat",array(
			"model"=>$model,
			'dp'=>$dp,
			'def'=>$def
		));
	}
	
	public function actionThemes() {
		DN::MakeBootstrap();
		$dp = new CActiveDataProvider("Themes",array(
			'pagination'=>array(
				'pageSize'=>50,
			),
		));
		$theme = new Themes;
		if(!isset($_POST['Themes'])) {
			$this->render("themes",array(
				'dp'=>$dp,
				'theme'=>$theme
			));
		} else {
			$theme->attributes=$_POST['Themes'];
			if(!isset($theme->shadow) || empty($theme->shadow)) {
				$theme->shadow=$theme->gstart;
			}
			if($theme->save()) {
				$this->redirect("themes");
			} else {
				$this->render("themes",array(
					'dp'=>$dp,
					'theme'=>$theme
				));
			}
		}
	}
	
	public function actionBlog() {
		$dp = new CActiveDataProvider("Blog",array(
			'criteria'=>array(
				'order'=>'id DESC'
			),
			'pagination'=>array(
				'pageSize'=>50,
			),
		));
		$this->render("blog",array('dp'=>$dp));
	}
	
	public function actionSounds() {
		echo "wip";
	}
	
	public function actionChars() {
		echo "wip";
	}

} ?>