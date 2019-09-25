<link rel="stylesheet" href="/css/block.css">
<link rel="stylesheet" href="/css/news2.css">
<div class="inmain">
        <div class="news2">
          <div class="tic">TIN TỨC</div>
          <div class="main-news2">
            <div class="row">
              <div class="col-sm-8 col-md-8 left-item">
                <h2 class="title"><strong><?php echo $blogInfo['Blog']['title'];?></strong></h2>
                <p class="date-time"><span class="date"><?php echo date('H:i', strtotime($blogInfo['Blog']['created'])); ?></span>
                  <span class="time"><?php echo date('d/m/Y', strtotime($blogInfo['Blog']['created'])); ?></span>
                </p>
                <?php echo $blogInfo['Blog']['description'];?>
              </div>

              <div class="col-sm-4 col-md-4 right-item">
                <div class="right-item1">
                  <p class="title-right"><strong>Có thể bạn quan tâm</strong></p>

                  <?php foreach($others as $key => $blog ){?>
                  <?php if($key > 5 ){break;}?>
                  <?php if($key % 2 == 0){ ?>
                  <div class="row item">
                    <div class="col-sm-4 col-md-4">
                      <a href="<?php echo SERVER;?>tin-tuc/<?php echo $blog['Blog']['id']. '/'. _rename(strtolower($blog['Blog']['title']),'-')  ; ?>.html">
                        <img src="<?php echo isset($blog['BlogImage']['0']['url']) ? dispImage($blog['BlogImage']['0']['url']) : 'images/uploads/no-image.jpg' ;?>" alt="<?php echo $blog['Blog']['title'];?>">
                      </a>
                    </div>
                    <div class="col-sm-8 col-md-8">
                      <a href="<?php echo SERVER;?>tin-tuc/<?php echo $blog['Blog']['id']. '/'. _rename(strtolower($blog['Blog']['title']),'-')  ; ?>.html">
                        <?php echo $blog['Blog']['title'];?>
                      </a>
                    </div>
                  </div>
                  <?php } ?>
                  <?php } ?>
                </div>

                <div class="right-item2">
                  <p class="title-right"><strong>Tin nổi bật</strong></p>
                  <?php foreach($others as $key => $blog ){?>
                  <?php if($key > 7 ){break;}?>
                    <?php if($key % 2 == 1){ ?>
                      <div class="item">
                        <a href="<?php echo SERVER;?>tin-tuc/<?php echo $blog['Blog']['id']. '/'. _rename(strtolower($blog['Blog']['title']),'-')  ; ?>.html">
                            <img src="<?php echo isset($blog['BlogImage']['0']['url']) ? dispImage($blog['BlogImage']['0']['url']) : 'images/uploads/no-image.jpg' ;?>" alt="<?php echo $blog['Blog']['title'];?>">
                        </a>
                        <p class="p1">
                          <a href="<?php echo SERVER;?>tin-tuc/<?php echo $blog['Blog']['id']. '/'. _rename(strtolower($blog['Blog']['title']),'-')  ; ?>.html">
                            <?php echo $blog['Blog']['title'];?>
                          </a>
                        </p>
                      </div>
                    <?php } ?>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php echo $this->Element('dich-vu');?>
      </div>