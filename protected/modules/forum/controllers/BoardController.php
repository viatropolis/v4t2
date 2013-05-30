<?php class BoardController extends Controller {
	
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

	public function actionCreate($id) {
		$board = new ForumBoards;
		$category = ForumCategories::model()->findByPk($id);
		if(!isset($_POST['ForumBoards'])) {
			$this->render("form",array("board"=>$board));
		} else {
			$board->attributes=$_POST['ForumBoards'];
			if($board->save()) {
				if(($cboards = unserialize($category->boards)) != false) {
					if(!in_array($board->id,$cboards)) {
						$cboards[]=$board->id;
						$category->boards=serialize($cboards);
						$category->update();
					}
				} else {
					$category->boards=serialize(array($board->id));
					$category->update();
				}
				$this->redirect(array("view/board","id"=>$board->id));
			} else {
				$this->render("form",array("board"=>$board));
			}
		}
	}

	public function actionEdit($id) {
		$board = ForumBoards::model()->findByPk($id);
		if(!isset($_POST['ForumBoards'])) {
			$this->render("form",array("board"=>$board));
		} else {
			$category->attributes=$_POST['ForumBoards'];
			if($category->save()) {
				$this->redirect(array("view/board","id"=>$board->id));
			} else {
				$this->render("form",array("board"=>$board));
			}
		}
	}

	public function actionDelete($id) {
		$board = ForumBoards::model()->findByPk($id);
		if($board != null) {
			$board->delete();
			$this->redirect("/view/index");
		} else throw new CException("Could not delete board.");
	}
	
} ?>