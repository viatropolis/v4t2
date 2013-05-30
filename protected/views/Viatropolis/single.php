<div id="post">
	<?php 
		$user = Yii::app()->getModule("user")->user($data->author); 
		switch($user->superuser) {
			case 0: $css = "user"; break;
			case 1: $css = "moderator"; break;
			case 2: $css = "admin"; break;
			case -1: $css = "vip"; break;
		}
	?>
	<div id="title"><?=CHtml::link($data->title,array("/Viatropolis/view",'id'=>$data->id),array("style"=>"color:white;"))?></div>
	<div id="actions">
		<?php
			echo CHtml::link("View in forum",array("/forum/view/topic",'id'=>$data->topicID));
			if(Yii::app()->user->id == $user->id || isset(Yii::app()->user->isAdmin) && Yii::app()->user->isAdmin) {
				echo " | ";				
				echo CHtml::link("Edit",array("/Viatropolis/edit","id"=>$data->id));
				echo " | ";				
				echo CHtml::link("delete",array("/Viatropolis/delete","id"=>$data->id));
			}
		?>
	</div>
	<div id="author"><?=CHtml::link($user->username,array("/user/user/view",'id'=>$user->id),array("class"=>$css))?></div>
	<div id="when"><?=date("d.m.Y H:i",$data->modified)?></div>
	<div id="message">
		<?php
			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $data->content;
			$this->endWidget();
		?>
	</div>
</div>
<hr>