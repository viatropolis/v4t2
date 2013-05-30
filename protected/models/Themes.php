<?php class Themes extends CActiveRecord {

	public static function model($className=__CLASS__) { return parent::model($className); }
	public function tableName() { return '{{themes}}'; }
	public function primaryKey() { return 'id'; }
	public function rules() {
		return array(
			array("name, gstart, gend","required"),
			array('shadow','safe')
		);
	}

	public $id;
	public $name;
	public $gstart;
	public $gend;
	public $shadow;

} ?>