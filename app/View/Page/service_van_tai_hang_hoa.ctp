<link rel="stylesheet" href="/css/block.css">
<link rel="stylesheet" href="/css/goods.css">
<div class="inmain">
        <div class="goods">
          <div class="tic">VẬN CHUYỂN HÀNG HÓA</div>
          <div class="main-goods">
            <p>
            <?php echo $this->App->render('gioi-thieu-dich-vu-van-tai-hang-hoa', $content, FRONT_END_PAGE_ID);?>
            </p>
            <?php echo $this->App->renderImg('gioi-thieu-dich-vu-van-tai-hang-hoa-hinh-anh-1', $content, FRONT_END_PAGE_ID);?>
            <img src="<?php echo $this->App->renderRaw('gioi-thieu-dich-vu-van-tai-hang-hoa-hinh-anh-1', FRONT_END_PAGE_ID);?>" alt="">
            <p>
            <?php echo $this->App->render('gioi-thieu-dich-vu-van-tai-hang-hoa-2', $content, FRONT_END_PAGE_ID);?>

            </p>
            <?php echo $this->App->renderImg('gioi-thieu-dich-vu-van-tai-hang-hoa-hinh-anh-2', $content, FRONT_END_PAGE_ID);?>
            <img src="<?php echo $this->App->renderRaw('gioi-thieu-dich-vu-van-tai-hang-hoa-hinh-anh-2', FRONT_END_PAGE_ID);?>" alt="">
            
            <div class="row search">
              <div class="col-sm-6 col-md-6 left-search">
                <div class="header-book">
                  <div class="main-header-book"><p><i class="fa fa-search"></i><span class="">TRA CỨU MÃ HÀNG TRỰC TUYẾN</span></p></div>
                </div>
                <div class="main-right-book">
                  <form class="" action="index.html" method="post">
                    <input class="form-control" type="text" name="" value="" placeholder="Nhập mã đơn hàng">
                  </form>
                  <form class="form-inline form2" action="index.html" method="post">
                    <input class="form-control" type="text" name="" value="" placeholder="Nhập mã kiểm tra">
                    <div class="makiemtra">
                      CFGK
                    </div>
                    <button class="form-control btn-book" type="button" name="button"><a href="pages/search.html">TRA CỨU</a></button>
                  </form>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 right-search">
              	<?php echo $this->App->renderImg('gioi-thieu-dich-vu-van-tai-hang-hoa-hinh-anh-3', $content, FRONT_END_PAGE_ID);?>
            	<img src="<?php echo $this->App->renderRaw('gioi-thieu-dich-vu-van-tai-hang-hoa-hinh-anh-3', FRONT_END_PAGE_ID);?>" alt="">
              </div>
            </div>
            <?php echo $this->App->renderImg('gioi-thieu-dich-vu-van-tai-hang-hoa-hinh-anh-4', $content, FRONT_END_PAGE_ID);?>
            <img src="<?php echo $this->App->renderRaw('gioi-thieu-dich-vu-van-tai-hang-hoa-hinh-anh-4', FRONT_END_PAGE_ID);?>" alt="">
                      </div>
        </div>

        <?php echo $this->Element('dich-vu');?>


      </div>