<link rel="stylesheet" href="/css/tut.css">
<div class="tut">
    <div class="tic pull-left">MUA VÉ HÀNH KHÁCH</div>
      <a href="tut2.php"><div class="tic tic2 pull-left">MUA VÉ THAM QUAN</div></a>
    <div class="main-tut">
        <div class="tut-item">
          <img src="/images/uploads/tut1.png" alt="">
        </div>
        <div class="tut-item">
          <img src="/images/uploads/tut2.png" alt="">
          <p><span>Bước 1:</span> truy cập vào website www.xedaingan.com</p>
        </div>
        <div class="tut-item">
          <img src="/images/uploads//tut3.png" alt="">
          <p><span>Bước 2:</span> chọn thông tin hành trình</p>
        </div>
        <div class="tut-item div4 clearfix">
          <div class="main-div4 clearfix">
            <img src="/images/uploads/tut4.png" alt="">
          </div>
          <img src="/images/uploads/nav.png" alt="" class="nav-image">
          <p><span>Bước 3:</span> chọn loại xe, kiểm tra lại thông tin và tiếp tục</p>
        </div>
        <div class="tut-item div4 div5 clearfix">
          <div class="main-div4 clearfix">
            <img src="/images/uploads/tut5.png" alt="">
          </div>
          <p><span>Bước 4:</span> nhập thông tin khách hàng và tiếp tục</p>
        </div>
        <div class="tut-item div4 div6 clearfix">
          <div class="main-div4 clearfix">
            <img src="/images/uploads/tut6.png" alt="">
          </div>
          <p><span>Bước 5:</span> nhận mã số đặt vé để thực hiện thanh toán</p>
        </div>
      </div>
    </div>

    <?php if(!empty($websiteInfo['banner_adv_service'])){?>
    <div class="travel">
        <a href="<?php echo $websiteInfo['banner_adv_service_link'];?>">
            <img src="<?php echo @$websiteInfo['banner_adv_service']; ?>" alt="<?php echo @$websiteInfo['title']; ?>">
        </a>
    </div>
    <br/>
    <?php }?>