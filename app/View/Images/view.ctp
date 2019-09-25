<div class="container">
	<div class="col-md-12">
		<?php echo $this->Element('breadcrumb');?>
		<div class="clear-fix"></div>
		<br/>
		<div id="grid" data-columns>
		
		<?php foreach($imageLibrary as $image){ ?>
			<div class="items" class="column size-1of3">
				<a rel="group" href="<?php echo $image;?>">
					<img src="<?php echo $image;?>" rel="group" class="img-thumbnail"/>
				</a>
			</div>
		<?php }?>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo SERVER;?>/js/salvattore.min.js"></script>
<script type="text/javascript" src="<?php echo SERVER;?>/js/jquery.fancybox.js"></script>
<link rel="stylesheet" href="<?php echo SERVER;?>/css/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
	$("a[rel=group]").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false
	});
});
</script>