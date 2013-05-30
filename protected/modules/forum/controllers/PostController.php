<?php class PostController extends Controller {
	
	public function filters() { return array( 'accessControl'); }
	public function accessRules() {
    	return array(
            array('allow',
                'actions'=>array('answer','edit','delete'),
                'users'=>array('@'),
            ),
            array('deny',
                'actions'=>array("answer",'edit','delete'),
                'users'=>array('*'),
            ),
        );
    }

	public function actionAnswer($tid) {
		$post = new ForumPosts;
		$topic = ForumTopics::model()->findByPk($tid);
		if(!isset($_POST['ForumPosts'])) {
			$this->render("form",array("post"=>$post, 'topic'=>$topic));
		} else {
			$form = $_POST['ForumPosts'];
			$post->answer=$form['answer'];
			$post->writerID=Yii::app()->user->id;
			$post->topicID=$tid;
			$post->createdAt=time();
			if($post->save()) {
				$this->redirect(array("/forum/view/topic",'id'=>$tid));
			} else {
				$this->render("form",array("post"=>$post, 'topic'=>$topic));
			}
		}
	}

	public function actionEdit($id) {
		$post = ForumPosts::model()->findByPk($id);
		$topic = ForumTopics::model()->findByPk($post->topicID);
		if(!isset($_POST['ForumPosts'])) {
			$this->render("form",array("post"=>$post,'topic'=>$topic));
		} else {
			$form = $_POST['ForumPosts'];
			$post->answer=$form['answer'];
			$post->editedAt=time();
			$post->attributes=$_POST['ForumPosts'];
			if($post->update()) {
				$this->redirect(array("view/topic","id"=>$post->topicID));
			} else {
				$this->render("form",array("post"=>$post,'topic'=>$topic));
			}
		}
	}

	public function actionDelete($id,$tid) {
		$category = ForumPosts::model()->findByPk($id);
		if($post != null) {
			$post->delete();
			$this->redirect("/forum/view/topic",array('id'=>$tid));
		} else throw new CException("Could not delete.");
	}
	
} ?>