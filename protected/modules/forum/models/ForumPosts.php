<?php class ForumPosts extends CActiveRecord {
	
	public $id;
	public $topicID;
	public $writerID;
	public $createdAt;
	public $editedAt;
	public $answer;
	public $isBlog=false;
	public $blogID;
	
	// default functions...
	public static function model($className=__CLASS__) { return parent::model($className); }
	public function tableName() { return '{{Fposts}}'; }
	public function primaryKey() { return 'id'; }	
	public function rules() {
		return array(
			array('answer','required')
		);
	}
	public function attributeLabels() {
		return array(
			'answer'=>Yii::t('forumModule.main',"answer")
		);
	}

} ?>