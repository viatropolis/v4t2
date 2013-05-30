<h2>Admins area</h2>
<?=Yii::t("admin","mHead")?>
<ul>
	<dt><?=CHtml::link('Chat',array("chat"))?></dt>
	<dd><?=Yii::t("admin","mChat")?></dd>
	
	<dt><?=CHtml::link('Themes',array("themes"))?></dt>
	<dd><?=Yii::t("admin","mThemes")?></dd>

	<dt><?=CHtml::link('Blog',array("blog"))?></dt>
	<dd><?=Yii::t("admin","mBlog")?></dd>
</ul>