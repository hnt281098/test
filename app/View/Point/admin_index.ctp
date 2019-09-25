
<div class='clearfix'></div>
<p class='pull-right'>
	<a href="/admin/point/add" class='btn btn-success btn-flat'>Thêm mới</a>
</p>
<table class='table table-bordered' >
	<tr>
		<th><?php echo $this->Paginator->sort('id', 'id');?></th>
		<th><?php echo $this->Paginator->sort('title', 'Tiêu đề');?></th>
		<th><?php echo $this->Paginator->sort('address', 'Địa chỉ');?></th>
		<th><?php echo $this->Paginator->sort('phone', 'Điện thoại');?></th>
		<th><?php echo $this->Paginator->sort('created', 'Ngày tạo ');?></th>
		<th><?php echo $this->Paginator->sort('modified', 'Chỉnh sửa lần cuối ');?></th>
	</tr>

<?php foreach ($pageData as $key  => $data){ ?>
	<tr>
		<td><?php echo $data['Point']['id']; ?></td>
		<td>
            <a href='/admin/point/edit/<?= $data['Point']['id']; ?>'>
                <?php echo $data['Point']['title']; ?>
            </a>
        </td>
		<td><?php echo $data['Point']['address']; ?></td>
		<td><?php echo $data['Point']['phone']; ?></td>
		<td><?php echo $data['Point']['created']; ?></td>
		<td><?php echo $data['Point']['modified']; ?></td>
	</tr>
<?php
}?>
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
