<link rel="stylesheet" href="/css/block.css">
<link rel="stylesheet" href="css/customer-info.css">
<style>
  .btn-book {
      background-color: #95181c;
      color: #fff;
      width: 100px;
      margin-left: 12px;
      font-weight: bold;
      cursor: pointer;
      border-color: #95181c;
      border-radius: 20px;
  }
</style>
<div class="customer-info" style="margin-bottom: 30px;">
  <div class="tab-customer clearfix">
      <div class="tab-customer-item tab2">
          <img src="/images/tab2.png" alt="">
          <p><a href="#">MUA VÉ</a></p>
      </div>
      <div class="tab-customer-item tab1">
          <img src="/images/tab1.png" alt="">
          <p><a href="thong-tin-khach-hang.html">THÔNG TIN KHÁCH HÀNG</a></p>
      </div>
      <div class="tab-customer-item tab2">
          <img src="/images/tab2.png" alt="">
          <p><a href="hinh-thuc-thanh-toan.html">THANH TOÁN</a></p>
      </div>
  </div>
  <form class="" action="/mua-ve-xe-khach" method="post">
      <div class="row main-customer">
          <div class="col-sm-6 col-md-6 left-customer">
              <div class="main-left-customer">
                  <input type="hidden" name="date" value="<?php echo $date; ?>">
                  <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
                  <input type="hidden" name="from" value="<?php echo $from; ?>">
                  <input type="hidden" name="to" value="<?php echo $to; ?>">
                  <input type="hidden" name="road_id" value="<?php echo $road["Road"]["id"];?>">
                  <h2 class="text-center">THÔNG TIN CHUYẾN XE </h2>
                  <div class="row">
                      <div class="col-sm-6 col-md-6">
                          <div class=" form-group">
                              <label for="">Thông tin chuyến xe </label>
                              <input type="text" name="" value="<?php echo $from; ?> - <?php echo $to; ?>" class="form-control">
                          </div>
                      </div>
                      <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                          <label for="">Chọn giờ khởi hành</label>
                          <select name="start_time" ref=roads id="road" class="form-control">
                            <?php if(isset($road['Road']['description'])){ ?>
                              <?php $road_times = explode("\n",$road['Road']['description']);?>
                            <?php foreach($road_times as $key => $road_time){?>
                                <option start="<?php echo $road_time; ?>"  price="<?php echo $road['Road']['price']; ?>" value="<?php echo $road_time; ?>"><?php echo $road_time; ?> (<?php echo $trip_car_type[$road['Road']['trip_car_type']]; ?>)</option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                  </div>
                  <hr/>
                  <h2 class="text-center">THÔNG TIN KHÁCH HÀNG</h2>
                  <div class="row">
                      <div class="col-sm-12 col-md-12 ">
                          <div class="form-group">
                              <label for="">Họ và tên *</label>
                              <input type="text" name="name" required="required" value="" placeholder="Họ và tên khách hàng" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6 col-md-6">
                          <div class=" form-group">
                              <label for="">Email *</label>
                              <input type="text" name="email" required="required" value="" placeholder="Địa chỉ Email" class="form-control">
                          </div>
                      </div>
                      <div class="col-sm-6 col-md-6">
                          <div class=" form-group">
                              <label for="">Ngày sinh *</label>
                              <input type="text" name="dob" required="required" value="" placeholder="dd-mm-yyyy" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6 col-md-6">
                          <div class=" form-group">
                              <label for="">Di động *</label>
                              <input type="text" name="phone" required="required" value="" placeholder="Số di động" class="form-control">
                          </div>
                      </div>
                      <div class="col-sm-6 col-md-6">
                          <div class=" form-group">
                              <label for="">Di động 2 *</label>
                              <input type="text" name="phone_2"  value="" placeholder="Số di động 2" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6 col-md-6">
                          <div class=" form-group">
                              <label for="">Tỉnh/TP *</label>
                              <input type="text" name="province" required="required" value="" placeholder="Chọn tỉnh/tp" class="form-control">
                          </div>
                      </div>
                      <div class="col-sm-6 col-md-6">
                          <div class=" form-group">
                              <label for="">Quận/huyện *</label>
                              <input type="text" name="district" required="required" value="" placeholder="Chọn quận/ huyện" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="direct-nav">
                      <a href="/" style="background: none;"><button class="btn btn-book" ref="btn" type="button" style="background-color: #ccc;color: #000;border-color: #ccc; ">Quay lại</button></a>
                      <button class="btn btn-book" ref="btn"  style="transform: translate(120px, -37px)"> Tiếp tục </button>
                  </div>
              </div>
          </div>
          <div class="col-sm-6 col-md-6 right-customer">
              <div class="main-right-customer">
                  <h2 class="text-center">ĐIỀU KHOẢN VÀ LƯU Ý</h2>
                  <p>
                      (*) Quý khách vui lòng mang email có chứa mã vé đến văn phòng để đổi vé lên xe trước giờ xuất bến ít nhất 60 phút để chúng tôi trung chuyển.<br/><br/>

                      (*) Thông tin hành khách phải chính xác, nếu không sẽ không thể lên xe hoặc hủy/đổi vé<br/><br/>

                      (*) Quý khách không được đổi / trả vé vào các ngày Lễ Tết ( ngày thường quý khách được quyền chuyển đổi hoặc hủy vé một lần duy nhất trước giờ xe chạy 24 giờ), phí hủy vé 10%.<br/><br/>

                      (*) Nếu quý khách có nhu cầu trung chuyển, vui lòng liên hệ số điện thoại 1900 6067 trước khi đặt vé. Chúng tôi sẽ không đón/ trung chuyển tại những điểm xe trung chuyển không thể tới được.

                  </p>
              </div>
          </div>
      </div>
  </form>
</div>
<br/>
<br/>

<script>
    $(document).ready(function(){

        <?php if(empty($_GET['from'])){?>
        $.get('/get_from_road/',function(resp){
            $('#from').html(resp);
        });
        <?php } ?>



       $('#from').change(function(){
          var from_value = $(this).val();
          $('#to').html('');
          $.get('/get_from_to_road/?from='+from_value+"&to=<?php echo isset($_GET['to']) ? $_GET['to']:""?>",function(resp){
            $('#to').html(resp);
          });
       });

       $('#from').trigger('change');

       $('#to').change(function(){
          var to =
          $.get('/get_detail_road/?to='+$(this).val()+"&from="+ $('#from').val() ,function(resp){
            $('#title').html(resp.title)
            $('#long_road').html(resp.long_road)
            $('#price').html(resp.price)
            $('#spn_from').html(resp.from)

          },'json');
       });
    });
</script>
