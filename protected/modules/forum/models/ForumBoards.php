<?php class ForumBoards extends CActiveRecord {
	public $id;
	public $name;
	public $desc;

	// default functions...
	public static function model($className=__CLASS__) { return parent::model($className); }
	public function tableName() { return '{{Fboards}}'; }
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