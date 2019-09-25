<link rel="stylesheet" href="/css/block.css">
<link rel="stylesheet" href="/css/search.css">
<div class="inmain">

	<div class="search">	
	<?php if(!empty($package)){?>
	
		<div class="tic">TRA CỨU MÃ HÀNG</div>
        <div class="main-search">
            <div class="row header-search">
                <div class="col-sm-3 col-md-3 offset-md-2 item">
                    <img src="/images/search/sending.png" alt="">
                    <div class="title-header clearfix">
                        <div class="ticbox"></div>
                        <?php if($package['Package']['phieu_status'] != '2'){?>
                    	<img src="/images/sending.png" alt="">
                    	<?php }?>
                        
                        <div class="name-title">Đang vận chuyển</div>
                    </div>
                </div>
                
                <div class="col-sm-3 col-md-3 offset-md-2 item">
                    <img src="/images/search/sent.png" alt="">
                    <div class="title-header clearfix">
                    	<div class="ticbox"></div>
                    	<?php if($package['Package']['phieu_status'] == '2'){?>
                    	<img src="/images/tic.png" alt="">
                    	<?php }?>
                        <div class="name-title">Đã giao hàng</div>
                    </div>
                </div>
              	
                
                
			</div>
            <div class="inmain-search">
                    <div class="title-table clearfix">
                        <div class="inmain1">
                            <img src="/images/search/icon.png" alt="">
                            <p>THÔNG TIN ĐƠN HÀNG</p>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="left-col">Tên hàng</td>
                                <td><?php echo $package['Package']['phieu_trigiahanggoi'];?></td>
                            </tr>
                            <tr>
                                <td class="left-col">Mã hàng</td>
                                <td><?php echo $package['Package']['phieu_code'];?></td>
                            </tr>
                            <tr>
                                <td class="left-col">Số lượng </td>
                                <td><?php echo $package['Package']['phieu_tenhang'];?></td>
                            </tr>
                            <tr>
                                <td class="left-col">Nơi gửi </td>
                                <td><?php echo $package['Package']['phieu_tuyen'];?></td>
                            </tr>
                            <tr>
                                <td class="left-col">Tên người gởi</td>
                                <td><?php echo $package['Package']['phieu_nguoigoi'];?></td>
                            </tr>
                            <tr>
                                <td class="left-col">Số điện thoại người gửi</td>
                                <td><?php echo $package['Package']['phieu_sdtgoi'];?></td>
                            </tr>
                            <tr>
                                <td class="left-col">Tên người nhận</td>
                                <td><?php echo $package['Package']['phieu_nguoinhan'];?></td>
                            </tr>
                            <tr>
                                <td class="left-col">Số điện thoại người nhận</td>
                                <td><?php echo $package['Package']['phieu_sdtnhan'];?></td>
                            </tr>
                            <tr>
                                <td class="left-col">Số xe </td>
                                <td><?php echo $package['Package']['phieu_note'];?></td>
                            </tr>
                            <tr>
                                <td class="left-col">Tiền cước</td>
                                <td>
                                    <?php if((int) $package['Package']['phieu_thanhtien'] == (int) $package['Package']['phieu_dathanhtoan']){?>
                                    <p>Đã thu tiền:  <?php echo $package['Package']['phieu_thanhtien'];?> </p>
                                    <?php }else if((int) $package['Package']['phieu_conlai'] > 0 ){ ?>
                                    <p>Phải thu thêm tại bến xe: <?php echo $package['Package']['phieu_conlai'];?>
                                    <?php } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            
        </div>
        
    <?php }else{ ?>
    	<br/>
	    <h4 class="text-center">Chúng tôi không tim ra đơn hàng đủ điểu kiện </h4>
    	<br/>
    <?php } ?>
    	
	</div>
	<?php echo $this->Element('tram-va-cac-chi-nhanh');?>
    <?php echo $this->Element('dich-vu');?>
</div>