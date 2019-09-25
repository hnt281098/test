
<div class='clearfix'></div>

<table class='table table-bordered ' >
	<tr>

		<th><?php echo $this->Paginator->sort('id', '#');?></th>
		<th><?php echo $this->Paginator->sort('full_name', 'Họ và tên');?></th>
		<th><?php echo $this->Paginator->sort('email', 'Email');?></th>
		<th><?php echo $this->Paginator->sort('phone', 'Số điện thoại');?></th>
		<th>Cập nhật</th>
	</tr>
<?php $inc = 1;?>
<?php foreach ($writingData as $key => $writing){?>
	<tr rel='data'>
		<td><?= $inc++;?></td>
		<td><?php echo $writing['Writer']['name']; ?></td>
		<td><?php echo $writing['Writer']['email']; ?></td>
		<td><?php echo $writing['Writer']['phone']; ?></td>

		<td >
			<a href="/admin/writing/writer_delete/<?php echo $writing['Writer']['id']; ?>"  onclick="return confirm('Tác giả sẽ bị xóa..?')">
				Xóa
			</a>
		</td>

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