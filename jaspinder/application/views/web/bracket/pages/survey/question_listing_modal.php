<div class="row">
	<div class="col-md-12">
	
		<a href="<?php echo $new_qcreate_url;?>" class="btn btn-sm btn-warning mb10 pull-right" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Question Detail", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "modal_success_callback" : "gl.site.listing.load_grid(g);"}, "params" : "echo"}'><i class="fa fa-plus mr5"></i>New Question</a>
		
		<div class="row">
			<div class="col-md-12">
				<div id="sortable_accordion" class="panel-group panel-group-dark">
				<?php foreach($qrows AS $index=>$qrow){ ?>
					<div id="ccl_<?php echo $qrow->question_id;?>"  class="panel panel-default ui-state-default" style="margin-top: 5px;">
						<div class="panel-heading">
							<h3 class="panel-title">
								<a data-toggle="collapse" class="collapsed" data-parent="#sortable_accordion" href="#collapse_<?php echo $qrow->question_id;?>"><?php echo $qrow->description;?></a>
								<?php if( in_array($current_user->group_id, array(GROUP_ADMIN)) ) { ?>
								<a style="padding:5px;line-height:14px;margin:-36px 45px 0 0;" href="<?php echo site_url('survey/qedit/'.serialize_object(array(SYS_FORM_TYPE_ID => $form_type_id, SYS_QUESTION_ID => $qrow->question_id)));?>" class="btn btn-xs btn-warning btn-edit pull-right wht" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Question Detail", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "gl.qform.listing._sort_callback();"}, "params" : "echo"}'><i class="fa fa-pencil"></i></a>
								<a style="padding:5px;line-height:14px;margin:-36px 15px 0 0;" href="<?php echo site_url('survey/qdelete/'.serialize_object(array(SYS_FORM_TYPE_ID => $form_type_id, SYS_QUESTION_ID => $qrow->question_id)));?>" class="btn btn-xs btn-warning btn-edit pull-right wht" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Delete Question", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "gl.qform.listing._sort_callback();"}, "params" : "echo"}'><i class="fa fa-trash-o"></i></a>
								<?php } ?>
							</h3>
						</div>
						<div id="collapse_<?php echo $qrow->question_id;?>" class="panel-collapse collapse">
							<div class="panel-body">
								<?php echo $qrow->description;?>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo load_js('survey/questions.js'); ?>