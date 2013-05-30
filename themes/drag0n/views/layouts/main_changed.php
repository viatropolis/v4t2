<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
			$.get('/chat/shoutbox',function(d){
				$('#shoutbox').html(d);
				ajaxChat.initialize();
			});
		",CClientScript::POS_READY); } ?>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Test', 'url'=>array('/Viatropolis/index')),
				array('label'=>'About', 'url'=>array('/Viatropolis/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/Viatropolis/contact')),
				array('label'=>'Login', 'url'=>array('/Viatropolis/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/Viatropolis/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
