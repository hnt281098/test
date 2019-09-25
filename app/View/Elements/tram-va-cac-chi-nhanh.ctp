
<?php $points = $this->App->getPoints();?>

<div class="branch">
    <div class="tic">CÁC TRẠM &amp; CHI NHÁNH</div>
    <div class="row main-branch">
        <?php foreach($points as $point){?>
            <div class="col-sm-4 col-md-4 item">
                <div class="main-item">
                	<?php if(!empty($point['Point']['image'])){ ?>
                    <img src="<?php echo $point['Point']['image'];?>" alt="<?php echo $point['Point']['title'];?>">
                    <?php } ?>
                    <div class="address-branch">
                        <p class="name-branch text-center"><?php echo $point['Point']['title'];?></p>
                        <div class="main-address">
                            <p><i class="fas fa-map-marker-alt"></i>Địa chỉ: <?php echo $point['Point']['address'];?></p>
                            <p><i class="fas fa-phone-volume"></i>Điện thoại: <?php echo $point['Point']['phone'];?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>