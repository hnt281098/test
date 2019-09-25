<div class="col-md-6">
<form method="post" action="/admin/users/change_email/<?= $userId;?>">
<input type="hidden" name="userId" value="<?= $userId;?>"/>
  <p class="danger">Email hiện tại : <?= @$email;?></p>
  <div class="form-group">
    <label for="exampleInputEmail1">Email mới</label>
    <input name="newEmail" type="text" class="form-control" id="newEmail">
    <small>Sau khi đổi email, hệ thống sẽ yêu cầu đăng nhập bằng email mới nếu thành công!.</small>
  </div>

  <button id="btnUpdateEmail" type="submit" name="btnUpdate" class="btn btn-danger">Cập nhật Email</button>
</form>
</div>

<script>
$(document).ready(function(){
    $('#btnUpdatePassword').click(function(){
        if($('#newEmail').val() == '' || $('#passwd2').val() == '' ){
            alert('Mật khẩu mới không được để trống ')
            return false;
        }
        return true;

    });
});
</script>