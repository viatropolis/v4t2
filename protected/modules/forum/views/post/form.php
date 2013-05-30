<h1><?=Yii::t("forumModule.main","answerTo")?>: <?=$topic->name?></h1>
<br>

<fieldset>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>
<?php echo $form->textAreaRow($post,"answer",array("class"=>"entryArea",'hint'=>Yii::t("forumModule.main","hint"))); ?>
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
</div>
<?php $this->endWidget(); ?>
</fieldset>