<?php $services  = $this->App->getServices();?>
<div class="service">
    <div class="tic">DỊCH VỤ</div>
    <div class="row main-service">
        <?php foreach($services as $id => $service){?>
            <div class="col-sm-6 col-md-6 service-item">
            	<?php if($service['Page']['images']){ ?>
                <a href="/dich-vu/<?php echo ($service['Page']['key']) ?>">
                    <img src="<?php echo $service['Page']['images'];?>" alt="<?php echo $service['Page']['title'];?>">
                </a>
                <?php }?>
                <div class="service-name"><a href="/dich-vu/<?php echo ($service['Page']['key']) ?>"><?php echo $service['Page']['title'];?></a></div>
            </div>
        <?php } ?>
    </div>
</div>
