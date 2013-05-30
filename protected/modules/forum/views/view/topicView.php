<h2><?=$topic->name?> <?php if($topic->sticky) echo "<small>Sticky</small>";?></h2>
<small><?=$topic->desc?></small>
<?php if(Yii::app()->user->isMod) { ?>
<p>
	<?=CHtml::link("Edit topic",array("topic/edit","id"=>$topic->id))?> | 
	<?=CHtml::link("Delete topic",array("topic/delete","id"=>$topic->id),array("onclick"=>"confirm('You sure?')"))?>
</p>
<?php } ?>
<?php $topic->views++; ?>
<br><br>

<?php foreach($posts as $post) {
	$name = Yii::app()->getModule("user")->user($post->writerID)->username;
	$id = Yii::app()->getModule("user")->user($post->writerID)->id;
	$uname = CHtml::link($name,array("/user/user/view","id"=>$id));
	$sig = Yii::app()->getModule("user")->user($post->writerID)->profile->getAttribute("sig"); #ProfileField::model()->findByAttributes(array("varname","sig"$post->writerID)->sig;
	echo '<div id="splitblock" class="forum">';
	echo '<div id="splitS">';
	echo "<h4>$uname</h4><br>";
	echo 'Created at:<br> '.date("d.m.Y H:i",$post->createdAt).'<br>';
	echo "Edited at:<br> ".date("d.m.Y H:i",$post->editedAt).'<br>';
	if(!$post->isBlog) {
		if($post->writerID==Yii::app()->user->id || Yii::app()->isMod) {
			echo "<br>";
			echo CHtml::link("Edit",array("post/edit","id"=>$post->id));
			echo "<br>";
			echo CHtml::link("delete",array("post/delete","id"=>$post->id));
		}
	} else {
		echo CHtml::link("View as blog",array('/DragonsInn/view','id'=>$post->blogID));
	}
	echo '</div>';
	echo '<div id="splitB">';
	$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
	echo $post->answer;
	$this->endWidget();
	echo "<hr>";
	echo $sig;
	echo '</div>';
	echo '</div>';
	echo '<div id="clearup"></div>';
}
echo '<div class="form-actions">';
echo CHtml::link("Answer to this topic",array("post/answer","tid"=>$topic->id),array("class"=>"btn btn-inverse"));
echo '</div>';
?>