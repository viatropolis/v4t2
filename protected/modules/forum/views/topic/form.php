<?php if(isset($topic->id)) { ?>
<h1>Edit topic</h1>
<?php } else { ?>
<h1>Create topic</h1>
<?php } ?>
<br>

<fieldset>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>
<?php echo $form->textFieldRow($topic,"name",array("class"=>"entryField")); ?>
<?php echo $form->textAreaRow($topic,"desc",array("class"=>"entryArea")); ?>
<?php if(!isset($topic->id)) { 
	echo $form->textAreaRow($topic,"firstPost",array("class"=>"entryArea",'hint'=>Yii::t("forumModule.main","hint")));
} ?>
<div class="form-actions">
	<?php if(Yii::app()->user->isMod) { 
		echo CHtml::activeCheckBox($topic,"sticky",array("value"=>"1"));
		$this->widget('ext.ibutton.IButton', array(
        	'model'     => $topic,
            'attribute' => 'sticky',
            'options' =>array(
            	'labelOn'=>"Sticky",
            	'labelOff'=>"Normal"
            )
    	));	
	} ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
</div>
<?php $this->endWidget(); ?>
</fieldset>