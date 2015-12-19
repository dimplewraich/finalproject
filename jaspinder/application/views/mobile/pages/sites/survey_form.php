<form name="frm-site-survey" data-ajax="false" action="<?php echo @$form_action; ?>" method="post" data-ajax="false" data-disabled="true" enctype="multipart/form-data" <?php /*sajax="wdp_ajax" options='{"params" : "ajax", "callback" : "wdp.callback_job(response);"}'*/ ?>>
	<?php if($survey_completed){ ?>
	<div class="success message">
		<h3>Congrats, you did it!</h3>
		<p>Survey for Site "<?php $site_info->site_code;?>" completed successfully.</p>
		<p><a href="<?php echo site_url('sites/survey/'.serialize_object());?>" data-ajax="false" data-role="false">Click here</a> to search again</p>
		<p><a href="<?php echo site_url('auth/logout');?>" data-ajax="false" data-role="false">Click here</a> to logout</p>
	</div>
	<?php } elseif($site_form_id > 0 && $site_id > 0 && $form_type_id > 0){ ?>
		<?php echo form_hidden('question_id', $form_question->question_id);?>
		<?php if($form_question->question_type == 'date') { ?>
		<div class="ui-field-contain" style="border-width:0;">
			<label for="answer"><Strong><?php echo $form_question->question_desc;?></strong></label>
			<input type="date" name="answer" id="answer" value="<?php echo $form_question->answer;?>" data-mini="true">
		</div>
		<?php /*<div class="ui-field-contain" style="border-width:0;"><textarea name="notes" id="notes" data-role="none" rows="5" style="height:150px;" class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-mini ui-textinput-autogrow"><?php echo $form_question->notes;?></textarea></div>*/ ?>
		<?php } elseif($form_question->question_type == 'text') { ?>
		<div class="ui-field-contain" style="border-width:0;">
			<label for="answer"><Strong><?php echo $form_question->question_desc;?></strong></label>
			<input type="text" name="answer" id="answer" value="<?php echo $form_question->answer;?>" data-mini="true">
		</div>
		<?php } elseif($form_question->question_type == 'textarea') { ?>
		<div class="ui-field-contain" style="border-width:0;">
			<label for="answer"><Strong><?php echo $form_question->question_desc;?></strong></label>
			<textarea name="answer" id="answer" data-role="none" rows="5" style="height:150px;" class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-mini ui-textinput-autogrow"><?php echo $form_question->answer;?></textarea>
		</div>
		<?php } elseif($form_question->question_type == 'yes_no') { ?>
		<div class="ui-field-contain" style="border-width:0;">
			<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
				<legend><Strong><?php echo $form_question->question_desc;?></strong></legend>
				<input type="radio" name="answer" id="answer_1" value="Yes" <?php if($form_question->answer=='Yes') { ?>checked="checked"<?php } ?>>
				<label for="answer_1">Yes</label><input type="radio" name="answer" id="answer_2" value="No" <?php if($form_question->answer=='No') { ?>checked="checked"<?php } ?>>
				<label for="answer_2">No</label><input type="radio" name="answer" id="answer_3" value="NA" <?php if($form_question->answer!='Yes' &&  $form_question->answer!='No') { ?>checked="checked"<?php } ?>>
				<label for="answer_3">N/A</label>
			</fieldset>
		</div>
		<div class="ui-field-contain" style="border-width:0;"><textarea name="notes" id="notes" data-role="none" rows="5" style="height:150px;" class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-mini ui-textinput-autogrow"><?php echo $form_question->notes;?></textarea></div><?php } elseif($form_question->question_type == 'upload') { ?><div class="ui-field-contain" style="border-width:0;">
				<label for="answer"><?php echo $form_question->question_desc;?></label>
				<input type="file" name="answer" id="answer"><div class="clearfix" style="margin-top:10px;">
<?php if(isset($form_question->answer)) { 
	$file = cdn_url() . 'documents/' . $form_question->answer;$file_headers = @get_headers($file);if (isset($form_question->answer) && !empty($form_question->answer) && !(strpos($file_headers[0], '404 Not Found'))   && !(strpos($file_headers[0], '403 Forbidden'))) {echo '<img src="' . cdn_url() . 'documents/' . $form_question->answer . '" alt="" class="image" style="margin-top:10px;" />';} else {echo '<img src="' . $asset_url . 'images/' . DEFAULT_IMAGE . '" alt="" class="image" style="margin-top:10px;" />';}}?></div></div><div class="ui-field-contain" style="border-width:0;"><textarea name="notes" id="notes" data-role="none" rows="5" style="height:150px;" class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-mini ui-textinput-autogrow"><?php echo $form_question->notes;?></textarea></div><p><?php echo $form_question->help_text;?></p><?php } elseif($form_question->question_type == 'select') { ?><div class="ui-field-contain" style="border-width:0;">
<label for="answer"><Strong><?php echo $form_question->question_desc;?></strong></label><?php $options = array("" => "");$opt_rows = explode("\n", $form_question->options);foreach($opt_rows AS $opt_row){$opt_row = explode(':', $opt_row);$options[$opt_row[0]] = isset($opt_row[1]) ? $opt_row[1] : '';}?><?php echo form_dropdown('answer', $options, $form_question->answer, 'id="answer" data-placeholder="Select a option" data-role="none"'); ?></div><div class="ui-field-contain" style="border-width:0;"><textarea name="notes" id="notes" data-role="none" rows="5" style="height:150px;" class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-mini ui-textinput-autogrow"><?php echo $form_question->notes;?></textarea></div><?php } elseif($form_question->question_type == 'radio') { ?><?php $options = array();$opt_rows = explode("\n", $form_question->options);foreach($opt_rows AS $opt_row){$opt_row = explode(':', $opt_row);$options[$opt_row[0]] = isset($opt_row[1]) ? $opt_row[1] : '';}?><div class="ui-field-contain" style="border-width:0;"><fieldset data-role="controlgroup" data-type="vertical" data-mini="true"><legend><Strong><?php echo $form_question->question_desc;?></strong></legend><?php $index=1; foreach($options AS $option) { ?><input type="radio" name="answer" id="answer_<?php echo $index;?>" value="<?php echo $option;?>" <?php if($form_question->answer==$option) { ?>checked="checked"<?php } ?>>
<label for="answer_<?php echo $index;?>"><?php echo $option;?></label><?php $index++; } ?></fieldset></div><div class="ui-field-contain" style="border-width:0;"><textarea name="notes" id="notes" data-role="none" rows="5" style="height:150px;" class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-mini ui-textinput-autogrow"><?php echo $form_question->notes;?></textarea></div><?php } elseif($form_question->question_type == 'checkbox') { ?><?php $options = array();$opt_rows = explode("\n", $form_question->options);foreach($opt_rows AS $opt_row){$opt_row = explode(':', $opt_row);$options[$opt_row[0]] = isset($opt_row[1]) ? $opt_row[1] : '';}?><div class="ui-field-contain" style="border-width:0;"><fieldset data-role="controlgroup" data-type="vertical" data-mini="true"><legend><Strong><?php echo $form_question->question_desc;?></strong></legend><?php $index=1; foreach($options AS $option) { ?><input type="checkbox" name="answer" id="answer_<?php echo $index;?>" value="<?php echo $option;?>" <?php if($form_question->answer==$option) { ?>checked="checked"<?php } ?>>
<label for="answer_<?php echo $index;?>"><?php echo $option;?></label><?php $index++; } ?></fieldset></div><div class="ui-field-contain" style="border-width:0;"><textarea name="notes" id="notes" data-role="none" rows="5" style="height:150px;" class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-mini ui-textinput-autogrow"><?php echo $form_question->notes;?></textarea></div><?php } ?><button type="submit" data-theme="b" name="submit">Next</button><?php } elseif( count($site_rows) > 0) { ?><?php $anysiteshown = FALSE; foreach($site_rows AS $site_row){ ?><?php /*if($site_row->site_forms) { $anysiteshown = TRUE;*/ ?><div data-role="collapsible" <?php /*data-inset="false"*/ ?>><h4><?php echo $site_row->code;?></h4><div class="ui-field-contain">
<label><Strong>Address</strong>: <?php echo $site_row->address;?></label>
<label><Strong>POSTCODE</strong>: <?php echo $site_row->postcode;?></label>
<label><Strong>SHELTER TYPE</strong>: <?php echo $site_row->shelter_type;?></label></div><ul data-role="listview"><?php foreach($site_row->site_forms AS $site_form){ ?><li><a data-ajax="false" href="<?php echo site_url('sites/survey/'.serialize_object(array(SYS_SITE_FORM_ID => $site_form->id, SYS_SITE_ID => $site_row->site_id, SYS_FORM_TYPE_ID => $site_form->form_type_id)));?>" data-mini="true"><?php echo $site_form->form_name;?></a></li><?php } ?></ul></div><?php /*}*/ ?>
<?php } ?>
<?php /*if(!$anysiteshown){ ?><p><a href="<?php echo site_url('sites/survey/'.serialize_object());?>" data-ajax="false" data-role="false">Click here</a> to search again</p><?php } */ ?>
<?php } else { ?><div data-role="fieldcontain">
<label for="site_code">SITE NO: </label><?php echo form_dropdown('site_code', site_fields_dropdown('return', array('first_row' => TRUE, 'field_name' => 'code')), '', 'id="site_code" data-mini="true" data-placeholder="Select Site By Site NO" data-role="none"'); ?>
<?php echo form_error('site_code','
<label class="error">','</label>'); ?></div><div data-role="fieldcontain">
<label for="site_ref">SITE REF: </label><?php echo form_dropdown('site_ref', site_fields_dropdown('return', array('first_row' => TRUE, 'field_name' => 'site_ref')), '', 'id="site_ref" data-mini="true" data-placeholder="Select Site By SIte REF" data-role="none"'); ?>
<?php echo form_error('site_ref','
<label class="error">','</label>'); ?></div><div data-role="fieldcontain">
<label for="site_district">DISTRICT NO: </label>
<?php echo form_dropdown('site_district', site_fields_dropdown('return', array('first_row' => TRUE, 'field_name' => 'district_no')), '', 'id="site_district" data-mini="true" data-placeholder="Select District" data-role="none"'); ?>
<?php echo form_error('site_district','
<label class="error">','</label>'); ?></div><div data-role="fieldcontain">
<label for="postcode">POSTCODE: </label><?php echo form_dropdown('postcode', site_fields_dropdown('return', array('first_row' => TRUE, 'field_name' => 'postcode')), '', 'id="postcode" data-mini="true" data-placeholder="Select District" data-role="none"'); ?>
<?php echo form_error('postcode','
<label class="error">','</label>'); ?></div><button type="submit" data-theme="b" name="submit">Submit</button><?php } ?></form><script type="text/javascript">var page_id = "#<?php echo $page_id;?>";</script><?php echo load_js('sites/survey.js');?>