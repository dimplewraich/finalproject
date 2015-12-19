<?php if ($params['current_user']->group_name == 'admin' || $params['current_user']->group_name == 'management_company' || $params['current_user']->group_name == 'user_company') { ?>
<li>
	<div class="btn-group">
		<button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
			<i class="fa fa-shopping-cart"></i>
			<span class="badge"><?php echo ($params['por_num'] > 0) ? $params['por_num'] : '';?></span>
		</button>
		<div class="dropdown-menu dropdown-menu-head pull-right">
			<h5 class="title">PO Request ><?php echo ($params['por_num'] > 0) ? $params['por_num'] : '';?></h5>
			
			<ul class="dropdown-list">	
				<?php if ( $params['por_rows'] ) { ?>
					<?php foreach( $params['por_rows'] AS $por_row ){ ?>
					<li>
						<span class="desc" style="margin-left:0;">
							<span class="msg">
								<strong><small>Job ID : </small></strong><small><?php echo $por_row->job_id;?></small><br />
								<strong><small>Requested By : </small></strong><small><?php echo $por_row->requested_by_name;?></small><br />
								<strong><small>Requested On : </small></strong><small><?php echo local_time($por_row->requested_on, 'M d, Y @ h:ia');?></small><br />
							</span>
						</span>
						<span class="pull-right" style="line-height:normal;">
						
							<?php foreach($por_row->files AS $attachment){ ?>
							<?php
								$cdn_file = cdn_url() . DOCUMENT_FOLDER . $attachment->document_name;
								$file_headers = @get_headers($cdn_file, 1);
								
								$is_document_exist = ( strpos($file_headers[0], '404 Not Found') === FALSE && strpos($file_headers[0], '403 Forbidden') === FALSE ) ? TRUE : FALSE;
								if($is_document_exist) {
							?>
							<a href="<?php echo $cdn_file;?>" title="<?php echo $attachment->original_name;?>"><i class="fa fa-link"></i></a>
							<?php } }  ?>
						
							<a href="<?php echo site_url('purchase_orders/po_request_show/'.wdp_arr_encode(array( WDP_PO_REQUEST_ID => $por_row->id)) );?>" title="View PO Request" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "PO Request Detail", "modal" : {"buttons" : false, "size" : "modal-lg"}, "params" : "echo"}' style="width:auto;"><span class="fa fa-eye" style="margin-right:5px;"></span></a>
							<a href="<?php echo site_url('purchase_orders/po_request_update/'.wdp_arr_encode(array( WDP_PO_REQUEST_ID => $por_row->id)) );?>"  title="Mark As Complete" style="width:auto;"><span class="fa fa-check"></span></a>
						</span>
					</li>
					<?php } ?>
				<?php } else { ?>
				<li>No New records(s)</li>
				<?php } ?>
				<li class="new"><a href="<?php echo site_url('purchase_orders/po_request_list') ?>">View all PO Request(s) <i class="glyphicon glyphicon-arrow-right"></i></a></li>
			</ul>
			
		</div>
	</div>
</li>
<?php } ?>