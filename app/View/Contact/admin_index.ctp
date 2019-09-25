
<div class='clearfix'></div>

<table class='table table-bordered ' >
	<tr>

		<th><?php echo $this->Paginator->sort('id', '#');?></th>
		<th><?php echo $this->Paginator->sort('subject', 'Email');?></th>
		<th><?php echo $this->Paginator->sort('subject', 'Name');?></th>
		<th><?php echo $this->Paginator->sort('content', 'Phone');?></th>
		<th><?php echo $this->Paginator->sort('content', 'Nội dung');?></th>
		<th><?php echo $this->Paginator->sort('created', 'Ngày viết bài');?></th>

		<th>Cập nhật</th>
	</tr>
	<?php $inc = 1;?>
	<?php foreach ($contactData as $key => $contact){?>
		<tr rel='data'>
			<td><?= $inc++;?></td>
			<td><?php echo $contact['Contact']['email']; ?></td>
			<td><?php echo $contact['Contact']['name']; ?></td>
			<td><?php echo $contact['Contact']['phone']; ?></td>
			<td><?php echo $contact['Contact']['content']; ?></td>
			<td><?php echo date('d-m-Y H:i', strtotime($contact['Contact']['created'])); ?></td>
			<td >
				<a href="/admin/contact/delete/<?php echo $contact['Contact']['id']; ?>"  onclick="return confirm('Liên hệ này sẽ bị xóa..?')">
					Xóa
				</a>
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