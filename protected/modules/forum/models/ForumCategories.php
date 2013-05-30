<?php class ForumCategories extends CActiveRecord {

	public $id;
	public $name;
	public $desc;
	public $boards; // @array-serialized num(topicID=>assoc(name,views,...)
	
	// default functions...
	public static function model($className=__CLASS__) { return parent::model($className); }
	public function tableName() { return '{{Fcategories}}'; }
	public function primaryKey() { return 'id'; }	
	public function rules() {
		return array(
			array('name','required'),
			array('desc','safe')
		);
	}
	public function attributeLabels() {
		return array(
			'name'=>Yii::t("forumModule.main","name"),
			'desc'=>Yii::t('forumModule.main',"desc")
		);
	}

} ?>