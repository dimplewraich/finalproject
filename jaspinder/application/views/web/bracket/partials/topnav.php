<a class="menutoggle"><i class="fa fa-bars"></i></a>
<div class="header-left">
	<ul class="headermenu">
		<li>
			<div class="btn-group">
				<a class="btn btn-default dropdown-toggle tp-icon" href="<?php echo site_url('dashboard');?>">Dashboard</a>
			</div>
		</li>
	</ul>
</div>
<div class="header-right">
	<ul class="headermenu">
		
		<li>
			<div class="btn-group">
				<button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
					<i class="glyphicon glyphicon-cog"></i>
				</button>
				<div class="dropdown-menu dropdown-menu-head pull-right">
					<h5 class="title">Settings</h5>
					
					
					<ul class="dropdown-list">
						
						<?php if ($current_user->group_id == GROUP_ADMIN) { ?>
						<li>
							<div class="desc" style="margin-left:0;">
								<h5><a href="<?php echo site_url('agencies'); ?>"><i class="fa fa-building"></i>Agencies</a></h5>
							</div>
						</li>
						<li>
							<div class="desc" style="margin-left:0;">
								<h5><a href="<?php echo site_url('users'); ?>"><i class="fa fa-users"></i>System Users</a></h5>
							</div>
						</li>
						<?php } ?>
						
						<?php if ($current_user->group_id == GROUP_ADMIN || $current_user->group_id == GROUP_MANAGEMENT_COMPANY) { ?>
						<li>
							<div class="desc" style="margin-left:0;">
								<h5><a href="<?php echo site_url('sites'); ?>"><i class="fa fa-home"></i>Sites</a></h5>
							</div>
						</li>
						<?php } ?>
						
					</ul>
					
					
				</div>
            </div>
		</li>
		
		<li>
            <?php //$this->load->view("web/{$default_theme}/partials/notifications");?>
		</li>
		
		<li>
            <div class="btn-group">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <?php
					$file = base_url() . 'documents/profile/' . @$current_user->avatar;
					$file_headers = @get_headers($file);
					
					if (isset($current_user->avatar) && !(strpos($file_headers[0], '404 Not Found'))  && !(strpos($file_headers[0], '403 Forbidden'))) {
						echo '<img src="' . base_url() . 'documents/profile/' . $current_user->avatar . '" alt="" class="nav-user-photo" />';
					} else {

						echo '<img src="' . $asset_url . 'images/' . DEFAULT_IMAGE . '" alt="" class="nav-user-photo" />';
					}
				?>
                <?php echo $current_user->first_name; ?> <?php echo $current_user->last_name; ?>
                <span class="caret"></span>
				</button>
              
				<ul class="dropdown-menu dropdown-menu-usermenu pull-right">
					<li><a href="<?php echo site_url('profile') ?>"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
				
					<?php if ($current_user->group_id == GROUP_ADMIN) { ?>
					
					<li><a href="<?php echo site_url('settings/account'); ?>" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Account Settings", "modal" : {"buttons" : true, "override" : true}, "params" : "echo"}'><i class="fa fa-cog"></i> Account Settings</a></li>
					<?php } ?>
					<?php /*} elseif ($current_user->group_name == 'management_company') { ?>
				
					<li><a href="<?php echo site_url('settings/myaccount/'.serialize_object()); ?>" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Account Settings", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true}, "params" : "echo"}'><i class="fa fa-cog"></i>Account Settings</a></li>
					
					<?php }*/ ?>
				
					<li><a href="<?php echo site_url('auth/logout'); ?>"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
				</ul>
            </div>
		</li>
	</ul>
</div>