<div class="container">
<?php foreach ($files as $key => $icon) { ?>
    <?php if(in_array($key, array(0,1,2))) { continue;} ?>
    	<i class="fa fa<?= str_replace(":before","", $icon) ?> fa-2x"></i>
<?php } ?>
</div>