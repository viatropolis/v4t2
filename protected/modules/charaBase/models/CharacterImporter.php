<?php class CharacterImporter extends CActiveRecord {
	
	// old DB variables
	public $id;
	public $name;
	public $category;
	public $species;
	public $sex;
	public $birthdate;
	public $placeofbirth;
	public $hair_c;
	public $hair_s;
	public $hair_l;
	public $eye_c;
	public $eye_s;
	public $desc;
	public $history;
	public $likes;
	public $dislikes;
	public $relationship;
	public $addit;
	public $created;
	
	public $birthday;
	public $birthPlace;
	public $addit_desc;
	public $position;
	public $orientation=0;
	public $scenario=3;
	public $relationships;
	
	public function rules() {
		return array(
			array('name, sex, orientation, species, category, position','required'),
			array(
				'name category, species, sex, birthday, birthdate, birthplace, placeofbirth,
				hair_c, hair_s, hair_l, eye_c, eye_s, desc, history, likes, dislikes, relationship, addit, created, 
				addit_desc','safe'
			)
		);
	}
	public static function model($className=__CLASS__) { return parent::model($className); }
	public function tableName() { return '{{charabaseImporter}}'; }
	public function primaryKey() { return 'id'; }	
	public function prepair() {
		$this->birthday = $this->birthdate;
		$this->birthPlace = $this->placeofbirth;
		$this->addit_desc = $this->desc."<br><br>".$this->addit;
		$this->relationships = $this->relationship;
		$this->position=0;
		switch($this->category) {
			case "English": $this->category=1;break;
			case "German": $this->category=2;break;
			default: $this->category=0;break;
		}
		
		unset($this->birthdate);
		unset($this->desc);
		unset($this->addit);
		unset($this->relationship);
		unset($this->placeofbirth);
	}
	
} ?>