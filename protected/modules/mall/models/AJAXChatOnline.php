<?php class AJAXChatOnline extends CActiveRecord {

	// default functions...
	public static function model($className=__CLASS__) { return parent::model($className); }
	public function tableName() { return 'ajax_chat_online'; }
	
	public $userID;
	public $userName;
	public $userRole;
	public $channel;
	public $dateTime;
	public $ip;

} ?>
