<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo $websiteInfo['title']; ?></title>

    <meta name="description" content="<?php echo @$websiteInfo['meta_description'];?>">
    <meta name="keywords" content="<?php echo @$websiteInfo['meta_tag_keyword'];?>">
    <meta name="author" content="<?php echo @$websiteInfo['meta_author'];?>">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/block-service.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/hotline.css">
    <link rel="stylesheet" href="/css/footer.css">
    <style>
      .btn_bg{

      }
    </style>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Charmonman" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  </head>

  <body class="br-header">
      <div class="top-nav clearfix">
        <ul class="list-top-nav list-inline pull-right">
          <?php foreach($menuTops as $id => $menu ){?>
            <li class="list-inline-item">
            <a href="<?php echo $menu['Category']['url'];?>">
            <i class="<?php echo $menu['Category']['icon'];?>"></i><?php echo $menu['Category']['name'];?></a></li>
          <?php } ?>
        </ul>
      </div>
      <div class="nav-menu clearfix">
          <div class="logo pull-left">
            <a href="/">
              <img src="/images/uploads/logo.png" alt=""></a>
          </div>
          <div class="company-name pull-left">
            <p class="name1">Công Ty Cổ Phần Đầu Tư Vận Tải </p>
            <img src="/images/uploads/namecompany.png" alt="Công Ty Cổ Phần Đầu Tư Vận Tải Đại Ngân">
            <p class="name2">Đại Ngân</p>
          </div>
          <div class="main-menu pull-right">
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

      <?php echo $content_for_layout;?>
      <div class="hotline pull-right">
        <div class="main-hotline main-hotline1">
          <i class="fa fa-phone"></i>
          TỔNG ĐÀI ĐẶT VÉ: <span><?php echo @$websiteInfo['ticket_phone'];?></span>
        </div>
      </div>


        <div class="footer">
          <h3 class="header-footer">
            <?php echo $websiteInfo['company']; ?>
          </h3>
          <ul class="list-inline icon-footer">
            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li class="list-inline-item li2"><a href="#"><img src="/images/uploads/zalo.png"/></a></li>
            <li class="list-inline-item"><a href="#"><i class="fa fa-youtube"></i></a></li>
          </ul>
          <ul class="list-inline address">
            <li class="list-inline-item address-item">
              <ul>
                <li class="li-first"><p>Trạm Sài Gòn:</p></li>
                <li><i class="fa fa-map-marker"></i><?php echo $websiteInfo['saigon_address']; ?></li>
                <li><i class="fa fa-phone"></i><?php echo $websiteInfo['saigon_mobile_address']; ?></li>
              </ul>
            </li>
            <li class="list-inline-item address-item">
              <ul>
                <li class="li-first"><p>Trạm Chợ Lách:</p></li>
                <li><i class="fa fa-map-marker"></i><?php echo $websiteInfo['cholach_address']; ?></li>
                <li><i class="fa fa-phone"></i><?php echo $websiteInfo['cholach_mobile_address']; ?></li>
              </ul>
            </li>
            <li class="list-inline-item address-item">
              <ul>
                <li class="li-first"><p>Trạm Cai Lậy:</p></li>
                <li><i class="fa fa-map-marker"></i><?php echo $websiteInfo['cailay_address']; ?></li>
                <li><i class="fa fa-phone"></i><?php echo $websiteInfo['cailay_mobile_address']; ?></li>
              </ul>
            </li>
          </ul>
          <p class="copyright"><?php echo $websiteInfo['footer_content']; ?></p>
        </div>
      <script>
        $('#btnSearch').click(function(){
            var tempKeyword = $('#search').val();
            var keyword = tempKeyword.replace(/ /g, "-");
            if(keyword!==''){
                window.location.href = '<?php echo SERVER;?>tim-kiem/'+ keyword;
            }
        });

        $('#search').keypress(function(e){
            if(e.keyCode == 13){
                $('#btnSearch').trigger('click');
            }
        });
      </script>
  </body>
</html>
