<div class="view">
    <ul>
        <li><h5><i class="fas fa-circle" style="color: green;"></i>&nbsp;<i style="color: #fff;">Đang Online: &nbsp;&nbsp; <?= $this->requestAction('/count_user_onlines'); ?></i></h5></li>
        <li><p>Tổng lượt xem trong ngày: &nbsp;&nbsp; <?= $this->requestAction('/count_user_in_day'); ?></p></li>
        <li><p>Tổng lượt xem trong tháng: &nbsp;&nbsp; <?= $this->requestAction('/count_user_in_month'); ?></p></li>
    </ul>
</div>