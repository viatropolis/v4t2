<?php class ViatropolisController extends Controller {

	public function init() {
		parent::init();
		DN::MakeBootstrap();
	}

	public function actionIndex() {
		$blog = new CActiveDataProvider("Blog",array(
			'criteria'=>array(
				'order'=>'id DESC'
			),
			'pagination'=>array(
				'pageSize'=>10
			)
		));
		$chars = new CActiveDataProvider("Character",array(
			'criteria'=>array(
				'order'=>'cID DESC',
				'offset'=>0,
				'limit'=>30,
			),			
		));
		$this->render("/Viatropolis/"."all",array(
			"blog"=>$blog,
			'chars'=>$chars
		));	
	}
	
	public function actionView($id) {
		$blog = new CActiveDataProvider("Blog",array(
			'criteria'=>array(
				'condition'=>'id='.$id
			),
			'pagination'=>array(
				'pageSize'=>10
			)
		));
		$chars = new CActiveDataProvider("Character",array(
			'criteria'=>array(
				'order'=>'cID DESC',
				'offset'=>0,
				'limit'=>20,
			),			
		));
		$this->render("/Viatropolis/"."all",array(
			"blog"=>$blog,
			'chars'=>$chars
		));	
	}
	
	public function actionEdit($id) {
		$blog = Blog::model()->findByPk($id);
		if(!isset($_POST['Blog'])) {
			$this->render("/Viatropolis/"."form",array("blog"=>$blog));
		} else {
			$blog->attributes=$_POST['Blog'];
			$blog->modified=time();
			
			$topic = ForumTopics::model()->findByPk($blog->topicID);
			$topic->name =$_POST['Blog']['title'];
			
			$post = ForumPosts::model()->findByPk($blog->postID);
			$post->editedAt=date("d.m.Y H:i");
			$post->answer=$_POST['Blog']['content'];

			if($blog->update() && $topic->update() && $post->update()) {
				$blog->postID=$post->id;
				$blog->topicID=$topic->id;
				if(!$blog->update()) die("cant update blogpost");
				$this->redirect(array('/Viatropolis/view','id'=>$blog->id));
			} else
				$this->render("/Viatropolis/"."form",array("blog"=>$blog));
		}
	}

	public function actionCreate() {
		$blog = new Blog;
		if(!isset($_POST['Blog'])) {
			$this->render("/Viatropolis/"."form",array("blog"=>$blog));
		} else {
			$blog->attributes=$_POST['Blog'];
			$blog->modified=time();
			$blog->author = Yii::app()->user->id;
			$blog->hasTopic=true;
			
			$topic = new ForumTopics;
			$topic->boardID=1;
			$topic->name =$_POST['Blog']['title'];
			$topic->desc = null;
			$topic->creatorID = Yii::app()->user->id;
			
			if($blog->save() && $topic->save()) {
				$post = new ForumPosts;
				$post->topicID=$topic->id;
				$post->writerID=Yii::app()->user->id;
				$post->createdAt=date("d.m.Y H:i");
				$post->answer=$_POST['Blog']['content'];
				$post->isBlog=true;
				$post->blogID=$blog->id;
				if($post->save()) {
					$blog->postID=$post->id;
					$blog->topicID=$topic->id;
					if(!$blog->update()) die("cant update blogpost");
					$this->redirect(array('/Viatropolis/view','id'=>$blog->id));
				} else
					die("Error saving post.");
			} else {
				$this->render("/Viatropolis/"."form",array("blog"=>$blog));
			}
		}
	}

	
	public function actionDelete($id) {
		$blog = Blog::model()->findByPk($id);
		if($blog->delete()) {
			$this->redirect("/Viatropolis/index");
		} else throw new CExeption("Could not delete post.");
	}

	public function actionError() {
		if($error=Yii::app()->errorHandler->error) {
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render("/Viatropolis/".'error', $error);
		}
	}
	
	public function actionInfo($p) {
		$this->render("/Viatropolis/".$p);
	}

	
} ?>