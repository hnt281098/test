<?php echo $this->Html->createEditor();?>
<div class='clearfix'></div>
<hr/>
<div class="row">
	<div class='col-md-12'>
	<form action="/admin/address/<?=  empty($data['Address']['id']) ? 'add':'edit/'.$data['Address']['id'];?>" method='POST' enctype="multipart/form-data" accept-charset="utf-8">
	<input type='hidden' name='data[Address][id]' value='<?php echo $data['Address']['id']; ?>'>

	<div class="row">
		<div class="col-md-8" >
			<div class="form-group">
				<label>Tên <span class="text-danger">(*)</span></label>
				<input type='text' placeholder='' class='form-control' name='data[Address][name]' value='<?php echo $data['Address']['name']; ?>'>
			</div>

            <div class="form-group">
				<label>Địa chỉ <span class="text-danger">(*)</span></label>
				<input type='text' placeholder='' class='form-control' name='data[Address][address]' value='<?php echo $data['Address']['address']; ?>'>
			</div>

            <div class="form-group">
				<label>Tỉnh thành phố <span class="text-danger">(*)</span></label>
                <select name="data[Address][province_id]" class='form-control'>
                <?php foreach($provinces as $key => $province){ ?>
                    <option value="<?php echo $key;?>" <?php echo ($key == $data['Address']['province_id'] ? 'selected="selected"':'') ?>><?php echo $province; ?></option>
                <?php }?>
                </select>
			</div>

            <div class="row form-group">
                <div class="col-md-6">
                    <label>Kinh độ (Lat) <span class="text-danger">(*)</span></label>
                    <input type='text' placeholder='' class='form-control' name='data[Address][lat]' value='<?php echo $data['Address']['lat']; ?>'>
                </div>
                <div class="col-md-6">
                    <label>Vĩ độ (Lon) <span class="text-danger">(*)</span></label>
                    <input type='text' placeholder='' class='form-control' name='data[Address][lon]' value='<?php echo $data['Address']['lon']; ?>'>
                </div>
            </div>

            <div class="form-group">
				<label>Số điện thoại đặt vé</label>
				<input type='text' placeholder='' class='form-control' name='data[Address][phone1]' value='<?php echo $data['Address']['phone1']; ?>'>
			</div>

            <div class="form-group">
				<label>Số điện thoại giao hàng</label>
				<input type='text' placeholder='' class='form-control' name='data[Address][phone2]' value='<?php echo $data['Address']['phone2']; ?>'>
			</div>
		</div>

		<div  class="col-md-4"  >
		</div>
	</div>
<br/>

<div class="row">
	<div class="col-md-12 pull-right">
		<button type='submit' class='btn btn-success' >Cập nhật</button>
		<a class='btn btn-primary' href="/admin/address/index"> Quay lại </a>
	</div>
</div>
</div>

</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		CKEDITOR.replace('description',{
			height: '200px',
		});
	});


</script>
