<?php

// constantfull classes:
class SEX {
 	const MALE=100; 		const FEMALE=200;
	const HERM=300; 		const MALE_HERM=301; 	const FEMALE_HERM=302;
	const SHEMALE=400; 		const CUNT_BOY=401;
	const GENDERLESS=500; 	const GENDER_SHIFTER=501;
}

class ATTD {
	const GOOD=10; 		const NEUTRAL=11; 	const BAD=12;
	const LAWFUL=220; 	const MIDDLE=221; 	const CHAOTIC=222;
	const LIGHT=30; 	const TWILIGHT=31; 	const DARK=32;
}

class charData_template {
	// Basic
	var $name;
	var $ID;
	var $category;
	var $position;
	
	public function __construct() {
		$l1 = array( "pic","casual","appearance","body","desc","relationship","relationship_extra","adult","spirit" );
		foreach($l1 as $obj) { 
			$this->$obj();
		}
	}
		
	//  Character detail creation
	public function pic() {
		$this->pic->avvie=NULL;
		$this->pic->solo=NULL;
		$this->pic->featured=NULL;
	}
	
	public function casual() {
		$this->casual->birthday=NULL;
		$this->casual->birthplace=NULL;
	}
	
	public function appearance() {
		$this->appearance->clothing=NULL;
		$this->appearance->makeup=NULL;
		$this->appearance->additional = FALSE;
		$this->appearance->addit_desc=NULL;
	}
	
	public function body() {
		$this->body->sex=NULL;
		$this->body->species=NULL;
		$this->body->height=NULL;
		$this->body->weight=NULL;
			$this->body->eyes->color=NULL;
			$this->body->eyes->style=NULL;
			$this->body->eyes->scelera=NULL;
			$this->body->hair->color=NULL;
			$this->body->hair->style=NULL;
			$this->body->hair->lengh=NULL;
	}
	
	public function desc() {
		$this->desc->history=NULL;
		$this->desc->likes=NULL;
		$this->desc->dislikes=NULL;
		$this->desc->addit = FALSE;
		$this->desc->addit_desc=NULL;
	}
	
	public function relationship() {
		$this->relationship->family=NULL; #= $mc->getFam($this->ID);
		$this->relationship->family_list=NULL; #= $mc->getFamList($this->ID);
		$this->relationship->partner=NULL; #= $mc->getPartner($this->ID); 
		$this->relationship->mate=NULL; #= $mc->getMate($this->ID);
		$this->relationship->master=NULL; #= $mc->getMaster($this->ID);
		$this->relationship->pets=NULL; #= $mc->getPets($this->ID);
		$this->relationship->slaves=NULL; #= $mc->getSlaves($this->ID);
	}
	
	public function relationship_extra() {
		$this->relationship_extra->forms=NULL; #= $mc->getForms($this-ID);
		$this->relationship_extra->clan=NULL; #= $mc->getClan($this->ID);
	}
	
	public function adult() {
		$this->adult->ds=NULL;
		$this->adult->prefs=NULL;
		$this->adult->addit = FALSE;
		$this->adult->addit_desc=NULL;
	}
	
	public function spirit() {
		$this->spirit->status=NULL;
		$this->spirit->condition=NULL;
		$this->spirit->alignment=NULL;
		$this->spirit->sub_alignment=NULL;
		$this->spirit->type=NULL;
			$this->spirit->death->date=NULL;
			$this->spirit->death->cause=NULL;
			$this->spirit->death->place=NULL;
	}
}
$c= new charData_template();
print_r($c);

?>