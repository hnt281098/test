<link rel="stylesheet" href="/css/block.css">
<link rel="stylesheet" href="/css/price.css">
<div class="inmain">

    <div class="price">
        <div class="head-price">
            <img src="/images/uploads/price.png" alt="">
        </div>
        <div class="main-price">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" href="#tab1" role="tab" data-toggle="tab">Giá vé ngày thường</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab2" role="tab" data-toggle="tab">Giá vé lễ, tết</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab3" role="tab" data-toggle="tab">Giá vé khuyến mãi</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tab1">
                    <?php echo $this->Element('lich-chay-xe');?>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab2">

                </div>
                <div role="tabpanel" class="tab-pane" id="tab3">
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->Element('tram-va-cac-chi-nhanh');?>

    <?php echo $this->Element('dich-vu');?>


</div>