<div class="btn-group">
	<button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
		<i class="glyphicon glyphicon-comment"></i>
		<span class="badge"><?php echo ($notification['remedial_note_count'] > 0) ? $notification['remedial_note_count'] : '';?></span>
	</button>
	<div class="dropdown-menu dropdown-menu-head pull-right">
		<h5 class="title">Remedial Notes <?php echo ($notification['remedial_note_count'] > 0) ? '( '.$notification['remedial_note_count'].' unread )' : '';?></h5>
		<ul class="dropdown-list">
			<?php if ( isset($notification['remedial_notes']) && count($notification['remedial_notes']) > 0) { ?>
			<?php $popup_atts = popup_atts(); ?>
			<?php foreach($notification['remedial_notes'] AS $message){ ?>
			<li class="new">
				<span class="desc"  style="margin-left:0;">
					<span class="name"><?php echo anchor_popup('job/show/' . $message->ref_id, !empty($message->job_ref) ? $message->job_ref : $message->ref_id, $popup_atts);?> </span>
					<span class="msg"><?php echo $message->note;?></span>
				</span>
				<span class="clearfix mt10" style="display:block">
					<span class="pull-left" style="line-height:normal;">
						<?php echo local_time($message->date_created, 'M d, Y @ H:i');?>
					</span>
					<span class="pull-right" style="line-height:normal;">
						<a href="<?php echo site_url('logs/notes/update_remedial_notes/'.$message->id);?>" title="Verify that you have dealt with this issue" class="tip" data-ajax="wdpajax" data-options='{"params" : "ajax", "success_callback" : "wdp.update_remedial_notification(response, form)"}' style="white-space:normal;">
							<span class="badge badge-success"><i class="glyphicon glyphicon-ok" style="margin-right:5px;"> </i>Mark as actioned</span>
						</a>
					</span>
				</span>
			</li>
			<?php }} else { ?>
				<li class="new">No New Remedial Notification(s)</li>
			<?php } ?>
			<li class="new"><a href="<?php echo site_url('logs/rnotifications') ?>">View all Remedial Note(s) <i class="glyphicon glyphicon-arrow-right"></i></a></li>			
		</ul>
	</div>
</div>