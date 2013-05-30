<?php class TransferController extends Controller {

	// access control
	public function filters() { return array( 'accessControl'); }
	public function accessRules() {
    	return array(
            array('allow',
                'actions'=>array('import','export'),
                'users'=>array('@'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

	public function actionImport() {
		#extract($_FILES); extract($_POST);
		if(!isset($_FILES['cbFile']) && !isset($_POST['multi'])) {
			$this->render("import");
		} else if(isset($_FILES['cbFile'])) {
			$data = unserialize(file_get_contents($_FILES['cbFile']['tmp_name']));
			$Cdata = array(); $res = array();
			if(!$_POST['multi']) { $Cdata[] = $data; } else { $Cdata = $data; }
			foreach($Cdata as $char) {
				$importer = new CharacterImporter();
				if(empty($char['species'])) $char['species']="UNKNOWN";
				$importer->attributes=$char;
				$importer->prepair();
				if($importer->validate()) {
					$importer->save();
				} else {
					echo "Error!! \n\n"; 
					var_dump($importer->errors); 
					die(); 
				}
				if(isset($importer->id))
					$res[]=$importer->id;
				else {
					die("\n\nNo ID was set.");
				}
				unset($importer);
			}
			foreach($res as $Pkey) {
				$impo = CharacterImporter::model()->findByPk($Pkey);
				$model = new Character("advanced");
				$model->scenario=3;
				$model->attributes=(array)$impo;
				$model->uID=Yii::app()->user->id;
				if(!$model->save()) {
					$this->render("importError",array("model"=>$model));
					die();
				} else {
					$impo->delete();
					$scc = true;
					unset($model);
				}
			}
			if($scc) { $this->render("importSuccess"); }
		} else throw new CException("o.o");
	}
	
	public function actionExport($id=null) {
		if($id=="ALL") {
			$chars = Character::model()->findAll();
			$file = serialize($chars);
			header('Content-Description: File Transfer');
   			header('Content-Type: application/octet-stream');
   			header('Content-Disposition: attachment; filename=Characters.cb');
   			header('Content-Transfer-Encoding: binary');
   			ob_clean();
   			flush();
   			echo $file;
   			exit;
   		} else if($id!=null) {
   			$char = Character::model()->findByPk($id);
			$file = serialize($chars);
			header('Content-Description: File Transfer');
   			header('Content-Type: application/octet-stream');
   			header('Content-Disposition: attachment; filename=Characters.cb');
   			header('Content-Transfer-Encoding: binary');
   			ob_clean();
   			flush();
   			echo $file;
   			exit;
   		} else throw new CException("No characterID specified!");
	}
	
} ?>