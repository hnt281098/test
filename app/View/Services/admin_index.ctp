
<div class='clearfix'></div>
<p class='pull-right'>
	<a href="/admin/services/add" class='btn btn-success btn-flat'>Thêm mới</a>
</p>
<table class='table' >
	<tr>
		<th><?php echo $this->Paginator->sort('id', 'id');?></th>
		<th><?php echo $this->Paginator->sort('title', 'title');?></th>
		<th><?php echo $this->Paginator->sort('created', 'created');?></th>
		<th><?php echo $this->Paginator->sort('modified', 'modified');?></th>
		<th>#</th>
	</tr>

<?php foreach ($servicesData as $key  => $data){ ?>
	<tr rel='data'>
		<td>
			<a href='/admin/services/edit/<?= $data['Service']['id']; ?>'>
				<?php echo $data['Service']['id']; ?>
			<a/>
		</td>
		<td><?php echo $data['Service']['title']; ?></td>
		<td><?php echo $data['Service']['created']; ?></td>
		<td><?php echo $data['Service']['modified']; ?></td>
		<th>
			<a href="/admin/services/delete/<?= $data['Service']['id']; ?>" rel='fa' onclick="return confirm('Bài viết này sẽ bị xóa..?')">
				<span class="fa fa-times"></span>
			</a>
		</th>
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