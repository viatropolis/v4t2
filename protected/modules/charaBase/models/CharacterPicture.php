<?php class CharacterPicture extends CActiveRecord {

	// default functions...
	public static function model($className=__CLASS__) { return parent::model($className); }
	public function tableName() { return '{{charabasePictures}}'; }
	public function primaryKey() { return 'id'; }
	public function rules() {
		return array(
			array('name,url,desc','safe')
		);
	}
	/*
		@var (pk) int(11) id
		@var int(11) cID
		@var varchar(255) name
		@var text desc
	*/
	
	public $id;
	public $name;
	public $url;
	public $desc;

} ?>