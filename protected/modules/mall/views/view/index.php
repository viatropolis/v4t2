<h1><?=$channel->name?></h1>
<?php if(!empty($channel->desc)) {
	echo $channel->desc;
} else {
	echo Yii::t("chatModule.main","noDesc");
} ?>