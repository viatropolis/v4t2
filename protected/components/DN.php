<?php class DN extends Controller {
	
	public $uname;
	public $vip;

	public function __construct(){
    	parent::__construct($this->id, $this->module);
		if(isset(Yii::app()->user->id))
			$this->uname=Yii::app()->getModule('user')->user(Yii::app()->user->id)->username;
		else
			$this->uname=null;

		if(isset(Yii::app()->user->isVIP) && Yii::app()->user->isVIP==true) {$this->vip=true;} else {$this->vip=false;}
	}

	public function bar(){
		$cn = AJAXChatOnline::model()->count();
		$ret = array(
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>CHtml::image(
					Yii::app()->theme->baseUrl."/images/home.gif",null,array(
						'class'=>'miniIcon'
				)), 'url'=>'#','linkOptions'=>array('onclick'=>'bar.clear();')),
				array('label'=>'Home', 'url'=>"#", 'linkOptions'=>array('onclick'=>'bar.home();')),
			#	array('label'=>Yii::t("site","chars"), 'url'=>"#", 'linkOptions'=>array('onclick'=>'bar.chars();')),
				array('label'=>"Mall ($cn)", 'url'=>array("/mall")),
				array('label'=>'Forum', 'url'=>array('/forum')),
				array('label'=>'|', 'visible'=>$this->vip),
				array('label'=>Yii::t("site","manage"),'url'=>"#", 'visible'=>$this->vip, 'linkOptions'=>array('onclick'=>'bar.manage();')),
			),
		);
		return $ret;
	}
	
	public function ubar() { 
		$ret = array(
			'encodeLabel'=>false,
			'items'=>array(
				array(
					'label'=>'Login', 
					'url'=>array('/user/login'), 
					'visible'=>(Yii::app()->user->isGuest),
				),
				array('label'=>Yii::t("site","settings"), 'visible'=>!Yii::app()->user->isGuest, 'url'=>"#",'linkOptions'=>array("onclick"=>"bar.user();")),
				array('label'=>'Logout', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest),
			)
		);
		return $ret;
	}
	
	public function ubar_user(){
		return array(
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>Yii::t("site","u").": ".$this->uname, 'url'=>array('/user/profile'), 'visible'=>!Yii::app()->user->isGuest),
#				array('label'=>'|'),
#				array('label'=>'Notifications: [1F, 1N]', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest),
				#array('label'=>'|'),
				#array('label'=>Yii::t("site","theme").": ".CHtml::dropDownList("themePicker",null,array(),array("id"=>"themePicker","class"=>"allNormal"))),
				#array('label'=>'|'),
				#array('label'=>Yii::t("site","lang").": ".CHtml::dropDownList('language',null,array("x"=>Yii::t("site","lang")."..."),array("class"=>"allNormal","id"=>"langPick")))
			)
		);
	}
		
	
	public function Nbar_home() {
		return array(
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>'Home', 'url'=>array("/Viatropolis/index")),
				array('label'=>Yii::t("site","ath"), 'url'=>array('/Viatropolis/info', 'p'=>'about')),
				array('label'=>Yii::t("site","contact"), 'url'=>array('/Viatropolis/info','p'=>'contact')),
				
			)
		);
	}

	public function Nbar_manage() {
		return array(
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>Yii::t('site','mBlog'), 'url'=>array('/manage/blog'), 'visible'=>$this->vip),
				array('label'=>Yii::t('site','mChat'), 'url'=>array('/manage/chat'), 'visible'=>$this->vip),
				array('label'=>Yii::t('site','mThemes'), 'url'=>array('/manage/themes'), 'visible'=>$this->vip),
			)
		);
	}
		
	public function Nbar_characters() {
		return array(
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>Yii::t("site","cbList"), 'url'=>array("/charaBase/view/list")),
#				array('label'=>Yii::t("site","cbManage"), 'url'=>array("/charaBase/view/manage"), 'visible'=>(!Yii::app()->user->isGuest)),
				array('label'=>Yii::t("site","cbCreate"), 'url'=>array("/charaBase/maintain/create"), 'visible'=>(!Yii::app()->user->isGuest)),
				array('label'=>'|'),
#				array('label'=>Yii::t("site","cbExport"), 'url'=>array("/charaBase/transfer/export"), 'visible'=>(!Yii::app()->user->isGuest)),
				array('label'=>Yii::t("site","cbImport"), 'url'=>array("/charaBase/transfer/import"), 'visible'=>(!Yii::app()->user->isGuest)),
			)
		);
	}
	
	static function makeBootstrap() {
		$component = array(
	        'bootstrap'=>array(
    	   		'class'=>'ext.bootstrap.components.Bootstrap',
           	    'yiiCss'=>true,
          		'enableJS'=>true,
           		'coreCss'=>true
           	)
        );
        Yii::app()->setComponents($component);
        Yii::app()->bootstrap; // initing bootstrap!
	}
	
	public function DoTheMenu() {
		echo '<div id="bar">';
		$this->widget('zii.widgets.CMenu',$this->bar());
	  	echo '<div id="ubar">';
		$this->widget('zii.widgets.CMenu',$this->ubar());
		echo '</div>';
		echo '</div>';
		echo '<div id="Nbar" class="home">';
		$this->widget('zii.widgets.CMenu',$this->Nbar_home());
		echo '</div>';
	#	echo '<div id="Nbar" class="characters">';
	#	$this->widget('zii.widgets.CMenu',$this->Nbar_characters());	
	#	echo '</div>';
		if(!Yii::app()->user->isGuest) {
			echo '<div id="Nbar" class="DIuser">';
			$this->widget('zii.widgets.CMenu',$this->ubar_user());		
			echo '</div>';
			echo '<div id="Nbar" class="manage">';
			$this->widget('zii.widgets.CMenu',$this->Nbar_manage());		
			echo '</div>';			
		}
	}
} ?>