<?php class TopicController extends Controller {
	
	public function filters() { return array( 'accessControl'); }
	public function accessRules() {
    	return array(
            array('allow',
                'actions'=>array('create','edit','delete'),
                'users'=>array('@'),
            ),
            array('deny',
                'actions'=>array("create",'edit','delete'),
                'users'=>array('*'),
            ),
        );
    }

	public function actionCreate($bid) {
		$topic = new ForumTopics("create");
		if(!isset($_POST['ForumTopics'])) {
			$this->render("form",array("topic"=>$topic));
		} else {
			$topic->attributes=$_POST['ForumTopics'];
			$topic->boardID=$bid;
			if(isset($_POST['ForumTopics']['sticky']))
				$topic->sticky=true;
			else
				$topic->sticky=false;
			if($topic->save()) {
				$post = new ForumPosts;
				$post->topicID=$topic->id;
				$post->writerID=Yii::app()->user->id;
				$post->answer=$_POST['ForumTopics']['firstPost'];
				$post->save();
				$this->redirect(array("view/topic","id"=>$topic->id));
			} else {
				$this->render("form",array("topic"=>$topic));
			}
		}
	}

	public function actionEdit($id) {
		$topic = ForumTopics::model()->findByPk($id);
		if(!isset($_POST['ForumTopics'])) {
			$this->render("form",array("topic"=>$topic));
		} else {
			$_POST['ForumTopics']['sticky']=$_POST['ForumTopics']['sticky'][0];
			$topic->attributes=$_POST['ForumTopics'];
			#print_r($topic);die();
			if($topic->update()) {
				$this->redirect(array("view/topic","id"=>$topic->id));
			} else {
				$this->render("form",array("topic"=>$topic));
			}
		}
	}

	public function actionDelete($id) {
		$topic = ForumTopics::model()->findByPk($id);
		$posts = ForumPosts::model()->findAll(array("condition"=>"topicID=:x","params"=>array(":x"=>$id)));
		if($topic != null) {
			foreach($posts as $post) { $post->delete(); }
			$topic->delete();
			$this->redirect("/view/index");
		} else throw new CException("Could not delete board.");
	}
	

	
} ?>