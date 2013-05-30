<?php /*boardView*/
$row = "even";
echo "<h2>$b->name</h2>";
echo "<p>$b->desc</p>";
echo "<p>";
echo CHtml::link("Create new topic",array("topic/create",'bid'=>$b->id));
echo "</p>";
echo "<table>";
echo "<thead><tr class=\"".$row."\">";
echo "<th>Name / Description</th>";
echo "<th> Created / Last posted </th>";
echo "</tr></thead>";
echo "<tbody>";
foreach($topics as $t){
	$post = ForumPosts::model()->find(array("condition"=>"topicID=:x","order"=>"id DESC",'params'=>array(":x"=>$t->id)));
	$name = Yii::app()->getModule("user")->user($post->writerID)->username;
	$id = $post->writerID;
	$userLink = CHtml::link($name,array("/user/user/view","id"=>$id));
	switch($row) {
		case 'odd':$row="even"; break;
		case 'even':$row="odd"; break;
	} 
	if($t->sticky) { ?>
	<tr class="<?=$row?> sticky">
	<?php } else { ?>
	<tr class="<?=$row?>">
	<?php } ?>
		<td>
			<?=CHtml::link($t->name,array("view/topic","id"=>$t->id))?>
			<br><?=$t->desc?></td>
		<td><?=$userLink?> @ <?=(isset($post->editedAt) ? $post->editedAt : $post->createdAt)?></td>
	</tr>
<?php }
echo "</tbody>";
echo "</table>";