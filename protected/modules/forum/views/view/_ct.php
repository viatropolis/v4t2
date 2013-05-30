<?php /*_ct*/ 
$topic = ForumTopics::model()->find(array("condition"=>"boardID=:x","order"=>"id DESC","params"=>array(":x"=>$data->id)));
if(!empty($topic))
	$post = ForumPosts::model()->find(array("condition"=>"topicID=:x","order"=>"id DESC","params"=>array(":x"=>$topic->id)));
?>
<tr class="<?=$row?>">
	<td>
		<?=CHtml::link($data->name,array("view/board","id"=>$data->id))?>
		<br><?=$data->desc?>
	</td>
	<td>
		<?php if(!empty($topic)) { ?>
		Last topic: <?=CHtml::link($topic->name,array("view/topic",'id'=>$topic->id))?>
		<br>By: <?=CHtml::link(Yii::app()->getModule("user")->user($post->writerID)->username,
			array("/user/user/view",'id'=>$post->writerID))?>
		<?php } ?>
	</td>
	<?php if(Yii::app()->user->role==2) { ?>
	<td>
		<?=CHtml::link("Edit",array("board/edit", "id"=>$data->id))?>, 
		<?=CHtml::link("Delete",array("board/delete", "id"=>$data->id),array("onclick"=>"confirm('Are you sure you want to delete this?')"))?>
	</td>
	<?php } ?>
</tr>