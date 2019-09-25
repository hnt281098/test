<style>
.btn-book{
    background-color: #6b1814;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
}

.btn-book:hover, {
    backgclicd-color: #6b1814;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
}

.dn_title{
    color: #6b1814 !important
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Đặt vé du lịch  </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 ">
            <h4 class="text-primary dn_title"> Đặt vé xe: <?php echo $road['Road']['title'];?> </h4><hr/>
            <form action="" method="post" id="frm_ticket">
                <input type="hidden" name="csrf" value="<?php echo $csrf;?>"/>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputCity">Ngày đặt vé <span class="text-danger"> * </span></label>
                        <?php $now = date('d-m-Y');?>
                        <select ref="start_time" class="form-control" name="start_time">
                            <?php for($i = 1; $i <= 7; $i++){ ?>
                                <option value="<?php echo date('Y-m-d', strtotime("+".$i." day ". $now));?>"> <?php echo date('d-m-Y', strtotime("+".$i." day ". $now));?> </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Chọn xe di chuyển <span class="text-danger"> * </span></label>
                        <select name="roads" ref="roads" class="form-control" required="required" data-parsley-required-message="Thiếu thông tin tuyến đường" >
                            <option value=""> -- Chọn tuyến xe -- </option>
                            <?php foreach($bus as $key => $item){?>
                                <option value="<?php echo $road['Road']['id']; ?>"><?php echo $road['Road']['start_time']; ?> (<?php echo $trip_car_type[$road['Road']['trip_car_type']]; ?>)</option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="exampleInputPassword1">Ngày/Giờ về <span class="text-danger"> * </span></label>
                        <input value="" id="end_time" name="end_time"  class="form-control" placeholder="16h00 - Trong ngày"
                            required="required" data-parsley-required-message="Thiếu thông tin giờ về ">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="exampleInputPassword1">Số lượng vé <span class="text-danger"> * </span></label>
                        <input type="number" value="1" id="number_ticket" name="number_ticket"  class="form-control" placeholder=""
                            required="required" data-parsley-required-message="Thiếu thông số lượng vé đặt "
                            data-parsley-type="number"
                            data-parsley-type-message="Số lượng vé không hợp lệ ">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputCity">Họ tên khách hàng <span class="text-danger"> * </span></label>
                        <input type="text" class="form-control" name="customer_name" id="customer_name" required="required" data-parsley-required-message="Thiếu thông tin giờ xuất bến">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">Số điện thoại <span class="text-danger"> * </span></label>
                        <input type="text"  class="form-control"  value="" maxlength="11" name="customer_phone"  id="customer_phone" required="required" data-parsley-required-message="Thiếu thông tin số điện thoại liên hệ">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputCity">Ghi chú </label>
                        <textarea class="form-control" rows="3" name="note"></textarea>
                        <small class="form-text text-muted">Dành cho quý khách có các yêu cầu thêm hay cần sự trợ giúp </small>
                        <small ><span class="text-danger"> * </span> Bắt buộc phải nhập thông tin </small>
                    </div>
                </div>
                <button type="submit" class="btn btn-book">Đặt vé trực tuyến </button>
            </form>
        </div>

        <div class="col-md-4 ">
            <div class="card">
                <div class="card-header text-danger ">
                    THÔNG TIN CHUYẾN ĐI
                </div>
                <div class="card-body">
                    <h5 class="card-title text-info" >DỊCH VỤ MIỄN PHÍ </h5>
                    <ul class="list-unstyled">
                        <li> - Khăn lạnh </li>
                        <li> - Nước uống đóng chai</li>
                        <li> - Wifi </li>
                        <li> - Tivi </li>
                    </ul>
                    <h5 class="card-title text-warning" >THÔNG TIN LƯU Ý  </h5>
                    <ul class="list-unstyled">
                        <li> - Quý Khách có mặt tại bến xe trước 15 phút giờ xe khởi hành </li>
                        <li> - Vui lòng nhập thông tin cẩn thận và chính xác.</li>
                        <li> - Quý Khách được đổi hoặc hủy vé một lần trước giờ xe chạy 24 giờ ( phí hủy vé 10% ). </li>
                        <li> - Nếu Quý Khách có nhu cầu trung chuyển, vui lòng liên hệ số điện thoại 1900 9028 trước khi đặt vé. Xe trung chuyển chỉ áp dụng tại những địa điểm theo quy định. </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>

<script src="/js/parsley.min.js"></script>
<script>
    $(document).ready(function(){
        $('#frm_ticket').parsley();
    });
</script>