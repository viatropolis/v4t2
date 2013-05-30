<?php class CBTranslator {
	public static function category($c) { 
		switch($c) {
			case 0: return Yii::t('CharaBaseModule.cb',"pic-only"); break;
			case 1: return Yii::t('CharaBaseModule.cb',"eng"); break;
			case 2: return Yii::t('CharaBaseModule.cb',"ger"); break;
		}
	}
	public static function position($p) {
		switch($p) {
			case 1: return Yii::t('CharaBaseModule.cb',"main"); break;
			case 0: return Yii::t('CharaBaseModule.cb',"casual"); break;
		}
	}
	public static function scenario($s) {
		switch($s) {
			case 0: return Yii::t('CharaBaseModule.cb',"pic-only"); break;
			case 1: return Yii::t('CharaBaseModule.cb',"simple"); break;
			case 2: return Yii::t('CharaBaseModule.cb',"detailed"); break;
			case 3: return Yii::t('CharaBaseModule.cb',"advanced"); break;
		}
	}
	public static function sex($s) {
		switch($s) {
			case 0: return Yii::t('CharaBaseModule.cb',"male"); break;
			case 1: return Yii::t('CharaBaseModule.cb',"female"); break;
			case 2: return Yii::t('CharaBaseModule.cb',"herm"); break;
			case 3: return Yii::t('CharaBaseModule.cb',"maleherm"); break;
			case 4: return Yii::t('CharaBaseModule.cb',"cuntboi"); break;
			case 5: return Yii::t('CharaBaseModule.cb',"shemale"); break;
			case 6: return Yii::t('CharaBaseModule.cb',"shifter"); break;
			case 7: return Yii::t('CharaBaseModule.cb',"genderless"); break;			
		}
	}
	public static function orientation($o) {
		switch($o) {
			case 0: return Yii::t('CharaBaseModule.cb',"straight"); break;
			case 1: return Yii::t('CharaBaseModule.cb',"bi"); break;
			case 2: return Yii::t('CharaBaseModule.cb',"lesbian"); break;
			case 3: return Yii::t('CharaBaseModule.cb',"gay"); break;
			case 4: return Yii::t('CharaBaseModule.cb',"pansexual"); break;
			case 5: return Yii::t('CharaBaseModule.cb',"omnisexual"); break;
			case 6: return Yii::t('CharaBaseModule.cb',"noGo"); break;
			case 7: return Yii::t('CharaBaseModule.cb',"asexual"); break;
			default: return null; break;
		}
	}
	public static function orientations() {
		return array(
			Yii::t('CharaBaseModule.cb',"straight"),
			Yii::t('CharaBaseModule.cb',"bi"),
			Yii::t('CharaBaseModule.cb',"lesbian"),
			Yii::t('CharaBaseModule.cb',"gay"),
			Yii::t('CharaBaseModule.cb',"pansexual"),
			Yii::t('CharaBaseModule.cb',"omnisexual"),
			Yii::t('CharaBaseModule.cb',"noGo"),
			Yii::t('CharaBaseModule.cb',"asexual")
		);
	}

	public static function spirit_type($s) {
		switch($s) {
			case 0: return Yii::t('CharaBaseModule.cb',"spirit_t_lightful"); break;
			case 1: return Yii::t('CharaBaseModule.cb',"spirit_t_darkness"); break;			
		}
	}
	public static function spirit_status($s) {
		switch($s) {
			case 0: return Yii::t('CharaBaseModule.cb',"spirit_s_alive"); break;
			case 1: return Yii::t('CharaBaseModule.cb',"spirit_s_dead"); break;
		}
	}
	public static function spirit_condition($c) {
		switch($c) {
			case 0: return Yii::t('CharaBaseModule.cb',"spirit_c_healthyHappy"); break;
			case 1: return Yii::t('CharaBaseModule.cb',"spirit_c_healthySick"); break;
			case 2: return Yii::t('CharaBaseModule.cb',"spirit_c_depressed"); break;
			case 3: return Yii::t('CharaBaseModule.cb',"spirit_c_sad"); break;
			case 4: return Yii::t('CharaBaseModule.cb',"spirit_c_alone"); break;
			case 5: return Yii::t('CharaBaseModule.cb',"spirit_c_raging"); break;
			case 6: return Yii::t('CharaBaseModule.cb',"spirit_c_mixed"); break;
		}
	}
	public static function spirit_alignment($s) {
		switch($s) {
			case 0: return Yii::t('CharaBaseModule.cb',"spirit_a_good"); break;
			case 1: return Yii::t('CharaBaseModule.cb',"spirit_a_neutral"); break;
			case 2: return Yii::t('CharaBaseModule.cb',"spirit_a_bad"); break;
		}
	}
	public static function spirit_sub_alignment($sa) {
		switch($sa) {			
			case 0: return Yii::t('CharaBaseModule.cb',"spirit_sa_lawful"); break;
			case 1: return Yii::t('CharaBaseModule.cb',"spirit_sa_middle"); break;
			case 2: return Yii::t('CharaBaseModule.cb',"spirit_sa_chaotic"); break;
		}
	}

	public static function ds($a) {
		switch($a) {
			case 0: return Yii::t('CharaBaseModule.cb',"dom"); break;
			case 1: return Yii::t('CharaBaseModule.cb',"sub"); break;
		}
	}
} ?>