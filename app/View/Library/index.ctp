<?php echo $this->Element('breadcrumb_front_end');?>
<section class="container">
	<br/>
	<div class="row">
		<div class="col-md-4">
			<div class="box-carticket" style="background:#f06429; float:left; height:148px; border-radius:4px; width:100%; margin-bottom:15px;">
				<a href="/trang/13-ly-do-chon-chung-toi.html">
					<img style="float:left;     max-width: 40%;" src="/images/suport.png" />
					<div style="float:left; width:54%; padding-left:10px;    color: #fff;">
						<h2 style="float: left; text-align: left; font-weight: bold; color: #fff; width: 100%;  margin: 14px 0 10px 0;">LÝ DO CHỌN CHÚNG TÔI</h2>
						<p style="float:left; text-align:left">Việt Tân Phát có đội ngũ nhân viên kinh doanh chuyên nghiệp</p>
					</div>
				</a>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="box-carticket" style="background:#f06429; float:left; height:148px; border-radius:4px; width:100%; margin-bottom:15px;">
				<a href="/tin-tuc/tin-tuc-dia-danh-du-lich/index.html">
					<img style="float:left;    max-width: 35%; padding-left:10px" src="/images/travel1.png" />
					<div style="float:left; width:54%;  padding-left:10px;    color: #fff;">
						<h2 style="    float: left; text-align: left; font-weight: bold; color: #fff; width: 100%;  margin: 14px 0 10px 0;">ĐỊA DANH DU LỊCH</h2>
						<p style="float:left; text-align:left">Khám phá những địa danh du lich nổi tiếng của Việt Nam</p>
					</div>
				</a>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="box-carticket" style="background:#f06429; float:left; height:148px; border-radius:4px; width:100%; margin-bottom:15px;">
				<a href="/tin-tuc/tin-tuc-khuyen-mai-du-lich/index.html">
					<img style="float:left;     max-width: 35%; padding-left:10px" src="/images/travel3.png" />
					<div style="float:left; width:54%;  padding-left:10px;    color: #fff;">
						<h2 style="    float: left; text-align: left; font-weight: bold; color: #fff; width: 100%;  margin: 14px 0 10px 0;">KHUYẾN MẠI DU LỊCH</h2>
						<p style="float:left; text-align:left">Những ưu đãi cho quý khách mỗi khi lựa chọn địa danh du lịch</p>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="row">
		<?php foreach($blogDatas as $categoryId => $blogs){ ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<a href="<?php echo SERVER;?>thue-xe/danh-muc/<?php echo $categoryId;?>/<?php echo _rename($categoryList[$categoryId]);?>.html">
						<?php echo @$categoryList[$categoryId];?>
					</a>
				</div>
				<div class="panel-body">
					<div class="row">
						<?php foreach($blogs as $blog){ ?>
						<div class="col-md-4 box-dv">
							<?php if(!empty($blog['BlogImage'][0])){ ?>
								<a href="#"><img src="<?php echo $blog['BlogImage'][0]['url']; ?>" class="img-thumbnail"></a>
							<?php } ?>
							
							<div class="text-car">
								<a href=""><?php echo $blog['Blog']['title']; ?></a>
								<?php 
									$description = explode(EXPLODE_BLOG ,$blog['Blog']['description']);
									echo @$description[0];
								?>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php }?>
	</div>
</div>
