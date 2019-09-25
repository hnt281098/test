<link rel="stylesheet" href="/css/travel.css">
<div class="travel">
    <div class="tic">THAM QUAN NHÀ VƯỜN</div>
    <div class="main-travel">
        <div class="row inmain-travel">
            <?php foreach($travels as $key => $travel){?>
            <div class="col-sm-4 col-md-4 travel-item">
                <a href="<?php echo SERVER;?>dich-vu-du-lich/<?php echo $travel['Road']['id']. '/'. _rename(strtolower($travel['Road']['title']),'-')  ; ?>.html">
                    <img src="<?php echo isset($travel['RoadImage']['0']['url']) ? dispImage($travel['RoadImage']['0']['url']) : 'images/uploads/no-image.jpg' ;?>" alt="<?php echo $travel['Road']['title'];?>">
                </a>
                <div class="des-travel">
                <p class="p1"><?php echo $travel['Road']['title'];?> </p>
                <p class="p2"><i class="fa fa-bus"></i>Khởi hành từ: <span><?php echo $travel['Road']['from'];?> </span>  - Thời gian: <span><?php echo $travel['Road']['start_time'];?> </span></p>
                <p class="p2 p3"><i class="fa fa-ticket"></i>Giá vé: <?php echo number_format($travel['Road']['price']);?> đ</p>
                </div>
            </div>
            <?php }?>
        </div>
        <div class="desription">
        </div>
      </div>
    </div>