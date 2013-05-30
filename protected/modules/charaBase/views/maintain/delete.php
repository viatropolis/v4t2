<?php $this->layout='//layouts/column1'; ?>
<div class="warning">
	<h2><?=$model->name?></h2><br>
	You really want to delete this character?<br>
	You can return with the link below.<br><br> 
	<?=CHtml::link("No, keep the character.",Yii::app()->request->urlReferrer)?>
	<br>
	<?=CHtml::link("Yes, delete.",array("/charaBase/maintain/delete","ID"=>$model->cID,"delete"=>1))?>
</div>