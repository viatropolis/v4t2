<?php class Coupon extends CActiveRecord {

	public static function model($className=__CLASS__) { return parent::model($className); }
	public function tableName() { return '{{coupon}}'; }
	public function primaryKey() { return 'id'; }	
	public function rules() {
		return array(
			array('company', 'required'),
			array('id, status', 'unsafe'), # prevent ->attributes=$_POST manipulation
		);
	}

	public $id; # PK
	public $company;
	public $slots;
	public $status;
	
	public $users=array(); // { name:ActiveRecord(User) }
	
	public function uniqueString($length=20) {
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
				."abcdefghijklmnopqrstuvwxyz"
				."01234567890"
				."?!.,;:-=<>";
		$str = "";
		for($i=0; $i<$length; $i++) {
			$str .= $chars[mt_rand(0, strlen($chars))];
		}
		return $str;
	}
	
	public function beforeSave() {
		$this->id = $this->uniqueString();
		parent::beforeSave();
	}
	
	public function afterFind() {
		$users = User::model()->findByAttributes(array(
			"couponCode" => $this->id
		));
		foreach($users as $user) $this->users[$user->username]=$user;
		parent::afterFind();
	}

} ?>