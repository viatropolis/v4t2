<?php class Character extends CActiveRecord {	
	
	/*
		@var int {unique pk} cID
		@var int uID
		@var string name
		@var string nickName
		@var int category
		@var int position
		@array-serialized numeric(N=>assoc(desc=>desc,img=>url)) cpic
		
		CASUAL								APPEARANCE
		@var string birthday				@var string makeup
		@var string birthPlace				@var string clothing
		@var int sex						@var bool addit_appearance
		@var int orientation				@var text addit_appearance_desc
		@var string species
		
		BODY 								BODY->EYES
		@var string height					@var string eye_c
		@var string weight					@var string eye_s
		
		BODY->HAIR							DESC
		@var string hair_c					@var text history
		@var string hair_s					@var text likes
		@var string hair_l					@var text dislikes
											@var text addit_desc
											@var text relationships
		
		RELATIONSHIP
		@array-serialized assoc( name=>assoc( desc=>desc, depicPage=>url, memberList=>url ) ) family | makotoExtension::getFamily
		@array-serialized assoc(name=>url) partners (Mates,wife/husband,etc.) | makotoExtension::getPartners
		@array-serialized assoc(name=>url) pets | makotoExtension::getPets
		@array-serialized assoc(name=>url) slaves | makotoExtension::getSlaves
		@array-serialized assoc(name=>url) master | makotoExtension::getMaster (will return array anyway, even if only one master.)
		
		RELATIONSHIPS_EXTRA
		@array-serialized assoc(name=>desc) forms | makotoExtension::getForms
		@array-serialized assoc(name=>desc) clan | makotoExtension::getClan
		
		ADULT
		@var int ds (dominant/submissive)
		@text prefs
		@var bool addit_adult
		
		SPIRIT
		@var bool status (dead,alive)
		@var int condition (healthy,ill,dramatic)
		@var int alignment (good,neutral,evil)
		@var int sub_alignment (lawful,middle,chaotic)
		@var int type (light,twilight,dark)
		@var string death_date
		@var string death_cause
		@var string death_place
	*/
	/* Scenarios:
		pic-only
			name, sex, orientation, cpic
			
		simple:
			name, sex, orientation, height, weight, history, cpic
			
		detailed:
			name, sex, orientation, height, weight, history, likes, dislikes, relationships,
			nickName, dom_sub, prefs, addit_adult, addit_adult_desc, cpic
			
		advanced:
			name, sex, orientation, height, weight, history, likes, dislikes, relationships
			eye_c, eye_s, hair_c, hair_s, hair_l,
			clothing, makeup, addit_appearance, addit_appearance_desc
			dom_sub, prefs, addit_adult, addit_adult_desc
	*/
	
	public $cID;
	public $uID;
	public $name;
	public $nickName;
	public $sex;
	public $orientation;
	public $species;
	public $category;
	public $position;
	public $scenario;
	public $cpic;

	public $birthday;
	public $birthPlace;

	public $height;
	public $weight;
	public $eye_c;
	public $eye_s;
	public $hair_c;
	public $hair_s;
	public $hair_l;

	public $makeup;
	public $clothing;
	public $addit_appearance;
	
	public $history;
	public $likes;
	public $dislikes;
	public $addit_desc;
	public $relationships;
	
	/*
	public $family;
	public $partners;
	public $pets;
	public $slaves;
	public $master;
	public $clan;
	public $forms;
	*/

	public $dom_sub;
	public $prefs;
	public $addit_adult;
	
	public $spirit_status;
	public $spirit_condition;
	public $spirit_alignment;
	public $spirit_sub_alignment;
	public $spirit_type;
	public $spirit_death_date;
	public $spirit_death_cause;
	public $spirit_death_place;
		
	public function rules() {
		return array(
			array('name, sex, orientation, species, category, position','required'),
			array('height, weight, history, likes, dislikes', 'safe', 'on'=>'simple'),
			array(
				'height, weight, history, likes, dislikes, relationships, 
				nickName, dom_sub, prefs, addit_adult', 'safe', 'on'=>'detailed'
			),
			array(
				'orientation, birthPlace, birthday,
				height, weight, clothing, makeup, addit_appearance,
				eye_c, eye_s, hair_c, hair_l, hair_s,
				history, likes, dislikes, addit_desc,
				relationships,
				dom_sub, prefs, addit_adult,
				spirit_status, spirit_condition, spirit_alignment, spirit_sub_alignment, spirit_type, 
				spirit_death_date, spirit_death_cause, spirit_death_place', 'safe', 'on'=>'advanced'
			),
			array('spirit_death_date,birthday','date','on'=>'detailed,advanced'),
			array('scenario,cpic,nickName','safe'),
			//array('family, partners, pets, slaves, master, forms, clan',) <- will be edited....
		);
	}

	public function search() {
    	$criteria = new CDbCriteria;
    	$criteria->compare('uID', $this->uID);
    	$criteria->compare('name', $this->name, true);
    	$criteria->compare('species', $this->species, true);
    	$criteria->compare('sex', $this->sex, true);
    	$criteria->compare('orientation', $this->orientation, true);
    	$criteria->compare('position', $this->position, true);

    	/*
    	* ------now the data provider---------
    	*/
    	return new CActiveDataProvider($this, array(
    	    'criteria' => $criteria,
        	'pagination' => array(
            	'pageSize' => 20,
            ),
			'sort'=>array(
            	'defaultOrder'=>'cID DESC',
        	),	    
        ));
	}

		
	// default functions...
	public static function model($className=__CLASS__) { return parent::model($className); }
	public function tableName() { return '{{charabase}}'; }
	public function primaryKey() { return 'cID'; }
#	public function afterFind() { if(!empty($this->cpic)) { $this->cpic = unserialize($this->cpic); } parent::afterFind(); }
	public function attributeLabels() {
		return include(Yii::getPathOfAlias("charaBase.messages.".Yii::app()->language)."/cb.php");
	}		
} ?>