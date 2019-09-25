<link rel="stylesheet" href="/css/block.css">
<!--link rel="stylesheet" href="/css/intro.css"-->
<div class="inmain">
<!--
    <br/>
    <h3><?php echo $contentPage['Page']['title'];?></h3>
    <div class="main-intro">
        <div class="row des1-intro">
        <?php /*echo $contentPage['Page']['description'];*/?>
        </div>
    </div>
-->
	<?php echo $contentPage['Page']['description'];?>
    <div class="branch">
        <div class="tic">CÁC TRẠM & CHI NHÁNH</div>
        <div class="row main-branch">
            <?php foreach($points as $point){?>
            <div class="col-sm-4 col-md-4 item">
                <div class="main-item">
                <img src="<?php echo $point['Point']['image'];?>" alt="<?php echo $point['Point']['title'];?>">
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
    <div class="service">
    <div class="tic">DỊCH VỤ</div>
      <div class="row main-service">
        <?php foreach($services as $id => $service){?>
            <div class="col-sm-6 col-md-6 service-item">
                <a href="/dich-vu/<?php echo ($service['Page']['key']) ?>">
                    <img src="<?php echo $service['Page']['images'];?>" alt="<?php echo $service['Page']['title'];?>">
                </a>
            <div class="service-name"><a href="/dich-vu/<?php echo ($service['Page']['key']) ?>"><?php echo $service['Page']['title'];?></a></div>
            </div>
        <?php } ?>
    </div>
  </div>
</div>