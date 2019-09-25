
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
        	<div class="alert alert-<?= ($resp['class'] ? $resp['class'] :'danger')?>">
			    <?php echo h($resp['msg']); ?>
			</div>
        </div>
    </div>
</div>