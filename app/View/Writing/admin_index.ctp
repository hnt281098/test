
<div class='clearfix'></div>

<table class='table table-bordered ' >
	<tr>

		<th><?php echo $this->Paginator->sort('id', '#');?></th>
		<th><?php echo $this->Paginator->sort('full_name', 'Họ và tên');?></th>
		<th><?php echo $this->Paginator->sort('email', 'Email');?></th>
		<th><?php echo $this->Paginator->sort('phone', 'Số điện thoại');?></th>
		<th><?php echo $this->Paginator->sort('created', 'Ngày Gửi bài');?></th>
		<th><?php echo $this->Paginator->sort('created', 'File đính kèm');?></th>


		<th>Cập nhật</th>
	</tr>
<?php foreach ($writingData as $key => $writing)
{?>
	<tr rel='data'>
		<td>
			<a href='/admin/blogs/edit/<?php echo $writing['Writing']['id']; ?>'>
				<?php echo $writing['Writing']['id']; ?>
			</a>
		</td>
		<td><?php echo $writing['Writing']['full_name']; ?></td>
		<td><?php echo $writing['Writing']['email']; ?></td>
		<td><?php echo $writing['Writing']['phone']; ?></td>
		<td><?php echo date('d-m-Y H:i', strtotime($writing['Writing']['created'])); ?></td>
		<td>
			<?php if(!empty($writing['Writing']['file'])){?>
				<a href="<?= $writing['Writing']['file'];?>"> Download file </a>
			<?php }?>
		</td>
		<td >
			<a href="/admin/writing/delete/<?php echo $writing['Writing']['id']; ?>"  onclick="return confirm('Liên hệ này sẽ bị xóa..?')">
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