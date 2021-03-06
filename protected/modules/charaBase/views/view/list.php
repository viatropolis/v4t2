<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
    'filter'=>$model,    
    'cssFile'=>false,
    'enableSorting'=>true,
    'columns'=>array(
    	array(
    		'name'=>'cID',
    		'header'=>'Owner',
    		'type'=>'raw',
    		'value'=>'CHtml::link(Yii::app()->getModule("user")->user($data->uID)->username, array("/user/user/view","id"=>$data->uID))',
    	),
    	array(
    		'name'=>'name',
			'type'=>'raw',
    		'value'=>'CHtml::link($data->name,array("view/char","ID"=>$data->cID))'
    	),
   		'species',
   		array(
   			'name'=>'sex',
   			'value'=>'CBTranslator::sex($data->sex)',
   			'filter'=>array(
   				$CBT->sex(0),$CBT->sex(1),$CBT->sex(2),$CBT->sex(3),$CBT->sex(4),
				$CBT->sex(5),$CBT->sex(6),$CBT->sex(7)
			),
   		),
   		array(
   			'name'=>'orientation',
   			'value'=>'CBTranslator::orientation($data->orientation)',
   			'filter'=>array(
				$CBT->orientation(0),$CBT->orientation(1),$CBT->orientation(2),
				$CBT->orientation(3),$CBT->orientation(4),$CBT->orientation(5),
				$CBT->orientation(6),
			),
   		),
   		array(
   			'name'=>'category',
   			'value'=>'CBTranslator::category($data->category)',
   			'filter'=>array($CBT->category(0),$CBT->category(1),$CBT->category(2))
   		),	
   		array(
   			'name'=>'position',
   			'value'=>'CBTranslator::position($data->position)',
   			'filter'=>array($CBT->position(0),$CBT->position(1)),
   		),
   	)
));
?>