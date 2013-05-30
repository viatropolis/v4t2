<?php /*_ct*/ 
$topic = ForumTopics::model()->find(array("condition"=>"boardID=:x","order"=>"id DESC","params"=>array(":x"=>$data->id)));
if(!empty($topic))
	$post = ForumPosts::model()->find(array("condition"=>"topicID=:x","order"=>"id DESC","params"=>array(":x"=>$topic->id)));
?>
<tr class="<?=$row?>">
	<td class=td_name>
		<span class="board_name"><?=CHtml::link($data->name,array("view/board","id"=>$data->id))?></span>
		<br><?=$data->desc?>
	</td>
	<td class=td_details>
		<?php if(!empty($topic)) { ?>
		Last topic: <span class="board_topic"><?=CHtml::link($topic->name,array("view/topic",'id'=>$topic->id))?></span>
		<br>By: <span class="board_user"><?=CHtml::link(Yii::app()->getModule("user")->user($post->writerID)->username,
			array("/user/user/view",'id'=>$post->writerID))?></span>
		<?php } ?>
	</td>
	<?php if(Yii::app()->user->role==2) { ?>
	<td class=td_actions>
		<span class="board_admin"><?=CHtml::link("Edit",array("board/edit", "id"=>$data->id))?>,
		<?=CHtml::link("Delete",array("board/delete", "id"=>$data->id),array("onclick"=>"confirm('Are you sure you want to delete this?')"))?> </span>
	</td>
	<?php } ?>
</tr>