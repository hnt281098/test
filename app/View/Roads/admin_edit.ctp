<?php echo $this->Html->createEditor();?>
<br/>
<form id="frm_roads" action="/admin/roads/<?= empty($data['Road']['id'])?'add':'edit/'.  $data['Road']['id'] ;?>" method='POST' enctype="multipart/form-data" accept-charset="utf-8">
<div class="row">
    <div rel="edit" class="col-md-8">
        <input type='hidden' name='data[Road][id]' value='<?php echo $data['Road']['id']; ?>'>
        <div class="form-group row">
            <div class="col-md-8">
                <label>Tuyến đường </label>
                <input type='text' required="required" data-parsley-required-message="Thiếu thông tin tuyến đường"  placeholder='' rel="point" class='form-control' name='data[Road][point]' value='<?php echo $data['Road']['point']; ?>'>
                <?php echo $this->Html->displayValidationError($this->validationErrors['Road'],'point');?>
            </div>
            <div class="col-md-4">
            <label>Loại xe</label>
                <select name="data[Road][trip_car_type]" class="form-control">
                    <option value=""> -- Chọn loại hinh xe </option>
                    <?php foreach($trip_car_type as $id => $name){ ?>
                    <option <?php echo ($data['Road']['car_type']==$id ? 'selected="selected"':'');?> value="<?php echo $id;?>"><?php echo $name ?></option>
                    <?php }?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-4">
                <label>Từ </label>
                <input type='text' required="required" data-parsley-required-message="Thiếu thông tin điểm xuất phát" placeholder='' class='form-control' name='data[Road][from]' value='<?php echo $data['Road']['from']; ?>'>
            <?php echo $this->Html->displayValidationError($this->validationErrors['Road'],'from');?>
            </div>
            <div class="col-md-4">
                <label>Đến </label>
                <input type='text' required="required" data-parsley-required-message="Thiếu thông tin điểm kết thúc"  placeholder='' rel="to" class='form-control' name='data[Road][to]' value='<?php echo $data['Road']['to']; ?>'>
                <?php echo $this->Html->displayValidationError($this->validationErrors['Road'],'to');?>
            </div>

            <div class="col-md-4">
                <label>Số chuyến </label>
                <input type='text' required="required" data-parsley-required-message="Thiếu thông tin điểm số lượng chuyến/ngày" placeholder='' class='form-control' name='data[Road][running_time]' value='<?php echo $data['Road']['running_time']; ?>'>
            <?php echo $this->Html->displayValidationError($this->validationErrors['Road'],'running_time');?>
            </div>


        </div>

        <div class="form-group row">
            <div class="col-md-3">
                <label>Thời gian xuất bến/khởi hành </label>
                <input type='text' placeholder='8h00'  required="required" data-parsley-required-message="Thiếu thông thời gian xuất phát" class='form-control' name='data[Road][start_time]' value='<?php echo $data['Road']['start_time']; ?>'>
                <?php echo $this->Html->displayValidationError($this->validationErrors['Road'],'start_time');?>
            </div>

            <div class="col-md-3">
                <label>Giá tiền </label>
                <input type='text' placeholder='' class='form-control'

                 required="required" data-parsley-required-message="Thiếu thông thời giá tiền " name='data[Road][price]' value='<?php echo $data['Road']['price']; ?>'>
                <?php echo $this->Html->displayValidationError($this->validationErrors['Road'],'price');?>
            </div>

            <div class="col-md-3">
                <label>Đơn giá tiền </label>
                <input type='text' placeholder='' class='form-control'
                 name='data[Road][unit]' value='<?php echo $data['Road']['unit']; ?>'>
            </div>

            <div class="col-md-3">
                <label>Quãng đường </label>
                <input type='text' placeholder='16h00'  required="required" data-parsley-required-message="Thiếu thông thời gian kết thúc " class='form-control' name='data[Road][long_road]' value='<?php echo $data['Road']['long_road']; ?>'>
                <?php echo $this->Html->displayValidationError($this->validationErrors['Road'],'long_road');?>
            </div>


        </div>

        <div class="form-group">
            <label>Giờ chạy trong ngày </label>
            <textarea id="description"  name="data[Road][description]" rows="5" class='form-control'><?php echo $data['Road']['description']; ?></textarea>
            <?php echo $this->Html->displayValidationError($this->validationErrors['Road'],'description');?>
        </div>

        <button type='submit' class='btn btn-success' name='btnSubmit'> Cập nhật </button>
        <a href="/admin/roads/index" class="btn btn-primary" > Quay lại </a>
    </div>

    <div rel="upload_image" class="col-md-4" style="background:#ffffcc" >
		<table class='table'>
		<tr>
			<td>
				<h4>Upload hình </h4> <br\>
				<input type="file" name="data[RoadImage][images]" value="" />
			</td>
		</tr>

        <?php if(!empty($data['RoadImage'])){ ?>
			<?php foreach ($data['RoadImage']  as $road_image) { ?>
			<tr>
				<td>
					<img class="img-thumbnail" src="<?php echo $road_image['url']; ?>"/>
					<a class="float-right" onclick="return confirm('Hình ảnh này sẽ bị xóa..?')" href="/admin/roads/delete_image/<?php echo $road_image['id']; ?>">Xóa</a>
				</td>
			</tr>
			<?php } ?>
		<?php } ?>


		</table>
	</div>
</div>
</form>

