<?php $provinces = provinces();?>
<?php $address  = $this->App->getAddress();?>
<div class="contact">
    <div class="icon-contact">
        <img src="/images/customer/iconpassenger.png" alt="">
    </div>
    <div class="main-contact">
        <?php foreach($provinces as $key => $provinceName){?>
            <div class="item">
                <div class="header-item">
                    <p><i class="fas fa-map-marker-alt"></i><?php echo $provinceName;?></p>
                </div>
                <div class="main-item">
                <?php foreach($address as $id => $addressItem){ ?>
                    <?php if($addressItem['Address']['province_id'] == $key){ ?>
                    <div class="row inner-item">
                        <div class="col-sm-4 col-md-4 left-contact">
                            <p><?php echo $addressItem['Address']['name'];?></p>
                        </div>
                        <div class="col-sm-8 col-md-8 right-contact">
                            <p><span>Địa chỉ : </span><?php echo $addressItem['Address']['address'];?></p>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 right-item">
                                    <p><span>Đặt vé </span><i class="fas fa-phone"></i><?php echo $addressItem['Address']['phone1'];?></p>
                                </div>
                                <div class="col-sm-6 col-md-6 right-item">
                                    <p><span>Gửi hàng </span><i class="fas fa-phone"></i><?php echo $addressItem['Address']['phone2'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                <?php }?>
                </div>
            </div>
        <?php }?>
    </div>
</div>
