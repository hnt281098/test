<div class='clearfix'></div>
<h3>Danh sách khách hàng đặt vé online </h3>
<br/>
<table class='table table-bordered ' >
	<tr>
		<th><?php echo $this->Paginator->sort('id', '#');?></th>
        <th><?php echo $this->Paginator->sort('code', 'Mã đặt chỗ ');?></th>
		<th><?php echo $this->Paginator->sort('title', 'Người đặt xe');?></th>
        <th><?php echo $this->Paginator->sort('phone', 'Điện thoại');?></th>
        <th><?php echo $this->Paginator->sort('quantity', 'Số lượng ');?></th>
        <th><?php echo $this->Paginator->sort('start_date', 'Ngày đi');?></th>
        <th><?php echo $this->Paginator->sort('start_time', 'Giờ khởi hành ');?></th>

        <th><?php echo $this->Paginator->sort('road_id', 'Chuyến xe ');?></th>
        <th><?php echo $this->Paginator->sort('car_type', 'Loại hình ');?></th>
        <th><?php echo $this->Paginator->sort('trip_car_type', 'Loại xe  ');?></th>
        <th><?php echo $this->Paginator->sort('actived', 'Tình trạng ');?></th>
        <th><?php echo $this->Paginator->sort('created', 'Thời gian đặt ');?></th>
	</tr>
    <?php $inc=1;?>
    <?php foreach ($data as $key => $arr){?>
        <tr rel='data'>
            <td>
                <a href='/admin/ticket/edit/<?php echo $arr['Ticket']['id']; ?>'><?= $inc++; ?></a>
            </td>
            <td><?php echo $arr['Ticket']['code'];?></td>
            <td><?php echo $arr['Ticket']['name']; ?></td>
            <td><?php echo $arr['Ticket']['phone']; ?> <?php echo $arr['Ticket']['phone2']; ?></td>
            <td><?php echo $arr['Ticket']['quantity'];?></td>
            <td><?php echo $arr['Ticket']['start_date'];?></td>
            <td><?php echo $arr['Road']['start_time'];?></td>
            <td><?php echo $arr['Road']['from']; ?> - <?php echo $arr['Road']['to'];?> </td>
            <td><?php echo $car_type[$arr['Road']['car_type']];?></td>
            <td><?php echo $trip_car_type[$arr['Road']['trip_car_type']];?></td>

            <td>
                <?php if($arr['Ticket']['actived']==0){ ?>
                <span class="label label-danger">Chưa nhập hệ thống </span>
                <?php } else { ?>
                <span class="label label-success">Đã xử lý </span>
                <?php } ?>
                <?php echo @$arr['noi_dung_do_nhan_vien_ghi'];?>
            </td>
            <td><?php echo $arr['Road']['created'];?></td>

        </tr>
    <?php } ?>
</table>

<?php if((int)$this->Paginator->counter('{:pages}')>1){ ?>
<div class='pagination pull-right'>
	<ul class='pagination pagination-sm'>
	<?php
		echo $this->Paginator->first('<<',array('tag' => 'li'));
		echo $this->Paginator->prev('<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
		echo $this->Paginator->next('>', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		echo $this->Paginator->last('>>',array('tag' => 'li'));
	?>
	</ul>
	<p><small class='pull-right'>
		<?php echo $this->Paginator->counter('Trang số {:page} trong {:pages} trang, hiển thị {:current} dòng trong tổng số {:count} dòng '); ?></small>
	</p>
</div>
<?php }?>