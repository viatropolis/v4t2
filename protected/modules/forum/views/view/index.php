<?php
/*
	@array $categories ForumCategories

	@array $boards ForumBoards
	@array $topics ForumTopics
*/
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getModule("forum")->assetsUrl; ?>/css/forum.css" media="screen" />
<?php
$row = "even";
echo "<h1 class=\"forum_h1\">Viatropolis Forum Support</h1>";
if(Yii::app()->user->role==2) {
	echo "<h4 class=\"forum_h4\">";
	echo CHtml::link("Create category",array("category/create"));
	echo "</h4>";
}
echo "<br>";
foreach($categories as $c) {
	echo '<h2 class="categoryHeader">'.$c->name.'</h2>';
	echo "<h4>$c->desc</h4>";

	if(Yii::app()->user->isMod) {
		echo '<h5 class=\"forum_h5\">';	
		echo CHtml::link("Edit this category",array("category/edit",'id'=>$c->id));
		echo " | ";
		echo CHtml::link("Delete this category",array("category/delete",'id'=>$c->id),array("onclick"=>"confirm('Sure to delete this?')"));
		if(Yii::app()->user->isAdmin) {
			echo " | ";
			echo CHtml::link("Create new board",array("board/create",'id'=>$c->id));		
		}
		echo "</h5>";
	}
	
	$c->boards = unserialize($c->boards);
	if(!empty($c->boards)) {
		echo "<table class=\"main_table\">";
		echo "<thead><tr class=\"".$row."\">";
		echo "<th class=\"desc\">Name / Description</th>";
		echo "<th class=\"detail\">Details</th>";
		if(Yii::app()->user->role==2) { echo "<th class=\"actions\">Actions</th>"; }	
		echo "</tr></thead>";
		echo "<tbody>";
		foreach($c->boards as $bid) {
			switch($row) {
				case 'odd':$row="even"; break;
				case 'even':$row="odd"; break;
			}

			$board = new CActiveDataProvider('ForumBoards',array(
				'criteria'=>array(
					'condition'=>'`id`='.$bid
				),
			));
			$this->widget("zii.widgets.CListView",array(
				'dataProvider'=>$board,
				'summaryText'=>" ",
				#'viewData'=>array( 'topics'=>$topics ),
				'viewData'=>array("row"=>$row),
				'itemView'=>"_ct"
			));
		}
		echo "</tbody>";
		echo "</table>";
	} else {
		echo "<i>No boards are available for this category.</i>"; 
	}
	
} 
$numCat = ForumCategories::model()->count();
$numPost = ForumPosts::model()->count();
$numTop = ForumTopics::model()->count();
$numBoard=ForumBoards::model()->count();
?>

<br><br><center>
	Categories: <?=$numCat?> | 
	Boards: <?=$numBoard?> | 
	Topics: <?=$numTop?> | 
	Posts: <?=$numPost?>
</center>