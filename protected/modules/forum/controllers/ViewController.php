<?php class ViewController extends Controller {

	public function actionIndex() {
		#$model = ForumTopics::model()->findAll();
		$dp = ForumCategories::model()->findAll();
		$this->render('index',array('categories'=>$dp));
	}

	public function actionTopic($id) {
		$topic = ForumTopics::model()->findByPk($id);
		$posts = ForumPosts::model()->findAll("topicID=".$id);
		$this->render('topicView',array('topic'=>$topic,'posts'=>$posts));	
	}
	
	public function actionBoard($id) {
		$dp = ForumTopics::model()->findAll(array('condition'=>"boardID=:x", 'order'=>'sticky DESC, id DESC', 'params'=>array(":x"=>$id)));
		#print_r($dp);die();
		$b=ForumBoards::model()->findByPk($id);
		$this->render("boardView",array("topics"=>$dp,"b"=>$b));
	}

}