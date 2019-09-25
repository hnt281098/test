<link rel="stylesheet" href="/css/block.css">
<link rel="stylesheet" href="/css/ticket-info.css">

<style type="text/css">
    .change-color{
        color: #95181c !important;
    }
    .table tr>th{
        padding-left: 4%;
    }
</style>
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12 ">
            <div class="ticket-info">
                <div class="tab-ticket clearfix">
                    <div class="tab-ticket-item tab2">
                        <img src="/images/tab2.png" alt="">
                        <p style="color:#FFF">THÔNG TIN GIÁ VÉ</p>
                    </div>
                    <div class="tab-ticket-item tab2">
                        <img src="/images/tab2.png" alt="">
                        <p style="color:#FFF">THÔNG TIN KHÁCH HÀNG</p>
                    </div>
                    <div class="tab-ticket-item tab1">
                        <img src="/images/tab1.png" alt="">
                        <p style="color:#FFF">HÌNH THỨC THANH TOÁN</p>
                    </div>
                </div>
            </div>
            <br/>
            <h4 class="text-customize"> ĐẶT VÉ TRỰC TUYẾN  </h4><hr/>
            <p class="font-weight-bold text-warning"><?php echo $this->App->contentPage('thong-bao-dat-ve-thanh-cong');?></p>

            <table class="table table-bordered " style="border-top: 10px #dee2e6 solid;">

                <tr>
                    <th width="20%;" class="change-color">Mã vé</th>
                    <th class="font-weight-bold text-nowrap change-color"><?php echo $ticket_code; ?> </th>
                </tr>
                <tr>
                    <th class="change-color">Họ tên </th>
                    <th><?php echo $ticket['Ticket']['name'];?> </th>
                </tr>
                <tr>
                    <th class="change-color">Email </th>
                    <th> <?php echo $ticket['Ticket']['email'];?></th>
                </tr>
                <tr>
                    <th class="change-color">SĐT </th>
                    <th> <?php echo $ticket['Ticket']['phone'];?> <?php echo $ticket['Ticket']['phone2'];?> </th>
                </tr>
                <tr>
                    <th class="change-color">Địa chỉ</th>
                    <th> <?php echo $ticket['Ticket']['district'];?> <?php echo $ticket['Ticket']['province'];?></th>
                </tr>
                <tr>
                    <th class="change-color">Chuyến đi </th>
                    <th><?php echo $road['Road']['from'];?> tới <?php echo $road['Road']['to'];?></th>
                </tr>

                <tr>
                    <th class="change-color">Ngày đi </th>
                    <th><?php echo $ticket['Ticket']['start_date'];?></th>
                </tr>
                <tr>
                    <th class="change-color">Giờ khởi hành </th>
                    <th><?php echo $ticket['Ticket']['start_time'];?> </th>
                </tr>
                <tr>
                    <th class="change-color">Giá vé</th>
                    <th class="change-color"><?php echo number_format($ticket['Ticket']['amount']);?> vnd</th>
                </tr>

            </table>
            <br/>



            <hr/>
            <p class="text-danger font-weight-bold">HÌNH THỨC THANH TOÁN</p>

            <div class="row" style="background-color: #ccc; padding: 20px 0;">
                <div class="col-md-6 pull-left">
                    <img src="/images/icon-chuyen-khoan.png" alt="" style="width: 100%;margin: 25% -15px;">
                </div>
                <div class="col-md-6 pull-right">
                    <?php echo $this->App->contentPage('chuyen-khoan-ngan-hang');?>
                </div>
            </div>

            <div class="row" style="background-color: #ccc; padding: 20px 0;margin-top: 30px;">
                <div class="col-md-6 pull-left" style="margin-top: 4%;">
                    <?php echo $this->App->contentPage('tra-tien-truc-tiep-tai-quay-giao-dich-phong-ve');?>
                </div>
                <div class="col-md-6 pull-right">
                    <img src="/images/icon-tien-mat.png" alt="" style="width: 100%;margin-left: 15px;">
                </div>
            </div>

        </div>

    </div>
</div>
<br/>

