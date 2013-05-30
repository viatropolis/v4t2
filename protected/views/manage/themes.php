<h1><?=Yii::t("admin","mThemes")?></h1>
<?=Yii::t("admin","tDesc")?>

<div id="splitblock">
	<div id="split">
		<h3>Themes</h3>
		<?php $this->widget("zii.widgets.grid.CGridView",array(
			'dataProvider'=>$dp,
			'columns'=>array(
				'id',
				'name',
				'gstart',
				'gend',
				'shadow'
			)
		)); ?>
	</div>
	<div id="split">
		<h3><?=Yii::t("admin","aTheme")?></h3>
		<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id'=>'verticalForm',
		));
		
		echo $form->textFieldRow($theme, 'name', array('class'=>'span7'));
		echo $form->textFieldRow($theme, 'gstart', array('class'=>'span7'));
		echo $form->textFieldRow($theme, 'gend', array('class'=>'span7'));
		echo $form->textFieldRow($theme, 'shadow', array('class'=>'span7'));
 		echo "<br>";
		$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Add', 'type'=>'success'));
 		$this->endWidget(); ?>
	</div>
</div>