<?php if($actions['type'] == BUTTON_TYPE_ANCHOR) { ?>
<a data-role="button" href="<?php echo $actions['href'];?>" title="<?php echo strip_tags($actions['title']);?>">
	<i class="<?php echo $actions['icon'];?>"></i><?php echo $actions['text'];?>
</a>
<?php } else { ?>
<a href="<?php echo $actions['href'];?>"  title="<?php echo strip_tags($actions['title']);?>" class="<?php echo $actions['class'];?>">
	<i class="<?php echo $actions['icon'];?>"><?php echo $actions['text'];?></i>
</a>
<?php } ?>