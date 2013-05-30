<h1>Importing a character.</h1>
<p>
	Here you will be able to import your characters from the previous version of BIRD.<br>
	Please take note of the following information:
	<ul>
		<li>Sex and orientation won't be transfered; but you will be able to set them when editing your character.</li>
		<li>Previous images wont be transfered. The old version stored images as plain HTML, which is not very well...</li>
		<li>The scenario will automatically be set to "Advanced" to display every field that'd be possible.</li>
	</ul>
	Happy importing!
</p>
<p>
	Please select the file that contains your characters, and click the checkbox if it is a file containing multiple characters, or a single character.
</p>
<?= CHtml::beginForm(array("transfer/import"),"post",array('enctype'=>'multipart/form-data')) ?>
<div class="row">
	Select file:
	<?= CHtml::fileField("cbFile") ?>
</div>
<div class="row">
	Does this file contain multiple characters?
	<?= CHtml::checkBox("multi",false) ?>
</div>
<div class="row">
	<?= CHtml::submitButton("Import") ?>
</div>
<?= CHtml::endForm() ?>