<?php if(isset($blog->id))
	echo "<h2>Edit entry: $blog->title</h2>";
else
	echo "<h2>Create new blog entry</h2>";	
?>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>

<?=$form->textFieldRow($blog,'title',array("class"=>"span7"))?>
<?=$form->textAreaRow($blog,'content',array('class'=>'bigText','hint'=>'Use the markdown syntax to style the post!'))?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
</div>
 
<?php $this->endWidget(); ?>