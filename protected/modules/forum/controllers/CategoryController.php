<?php class CategoryController extends Controller {
	
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

	public function actionCreate() {
		$category = new ForumCategories;
		if(!isset($_POST['ForumCategories'])) {
			$this->render("form",array("category"=>$category));
		} else {
			$category->attributes=$_POST['ForumCategories'];
			if($category->save()) {
				$this->redirect(array("view/index"));
			} else {
				$this->render("form",array("category"=>$category));
			}
		}
	}

	public function actionEdit($id) {
		$category = ForumCategories::model()->findByPk($id);
		if(!isset($_POST['ForumCategories'])) {
			$this->render("form",array("category"=>$category));
		} else {
			$category->attributes=$_POST['ForumCategories'];
			if($category->save()) {
				$this->redirect(array("view/category","id"=>$category->id));
			} else {
				$this->render("form",array("category"=>$category));
			}
		}
	}

	public function actionDelete($id) {
		$category = ForumCategories::model()->findByPk($id);
		$bIDs = unserialize($category->boards);
		foreach($bIDs as $bID) {
			$board = ForumBoards::model()->findByPk($bID);
			$topics = ForumTopics::model()->findAll("boardID=".$board->id);
			foreach($topics as $t) { 
				$posts = ForumPosts::model()->findAll("topicID=".$t->id);
				foreach($posts as $p) { $p->delete(); }
				$t->delete(); 
			}
			$board->delete();
		}
		if($category != null) {
			$category->delete();
			$this->redirect("/forum/view/index");
		} else throw new CException("Could not delete.");
	}
	
} ?>