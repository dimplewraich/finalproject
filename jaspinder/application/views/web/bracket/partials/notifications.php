<div class="btn-group">
	<button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
		<i class="glyphicon glyphicon-bell"></i>
		<span class="badge"><?php echo ($notification['message_count'] > 0) ? $notification['message_count'] : '';?></span>
	</button>
	<div class="dropdown-menu dropdown-menu-head pull-right">
		<h5 class="title">Notifications <?php echo ($notification['message_count'] > 0) ? '( '.$notification['message_count'].' unread )' : '';?></h5>
		
		<ul class="dropdown-list">	
			<?php if ( isset($notification['messages']) && count($notification['messages']) > 0) { ?>
			<?php foreach($notification['messages'] AS $message){ ?>
			<li>
				<span class="desc" style="margin-left:0;">
				  <span class="name"><?php echo $message->subject;?></span>
				  <span class="msg"></span>
				</span>
                <span class="pull-right" style="line-height:normal;">
					<a href="<?php echo site_url('logs/notifications/view/'.$message->id);?>" title="View Message" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Message Detail", "modal" : {"buttons" : false}, "params" : "echo"}' style="width:auto;"><span class="glyphicon glyphicon-eye-open" style="margin-right:5px;"></span></a>
					<a href="<?php echo site_url('logs/notifications/delete/'.$message->id);?>"  title="Remove Message" data-ajax="wdpajax" data-options='{"params" : "ajax", "success_callback" : "g.reload_notifications()"}' style="width:auto;"><span class="glyphicon glyphicon-trash"></span></a>
				</span>
			</li>
			<?php } ?>
			<?php } else { ?>
			<li>No New notification(s)</li>
			<?php } ?>
			<li class="new"><a href="<?php echo site_url('logs/notifications') ?>">View all notifications <i class="glyphicon glyphicon-arrow-right"></i></a></li>
		</ul>
		
	</div>
</div>