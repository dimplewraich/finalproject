<?php echo form_open($form_action,' name="frm-qform" class="form-horizontal" data-ajax="wdpajax" data-options=\'{"params" : "ajax", "loader" : "modal"}\'', $hiddenvars);?>
			
<div class="row">
	
	<div class="col-sm-12">
	
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form_section_id">Section Page:</label>
			<div class="col-sm-7">
				<?php echo form_dropdown('form_section_id', cust_tbls_dropdown('return', 'form_section', TRUE), $form_section_id ,'class="form-control input-sm" data-placeholder="Select section page"'); ?>
				<?php echo form_error('form_section_id','<label class="error">','</label>');?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="description">Description:</label>
			<div class="col-sm-8">
				<?php echo form_input('description', $description, 'id="description" class="form-control input-sm"'); ?>
				<?php echo form_error('description','<label class="error">','</label>');?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="help_text">Help Text:</label>
			<div class="col-sm-8">
				<textarea name="help_text" cols="40" rows="5" id="help_text" class="form-control input-sm"><?php echo $help_text;?></textarea>
				<?php echo form_error('help_text','<label class="error">','</label>');?>
			</div>
		</div>
	
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="question_type">Question Type:</label>
			<div class="col-sm-7">
				<?php echo form_dropdown('question_type', array('' => '','date' => 'date', 'text' => 'text', 'textarea' => 'textarea', 'yes_no' => 'yes_no', 'upload' => 'upload', 'select' => 'select', 'checkbox' => 'checkbox', 'radio' => 'radio', 'database_table' => 'database_table'), $question_type ,'class="required form-control" data-placeholder="Select option"'); ?>
				<?php echo form_error('question_type','<label class="error">','</label>');?>
			</div>
		</div>

		<div class="form-group div-allowed-types" <?php if($question_type != 'upload'){?>style="display:none;"<?php } ?>>
			<label class="col-sm-3 control-label no-padding-right" for="allowed_types">Allowed Types:</label>
			<div class="col-sm-7">
				<?php echo form_dropdown('allowed_types[]', array('gif' => 'gif', 'jpg' => 'jpg', 'jpeg' => 'jepg', 'png' => 'png'), $allowed_types ,'class="form-control input-sm" data-placeholder="Select option" multiple="multiple"'); ?>
				<?php echo form_error('allowed_types','<label class="error">','</label>');?>
			</div>
		</div>

		<div class="form-group div-max-size" <?php if($question_type != 'upload'){?>style="display:none;"<?php } ?>>
			<label class="col-sm-3 control-label no-padding-right" for="max_size">Max Size:</label>
			<div class="col-sm-8">
				<?php echo form_input('max_size', $max_size, 'id="max_size" class="form-control input-sm"'); ?>
				<?php echo form_error('max_size','<label class="error">','</label>');?>
			</div>
		</div>

		<div class="form-group div-db-table" <?php if($question_type != 'database_table'){?>style="display:none;"<?php } ?>>
			<label class="col-sm-3 control-label no-padding-right" for="db_table">Table:</label>
			<div class="col-sm-7">
				<?php echo form_dropdown('db_table', array('' => '', 'panels' => 'Panels', 'ranking' => 'Ranking', 'shelter_types' => 'Shelter Types'), $db_table ,'class="form-control input-sm" data-placeholder="Select option"'); ?>
				<?php echo form_error('db_table','<label class="error">','</label>');?>
			</div>
		</div>

		<div class="form-group div-options"<?php if( !in_array($question_type, array('select','checkbox', 'radio')) ){?>style="display:none;"<?php } ?>>
			<label class="col-sm-3 control-label no-padding-right" for="options">Options:</label>
			<div class="col-sm-8">
				<textarea name="options" cols="40" rows="5" id="options" class="form-control input-sm"><?php echo $options;?></textarea>
				<span class="help-block">Example:-<br />option1:option1<br />option2:option2<br />option3:option3</span>
				<?php echo form_error('options','<label class="error">','</label>');?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="sort_order">Sort Order:</label>
			<div class="col-sm-8">
				<?php echo form_input('sort_order', $sort_order, 'id="sort_order" class="form-control input-sm"'); ?>
				<?php echo form_error('sort_order','<label class="error">','</label>');?>
			</div>
		</div>
		
	</div>
	
</div>

<?php echo form_close();?>
<?php echo load_js('survey/qform.js');?>