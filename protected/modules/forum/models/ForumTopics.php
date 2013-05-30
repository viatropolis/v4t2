<?php class ForumTopics extends CActiveRecord {

	public $id;
	public $boardID;
	public $creatorID;
	public $sticky;
	public $name;
	public $desc;
	public $views;
	public $firstPost;

	// default functions...
	public static function model($className=__CLASS__) { return parent::model($className); }
	public function tableName() { return '{{Ftopics}}'; }
	public function primaryKey() { return 'id'; }	
	public function rules() {
		return array(
			array('name','required'),
			array('desc, sticky','safe'),
			array("firstPost","required","on"=>"create")
		);
	}
	public function attributeLabels() {
		return array(
			'name'=>Yii::t("forumModule.main","name"),
			'desc'=>Yii::t('forumModule.main',"desc"),
			'firstPost'=>Yii::t("forumModule.main","firstPost"),
		);
	}

} ?>