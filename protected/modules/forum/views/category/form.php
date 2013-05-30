<?php if(isset($category->id)) { ?>
<h1>Edit category</h1>
<?php } else { ?>
<h1>Create category</h1>
<?php } ?>
<br>

<fieldset>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>
<?php echo $form->textFieldRow($category,"name",array("class"=>"entryField")); ?>
<?php echo $form->textAreaRow($category,"desc",array("class"=>"entryArea")); ?>
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
</div>
<?php $this->endWidget(); ?>
</fieldset>