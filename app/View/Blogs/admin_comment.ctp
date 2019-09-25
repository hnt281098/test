

<?php if(empty($blogInfo['BlogComment'])){ ?>
	<h3> Bài viết chưa có bình luận </h3>
<?php }else{ ?>
<p class="text-danger"> Bài viết: <?= @$blogInfo['Blog']['title'];?> </p>
<div class="row">
	<div class="col-md-8">
		<table class="table bordered">
		<tr>
			<th>STT</th>
			<th>Tên người viết</th>
			<th>Nội dung</th>
			<th>Ngày viết</th>
			<th>Duyệt/Xóa</th>
		</tr>
		<?php $inc = 1;?>
		<?php foreach ($blogInfo['BlogComment'] as $key => $comment) {?>
			<?php
				$class= "";
				if($comment['visiabled'] == DISABLED){
					$class ='class="success"';
				}
			?>
			<tr <?= $class;?>>
				<td><?= $inc++;?></td>
				<td><?= $comment['name'];?></td>
				<td><?= $comment['content'];?></td>
				<td><?= date('d-m-Y H:i', strtotime($comment['created']));?> </td>
				<td>
					<a href="/admin/blogs/comment_delete/<?= $comment['id']; ?>"  onclick="return confirm('Bài viết này sẽ bị xóa..?')"> Xóa </a> |
					<?php if($comment['visiabled'] == DISABLED){?>
						<a href="/admin/blogs/comment_approval/<?= $comment['id']; ?>" > Duyệt</a>
					<?php } ?>
				</td>
			</tr>
		<?php }?>
		</table>
	</div>
</div>




<?php } ?>