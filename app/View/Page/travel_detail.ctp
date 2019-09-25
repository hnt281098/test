<link rel="stylesheet" href="/css/travel-detail.css">

<div class="travel-detail">
      <div class="tic"><?php echo $travel['Road']['title'];?></div>
      <div class="row main-travel-detail">
        <div class="col-sm-7 col-md-7 left-item">
          <img src="<?php echo isset($travel['RoadImage']['0']['url']) ? dispImage($travel['RoadImage']['0']['url']) : 'images/uploads/no-image.jpg' ;?>" alt="<?php echo $travel['Road']['title'];?>">
          <div class="book-ticket">
            <div class="left-book-ticket">
              <p><i class="fa fa-bus"></i>Khởi hành từ: <strong><?php echo $travel['Road']['from'];?></strong></p>
              <p><i class="fa fa-ticket"></i>Giá vé: <?php echo number_format($travel['Road']['price']);?> đ</p>
              <p><i class="fa fa-clock-o"></i> Thời gian: <?php echo $travel['Road']['start_time'];?></p>
            </div>
            <div class="right-book-ticket">
              <a href="/mua-ve-du-lich/<?php echo $travel['Road']['id'];?>-<?php echo _rename($travel['Road']['title']);?>.html">MUA VÉ</a>
            </div>
          </div>
          <div class="des-travel">
            <?php echo $travel['Road']['description'];?>
          </div>
        </div>
        <div class="col-sm-5 col-md-5 right-item">
          <div class="row right-book-item">
            <?php foreach($travel_others as $key => $travel_other){?>
            <div class="col-sm-6 col-md-6 item1">
                <a href="<?php echo SERVER;?>dich-vu-du-lich/<?php echo $travel_other['Road']['id']. '/'. _rename(strtolower($travel_other['Road']['title']),'-')  ; ?>.html">
                    <img src="<?php echo isset($travel_other['RoadImage']['0']['url']) ? dispImage($travel_other['RoadImage']['0']['url']) : '/images/uploads/no-image.jpg' ;?>" alt="<?php echo $travel_other['Road']['title'];?>">
                </a>
            </div>
            <div class="col-sm-6 col-md-6 item2">
              <h5><?php echo $travel_other['Road']['title'];?></h5>
              <p><i class="fa fa-bus"></i>Khởi hành từ: <strong><?php echo $travel_other['Road']['from'];?></strong></p>
              <p><i class="fa fa-ticket"></i>Giá vé: <?php echo number_format($travel_other['Road']['price']);?> đ</p>
            </div>
            <?php }?>
          </div>
        </div>
      </div>
    </div>