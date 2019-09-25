<p >
	<a href="/users/add"> Tạo thêm tài khoản </a>
</p>
<table >
<?php foreach ($users as $key => $user) {?>
	<tr>
		<th>#</th>
		<th>User</th>
		<th>Password</th>
		<th>Role</th>
		<th>Created</th>
		<th>Modified</th>
	</tr>
	<tr>
		<td> <?php echo implode('</td><td>', $user['User']);  ?></td>
	</tr>
<?php } ?>
</table>