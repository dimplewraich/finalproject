<div class="visible-lg">

	<?php if(isset($actions['settings'])) { ?>
	<a href="<?php echo $actions['settings']['href'];?>" <?php echo $actions['settings']['params'];?> title="<?php echo strip_tags($actions['settings']['title']);?>" class="btn btn-xs btn-warning btip">
		<i class="glyphicon glyphicon-cog"></i>
	</a>
	<?php } ?>

	<?php if(isset($actions['view'])) { ?>
	<a href="<?php echo $actions['view']['href'];?>" <?php echo $actions['view']['params'];?> title="<?php echo strip_tags($actions['view']['title']);?>" class="btn btn-xs btn-success btip">
		<i class="glyphicon glyphicon-eye-open"></i>
	</a>
	<?php } ?>
	
	<?php if(isset($actions['approve'])) { ?>
	<a href="<?php echo $actions['approve']['href'];?>" <?php echo $actions['approve']['params'];?> title="<?php echo strip_tags($actions['approve']['title']);?>" class="btn btn-xs btn-warning btip">
		<i class="glyphicon glyphicon-ok-sign"></i>
	</a>
	<?php } ?>
	
	<?php if(isset($actions['download'])) { ?>
	<a href="<?php echo $actions['download']['href'];?>" <?php echo $actions['download']['params'];?> title="<?php echo strip_tags($actions['download']['title']);?>" class="btn btn-xs btn-inverse btip  wht">
		<i class="glyphicon glyphicon-download-alt"></i>
	</a>
	<?php } ?>
	
	<?php if(isset($actions['edit'])) { ?>
	<a href="<?php echo $actions['edit']['href'];?>" <?php echo $actions['edit']['params'];?> title="<?php echo strip_tags($actions['edit']['title']);?>" class="btn btn-xs btn-info btip">
		<i class="glyphicon glyphicon-pencil"></i>
	</a>
	<?php } ?>
	
	<?php if(isset($actions['deactivate'])) { ?>
	<a href="<?php echo $actions['deactivate']['href'];?>" <?php echo $actions['deactivate']['params'];?> title="<?php echo strip_tags($actions['deactivate']['title']);?>" class="btn btn-xs btn-danger btip">
		<i class="fa fa-times"></i>
	</a>
	<?php } ?>
	
	<?php if(isset($actions['activate'])) { ?>
	<a href="<?php echo $actions['activate']['href'];?>" <?php echo $actions['activate']['params'];?> title="<?php echo strip_tags($actions['activate']['title']);?>" class="btn btn-xs btn-success btip">
		<i class="glyphicon glyphicon-ok-sign"></i>
	</a>
	<?php } ?>
	
	<?php if(isset($actions['delete'])) { ?>
	<a href="<?php echo $actions['delete']['href'];?>" <?php echo $actions['delete']['params'];?> title="<?php echo strip_tags($actions['delete']['title']);?>" class="btn btn-xs btn-danger btip">
		<i class="glyphicon glyphicon-trash"></i>
	</a>
	<?php } ?>
	
	<?php if(isset($actions['regions'])) { ?>
	<a href="<?php echo $actions['regions']['href'];?>" <?php echo $actions['regions']['params'];?> title="<?php echo strip_tags($actions['regions']['title']);?>" class="btn btn-xs btn-danger btip">
		<i class="glyphicon glyphicon-globe"></i>
	</a>
	<?php } ?>
	
	<?php if(isset($actions['sites'])) { ?>
	<a href="<?php echo $actions['sites']['href'];?>" <?php echo $actions['sites']['params'];?> title="<?php echo strip_tags($actions['sites']['title']);?>" class="btn btn-xs btn-danger btip">
		<i class="glyphicon glyphicon-home"></i>
	</a>
	<?php } ?>
</div>

<div class="hidden-lg">
	<div class="btn-group">
		<button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
			
			<?php if(isset($actions['view'])) { ?>
			<li><a href="<?php echo $actions['view']['href'];?>"  title="<?php echo $actions['view']['title'];?>" ><i class="fa fa-eye mr5"></i> <?php echo $actions['view']['title'];?></a></li>
			<?php } ?>
		
			<?php if(isset($actions['edit'])) { ?>
			<li><a href="<?php echo $actions['edit']['href'];?>"  title="<?php echo $actions['edit']['title'];?>" ><i class="fa fa-pencil mr5"></i> <?php echo $actions['edit']['title'];?></a></li>
			<?php } ?>
		
			<?php if(isset($actions['delete'])) { ?>
			<li><a href="<?php echo $actions['delete']['href'];?>"  title="<?php echo $actions['delete']['title'];?>" ><i class="fa fa-trash-o mr5"></i> <?php echo $actions['delete']['title'];?></a></li>
			<?php } ?>
			
			<?php if(isset($actions['settings']) || isset($actions['deactivate']) || isset($actions['activate']) || isset($actions['approve']) || isset($actions['download'])
				 || isset($actions['regions']) || isset($actions['sites'])
			) { ?>
			<li class="divider"></li>		
			<?php } ?>
			
			<?php if(isset($actions['approve'])) { ?>
			<li><a href="<?php echo $actions['approve']['href'];?>"  title="<?php echo $actions['approve']['title'];?>" ><i class="fa  fa-check-square-o mr5"></i> <?php echo $actions['approve']['title'];?></a></li>
			<?php } ?>
			
			<?php if(isset($actions['download'])) { ?>
			<li><a href="<?php echo $actions['download']['href'];?>"  title="<?php echo $actions['download']['title'];?>" ><i class="fa fa-download mr5"></i> <?php echo $actions['download']['title'];?></a></li>
			<?php } ?>
			
			<?php if(isset($actions['settings'])) { ?>			
			<li><a href="<?php echo $actions['settings']['href'];?>"  title="<?php echo $actions['settings']['title'];?>" ><i class="fa fa-cog mr5"></i> <?php echo $actions['settings']['title'];?></a></li>			
			<?php } ?>
			
			<?php if(isset($actions['deactivate'])) { ?>			
			<li><a href="<?php echo $actions['deactivate']['href'];?>"  title="<?php echo $actions['deactivate']['title'];?>" ><i class="fa fa-times mr5"></i> <?php echo $actions['deactivate']['title'];?></a></li>			
			<?php } ?>
			
			<?php if(isset($actions['activate'])) { ?>			
			<li><a href="<?php echo $actions['activate']['href'];?>"  title="<?php echo $actions['activate']['title'];?>" ><i class="fa fa-check mr5"></i> <?php echo $actions['activate']['title'];?></a></li>			
			<?php } ?>
			
			<?php if(isset($actions['regions'])) { ?>			
			<li><a href="<?php echo $actions['regions']['href'];?>"  title="<?php echo $actions['regions']['title'];?>" ><i class="fa fa-home mr5"></i> <?php echo $actions['regions']['title'];?></a></li>			
			<?php } ?>
			
			<?php if(isset($actions['sites'])) { ?>			
			<li><a href="<?php echo $actions['sites']['href'];?>"  title="<?php echo $actions['sites']['title'];?>" ><i class="fa fa-home mr5"></i> <?php echo $actions['sites']['title'];?></a></li>			
			<?php } ?>
		</ul>
	</div>
</div>