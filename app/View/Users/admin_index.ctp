<?php $userCurrentLogin = $this->Session->read(SESSION_ADMIN_DATA);?>

<div class='clearfix'></div>
<?php if($userCurrentLogin['User']['role']==='admin'){ ?>
<div class="row" >
	<div class="col-md-12 pull-right"  >
		<a class='btn btn-success pull-right' href="/admin/users/add"> Thêm mới dữ liệu </a>
	</div>
</div>
<?php } ?>
<br/>
<table class='table table-bordered ' >
	<tr>
		<th><?php echo $this->Paginator->sort('id', '#');?></th>
		<th><?php echo $this->Paginator->sort('email', 'Email đăng nhập');?></th>
		<th><?php echo $this->Paginator->sort('role', 'Quyền');?></th>
		<th><?php echo $this->Paginator->sort('created', 'Ngày khởi tạo');?></th>
		<th>Cập nhật</th>
	</tr>
	<?php $inc = 1;?>
	<?php foreach ($userData as $key => $user){?>

	<tr rel='data'>
		<td>
		<?php echo $inc++ ?>
		</td>
		<td><?= $user['User']['email'];?></td>
		<td><?= $user['User']['role'];?></td>
		<td><?php echo date('d-m-Y H:i', strtotime($user['User']['created'])); ?></td>
		<td >
			<?php if($userCurrentLogin['User']['role']==='admin' || $user['User']['email']===$userCurrentLogin['User']['email']){ ?>
				<a href="/admin/users/changepassword/<?php echo $user['User']['id']; ?>">Thay đổi mật khẩu</a> |
				<a href="/admin/users/change_email/<?php echo $user['User']['id']; ?>">Thay đổi email</a> |
				<a href="/admin/users/delete_account/<?php echo $user['User']['id'];?>"> Xóa </a>			
			<?php } ?>
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
