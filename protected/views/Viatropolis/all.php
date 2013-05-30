<?php
	$this->pageTitle=Yii::app()->name;
?>
<div id="splitblock">
	<div id="splitSS">
		<h3>Recent Vendors</h3>
		<?php $this->widget("zii.widgets.CListView",array(
			'dataProvider'=>$chars,
			'itemView'=>'/DragonsInn/csingle',
			'summaryText'=>' ',
			'template'=>"{items}",
        )); ?>
	</div>
	<div id="splitB">
		<h1><b style="color:Orange;">Viatropolis</b> - Who are we?</h1>
		<p>We provide you with powerful features like:</p>
		<ul>
			<dt>Viatropolis will create your first Virtual Event</dt>
				<dd>Start Developing your marketing to old and new exhibitors, attendees, lectueres and sponsors within weeks.</dd><br />
			<dt>Database Driven software</dt>
				<dd>Besides the Virtual Event Platforms, Viatropolis can handle many of your other Internet, Web and Programing Needs</dd>
		</ul>
		<p>
			<br />High End Database Driven Software, e-Commerce, Shopping Carts, Web Malls, Graphic Design, and Social Media outlets are just a few things Viatropolis can handle and do for you.
		</p><br>
		<div id="splitblock">
			<div id="split">
				Help categories: <?php echo ForumCategories::model()->count(); ?><br>
				Help boards: <?php echo ForumBoards::model()->count(); ?><br>
				Help topics: <?php echo ForumTopics::model()->count(); ?><br>
				Help posts: <?php echo ForumPosts::model()->count(); ?><br>
			</div>
			<div id="split">
				Total members: <?php echo YiiUser::model()->count(); ?><br>
				Viatropolis posts: <?php echo Blog::model()->count(); ?><br>
			</div>
		</div>
		<div id="clearup"></div>
		<?php $this->widget("zii.widgets.CListView",array(
			'dataProvider'=>$blog,
			'itemView'=>'/DragonsInn/single',
			'summaryText'=>' ',
		)); ?>
	</div>
</div>