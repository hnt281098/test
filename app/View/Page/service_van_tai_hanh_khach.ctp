<link rel="stylesheet" href="/css/block.css">
<link rel="stylesheet" href="/css/passenger.css">
<link rel="stylesheet" href="/css/schedule.css">

<div class="inmain">
        <div class="customer">
          <div class="main-customer">
            <div class="tic">VẬN TẢI HÀNH KHÁCH</div>
            <div class="inmain-customer">
              <h2 class="text-center">
              <?php echo $this->App->render('gioi-thieu-dich-vu-van-chuyen', $content, FRONT_END_PAGE_ID);?>
              </h2>
              <div class="row item">
                <div class="col-sm-6 col-md-6 item-img">
                	 <?php echo $this->App->renderImg('gioi-thieu-dich-vu-van-chuyen-hinh-anh-1', $content, FRONT_END_PAGE_ID);?>
                  	<img src="<?php echo $this->App->renderRaw('gioi-thieu-dich-vu-van-chuyen-hinh-anh-1', FRONT_END_PAGE_ID);?>" alt="">
                </div>
                <div class="col-sm-6 col-md-6 item-text">
                  <!--p class="title">Xe Giường nằm</p-->
                  <p><?php echo $this->App->render('gioi-thieu-xe-1', $content, FRONT_END_PAGE_ID,'textarea');?><br>
                  </p>
                </div>
              </div>
              <div class="row item">
                <div class="col-sm-6 col-md-6 item-text">
                  <!--p class="title">Xe ghế ngồi limousine 9 chỗ</p-->
                  <p>
                  <?php echo $this->App->render('gioi-thieu-xe-2', $content, FRONT_END_PAGE_ID,'textarea');?>
                  </p>
                </div>
                <div class="col-sm-6 col-md-6 item-img">
                	<?php echo $this->App->renderImg('gioi-thieu-dich-vu-van-chuyen-hinh-anh-2', $content, FRONT_END_PAGE_ID);?>
                  <img src="<?php echo $this->App->renderRaw('gioi-thieu-dich-vu-van-chuyen-hinh-anh-2',  FRONT_END_PAGE_ID);?>" alt="">
                </div>
              </div>
              <div class="row item">
                <div class="col-sm-6 col-md-6 item-img">
                	<?php echo $this->App->renderImg('gioi-thieu-dich-vu-van-chuyen-hinh-anh-3', $content, FRONT_END_PAGE_ID);?>
                  <img src="<?php echo $this->App->renderRaw('gioi-thieu-dich-vu-van-chuyen-hinh-anh-3', FRONT_END_PAGE_ID);?>" alt="">
                </div>
                <div class="col-sm-6 col-md-6 item-text">
                  <!--p class="title">Xe ghế ngồi 22 chỗ bình dân</p-->
                  <p><?php echo $this->App->render('gioi-thieu-xe-3', $content, FRONT_END_PAGE_ID,'textarea');?>
                  </p>
                </div>
              </div>
              <div class="row item">
                <div class="col-sm-6 col-md-6 item-text">
                  <!--p class="title">Xe ghế ngồi cao cấp 45 chỗ unilever</p-->
                  <p><?php echo $this->App->render('gioi-thieu-xe-4', $content, FRONT_END_PAGE_ID,'textarea');?>
                  </p>
                </div>
                <div class="col-sm-6 col-md-6 item-img">
                  <?php echo $this->App->renderImg('gioi-thieu-dich-vu-van-chuyen-hinh-anh-4', $content, FRONT_END_PAGE_ID);?>
                  <img src="<?php echo $this->App->renderRaw('gioi-thieu-dich-vu-van-chuyen-hinh-anh-4',FRONT_END_PAGE_ID);?>" alt="">
                </div>
              </div>
              <div class="row item">
                <div class="col-sm-6 col-md-6 item-img">
                	<?php echo $this->App->renderImg('gioi-thieu-dich-vu-van-chuyen-hinh-anh-5', $content, FRONT_END_PAGE_ID);?>
                  <img src="<?php echo $this->App->renderRaw('gioi-thieu-dich-vu-van-chuyen-hinh-anh-5', FRONT_END_PAGE_ID);?>" alt="">
                </div>
                <div class="col-sm-6 col-md-6 item-text">
                  <!--p class="title">Xe ghế ngồi 22 chỗ bình dân</p-->
                  <p><?php echo $this->App->render('gioi-thieu-xe-5', $content, FRONT_END_PAGE_ID,'textarea');?>
                  </p>
                </div>
              </div>
            </div>
          </div>

          <?php echo $this->Element('lich-chay-xe');?>
          <?php echo $this->Element('dia-chi');?>
          <?php echo $this->Element('tram-va-cac-chi-nhanh');?>
          <?php echo $this->Element('dich-vu');?>
      </div>
</div>
