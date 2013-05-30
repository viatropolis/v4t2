<?php

class YiiUser extends CActiveRecord {

	/**
	 * The followings are the available columns in table 'users':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $activkey
	 * @var integer $createtime
	 * @var integer $lastvisit
	 * @var integer $superuser
	 * @var integer $status
     * @var timestamp $create_at
     * @var timestamp $lastvisit_at
	**/
	
	public $id;
	public $user;
	public $superuser;
	public $role;
	 
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return Yii::app()->getModule('user')->tableUsers;
		#return '{{users}}';
	}

}