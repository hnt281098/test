<div class='clearfix'></div>
<div class="row" >
	<div class="col-md-12 "  >
		<a class='btn btn-success ' href="/admin/blogs/add"> Thêm mới dữ liệu </a>
	</div>
</div>
<br/>

<div class="row">
	<div class="col-md-7">
		<form action="/admin/blogs/index" method="GET">
			<table class='table '>
				<tr>
					<td style="width:15%">Tiêu đề </td>
					<td><input type="text" class='form-control' name="searchByTitle" value="<?= @$this->params->query['searchByTitle'];?>"/></td>
				</tr>
				<tr>
					<td style="width:15%">Loại tin tức </td>
					<td>
					<?php echo $this->Html->selectCategory($categories, @$this->params->query['searchByCategoryId'], array('name'=>'searchByCategoryId'));?>
					</td>
				</tr>
				<tr>
				<td colspan="2"> <button type="summit" name="btnSummit" class="btn btn-danger"> Tìm kiếm </button>  </td>
				</tr>
			</table>
		</form>
	</div>
</div>
<br/>
<table class='table table-bordered ' >
	<tr>
		<th><?php echo $this->Paginator->sort('id', '#');?></th>
		<th><?php echo $this->Paginator->sort('title', 'Tiêu đề');?></th>
		<th><?php echo $this->Paginator->sort('category_id', 'Loại tin tức');?></th>

		<th><?php echo $this->Paginator->sort('created', 'Ngày viết bài');?></th>
		<th width="15%"><?php echo $this->Paginator->sort('updated', 'Cập nhật mới');?></th>
		<th>Cập nhật</th>
	</tr>
<?php $inc=1;?>
<?php foreach ($arrData as $key => $arr){?>
	<tr rel='data'>
		<td>
			<a href='/admin/blogs/edit/<?php echo $arr['Blog']['id']; ?>'><?= $inc++; ?></a>
		</td>
		<td><?php echo $arr['Blog']['title']; ?></td>
		<td><?php echo $categoryList[$arr['Blog']['category_id']];?></td>
		<td><?php echo date('d-m-Y H:i', strtotime($arr['Blog']['created'])); ?></td>
		<td><?php echo date('d-m-Y H:i', strtotime($arr['Blog']['updated'])); ?></td>
		<td >
			<a href="/admin/blogs/edit/<?= $arr['Blog']['id']; ?>"  >  Chỉnh sửa</a>
			<a href="/admin/blogs/comment/<?= $arr['Blog']['id']; ?>"  > | Bình luận</a>
			<a href="/admin/blogs/delete/<?php echo $arr['Blog']['id']; ?>"  onclick="return confirm('Bài viết này sẽ bị xóa..?')">| Xóa </a>
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