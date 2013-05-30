<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<?php DN::MakeBootstrap(); ?>
		<?php Yii::app()->clientScript->registerMetaTag('text/html; charset=utf-8',null, 'Content-type'); ?>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
		<?php if(!isset($_COOKIE['themepicker'])) { ?>
    	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/drag0n.css.php" media="screen" />
		<?php } else { ?>
    	<link rel="stylesheet" type="text/css" href="<?=$_COOKIE['themepicker']?>" media="screen" />
		<?php } ?>
		<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/bar.js",CClientScript::POS_HEAD); ?>
		<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/themePicker.js.php?for=site",CClientScript::POS_HEAD); ?>
		<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/extLoader.js",CClientScript::POS_HEAD); ?>
		<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/langPick.js",CClientScript::POS_HEAD); ?>
		<?php Yii::app()->clientScript->registerScript("barInit","bar.clear();",CClientScript::POS_READY); ?>
		<?php if(!Yii::app()->user->isGuest) { Yii::app()->clientScript->registerScript("shoutbox", "
			$.get('/Mall/shoutbox',function(d){
				$('#shoutbox').html(d);
				ajaxChat.initialize();
			});
		",CClientScript::POS_READY); } ?>
	</head>
	<body>
		<?php $dn = new DN; $dn->DoTheMenu(); ?>

		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		<?php endif?>

		<div id="top">
			<?php
				if(!Yii::app()->user->isGuest) {
					$text = "Shoutbox";
					echo CHtml::link(
						CHtml::image(Yii::app()->theme->baseUrl."/images/sign.png",null,array("class"=>"centerpic")),
						"#",
						array("onclick"=>"bar.shoutbox();")
					);
				} else {
					$text = "Viatropolis";
					echo CHtml::image(Yii::app()->theme->baseUrl."/images/sign.png",$text,array('title'=>$text,'class'=>'centerpic'));
				}
			?>
			<div id="shoutbox" style="display:none;"></div>
		</div>

		<div id="container"><!-- layout content div -->
  	   		<?php echo $content; ?>
  		</div>

		
	</body>
</html>
