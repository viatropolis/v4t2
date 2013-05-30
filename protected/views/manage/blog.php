<h1>Blog</h1>
<?=Yii::t("admin","bDesc")?>
<?=CHtml::link(Yii::t("admin","aBlog"),array("/Viatropolis/create"))?>

<?php $this->widget("zii.widgets.grid.CGridView",array(
	'dataProvider'=>$dp,
	'columns'=>array(
		'id',
		array(
			'name'=>'Author',
			'type'=>'raw',
			'value'=>'CHtml::link(Yii::app()->getModule("user")->user($data->author)->username,array("/user/user/view","id"=>Yii::app()->getModule("user")->user($data->author)->id))',
		),
		array(
			'name'=>'modified',
			'type'=>'raw',
			'value'=>'date("d.m.Y H:i",$data->modified)',
		),
		'tags',
		array(
			'name'=>'title',
			'type'=>'raw',
			'value'=>'CHtml::link($data->title,array("/Viatropolis/view","id"=>$data->id))'
		),
	)
)); ?>