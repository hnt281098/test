
    <form method="POST" class="form-horizontal" action="/order/store" role="form" id="frmOrder">
        <input type="hidden" name="token_key" value="<?php echo $token_key;?>" class="form-control">

        <div class="form-group">
            <div class="col-md-6">
                <label name="" for="full-name"> Họ và tên </label>
                <input type="text" id="name" maxlength="100" name="name" class="form-control" autocomplete="off"  placeholder="" required>
            </div>

            <div class="col-md-6">
                <label name="" for="full-name"> Số điện thoại </label>
                <input type="text" maxlength="50" id="phone" name="phone" class="form-control" autocomplete="off"  placeholder="" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <label name="" for="full-name" > Ngân hàng </label>
                <select name="banks" id="bank" class="form-control">
                </select>
            </div>
            <div class="col-md-6">
                <label name="" for="full-name"> Số tài khoản nhận </label>
                <input type="text" maxlength="16" id="recived_account" name="recived_account" class="form-control" autocomplete="off"  placeholder="" required>
            </div>

        </div>

        <div class="form-group">
            <div class="col-md-6">
                <label name="" for="full-name"> Số tiền chuyển </label>
                <input type="text" id="amount" maxlength="8" name="amount" class="form-control" autocomplete="off"  placeholder="" required>
            </div>
            <div class="col-md-6">
                <label name="" for="full-name"> Mã giao dịch/ Số tài khoản </label>
                <input type="text" maxlength="16" id="send_account" name="send_account" class="form-control" autocomplete="off"  placeholder="" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label name="" for="full-name"> Ghi chú </label>
                <textarea name="note" maxlength="200" rows="5" class="form-control"></textarea>
            </div>
        </div>
        <button name="btn" id="btnUpdate" class="btn btn-success"> Xác nhận chuyển tiền mua vé </button>
    </form>


<script type="text/javascript" src="/js/accounting.js"></script>
<script type="text/javascript" >
$(document).ready(function(){

    $('#btnUpdate').click(function(){

        if($('#name').val()==''){
            $('#name').focus();
            alert('Vui lòng nhập tên khách hàng');
            return false;
        }

        if($('#phone').val()==''){
            $('#phone').focus();
            alert('Vui lòng nhập số điện thoại của khách hàng');
            return false;
        }

        if($('#bank').val()==''){
            $('#bank').focus();
            alert('Vui lòng chọn ngân hàng');
            return false;
        }

        if($('#recived_account').val()==''){
            $('#recived_account').focus();
            alert('Số tài khoản ngân hàng không có thực');
            return false;
        }

        var amount = $('#amount').val();
        amount = parseInt(amount, 10)
        if(amount <= 0 || isNaN(amount)){
            $('#amount').focus();
            alert('Số tiền chuyển không xác định được');
            return false;
        }

        if($('#send_account').val()==''){
            $('#send_account').focus();
            alert('Mã giao dịch/ Số tài khoản không xác định');
            return false;
        }

        return true;
    });

    $('#amount').change(function(){
        $(this).val( accounting.formatNumber($(this).val() ));
    });

    $('#bank').change(function(){
        var selectBank = $(this).val();
        if(selectBank == ''){
            alert('Vui lòng chọn ngân hàng');
            $('#bank').forcus();
            return false;
        }

        $.get('/order/account/'+selectBank,function(resp){
            $('#recived_account').val(resp);
        });

    });

    $.get('/order/banks',function(resp){
        var banks = '<option value="" >----Vui lòng chọn ngân hàng----</option>';
        $('#bank').empty();
        $('#bank').append('<option value="" >----Vui lòng chọn ngân hàng----</option>');
        $.each(resp, function(i, item) {
            $('#bank').append('<option value="'+i+'" >'+item+'</option>');
        });
    },'json');


});
</script>
