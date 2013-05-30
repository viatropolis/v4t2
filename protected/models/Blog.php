<?php class Blog extends CActiveRecord {

	public static function model($className=__CLASS__) { return parent::model($className); }
	public function tableName() { return '{{blog}}'; }
	public function primaryKey() { return 'id'; }
	public function rules() {
		return array(
			array('title, content','required'),
			array('modified','safe')
		);
	}

	public $id;
	public $author;
	public $modified;
	public $tags="me,gusta";
	public $title;
	public $content;
	public $hasTopic=false;
	public $postID=0;
	public $topicID=0;

} ?>