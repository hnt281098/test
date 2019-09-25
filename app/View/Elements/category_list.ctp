<p class='pull-left'>
	<button class='btn btn-success btn-flat' onClick="document.location='/admin/categories/add'">Thêm mới danh mục </button>
</p>
<table class="table table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nội dung</th>
			<th>#</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($categories as $categoryTempId =>$categoryTitle){ ?>
			<tr <?php echo (isset($categoryId) && $categoryId==$categoryTempId) ? 'class="warning"':''; ?> rel='data'>
				<td class="center"><?php echo $categoryTempId; ?></td>
				<td><a href="/admin/categories/edit/<?= $categoryTempId ?>"><?php echo $categoryTitle; ?></a></td>
				<td>
					<!--a href="/admin/categories/delete/<?php echo $categoryTempId; ?>" rel='fa' onclick="return confirm('Bài viết này sẽ bị xóa..?')">
						<span class="fa fa-times"></span>
					</a-->
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
