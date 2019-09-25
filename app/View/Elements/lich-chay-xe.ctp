<link rel="stylesheet" href="/css/tuyen-duong.css">
<?php $roads = $this->App->getRoads();?>
<div class="tuyen-duong">

        <?php $start_point = "";?>
        <?php $close_tag = true ;?>
    	<?php foreach($roads as $key=> $road){ ?>

        <?php if($start_point != $road['Road']['point']){ ?>
        	<?php $start_point = $road['Road']['point'] ;?>
        	<?php $inc = 1; ?>
        	<?php $close_tag = false ;?>
        	<div class="ben-xe">
            <div class="title-ben-xe clearfix">
                <img src="/images/1.png" alt="">
                <p class="text-uppercase"><?php echo $start_point;?> </p>
                <img src="/images/2.png" alt="">
            </div>

            <div class="main-ben-xe">
            <table class="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Bến đi</th>
                    <th>Bến đến</th>
                    <th>Loại xe</th>
                    <th>Quãng đường</th>
                    <th>Thời gian</th>
                    <th>Số chuyến</th>
                    <th>Giá vé</th>
                    <th >Giờ chạy</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
        <?php } ?>
				<tr>
					<td><?php echo $inc++ ;?> </td>
					<td><?php echo $road['Road']['from'] ;?> </td>
					<td><?php echo $road['Road']['to'] ;?> </td>
					<td class="color"><?php echo @$trip_car_type[$road['Road']['car_type']] ;?> </td>
					<td><?php echo $road['Road']['long_road'] ;?> </td>
					<td><?php echo $road['Road']['start_time'] ;?> </td>
					<td><?php echo $road['Road']['running_time'] ;?> </td>
					<td class="color"><?php echo number_format($road['Road']['price']) ;?> <?php echo $road['Road']['unit'] ;?></td>
					<td><img src="/images/3.png" class="gio-chay" id="gio-chay<?php echo $inc;?>" time_r="<?php echo $inc;?>">
						<?php $times = explode(PHP_EOL,  $road['Road']['description']);?>
						<div class="sub-time" id="sub-time-<?php echo $inc;?>">
                    		<div class="row">
                    			<?php foreach($times as $k => $time){?>
                      				<div class="col-2"><?php echo $time;?> </div>
                      			<?php } ?>
                    		</div>
                    	</div>
					</td>
					<td>
					<div class="mua-ve"><a href=""><img src="/images/4.png"><span>Mua vé</span></a></div>
					</td>
				</tr>


        <?php if(isset($roads[$key + 1]) && $roads[$key + 1]['Road']['point'] != $start_point ) { ?>
        	<?php $close_tag = true ;?>
                </tbody>
            </table>
        </div>
         </div>
        <?php } ?>



    	<?php } ?>

    	<?php if($close_tag == false ){?>
    	</tbody>
            </table>
        </div>
         </div>
    	<?php } ?>

</div>


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Lịch chạy xe </h4>
        </div>
        <div class="modal-body" id="lich-chay-xe">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng </button>
        </div>
      </div>
    </div>
  </div>
<script src="/js/tuyenduong.js"></script>
