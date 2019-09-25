<link rel="stylesheet" href="/css/block.css">
<link rel="stylesheet" href="/css/contact.css">
<div class="inmain">
<div class="contact">
          <div class="main-contact">
            <div class="title"><img src="/images/contact/contact.png" alt=""></div>
            <div class="row inmain-contact">
              <div class="col-sm-5 col-md-5 left-item">
                <h5>CÔNG TY TNHH VẬN TẢI THÀNH CÔNG</h5>
                <p><i class="fas fa-map-marker-alt"></i>Số 604 đường Phú Riềng Đỏ, P. Tân Xuân, TX. Đồng Xoài, Bình Phước.</p>
                <p><i class="fas fa-phone"></i>06513879072.</p>
              </div>
              <div class="col-sm-7 col-md-7 right-item">
                <h5>Nếu có thắc mắc hoặc cần tư vấn xin quý khách gửi thông tin cho chúng tôi thông qua form bên dưới:</h5>
                <form class="" id="frm_contact" action="" method="post">
                <input type="hidden" name="token_key" value="<?php echo $token_key ?>"/>
              <div class="form-group">
                <label for="">* Họ và tên:</label>
                <input type="text" class="form-control" required="required" placeholder="Nhập họ và tên..." name="name">
              </div>
              <div class="form-group">
                <label for="">* Điện thoại</label>
                <input type="text" class="form-control" required="required" placeholder="Nhập số điện thoại..." name="phone">
              </div>
              <div class="form-group">
                <label for="">* Email:</label>
                <input type="email" class="form-control" required="required" placeholder="Nhập email..." name="email">
              </div>
              <div class="form-group">
                <label for="">* Tiêu đề:</label>
                <input type="text" class="form-control" required="required" placeholder="Nhập tiêu đề..." name="subject">
              </div>
              <div class="form-group item5">
                <label for="">* Nội dung yêu cầu:</label>
                <input type="text" class="form-control" required="required"  placeholder="Nhập câu hỏi của Quý khách..." name="content">
              </div>
              <button type="button" id="btn_send" class="btn btn-primary btn1">Gửi</button>
              <button type="clear" class="btn btn-primary btn2">Xóa</button>
              <br/><br/>
            </form>
              </div>
    </div>
  </div>
  <div class="contact-item">
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
                  <p><span>Đặt vé </span>
                  <i class="fas fa-phone"></i><?php echo $addressItem['Address']['phone1'];?></p>
                </div>
                <div class="col-sm-6 col-md-6 right-item">
                  <p><span>Gửi hàng </span>
                  <i class="fas fa-phone"></i><?php echo $addressItem['Address']['phone2'];?></p>
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
</div>


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






<script>
    $('document').ready(function(){
        $('#btn_send').click(function(){
            $.post('/contact/send', $('#frm_contact').serialize(),function(resp){
                alert(resp.msg);
                if(resp.status == 1){
                    location.reload();
                }
            },'json')
        })
    });
</script>