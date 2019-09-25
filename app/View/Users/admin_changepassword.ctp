<div class="col-md-4">
<form method="post" action="/admin/users/changepassword/<?= $userId;?>">
<input type="hidden" name="userId" value="<?= $userId;?>"/>

  <div class="form-group">
    <label for="exampleInputEmail1">Mật khẩu mới</label>
    <input name="password" type="password" class="form-control" id="passwd1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Xác nhận mật khẩu mới</label>
    <input type="password" name="password_confirmtion" class="form-control" id="passwd2" >
  </div>
  <button id="btnUpdatePassword" type="submit" name="btnUpdate" class="btn btn-danger">Cập nhật mật khẩu mới</button>
</form>
</div>

<script>
$(document).ready(function(){
    $('#btnUpdatePassword').click(function(){
        if($('#passwd1').val() == '' || $('#passwd2').val() == '' ){
            alert('Mật khẩu mới không được để trống ')
            return false;
        }

        if($('#passwd1').val() != $('#passwd2').val()){
            alert('Mật khẩu mới không chính xác được  ');
            return false;
        }

        return true;

    });
});
</script>