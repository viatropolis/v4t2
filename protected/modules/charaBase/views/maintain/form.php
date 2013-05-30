<?php $this->layout='//layouts/column1';
	$pic_only = array();$simple = array();$detailed = array();$advanced = array();
	foreach(array('nickName','name','sex','orientation','species') as $label) { $pic_only[] = CHtml::activeName($model,$label); }
	foreach(array('nickName','name','sex','orientation','species','height', 'weight', 'history','birthday','birthPlace','likes','dislikes') as $label) {$simple[]=CHtml::activeName($model,$label);}
	foreach(
		array('nickName','name','sex','orientation','species',	'height', 'weight','birthday','birthPlace', 'history','addit_desc','likes', 'dislikes', 'relationships',
				'nickName','dom_sub', 'prefs', 'addit_adult') as $label) {$detailed[]=CHtml::activeName($model,$label);}
	foreach(array('name','sex','orientation','species','height', 'weight',
					'nickName','birthPlace','birthday',
					'clothing','makeup','addit_appearance',
					'eye_c','eye_s','hair_c','hair_l','hair_s',
					'history','likes','dislikes','addit_desc','relationships',
					'dom_sub','prefs','addit_adult',
					'spirit_status','spirit_condition','spirit_alignment','spirit_sub_alignment','spirit_type',
					'spirit_death_date','spirit_death_cause','spirit_death_place') as $label) {$advanced[]=CHtml::activeName($model,$label);}
?>
<script type="text/javascript">
	scenarios = {
		pic_only: ["<?=implode('","',$pic_only)?>"],
		simple: ["<?=implode('","',$simple)?>"],
		detailed: ["<?=implode('","',$detailed)?>"],
		advanced: ["<?=implode('","',$advanced)?>"],
		data: ['pic_only','simple','detailed','advanced'],
	};
	function CBDisplay(sID) {
		$('input,textarea,select,small,div.control-group,#YouDontNeedToSeeThis').hide();
		$('[name="<?=CHtml::activeName($model,"category")?>"],'+
			'[name="<?=CHtml::activeName($model,"position")?>"],'+
			'[name="<?=CHtml::activeName($model,"scenario")?>"],#Character_cpic_desc').show();
		var sData = scenarios[scenarios.data[sID]];
		for(var key in sData) {
			$('[name="'+sData[key]+'"]').parent().parent().show();
			$('[name="'+sData[key]+'"]').parent().show();
			$('[name="'+sData[key]+'"]').show();
		}

		switch(sID) {
			case "0": 
				$('[name="appearance"],[name="spirit"],[name="body"],[name="history"],[name="likes"],[name="dislikes"],[name="relationships"],'+
					'[name="adult"],[name="addit_desc"],[name="literature"]').hide();
				$('[name="basic"]').show();
				break;
			case "1":
				$('[name="appearance"],[name="spirit"],[name="likes"],[name="dislikes"],[name="adult"],[name="relationships"],[name="addit_desc"]').hide();
				$('[name="basic"],[name="body"],[name="literature"]').show();
				$('[name="history"],[name="likes"],[name="dislikes"]').show();
				break;
			case "2":
				$('[name="appearance"],[name="spirit"]').hide();
				$('[name="basic"],[name="body"],[name="likes"],[name="dislikes"],[name="adult"],[name="relationships"],[name="literature"],[name="addit_desc"]').show();
				break;			
			case "3":
				$('h3,[name="literature"],hr').show();
				break;
		}
		$('.descBox, #themePicker').show();
		$("#ajaxChatContent #ajaxChatInputFieldContainer #ajaxChatInputField").show();
		$("#langPick").show();
	}
	function postUpdate(filename,desc) {
		$.ajax({
			type: "get",
			url: "<?=CHtml::normalizeUrl(array('maintain/cpic'))?>",
			data: {Fname:filename,Fdesc:desc},
		}).done(function(data) { console.log(data); });
	}
