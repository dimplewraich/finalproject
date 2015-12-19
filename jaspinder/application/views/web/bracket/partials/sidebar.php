<div class="logopanel">
	<h1><a class="brand" href="<?php echo site_url('dashboard');?>"><img src='<?php echo base_url(); ?>/assets/images/logo.png' ></a></h1>
</div>

<div class="leftpanelinner">
	
	<div class="visible-xs hidden-sm hidden-md hidden-lg">   
		<div class="media userlogged">
			<?php
				$file = base_url() . 'documents/profile/' . @$current_user->avatar;
				$file_headers = @get_headers($file);
				
				if (isset($current_user->avatar) && !(strpos($file_headers[0], '404 Not Found'))  && !(strpos($file_headers[0], '403 Forbidden'))) {
					echo '<img src="' . base_url() . 'documents/profile/' . $current_user->avatar . '" alt="" class="nav-user-photo" />';
				} else {

					echo '<img src="' . $asset_url . 'images/' . DEFAULT_IMAGE . '" alt="" class="nav-user-photo" />';
				}
			?>
			<div class="media-body">
				<h4><?php echo $current_user->first_name; ?> <?php echo $current_user->last_name; ?></h4>
			</div>
		</div>
	  
		<h5 class="sidebartitle actitle">Account</h5>
		<ul class="nav nav-pills nav-stacked nav-bracket mb30">
		  <li><a href="<?php echo site_url('profile') ?>"><i class="fa fa-user"></i> <span>Profile</span></a></li>
		  <li><a href="<?php echo site_url('auth/logout'); ?>"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
		</ul>
	</div>
	
	<h5 class="sidebartitle"><!--Navigation--> &nbsp;</h5>
	
	<?php $menu = get_sidebar_menu();?>
	
	<ul class="nav nav-pills nav-stacked nav-bracket">
		<?php foreach($menu as $key => $menu_item){ ?>
		<?php $show_on_website = isset($menu_item['website']) ? $menu_item['website'] : TRUE; ?>
		
		<?php if($show_on_website) { ?>
		
		<?php if(count($menu_item['subitems'])){ ?>
		
		<li class="nav-parent">
			<a href="<?php echo $menu_item['link'];?>">
				<i class="<?php echo $menu_item['class']; ?>"></i>
				<span><?php echo $menu_item['name'] ?></span>
			</a>

			<ul class="children">
				<?php foreach($menu_item['subitems'] as $subs){ ?>
				<li><a href="<?php echo $subs['link'] ?>"><i class="fa fa-caret-right"></i> <?php echo $subs['name'] ?></a></li>
				<?php } ?>
			</ul>
		</li>
		
		<?php } else { ?>
		
		<li>
			<a href="<?php echo $menu_item['link'] ?>">
				<i class="<?php echo $menu_item['class']; ?>"></i>
				<span> <?php echo $menu_item['name'] ?> </span>
			</a>
		</li>
		
		<?php } ?>
		
		<?php } ?>
		
		<?php } ?>
	</ul>
	<?php if(ENVIRONMENT=='development' || ENVIRONMENT=='testing') { ?>
	<h3 style="text-align:center"><?php echo strtoupper(substr(ENVIRONMENT, 0, 3));?></h3>
	<?php } ?>
</div>