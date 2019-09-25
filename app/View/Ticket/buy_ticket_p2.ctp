<link rel="stylesheet" href="/css/customer-info.css">
<style>
 .btn-book {
    background-color: #6b1814;
    color: #fff;
    width: 100px;
    margin-left: 12px;
    font-weight: bold;
    cursor: pointer;
}

</style>
<div class="customer-info">
      <div class="tab-customer clearfix">
        <div class="tab-customer-item tab2">
          <img src="/images/uploads/tab2.png" alt="">
          <p>THÔNG TIN GIÁ VÉ</p>
        </div>
        <div class="tab-customer-item tab1">
          <img src="/images/uploads/tab1.png" alt="">
          <p>THÔNG TIN KHÁCH HÀNG</p>
        </div>
        <div class="tab-customer-item tab2">
          <img src="/images/uploads/tab2.png" alt="">
          <p>HÌNH THỨC THANH TOÁN</p>
        </div>
      </div>
      <div class="header-book">
        <div class="main-header-book"><p>THÔNG TIN KHÁCH HÀNG</p></div>
        <div class="icon-header-book">
          <i class="fa fa-users"></i>
        </div>
      </div>
      <form class="" action="/mua-ve-xe-khach" method="post">
      <div class="row main-customer">
        <div class="col-sm-6 col-md-6 left-customer">
          <div class="main-left-customer">

                <input type="hidden" name="start_time" value="<?php echo $date; ?>">
                <input type="hidden" name="number_ticket" value="<?php echo $quantity; ?>">
                <input type="hidden" name="roads" value="<?php echo $road; ?>">
                <input type="hidden" name="from" value="<?php echo $from; ?>">
                <input type="hidden" name="to" value="<?php echo $to; ?>">

              <div class="row">
                <div class="col-sm-6 col-md-6 ">
                  <div class="form-group">
                    <label for="">* Họ và tên</label>
                    <input type="text" name="customer_name" required="required" value="" placeholder="Họ và tên khách hàng" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class=" form-group">
                    <label for="">* Số điện thoại</label>
                    <input type="text" name="customer_phone" required="required" value="" placeholder="Số điện thoại" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12 ">
                  <div class="form-group">
                    <label for="">* Địa chỉ</label>
                    <input type="text" name="note" required="required" value="" placeholder="Địa chỉ" class="form-control">
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-6 right-customer">
          <div class="main-right-customer">
            <h2 class="text-center">LƯU Ý</h2>
            <p>
              - Quý Khách có mặt tại bến xe trước 15 phút giờ xe khởi hành. <br>
              - Vui lòng nhập thông tin cẩn thận và chính xác.<br>
              - Quý Khách được đổi hoặc hủy vé một lần trước giờ xe chạy 24 giờ ( phí hủy vé 10% ).<br>
              - Nếu Quý Khách có nhu cầu trung chuyển, vui lòng liên hệ số điện thoại <span>1900 9028</span> trước khi đặt vé. Xe trung chuyển chỉ áp dụng tại những địa điểm theo quy định.
            </p>
          </div>
        </div>
      </div>
      <div class="direct-nav">
          <button class="btn btn-dark btn-book" ref="btn" href="/mua-ve-xe-p1?from=<?php echo $from;?>&date=<?php echo $date ?>&to=<?php echo $to ?>&quantity=<?php echo $quantity ?>&button=" type="button"><i class="fa fa-caret-left" style="margin-right:10px"></i>Quay lại</button>
         <button class="btn btn-dark btn-book"> Tiếp tục<i class="fa fa-caret-right" style="margin-left:10px"></i></button>
      </div>
      </form>
    </div>
<br/>


<script>
    $(document).ready(function(){
        $('button[ref=btn]').click(function(){
          window.location.href = $(this).attr('href');
        });
    });
</script>