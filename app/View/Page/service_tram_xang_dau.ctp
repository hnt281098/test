<link rel="stylesheet" href="/css/block.css">
<link rel="stylesheet" href="/css/gas.css">


<div class="inmain">
        <div class="gas">
          <div class="head-gas">
            <?php echo $this->App->render('tram-xang-dau-1', $content, FRONT_END_PAGE_ID,'textarea');?>
          </div>
          <br/><br/>
          
          <div class="gas1">
            <h1><?php echo $this->App->render('tram-xang-dau-2', $content, FRONT_END_PAGE_ID);?></h1>
            <img src="/image/gas/gas1.png" alt="">
            <div class="row">
              <div class="col-sm-12 col-md-12 item">
                <?php echo $this->App->renderImg('tram-xang-dau-hinh-anh-1', $content, FRONT_END_PAGE_ID);?>
                <img class="img-fluid" src="<?php echo $this->App->renderRaw('tram-xang-dau-hinh-anh-1', FRONT_END_PAGE_ID);?>" alt="">
              </div>
              <div class="col-sm-6 col-md-6 item">
                <?php echo $this->App->renderImg('tram-xang-dau-hinh-anh-2', $content, FRONT_END_PAGE_ID);?>
                <img class="img-fluid" src="<?php echo $this->App->renderRaw('tram-xang-dau-hinh-anh-2', FRONT_END_PAGE_ID);?>" alt="">
              </div>
              <div class="col-sm-6 col-md-6 item">
                <?php echo $this->App->renderImg('tram-xang-dau-hinh-anh-3', $content, FRONT_END_PAGE_ID);?>
                <img class="img-fluid" src="<?php echo $this->App->renderRaw('tram-xang-dau-hinh-anh-3', FRONT_END_PAGE_ID);?>" alt="">
              </div>
            </div>
            <p class="text-center"><?php echo $this->App->render('tram-xang-dau-3', $content, FRONT_END_PAGE_ID);?></p>
          </div>
          
          <div class="gas2">
            <h1><?php echo $this->App->render('tram-xang-dau-4', $content, FRONT_END_PAGE_ID);?></h1>
            
            <div class="row">
            	<div class="col-sm-12 col-md-12 item">
                <?php echo $this->App->renderImg('tram-xang-dau-hinh-anh-6', $content, FRONT_END_PAGE_ID);?>
                <img class="img-fluid" src="<?php echo $this->App->renderRaw('tram-xang-dau-hinh-anh-6', FRONT_END_PAGE_ID);?>" alt="">
              </div>
              
              <div class="col-sm-6 col-md-6">
                <?php echo $this->App->renderImg('tram-xang-dau-hinh-anh-7', $content, FRONT_END_PAGE_ID);?>
                <img class="img-fluid" src="<?php echo $this->App->renderRaw('tram-xang-dau-hinh-anh-7', FRONT_END_PAGE_ID);?>" alt="">
              
              </div>
              <div class="col-sm-6 col-md-6">
                <?php echo $this->App->renderImg('tram-xang-dau-hinh-anh-8', $content, FRONT_END_PAGE_ID);?>
                <img class="img-fluid" src="<?php echo $this->App->renderRaw('tram-xang-dau-hinh-anh-8', FRONT_END_PAGE_ID);?>" alt="">
              
              </div>
          </div>
          
          <div class="gas2">
            <h1><?php echo $this->App->render('tram-xang-dau-9', $content, FRONT_END_PAGE_ID);?></h1>
            
            <div class="row">
            	<div class="col-sm-12 col-md-12 item">
                <?php echo $this->App->renderImg('tram-xang-dau-hinh-anh-10', $content, FRONT_END_PAGE_ID);?>
                <img class="img-fluid" src="<?php echo $this->App->renderRaw('tram-xang-dau-hinh-anh-10', FRONT_END_PAGE_ID);?>" alt="">
              </div>
              
              <div class="col-sm-6 col-md-6">
                <?php echo $this->App->renderImg('tram-xang-dau-hinh-anh-11', $content, FRONT_END_PAGE_ID);?>
                <img class="img-fluid" src="<?php echo $this->App->renderRaw('tram-xang-dau-hinh-anh-11', FRONT_END_PAGE_ID);?>" alt="">
              
              </div>
              <div class="col-sm-6 col-md-6">
                <?php echo $this->App->renderImg('tram-xang-dau-hinh-anh-12', $content, FRONT_END_PAGE_ID);?>
                <img class="img-fluid" src="<?php echo $this->App->renderRaw('tram-xang-dau-hinh-anh-12', FRONT_END_PAGE_ID);?>" alt="">
              </div>
          </div>
        </div>
        
        <?php echo $this->Element('tram-va-cac-chi-nhanh');?>
        <br/>
        <?php echo $this->Element('dich-vu');?>

      </div>