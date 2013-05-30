<?php class AJAXChatDefaults extends CActiveRecord {

	// default functions...
	public static function model($className=__CLASS__) { return parent::model($className); }
	public function tableName() { return 'ajax_chat_defaults'; }
	public function primaryKey() { return 'PK'; }
	public function rules() {
		return array(
			array("adminChannels, userChannels","required"),
		);
	}

	public $adminChannels; // serialized array
	public $userChannels; // serialized array

} ?>