<h4><?php echo $current_user->email; ?> <a href="<?php echo site_url('auth/logout') ?>" data-ajax="false" data-role="button" data-mini="true" data-inline="true">Logout</a></h4>

<?php $menu = get_sidebar_menu(); ?>
<ul data-role="listview" data-theme="b" data-mini="true">
	<?php 
		foreach ($menu as $key => $menu_item)
		{
			if ($menu_item['mobile'])
			{
				
				echo '<li><a data-transition="fade" '.$menu_item['mobile_params'].' href="'.$menu_item['link'].'" ><span class="'.$menu_item['class'].'"></span>'.$menu_item['name'].'</a></li>';
				
				foreach ($menu_item['subitems'] as $sub_item)
				{
					if($sub_item['mobile'])
					{
						echo '<li><a data-transition="fade" '.$sub_item['mobile_params'].' href="'.$sub_item['link'].'"><span class="'.$sub_item['class'].'"></span>'.$sub_item['name'].'</a></li>';
					}
				}

			
			}
		}
	?>
</ul>
<?php if(ENVIRONMENT=='development' || ENVIRONMENT=='testing') { ?>
<p><strong>Agent</strong>: <?php echo $agent; ?></p>
<p style="text-align:center"><?php echo ENVIRONMENT;?></p>
<?php } ?>