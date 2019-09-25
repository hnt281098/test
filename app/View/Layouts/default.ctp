<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo isset($title_ext) ? $title_ext : @$websiteInfo['title'] ?></title>
    <meta name="<?php echo isset($meta_description_ext) ? $meta_description_ext : @$websiteInfo['meta_description'] ?>"/>
    <meta name="<?php echo isset($meta_keyword_ext) ? $meta_keyword_ext : @$websiteInfo['meta_tag_keyword'] ?>" />
    <meta name="author" content="<?php echo @$websiteInfo['meta_author'];?>">

	  <meta name="google-site-verification" content="Td8VsAsYuqzt_v4nIhd0EHdFPlqRVP9gPZmc2UgDgZ8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/js/popup.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="icon" href="/images/uploads/mini-logo.png" sizes="192x192" />
    <?php
      echo $this->Html->css('counter-user');
    ?>
  </head>
  <body>
    <div class="popup">
      <img src="/images/sub-banner.png" alt="">
      <i class="fas fa-times" id="close"></i>
    </div>
    <div class="top-nav clearfix">
      <ul class="list-top-nav list-inline">
        <?php foreach($menuTops as $id => $menu ){?>
            <li class="list-inline-item">
              <a href="<?php echo $menu['Category']['url'];?>">
                <i class="<?php echo $menu['Category']['icon'];?>"></i><?php echo $menu['Category']['name'];?></a>
            </li>
        <?php } ?>
      </ul>
    </div>
    <div class="nav-menu clearfix">
      <div class="logo pull-left">
        <a href="/"><img src="/images/uploads/logo-1.png" alt=""></a>
      </div>
      <div class="main-menu">
        <input class="chk-nav" type="checkbox" id="btn-navbar" />
        <label for="btn-navbar" class="label-menu"><i class="fa fa-bars"></i></label>
        <ul class="list-nav-menu list-inline">
          <?php foreach($menuHeader as $id => $menu ){?>
              <li class="list-inline-item">
                <a href="<?php echo $menu['Category']['url'];?>"><?php echo ($menu['Category']['name']) ?></a>
              </li>
              <?php if($id == 3){?>
                <?php foreach($menuTops as $id => $menu ){?>
                  <li class="list-inline-item desktop" style="text-transform:uppercase">
                    <a href="<?php echo $menu['Category']['url'];?>"><?php echo strtoupper($menu['Category']['name']);?></a>
                  </li>
                <?php } ?>
                <?php } ?>
          <?php } ?>
        </ul>
      </div>
    </div>

    <div class="row main">
      <div class=" sub-banner left">
        <a href="<?php echo @$websiteInfo['link_left_adv'];?>" target="_blank"><img src="<?php echo @$websiteInfo['left_adv'];?>" alt=""></a>
      </div>
      <?php echo $content_for_layout;?>
      <div class=" sub-banner right">
        <a href="<?php echo @$websiteInfo['right_left_adv'];?>" target="_blank"><img src="<?php echo @$websiteInfo['right_adv'];?>" alt=""></a>
      </div>
    </div>

    <div class="footer">
      <?= $this->element('count_user_online'); ?>

      <div class="hotline">
        <div class="main-hotline" style="background:#FFA500;font-size: 14px;">&nbsp;<i class="fas fa-phone-volume"></i><?php echo @$websiteInfo['ticket_phone'];?></div>
        <?php if(!empty($websiteInfo['hotline_1'])){?>
        <div class="main-hotline" style="background:#006400;font-size: 14px;">&nbsp;<i class="fas fa-phone-volume"></i><?php echo @$websiteInfo['hotline_1'];?></div>
        <?php } ?>
        <?php if(!empty($websiteInfo['hotline_2'])){?>
        <div class="main-hotline" style="background:#104e8b;font-size: 14px;">&nbsp;<i class="fas fa-phone-volume"></i><?php echo @$websiteInfo['hotline_2'];?></div>
        <?php } ?>
      </div>

      <div class="main-footer">
        <h3 class="header-footer">
          <?php echo @$websiteInfo['company'];?>
        </h3>
        <ul class="list-inline icon-footer" >
          <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
          <li class="list-inline-item li2"><a href="#"><img src="/images/zalo.png"/></a></li>
          <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
        </ul>
        <p>
          <a target="_blank" href="http://online.gov.vn/CustomWebsiteDisplay.aspx?DocId=58458" >
            <img src="http://online.gov.vn/Images/dathongbao.png" width="180px">
          </a>
        </p>
        <p><?php echo @$websiteInfo['business_license'];?></p>
        <p>Người đại diện: <?php echo @$websiteInfo['owner'];?></p>
        <p>Địa chỉ: <?php echo @$websiteInfo['company_address'];?></p>
        <p>Email: <?php echo @$websiteInfo['email'];?></p>
        <p class="copyright"><?php echo @$websiteInfo['footer_content'];?></p>
        <?php echo @$websiteInfo['backlink'];?>
      </div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <?php
    if($this->Session->read(SESSION_ADMIN_DATA)){?>
        <?php echo $this->Element('editable');?>
    <?php } ?>




  </body>
</html>
