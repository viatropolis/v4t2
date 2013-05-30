<?php
/*$this->breadcrumbs=array(
	UserModule::t('Users')=>array('index'),
	$model->username,
);*/
#$this->layout='//layouts/column2';
$this->menu=array(
    array('label'=>UserModule::t('List User'), 'url'=>array('index')),
);
?>
<h1><?php echo UserModule::t('View Member').' "'.$model->username.'"'; ?></h1>
<?php 

// For all users
	$attributes = array(
			'username',
	);
	
	$profileFields=ProfileField::model()->forAll()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			array_push($attributes,array(
					'label' => UserModule::t($field->title),
					'name' => $field->varname,
					'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),

				));
		}
	}
	array_push($attributes,
		'create_at',
		array(
			'name' => 'lastvisit_at',
			'value' => (($model->lastvisit_at!='0000-00-00 00:00:00')?$model->lastvisit_at:UserModule::t('Not visited')),
		)
	);
			
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));?>
	<br>
	
	
	<?php
	$CADPmain = new CActiveDataProvider("Character",array(
			'criteria'=>array(
				'condition'=>'uID='.$model->id.' AND position=1',
			)
		)
	);
	$CADPcasual = new CActiveDataProvider("Character",array(
			'criteria'=>array(
				'condition'=>'uID='.$model->id.' AND position=0',
			)
		)
	);
	$CBT = new CBTranslator;
	$cols = array(
    	array(
   			'name'=>'name',
			'type'=>'raw',
   			'value'=>'CHtml::link($data->name,array("/charaBase/view/char","ID"=>$data->cID))'
    	),
		'species',
		array(
   			'name'=>'sex',
			'value'=>'CBTranslator::sex($data->sex)',
		),
		array(
 			'name'=>'orientation',
			'value'=>'CBTranslator::orientation($data->orientation)',
		),
   		array(
			'name'=>'category',
			'value'=>'CBTranslator::category($data->category)',
  		),	
		array(
			'name'=>'position',
			'value'=>'CBTranslator::position($data->position)',
		),			
	);
	$this->widget('zii.widgets.grid.CGridView',array(
		'dataProvider'=>$CADPmain,
		'summaryText'=>"<h3>User's main characters:</h3>",
		'summaryCssClass'=>'prettySummary',
		'columns'=>$cols
	));
	$this->widget('zii.widgets.grid.CGridView',array(
		'dataProvider'=>$CADPcasual,
		'summaryText'=>"<h3>User's casual characters:</h3>",
		'summaryCssClass'=>'prettySummary',
		'columns'=>$cols
	));

?>
