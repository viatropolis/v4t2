<h3><?=Yii::t("admin","cDef")?></h3>
<?php 
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    	'id'=>'horizontalForm',
    	'type'=>'horizontal',
	));

	echo $form->textFieldRow($def, 'adminChannels', array(
		'class'=>'span8',
		'hint'=>"Comma-seperated channelID's."
	));
	echo $form->textFieldRow($def, 'userChannels', array(
		'class'=>'span8',
		'hint'=>"Comma-seperated channelID's."
	));
	echo "<br>";
	$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Add', 'type'=>'success'));
	$this->endWidget(); 
?>


<div id="splitblock">
	<div id="split">
		<h3><?=Yii::t("admin","cs")?></h3>
		<?php $this->widget("zii.widgets.grid.CGridView",array(
			'dataProvider'=>$dp,
			'columns'=>array(
				'id',
				array(
					'name'=>'orderID',
					'type'=>'raw',
					'value'=>'$data->orderID'
				),
				array(
					'name'=>'name',
					'type'=>'raw',
					'value'=>'CHtml::link($data->name,array("/mall/view","id"=>$data->id))'
				)
			)
		)); ?>
	</div>
	<div id="split">
		<h3><?=Yii::t("admin","cAdd")?></h3>
		<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id'=>'verticalForm',
		));
		
		echo $form->textFieldRow($model, 'name', array('class'=>'span7'));
		echo $form->textFieldRow($model, 'orderID', array(
			'class'=>'span1',
			'hint'=>"Defines at which position the channel is located in the selection. CAUTION: This also acts as channelID inside the chat and affects the logs!"
		));
		echo $form->textAreaRow($model, 'desc', array('class'=>'span7'));
 		echo "<br>";
		$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Add', 'type'=>'success'));
 		$this->endWidget(); ?>
	</div>
</div>