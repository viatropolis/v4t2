<?php class AJAXChatChannels extends CActiveRecord {

	// default functions...
	public static function model($className=__CLASS__) { return parent::model($className); }
	public function tableName() { return 'ajax_chat_channels'; }
	public function primaryKey() { return 'id'; }
	public function rules() {
		return array(
			array("name, orderID","required"),
			array("desc","safe")
		);
	}
	
	public $id;
	public $orderID=100;
	public $name;
	public $desc;

	public function attributeLabels() {
		return include(Yii::getPathOfAlias("mall.messages.".Yii::app()->language)."/main.php");
	}


} ?>