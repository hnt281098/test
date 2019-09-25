<?php echo $this->Html->createEditor();?>
<div class='clearfix'></div>
<hr/>
<div class="row">
	<div class='col-md-12'>
	<form action="/admin/point/<?=  empty($data['Point']['id']) ? 'add':'edit/'.$data['Point']['id'];?>" method='POST' enctype="multipart/form-data" accept-charset="utf-8">
	<input type='hidden' name='data[Point][id]' value='<?php echo $data['Point']['id']; ?>'>

	<div class="row">
		<div class="col-md-8" >
			<div class="form-group">
				<label>Tiêu đề - Title <span class="text-danger">(*)</span></label>
				<input type='text' placeholder='' class='form-control' name='data[Point][title]' value='<?php echo $data['Point']['title']; ?>'>
			</div>

            <div class="row form-group">
                <div class="col-md-6">
                    <label>Kinh độ (Lat) <span class="text-danger">(*)</span></label>
                    <input type='text' placeholder='' class='form-control' name='data[Point][lat]' value='<?php echo $data['Point']['lat']; ?>'>
                </div>
                <div class="col-md-6">
                    <label>Vĩ độ (Lon) <span class="text-danger">(*)</span></label>
                    <input type='text' placeholder='' class='form-control' name='data[Point][lon]' value='<?php echo $data['Point']['lon']; ?>'>
                </div>
            </div>

			<div class="form-group">
				<label>Địa chỉ </label>
				<input type='text' placeholder='' class='form-control' name='data[Point][address]' value='<?php echo $data['Point']['address']; ?>'>
			</div>

            <div class="form-group">
				<label>Số điện thoại</label>
				<input type='text' placeholder='' class='form-control' name='data[Point][phone]' value='<?php echo $data['Point']['phone']; ?>'>
			</div>

			<div class="form-group">
				<label>Content </label>
				<textarea class='form-control' id="description" name="data[Point][description]"><?php echo $data['Point']['description']; ?></textarea>
			</div>

			<div class="form-group">
				<label>Meta Description</label>
				<textarea class='form-control' name="data[Point][meta_description]"><?php echo $data['Point']['meta_description']; ?></textarea>
			</div>

			<div class="form-group">
				<label>Meta Keyword</label>
				<textarea class='form-control' name="data[Point][meta_keyword]"><?php echo $data['Point']['meta_keyword']; ?></textarea>
			</div>
		</div>


		<div  class="col-md-4" style="background:#ffffcc" >

			<table class='table'>
			<tr>
				<td>
					<h4>Upload hình đại diện </h4> <br\>
					<input type="file" name="data[Point][image]" value="" />
				</td>
			</tr>

			<?php if(!empty($data['Point']['image'])){ ?>
			<tr>
				<td>
					<img class="img-thumbnail" src="<?php echo $data['Point']['image']; ?>"/>
					<?php echo $data['Point']['image']; ?>
				</td>
			</tr>
			<?php } ?>
			</table>

		</div>
	</div>
<br/>
<div class="row">
	<div class="col-md-12 pull-right">
		<button type='submit' class='btn btn-success' name='btnSubmit' >Cập nhật</button>
		<a class='btn btn-primary' href="/admin/point/index"> Quay lại </a>
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
