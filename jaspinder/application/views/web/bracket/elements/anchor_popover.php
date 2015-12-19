<a class="userPop no-unln width-300" rel="popover" data-placement="<?php echo isset($params['placement'])?$params['placement']:'right';?>" 
	data-content="<?php echo $params['content'];?>" 
	data-title="<?php echo $params['title'];?>" 
	<?php echo isset($params['extras']) ? $params['extras'] : '';?>
><?php echo $params['icon'] ? '<span class="fa fa-user mr5"></span>' : '';?><?php echo $params['text'];?></a>