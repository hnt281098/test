<link rel="stylesheet" href="/css/index.css">
<style type="text/css">



</style>
<div class="inmain">
        <div class="slider">
          <div id="demo" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
              <?php foreach($sliders as $key => $slider){?>
                <li data-target="#demo" data-slide-to="<?php echo $key;?>" <?php echo ($key==0 ? 'class="active"':'');?> ></li>
              <?php } ?>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
              <?php foreach($sliders as $key => $slider){?>
              <div class="carousel-item <?php echo ($key==0 ? 'active':'');?>">
                <img src="/images/slider/<?php echo $slider['Slider']['image'];?>" alt="" >
              </div>
              <?php }?>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
              <span class="carousel-control-next-icon"></span>
            </a>
          </div>
        </div>

        <div class="row book clearfix">
          <div class="col-sm-6 col-md-6 left-book">
            <div class="header-book">
              <div class="main-header-book"><p><i class="fa fa-bus"></i><span class="">MUA VÉ TRỰC TUYẾN</span></p></div>
            </div>
            <div class="main-left-book">
              <form class="" action="/mua-ve-xe-p1" method="GET" >
                <div class="row">
                  <div class="col-sm-6 col-md-6 ">
                    <div class="form-group">
                      <label for="">Điểm khởi hành</label>
                      <select class="form-control" name="from" id="from" required="required">
                        <option value="Sài Gòn">Sài Gòn</option>
                        <option value="Bình Phước">Bình Phước</option>
                        <option value="Đồng Xoài">Đồng Xoài</option>
                      </select>
                    </div>
                    <div class="form-group clock">
                      <label for="">Ngày khởi hành</label>
                      <input min="02-03-2019" required="required" class="form-control date" type="date" name="date" value="<?php echo date('m/d/Y'); ?>">
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 ">
                    <div class="form-group">
                      <label for="">Điểm đến</label>
                      <select class="form-control" name="to" id="to" required="required">
                        <option value="Bình Phước">Bình Phước</option>
                        <option value="Đồng Xoài">Đồng Xoài</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Số lượng vé</label>
                      <input type="number" min="1" max="45" class="form-control" value="1" name="quantity">
                    </div>
                  </div>
                </div>
                <button class="form-control btn-book" name="button">MUA VÉ</button>
              </form>
            </div>
          </div>

          <div class="col-sm-6 col-md-6 right-book">
            <div class="header-book">
              <div class="main-header-book"><p><i class="fa fa-search"></i><span class="">TRA CỨU MÃ HÀNG TRỰC TUYẾN</span></p></div>
            </div>
            <div class="main-right-book">
              <form  action="/tim-kiem/" method="get">
            <div class="form-group">
                <label for="">Nhập mã đơn hàng </label>
                <input class="form-control" required="required" type="text" name="phieu_code" value="" maxlength="8" placeholder="Nhập mã đơn hàng">
            </div>

            <div class=" form-group">
                <label for="">Số điện thoại người nhận </label>
                <input class="form-control" required="required" type="text" name="phieu_sdtnhan" value="" maxlength="12" placeholder="">
            </div>

            <button class="form-control btn-book" >TRA CỨU</button>
        </form>
            </div>
          </div>
        </div>

  <div class="row tut-book">
    <div class="col-sm-6 col-md-6 tut-book-item">
      <a href="/thong-tin/142-huong-dan-mua-ve-xe">HƯỚNG DẪN MUA VÉ</a>
    </div>
    <div class="col-sm-6 col-md-6 tut-book-item">
      <a href="/thong-tin/143-huong-dan-goi-hang">HƯỚNG DẪN GỬI HÀNG</a>
    </div>
  </div>

  <div class="service">
    <div class="tic">DỊCH VỤ</div>
      <div class="row main-service">
        <?php foreach($pages as $id => $service){?>
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

  <div class="infomation">
    <div class="tic">THÔNG TIN CẦN BIẾT</div>
    <div class="row main-infomation">
      <?php foreach($infomartion_requireds as $infomartion_required){ ?>
      <div class="col-sm-4 col-md-4 item">
        <img src="/images/tic.png" alt="">
        <div class="main-item">
          <h5><?php echo $infomartion_required['Page']['title'] ?></h5>
          <p>
            <?php echo $this->App->getShortDescription($infomartion_required['Page']['description']) ?>.
            <a href="/thong-tin/<?php echo $infomartion_required['Page']['id'] ?>-<?php echo _rename($infomartion_required['Page']['title']); ?>.html"> chi tiết</a>
          </p>
        </div>
      </div>
      <?php } ?>
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




  <div class="news">
    <div class="tic">TIN TỨC</div>
    <img src="/images/bg-news.png" alt="">
    <div class="des-news">
      <?php foreach($blogs as $id=>$blog){?>
        <div class="des-news-item">
            <p class="time-des"><?php echo date('H:i d-m-Y', strtotime($blog['Blog']['updated']));?></p>
            <p class="header-des"><a href="tin-tuc/<?php echo $blog['Blog']['id'];?>/<?php echo _rename($blog['Blog']['title']);?>.html"><?php echo $blog['Blog']['title'];?></a></p>
            <p class="main-des"><?php echo $this->App->getShortDescription($blog['Blog']['description']);?>.<span>
            <a href="/tin-tuc/<?php echo $blog['Blog']['id'];?>/<?php echo _rename($blog['Blog']['title']);?>.html">Xem thêm</a></span></p>
        </div>
      <?php } ?>
    </div>
  </div>
</div>


<script>
    $(document).ready(function(){
      $('#from').html('')
        $.get('/get_from_road/',function(resp){
          $('#from').append('<option value=""> -- Điểm khởi hành -- </option>')
          $('#from').append(resp);
        });

       $('#from').change(function(){
            var from_value = $(this).val();
            $('#to').html('');
            $.get('/get_from_to_road/?from='+from_value ,function(resp){
              $('#to').html(resp);
            });
       });

       $('#from').trigger('change');
    });
</script>

