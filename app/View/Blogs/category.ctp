<link rel="stylesheet" href="/css/block.css">
<link rel="stylesheet" href="/css/news1.css">
<div class="inmain">
<div class="news1">
    <div class="tic">TIN TỨC</div>
    <div class="main-news1">
        <div class="row">
            <div class="col-sm-9 col-md-9 left-col">
                <?php foreach ($blogDatas as $key => $blog) { ?>

                <div class="row news1-item">
                    <div class="col-sm-3 col-md-3">
                    <a href="<?php echo SERVER;?>tin-tuc/<?php echo $blog['Blog']['id']. '/'. _rename(strtolower($blog['Blog']['title']),'-')  ; ?>.html">
                        <img src="<?php echo isset($blog['BlogImage']['0']['url']) ? dispImage($blog['BlogImage']['0']['url']) : 'images/uploads/no-image.jpg' ;?>" alt="<?php echo $blog['Blog']['title'];?>">
                    </a>
                    </div>
                    <div class="col-sm-9 col-md-9">
                    <h4>
                        <a href="<?php echo SERVER;?>tin-tuc/<?php echo $blog['Blog']['id']. '/'. _rename(strtolower($blog['Blog']['title']),'-')  ; ?>.html">
                            <?php echo $blog['Blog']['title'];?>
                        </a>
                    </h4>
                    <p>
                        <?php echo $this->App->getShortDescription($blog['Blog']['description']);?>
                        <small><a href="<?php echo SERVER;?>tin-tuc/<?php echo $blog['Blog']['id']. '/'. _rename(strtolower($blog['Blog']['title']),'-')  ; ?>.html">Xem thêm</a></small>
                    </p>
                    </div>
                </div>

                <?php } ?>
            </div>
            <div class="col-sm-3 col-md-3 right-col">
                <h3>Tin mới nhất:</h3>
                <?php foreach ($blogDatas as $key => $blog) { ?>
                    <?php if($key >3 ){break;}?>
                    <div class="right-col-item" style="margin-top:10px">
                        <img src="<?php echo isset($blog['BlogImage']['0']['url']) ? dispImage($blog['BlogImage']['0']['url']) : 'images/uploads/no-image.jpg' ;?>" alt="<?php echo $blog['Blog']['title'];?>">
                        <div class="des-item" style="margin-top:5px">
                            <h5><a href="<?php echo SERVER;?>tin-tuc/<?php echo $blog['Blog']['id']. '/'. _rename(strtolower($blog['Blog']['title']),'-')  ; ?>.html"><?php echo $blog['Blog']['title'];?></a></h5>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<?php echo $this->Element('dich-vu');?>

