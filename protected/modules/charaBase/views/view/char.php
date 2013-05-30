<div>
	<h2><?=$model->name?> <small><?=$model->nickName?></small></h2>
	<h4>Category: <?=$CBT->category($model->category)?> | Position: <?=$CBT->position($model->position)?> | 
		Owned by: <?=CHtml::link(
			Yii::app()->getModule("user")->user($model->uID)->username,
			array('/user/user/view','id'=>$model->uID)
		)?><br><br>
	<?php if(Yii::app()->user->id == $model->uID): ?>
		<small>[
			<?=CHtml::link(Yii::t("charaBaseModule.cb","edit"), array("maintain/edit","ID"=>$model->cID))?>
			|
			<?=CHtml::link(Yii::t("charaBaseModule.cb","delete"), array("maintain/delete","ID"=>$model->cID))?>
			|
			<?=CHtml::link(Yii::t("charaBaseModule.cb","backup"), array("transfer/backup","ID"=>$model->cID))?>
		]</small>
	<?php endif; ?>
	</h4><br><br>
	
	<div id="splitblock">
		<div id="split">
			<?php
				$data = array("species","sex","orientation","birthday","birthPlace");
				echo '<h3 name="basic">'.Yii::t('charaBaseModule.cb','basic').'</h3>';
				foreach($data as $label) {
					if($model->$label != "0000-00-00" and $model->$label != null) {
						switch($label) {
							case "sex": $o = $CBT->sex($model->$label); break;
							case "orientation": $o = $CBT->orientation($model->$label); break;
							default: $o = $model->$label; break;
						}
						echo '<b>'.Yii::t('charaBaseModule.cb', $label).":</b> ".$o."<br>";										
					}
				}
			?><br>
			<?php if($model->scenario != 0) {
				$data = array('height','weight','eye_c','eye_s','hair_c', 'hair_s', 'hair_l'); 
				echo '<h3 name="body">'.Yii::t('charaBaseModule.cb','body').'</h3>';
				foreach($data as $label) {
					if($model->$label != "0000-00-00" and $model->$label != null) {
						switch($label) {
							default: $o = $model->$label; break;
						}
						echo '<b>'.Yii::t('charaBaseModule.cb', $label).":</b> ".$o."<br>";										
					}
				}			
			} ?>
		</div>
		<div id="split">
			<?php if($model->scenario == 3) {
				$data = array("makeup","clothing","addit_appearance"); 
				echo '<h3 name="appearance">'.Yii::t('charaBaseModule.cb','appearance').'</h3>';
				foreach($data as $label) {
					if($model->$label != "0000-00-00" and $model->$label != null) {
						switch($label) {
							default: $o = $model->$label; break;
						}
						echo '<b>'.Yii::t('charaBaseModule.cb', $label).":</b> ".$o."<br>";										
					}
				}			
			?><br>
			<?php
				$data = array(
					"spirit_condition","spirit_alignment","spirit_sub_alignment","spirit_type",'spirit_status',
					"spirit_death_date","spirit_death_place","spirit_death_cause"
				); 
				echo '<h3 name="spirit">'.Yii::t('charaBaseModule.cb','spirit').'</h3>';
				foreach($data as $label) {
					if($model->$label != "0000-00-00" and $model->$label != null and $model->$label != 100) {
						switch($label) {
							case 'spirit_condition': $o = $CBT->spirit_condition($model->$label); break;
							case 'spirit_alignment': $o = $CBT->spirit_alignment($model->$label); break;
							case 'spirit_sub_alignment': $o = $CBT->spirit_sub_alignment($model->$label); break;
							case 'spirit_type': $o = $CBT->spirit_type($model->$label); break;
							case 'spirit_status': $o = $CBT->spirit_alignment($model->$label); break;
							default: $o = $model->$label; break;
						}
						echo '<b>'.Yii::t('charaBaseModule.cb', $label).":</b> ".$o."<br>";										
					}
				}			
			} ?>
		</div>
	</div>
	<div id="clearup"></div>
	
	<?php if($model->scenario == 1 || $model->scenario == 2 || $model->scenario == 3) { ?>
	<hr>
	<h1 style="padding-top: 20px; padding-bottom: 25px;">Literature</h1>

	<?php
		if($model->history != null) {
			echo "<h2>".Yii::t("charaBaseModule.cb","history")."</h2>";
			echo "<p>".$model->history."</p>";
		}
	?>

	<?php
		if($model->addit_desc != null) {
			echo "<h2>".Yii::t("charaBaseModule.cb","addit_desc")."</h2>";
			echo "<p>".$model->addit_desc."</p>";
		}
	?>
		
	<div id="splitblock">
		<div id="split">
			<?php
				$data = array("likes"); 
				foreach($data as $label) {
					if($model->$label != "0000-00-00" || $model->$label != null) {
						echo '<h3 name="likes">'.Yii::t('charaBaseModule.cb','likes').'</h3>';
						echo "<p>".$model->$label."</p>";										
					}
				}			
			?>
		</div>
		<div id="split">
			<?php
				$data = array("dislikes"); 
				foreach($data as $label) {
					if($model->$label != "0000-00-00" || $model->$label != null) {
						echo '<h3 name="dislikes">'.Yii::t('charaBaseModule.cb','dislikes').'</h3>';
						echo "<p>".$model->$label."</p>";										
					}
				}			
			?>
		</div>
	</div>
	<div style="clear: both; padding-top:20px;"></div>
	<?php } ?>
	
	<?php if($model->scenario != 0 && $model->scenario != 1) { ?>
	<div id="splitblock">
		<div id="split">
			<?php
				$data = array("relationships"); 
				foreach($data as $label) {
					if($model->$label != "0000-00-00" and $model->$label != null) {
						echo '<h3 name="relationships">'.Yii::t('charaBaseModule.cb','relationships').'</h3>';
						echo "<p>".$model->$label."</p>";										
					}
				}			
			?>
		</div>
		<div id="split">
			<?php
				$data = array("dom_sub","prefs","addit_adult"); 
				echo '<h3 name="adult">'.Yii::t('charaBaseModule.cb','adult').'</h3>';
				foreach($data as $label) {
					if($model->$label != "0000-00-00" and $model->$label != null) {
						switch($label) {
							case 'dom_sub': $o = $CBT->ds($model->$label); break;
							default: $o = $model->$label; break;
						}
						echo '<b>'.Yii::t('charaBaseModule.cb', $label).":</b> ".$o."<br>";										
					}
				}			
			?>
		</div>
	</div>
	<?php } ?>
	<div style="clear: both; padding-top:20px;"></div>

	<div id="cpic">
		<?php
			$picData=unserialize($model->cpic);
			#echo $model->cpic;
			if(is_array($picData)) {
				foreach($picData as $key=>$cpicNr) {
					$Cpic=CharacterPicture::model()->findByPk($cpicNr);
					if(is_object($Cpic)) {
						echo CHtml::link(
							CHtml::image($this->createUrl('cpic/view',array(
								'pid'=>$Cpic->id,
								'ID'=>$model->cID
							))),
							array('cpic/view',
								'pid'=>$Cpic->id,
								'ID'=>$model->cID
							)
						);
						echo '<br><div style="text-align:center;">'.$Cpic->desc."</div><br><br>";
						unset($Cpic);
					}
				}
			}
		?>
	</div>
</div>