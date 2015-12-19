<?php /*<div data-role="controlgroup">*/ ?>
	<?php if(isset($actions['view'])) { ?>
	<a data-role="button" data-theme="a" href="<?php echo $actions['view']['href'];?>" title="<?php echo strip_tags($actions['view']['title']);?>" ><i class="fa fa-eye mr5"></i></a>
	<?php } ?>
	<?php if(isset($actions['edit'])) { ?>
	<a data-role="button" data-theme="a" href="<?php echo $actions['edit']['href'];?>" title="<?php echo strip_tags($actions['edit']['title']);?>" ><i class="fa fa-pencil mr5"></i></a>
	<?php } ?>
	<?php if(isset($actions['delete'])) { ?>
	<a data-role="button" data-theme="a" href="<?php echo $actions['delete']['href'];?>" title="<?php echo strip_tags($actions['delete']['title']);?>"><i class="fa fa-trash-o mr5"></i></a>
	<?php } ?>
<?php /*</div>*/ ?>