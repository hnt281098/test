<div class="col-md-6">
<?php echo $this->Form->create('User'); ?>

	<div class="form-group">
		<label for="exampleInputEmail1">Email</label>
		<input name="data[User][email]" type="text" id="UserEmail" class="form-control" required="required">
	</div>

	<div class="form-group">
		<label for="exampleInputEmail1">Nhập mật khẩu</label>
		<input name="data[User][password]" type="password" id="UserPassword" class="form-control" required="required">
	</div>

	<div class="form-group">
		<label for="exampleInputEmail1">Nhóm sử dụng</label>
		<select name="data[User][role]" id="UserRole" class="form-control" required="required">
			<option value="admin">Admin</option>
			<option value="user">User</option>
		</select>
	</div>
	<button id="btnUpdateEmail" type="submit" name="btnUpdate" class="btn btn-danger">Cập nhật Email</button>
	</form>
</div>

<script>
$(document).ready(function(){
	$()
    $('#btnUpdatePassword').click(function(){
        if($('#newEmail').val() == '' || $('#passwd2').val() == '' ){
            alert('Mật khẩu mới không được để trống ')
            return false;
        }
        return true;

    });
});
</script>