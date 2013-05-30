<?php 
	// Debug
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
class cpicController extends Controller {
    
    private $data=null;
    private $fullPath;
    private $id;
    private $realPath;
        
	public function beforeAction($a) {
		if(!isset(Yii::app()->session['cpicID'])) Yii::app()->session['cpicID'] = uniqid();
		$this->data = Yii::app()->session['cpic'];
		$this->id = Yii::app()->session['cpicID'];
		$this->fullPath = Yii::getPathOfAlias("webroot.protected.modules.charaBase.cpic")."/tmp/".$this->id."/";
		$this->realPath = Yii::getPathOfAlias("webroot.protected.modules.charaBase.cpic");
		@mkdir($this->fullPath,0777,true);
		return true;
	}		    	
        
    public function actionList() { $this->outcome(); }
    
    public function actionView($pid,$ID=null) {
    	$Cpic = CharacterPicture::model()->findByPk($pid);
    	$path = Yii::getPathOfAlias("charaBase.cpic");
    	$tmpFile = $path."/tmp/".$this->id."/".$Cpic->name;
    	if(!empty($ID)) $realFile = $path."/".$ID."/".$Cpic->name; else $realFile=null;
    	#echo $realFile;
    	if(file_exists($tmpFile)) {
    		$this->display($tmpFile);
    	} else if(file_exists($realFile)) {
    		$this->display($realFile);
    	} else $this->reject("404, File not found.");
    }
    private function display($file){
    	header("Content-type: ".mime_content_type($file));
    	readfile($file);
    }
    
    public function actionSave() {
    	$cpic = $_FILES['cpic'];
    	if($cpic['error'] == 0) {
    		if(move_uploaded_file($cpic['tmp_name'],$this->fullPath.$cpic['name'])) {
#	    		$Cpic = CharacterPicture::model()->find("name='".$cpic['name']."'");
 #   			if(is_null($Cpic)) {
    				unset($Cpic);
    				$Cpic = new CharacterPicture;
    				$Cpic->name=$cpic['name'];
    				$Cpic->url=urlencode($cpic['name']);
    				$Cpic->save();
    				$this->data[]=$Cpic->id;
			    	$this->dump();
    				$this->outcome();
  #  			} else $this->reject("File exists!");
    		} else $this->reject("Could not save file.");
    	} else $this->reject("Upload failed with errorcode: ".$cpic['error']);
    }
    
    public function actionSess() { 
    	var_dump(Yii::app()->session['cpic_old']); 
    	var_dump(Yii::app()->session['cpic']); 
    	var_dump($this->data);
    }
    
    public function actionDelete($pid,$ID=null) {
    	$Cpic = CharacterPicture::model()->findByPk($pid);
    	if(!is_null($Cpic)) {
    		if(!is_null($ID)) {
    			@unlink(	Yii::getPathOfAlias("charaBase.cpic.".$ID)."/".$Cpic->name );
    		} else {
    			@unlink(	Yii::getPathOfAlias("charaBase.cpic.tmp")."/".$this->id."/".$Cpic->name );
    		}
    		$Cpic->delete();
    	} #else $this->reject("File not exist.");

		$found = false;
   		foreach($this->data as $key=>$nr) {
   			if($nr==$pid) {
   				unset($this->data[$key]);
				$this->dump();
   				$this->say("Complete!");
   				$found = true; 
   				break;
   			}
   		}
   		
   		if(!$found) $this->reject("Unable!");
    }
    
    public function actionDesc() {
		if(isset($_POST['input'])) {
			$Cpic = CharacterPicture::model()->findByPk($_POST['pid']);
			$Cpic->desc = $_POST['input'];
			if($Cpic->isNewRecord)
				$Cpic->save();
			else
				$Cpic->update();
			$this->outcome();
		} else $this->reject("No input given.");	
    }
    
    private function dump() { Yii::app()->session['cpic'] = $this->data; }
    private function say($msg) { echo json_encode(array('error'=>false,'msg'=>$msg)); }
    private function reject($msg) {	echo json_encode(array('error'=>TRUE,'msg'=>$msg)); }
    private function outcome() { 
    	echo json_encode($this->data);
	}

} ?>
