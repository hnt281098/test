<div class='clearfix'></div>
<div class="row" >
	<div class="col-md-12 "  >
		<a class='btn btn-success float-right' href="/admin/roads/add"> Thêm mới dữ liệu </a>
	</div>
</div>
<br/>

<table class='table table-bordered ' >
	<tr>
		<th><?php echo $this->Paginator->sort('id', '#');?></th>
		<th><?php echo $this->Paginator->sort('point', 'Khu vực ');?></th>
        <th><?php echo $this->Paginator->sort('car_type', 'Dịch vụ');?></th>
        <th><?php echo $this->Paginator->sort('start_time', 'Thời gian xuất bến ');?></th>
        <th><?php echo $this->Paginator->sort('from', 'Từ');?></th>
        <th><?php echo $this->Paginator->sort('to', 'Đến');?></th>
		<th><?php echo $this->Paginator->sort('price', 'Đơn giá');?></th>
		<th>Cập nhật</th>
	</tr>
    <?php $inc=1;?>
    <?php foreach ($data as $key => $arr){?>
        <tr rel='data'>
            <td>
                <a href='/admin/roads/edit/<?php echo $arr['Road']['id']; ?>'><?= $inc++; ?></a>
            </td>
            <td><a href="/admin/roads/edit/<?= $arr['Road']['id']; ?>"> <?php echo $arr['Road']['point']; ?> </a> </td>
            <td><?php echo $trip_car_type[$arr['Road']['car_type']];?></td>
            <td><?php echo $arr['Road']['start_time'];?></td>
            <td><?php echo $arr['Road']['from'];?></td>
            <td><?php echo $arr['Road']['to'];?></td>
            <td><?php echo $arr['Road']['price'] ;?></td>
            <td >
                <a href="/admin/roads/delete/<?php echo $arr['Road']['id']; ?>"  onclick="return confirm('Chuyến xe này sẽ bị xóa..?')">| Xóa </a>
            </td>
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