</script><?php Yii::app()->clientScript->registerScript('cbChange','CBDisplay($("#Character_scenario").val());',CClientScript::POS_READY); ?>
<?php $this->widget('ext.widgets.loading.LoadingWidget'); ?>
<fieldset><?php /** @var BootActiveForm $form */
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    	'id'=>'horizontalForm',
    	'type'=>'horizontal',
    	'enableAjaxValidation' => false,
        'htmlOptions' => array( 'enctype' => 'multipart/form-data' ),
	)); 
	?>
	<?php echo CHtml::errorSummary($model); ?>
		<?php 
			echo '<h2>'.$model->getAttributeLabel('name').': '.CHtml::activeTextField($model,"name");
			echo '&nbsp;&nbsp;&nbsp;<small name="'.$model->getAttributeLabel("nickName").'"><b>'.$model->getAttributeLabel("nickName")." ".CHtml::activeTextField($model,"nickName")."</b></small></h2>";
			echo '<h4>'.$model->getAttributeLabel('scenario').": ".
						CHtml::activeDropDownList($model,'scenario',
							array($CBT->scenario(0),$CBT->scenario(1),
								  $CBT->scenario(2),$CBT->scenario(3)),
							array('onchange'=>'CBDisplay(this.value);if(this.value=="0"){$("#Character_category").val(0);}else{$("#Character_category").val(1);}')).
					"&nbsp;&nbsp;".$model->getAttributeLabel('category').": ".
						CHtml::activeDropDownList($model,"category",
							array($CBT->category(0),$CBT->category(1),$CBT->category(2)),
							array('onchange'=>'if(this.value==0){$("#Character_scenario").val(0);CBDisplay("0");}else{$("#Character_scenario").val(1);CBDisplay("1");}')).
					"&nbsp;&nbsp;".$model->getAttributeLabel('position').": ".
						CHtml::activeDropDownList($model,"position",array($CBT->position(0),$CBT->position(1))).
				'</h4>';
		?>	
		<div id="splitblock">
			<div id="split">
				<?php
					$data = array('species','sex','orientation','birthPlace','birthday');
					echo '<h3 name="basic">'.Yii::t('charaBaseModule.cb','basic').'</h3>';
					foreach($data as $label) {
						switch($label) {
							case 'sex': $html = $form->dropDownListRow($model,$label,
								array($CBT->sex(0),$CBT->sex(1),$CBT->sex(2),$CBT->sex(3),$CBT->sex(4),
								$CBT->sex(5),$CBT->sex(6),$CBT->sex(7))
							); break;
							case 'birthday': $html = $form->textFieldRow($model, $label,array('hint'=>"Format: TT.MM.JJJJ<br> If unknown: 00.00.0000 or blank")); break;
							case 'orientation': $html = $form->dropDownListRow($model,$label,array(
														$CBT->orientation(0),$CBT->orientation(1),$CBT->orientation(2),
														$CBT->orientation(3),$CBT->orientation(4),$CBT->orientation(5),
														$CBT->orientation(6),
													)
												);
												break;
							default: $html = $form->textFieldRow($model, $label); break;
						}
						echo '<div name="'.CHtml::activeName($model,$label).'">'.$html.'</div>';				
					}
				?><br>
				<?php
					$data = array('height','weight','eye_c','eye_s','hair_c', 'hair_s', 'hair_l');
					echo '<h3 name="body">'.Yii::t('charaBaseModule.cb','body').'</h3>';
					foreach($data as $label) {
						echo $form->textFieldRow($model, $label);				
					}
				?>
			</div>
			<div id="split">
				<?php
					$data = array('makeup','clothing','addit_appearance');
					echo '<h3 name="appearance">'.Yii::t('charaBaseModule.cb','appearance').'</h3>';
					foreach($data as $label) {
						switch($label) {
							case 'addit_appearance': $html = $form->textAreaRow($model,$label,array('class'=>'miniText')); break;
							default: $html = $form->textFieldRow($model, $label); break;
						}
						echo $html;
					}
				?><br>
				<?php
					$data = array(
						'spirit_status','spirit_condition','spirit_alignment', 'spirit_sub_alignment', 'spirit_type',
						'spirit_death_place', 'spirit_death_date', 'spirit_death_cause'
					);
					echo '<h3 name="spirit">'.Yii::t('charaBaseModule.cb','spirit').'</h3>';
					foreach($data as $label) {
						switch($label) {
							case 'spirit_death_date': $html = $form->textFieldRow($model, $label,array('hint'=>"Format: TT.MM.JJJJ<br> If unknown: 00.00.0000 or blank")); break;						
							case 'spirit_status': $html = $form->dropDownListRow($model,$label,array( $CBT->spirit_status(0),$CBT->spirit_status(1))); break;
							case 'spirit_condition': $html = $form->dropDownListRow($model,$label,array(
								$CBT->spirit_condition(0),$CBT->spirit_condition(1),$CBT->spirit_condition(2),
								$CBT->spirit_condition(3),$CBT->spirit_condition(4),$CBT->spirit_condition(5),
							)); break;
							case 'spirit_alignment': $html = $form->dropDownListRow($model,$label,array(
								$CBT->spirit_alignment(0),$CBT->spirit_alignment(1),$CBT->spirit_alignment(2),
							)); break;
							case 'spirit_sub_alignment': $html = $form->dropDownListRow($model,$label,array(
								$CBT->spirit_sub_alignment(0),$CBT->spirit_sub_alignment(1),$CBT->spirit_sub_alignment(2),
							)); break;
							case 'spirit_type': $html = $form->dropDownListRow($model,$label,array(
								$CBT->spirit_type(0),$CBT->spirit_type(1),
							)); break;
							default: $html = $form->textFieldRow($model, $label); break;
						}
						echo $html;				
					}
				?>
			</div>
		</div>
		<div id="clearup"></div>

		<?php echo '<hr name="literature"><h1 style="padding-top: 20px; padding-bottom: 25px;" name="literature">'.Yii::t('charaBaseModule.cb','literature').'</h1>'; ?>

		<?php
			echo '<h3 name="history">'.Yii::t('charaBaseModule.cb','history').'</h3><br>';
			echo CHtml::activeTextArea($model,'history',array('class'=>'bigText'));
		?>
		<?php
			echo '<h3 name="addit_desc">'.Yii::t('charaBaseModule.cb','addit_desc').'</h3><br>';
			echo CHtml::activeTextArea($model,'addit_desc',array('class'=>'bigText'));
		?>

		<div id="splitblock">
			<div id="split">
				<?php
					$data = array('likes');
					echo '<h3 name="likes">'.Yii::t('charaBaseModule.cb','likes').'</h3>';
					foreach($data as $label) {
						echo CHtml::activeTextArea($model,$label,array('class'=>'smallText'))."<br>";
					}
				?>
			</div>
			<div id="split">
				<?php
					$data = array('dislikes');
					echo '<h3 name="dislikes">'.Yii::t('charaBaseModule.cb','dislikes').'</h3>';
					foreach($data as $label) {
						echo CHtml::activeTextArea($model,$label,array('class'=>'smallText'))."<br>";
					}
				?>
			</div>
		</div>
		<div id="clearup"></div>

		<div id="splitblock">
			<div id="split">
				<?php
					$data = array('relationships');
					echo '<h3 name="relationships">'.Yii::t('charaBaseModule.cb','relationships').'</h3>';
					foreach($data as $label) {
						echo CHtml::activeTextArea($model,$label,array('class'=>'smallText'))."<br>";
					}
				?>
			</div>
			<div id="split">
				<?php
					$data = array('dom_sub', 'prefs','addit_adult');
					echo '<h3 name="adult">'.Yii::t('charaBaseModule.cb','adult').'</h3>';
					foreach($data as $label) {
						switch($label) {
							case 'addit_adult': $html = $form->textAreaRow($model,$label,array('class'=>'miniText')); break;
							case 'dom_sub': $html = $form->dropDownListRow($model,$label,array($CBT->ds(0),$CBT->ds(1))); break;
							default: $html = $form->textFieldRow($model, $label); break;
						}
						echo $html."<br>";
					}				
				?>
			</div>
		</div>
		<?php echo CHtml::activeTextField($model,'cpic',array("type"=>"hidden")); ?>
	    <?php $this->endWidget(); ?>
		<div id="clearup"></div>

		<div id="splitblock">
			<h2>Uploads</h2>
			<?php $code = '
				$("#cpic").fileupload({
					url: "'.CHtml::normalizeUrl(array('cpic/save')).'",
					dataType: "json",
					maxFileSize: 5000000,
           			acceptFileTypes: ["jpg","gif","bmp","png","JPG","GIF","BMP","PNG","JPGEG","jpeg"],
				    error: function(e,data) { console.log("Error: ",data); },
       				add: function (e, data) {
       					$.each(data.files, function(index,file){
			        		var ext = file.name.split(".").pop();
			        		var exts = $("#cpic").fileupload("option","acceptFileTypes");
			        		//console.log("acc: ",exts);
			        		if($.inArray(ext, exts) == -1) {
			        			alert("Selected file is disallowed");
			        		} else {
		       					Loading.show();
			        			data.submit();
			        		}
			        	});
				    },
					done: function (e, data) {
       					Loading.hide();
       					if(data.result.error==true) {
							alert("Error: "+data.result.msg);
						} else {
		    				$.each(data.result, function (index, file) {
								//console.log("working:"+file);
           						//console.log("file nr:"+file);
       							$("#"+file).empty();
       							det = $("<div />")
         							.attr("class","splitblock")
          							.attr("id",file)
									.append( $("<div/>")
										.attr("id","imgDiv")
										.append( $("<img />")
											.attr("class","show")
		       								.attr("src","'.(isset($model->cID)
												? CHtml::normalizeUrl(array('cpic/view', 'ID'=>$model->cID))
												: CHtml::normalizeUrl(array('cpic/view'))
											).'/pid/"+file)
	    	   							)
	    	   						)
    	   							.append($("<div/>")
    	   								.attr("id","imgDiv")
    	   								.append( $("<a/>")
											.attr("href","'.(isset($model->cID)
												? CHtml::normalizeUrl(array('cpic/view', 'ID'=>$model->cID))
												: CHtml::normalizeUrl(array('cpic/view'))
											).'/pid/"+file)												
											.html("Link to image")
										)
										.append( $("<a/>")
											.attr("class","btn btn-danger btn-mini")
											.attr("href","#")
		       								.click(function(e){
												e.preventDefault();
												$.ajax({
													url: "'.(isset($model->cID)
														? CHtml::normalizeUrl(array('cpic/delete', 'ID'=>$model->cID))
														: CHtml::normalizeUrl(array('cpic/delete'))
													).'/pid/"+file,
													//dataType: "JSON",
													type: "GET",
													success: function(data){ 
														console.log("ajax(del):",data);
														$("#"+file).html(null);
													},
												});
											})
											.html("X")
										)
										.append($("<br/>"))
										.append( $("<p/>").html("File name: <b>"+file.name+"</b> ("+Math.round( file.size*1/1000 )+"KB)") )
										.append($("<p/>")
											.html("Full file URL: ")
											.append($("<input/>")
												.attr("type","text")
												.attr("readonly","readonly")
												.attr("class","span8 uneditable-input descBox")
												.val("'.(isset($model->cID)
													? $this->createAbsoluteUrl('cpic/view',array('ID'=>$model->cID))
													: $this->createAbsoluteUrl('cpic/view')
												).'/pid/"+file)
											)
										)
										.append($("<span/>")
											.attr("class","goCenter")
											.html("Description: ")
											.append($("<input/>")
												.attr("type","text")
												.attr("class","span7 descBox")
												.attr("id","Character_cpic_desc_"+file)
											)
											.append($("<a/>")
												.attr("class","btn btn-success btn-small rightWalk")
												.attr("href","#")
												.html("Update")
												.click(function(e){
													e.preventDefault();
													console.log("ready: "+file);
													console.log("desc: "+$("#Character_cpic_desc_"+file).val());
													var desc = $("#Character_cpic_desc_"+file).val();
													$.ajax({
														url: "'.CHtml::normalizeUrl(array('cpic/desc')).'",
														//dataType: "JSON",
														type: "POST",
														data: {input: desc, pid: file},
														success: function(data){ 
															console.log("ajax:",data); 
															$("#desc_"+file).html("Updated description."); 
														},
													});
												})
											)
											.append($("<div/>")
												.attr("id","desc_"+file)
											)
										)
										.append( $("<div/>").attr("id","scs_"+file) )
	   	   							)
	   	   							.append( $("<div/>").attr("id","clearup") )
	   	   							.append( $("<br/>") 
	   	   							);			
   								//console.log("det",det);
   	   							$("#cpicList").append(det);
	        				});
           				}
       				},
				});'; 
			?>
			<?php
				$refresh = 'function refreshCpic(){$.getJSON("'.CHtml::normalizeUrl(array('cpic/list')).'",function(ares){
					console.log(ares);
					var data = {result: ares};
					$("#cpic").fileupload("option","done")(null, data);
				});}'; 
			?>
			<?php 
				Yii::app()->clientScript
					->registerScriptFile($this->module->assetsUrl.'/js/vendor/jquery.ui.widget.js',CClientScript::POS_HEAD)
					->registerScriptFile($this->module->assetsUrl.'/js/jquery.iframe-transport.js',CClientScript::POS_HEAD)
					->registerScriptFile($this->module->assetsUrl.'/js/jquery.fileupload.js',CClientScript::POS_HEAD)
					->registerScriptFile($this->module->assetsUrl.'/js/libs/load-image.min.js',CClientScript::POS_HEAD)
					->registerScriptFile($this->module->assetsUrl.'/js/libs/canvas-to-blob.min.js',CClientScript::POS_HEAD)
					->registerScript('fileUploader',$code,CClientScript::POS_READY)
					->registerScript('refreshCpics',$refresh,CClientScript::POS_HEAD)
					->registerScript('runRefreshCpics',"refreshCpic();",CClientScript::POS_READY);
			?>
			<p id="cpicList"></p>
			<div id="resource"></div>
			<div id="YouDontNeedToSeeThis">
				<div id="delete" style="display:none;">
					<?php $this->widget('bootstrap.widgets.TbButton', array('label'=>'X','type'=>'danger','size'=>'mini')); ?>
				</div>
			</div>
		</div>
		<div id="clearup"></div>
		
		<div style="text-align:center;">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
			    'label'=>Yii::t('charaBaseModule.cb','upload').' (max: '.(int)ini_get('post_max_size').'MB)',
			    'type'=>'inverse',
			    'size'=>'small', 
			    'htmlOptions'=>array(
			    	'onclick'=>'$("#cpic").click()'
			    ),
			)); ?>
			<?=CHtml::activeFileField($model,'cpic',array('name'=>'cpic','id'=>'cpic',/*'multiple'=>'multiple'*/))?><br>			
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit', 
				'type'=>'primary', 
				'label'=>'Submit', 
				'size'=>'small',
				'htmlOptions'=>array(
					'onclick'=>'$("#horizontalForm").submit();'
				)
			)); ?>
	    </div>
</fieldset>