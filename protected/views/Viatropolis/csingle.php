<?php 
	$user = Yii::app()->getModule("user")->user($data->uID); 
	switch($user->superuser) {
		case 0: $css = "user"; break;
		case 1: $css = "moderator"; break;
		case 2: $css = "admin"; break;
		case -1: $css = "vip"; break;
	}
?>
<?="Owner: ".CHtml::link($user->username,array("/user/user/view","id"=>$data->uID))?><br>
<?=Yii::t("CharaBaseModule.cb","name").": ".CHtml::link($data->name,array("/charaBase/view/char",'ID'=>$data->cID))?><br>
<?=Yii::t("CharaBaseModule.cb","species").": ".$data->species?><br>
<?=Yii::t("CharaBaseModule.cb","sex").": ".CBTranslator::sex($data->sex)?><br>
<?=Yii::t("CharaBaseModule.cb","orientation").": ".CBTranslator::orientation($data->orientation)?><br>
<hr>

