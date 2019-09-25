<link rel="stylesheet" href="/css/block.css">
<link rel="stylesheet" href="/css/recruitment.css">
<div class="inmain">
        <div class="recruitment">
          <div class="tic">TUYỂN DỤNG</div>
          <div class="main-recruitment">
            <div class="div1 clearfix">
              <div class="des-recruitment">
                <p>Nhằm mở rộng và nâng cao chất lượng dịch vụ, chúng tôi cần tuyển dụng các vị trí sau: </p>
                <?php echo $page['Page']['description'];?>
              </div>
              <div class="img">
                <img src="<?php echo $page['Page']['images'];?>" alt="<?php echo $page['Page']['title'];?>">
              </div>
            </div>
            <div class="div2">
              <h4>ỨNG VIÊN NỘP HỒ SƠ TẠI CÔNG TY TNHH VẬN TẢI THÀNH CÔNG:</h4>
              <div class="row">
                <?php foreach($points as $point){?>
                <div class="col-sm-6 col-md-6 item">
                  <span class="name"><?php echo $point['Point']['title'];?></span>
                  <div class="">
                    <span><i class="fas fa-map-marker-alt"></i>Địa chỉ: <?php echo $point['Point']['address'];?></span></br>
                    <span><i class="fas fa-phone-volume"></i>Điện thoại: <?php echo $point['Point']['phone'];?></span>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
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
            <div class="service-name">
              <a href="/dich-vu/<?php echo ($service['Page']['key']) ?>">
                  <?php echo $service['Page']['title'];?>
                  </a>
            </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
