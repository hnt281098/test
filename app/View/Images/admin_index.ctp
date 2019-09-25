<br/>
<ul class="nav nav-tabs">
    <li class="nav-item ">
		<a href="#home"  class="nav-link active" data-toggle="tab">Cập nhật hình ảnh</a></li>
    <li class="nav-item">
		<a href="#profile"  class="nav-link" data-toggle="tab">Hình ảnh đã upload</a></li>
    <li class="nav-item">
		<a href="#library"  class="nav-link" data-toggle="tab">Thư viện ảnh</a></li>
    <li class="nav-item">
		<a href="#customer"  class="nav-link" data-toggle="tab">Hình ảnh cho khách hàng, đối tác </a></li>
    <li class="nav-item">
		<a href="#slider"  class="nav-link" data-toggle="tab">Hình ảnh cho slider </a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
  	<div  class="tab-pane container-fluid active" id="home">
    	<br/>
		<div class="col-md-4">
			<form method="POST" class="form" action="/admin/images/upload" enctype="multipart/form-data" accept-charset="utf-8">
			<div class="form-group">
				<input id="upload_file" type="file" name="data[ImageFile][]" value="" multiple />
			</div>
			<div class="form-group">
				<label for="exampleInputName2"> Thư mục upload : &nbsp;</label>
				<select name="data[folder]" id="folder" class="form-control">
			  		<option value="uploads">Upload </option>
			  		<option value="slider">Slider</option>
			  		<option value="library">Thư viện ảnh</option>
			  		<option value="customer">Khách hàng, đối tác</option>
			  	</select>
			</div>
			<div class="form-group preview" >
				<label> Image preview </label>
				<br/>
				<img id="image_preview" src="#" />
			</div>
			<button class="btn btn-info" type="submit" name="btnUpload"> Upload hình </button>
	  		</form>
		</div>
    </div>
  	<div  class="tab-pane container-fluid fade" id="slider">
    	<br/>
		<table class="table table-bordered">
    	<?php $totalImages = count($imageSlider);?>
    	<?php $col = 0;?>
		<?php foreach ($imageSlider as $file => $image) {
			if($col == 0){
				echo '<tr>';
			}
			echo '<td>'. $image .' <br/>

					<a href="/admin/images/delete/?file='.$file.'"  onclick="return confirm(\'Hình ảnh này sẽ bị xóa bỏ..?\')"> Xóa </a>
					'. $this->App->getTextSlider($textSlider, str_replace("slider/", "", $file)).'
				</td>';
			if($col==3){
				$col = 0;
				echo '</tr>';
			}else{
				$col++;
			}
		}?>
		</table>
    </div>

    <div  class="tab-pane container-fluid fade" id="library">
    	<br/>
    	<table class="table table-bordered">
		<?php if(!empty( $imageLibrary)){
			$totalCols = count($imageLibrary);
			$col = 0;
			foreach ($imageLibrary as $file => $image) {
				if($col == 0){
					echo '<tr>';
				}
				echo '<td>'. $image .' <br/> <a href="/admin/images/delete/?file='.$file.'"  onclick="return confirm(\'Hình ảnh này sẽ bị xóa bỏ..?\')"> Xóa </a> </td>';
				if($col==5){
					$col = 0;
					echo '</tr>';
				}else{
					$col++;
				}
			}
		} ?>
		</table>
    </div>

    <div  class="tab-pane container-fluid fade" id="profile">
    	<br/>
    	<table class="table table-bordered">
		<?php if(!empty( $imageUploaded)){
			$totalCols = count($imageUploaded);
			$col = 0;
			foreach ($imageUploaded as $file => $image) {
				if($col == 0){
					echo '<tr>';
				}
				echo '<td>'. $image .' <br/> <a href="/admin/images/delete/?file='.$file.'"  onclick="return confirm(\'Hình ảnh này sẽ bị xóa bỏ..?\')"> Xóa </a> </td>';
				if($col==5){
					$col = 0;
					echo '</tr>';
				}else{
					$col++;
				}
			}
		} ?>
		</table>
    </div>

    <div  class="tab-pane container-fluid fade" id="customer">
    	<br/>
    	<table class="table table-bordered">
		<?php if(!empty( $imageCustomer)){
			$totalCols = count($imageCustomer);
			$col = 0;
			foreach ($imageCustomer as $file => $image) {
				if($col == 0){
					echo '<tr>';
				}
				$dataCustomer = $this->App->getDataCustomer($textCustomer, str_replace("customer/", "", $file));

				echo '<td>'. $image .' <br/> <a href="/admin/images/delete/?file='.$file.'"  onclick="return confirm(\'Hình ảnh này sẽ bị xóa bỏ..?\')"> Xóa </a> </td>';
				echo '<td>
						<label> Tên công ty </label>
						<input type="text" data-id="'.@$dataCustomer['Customer']['id'].'" class="form-control" value="'.@$dataCustomer['Customer']['title'].'"  rel="customer" field="title" />
						<label> Website </label>
						<input type="text" data-id="'.@$dataCustomer['Customer']['id'].'" class="form-control" value="'.@$dataCustomer['Customer']['website'].'" rel="customer" field="website" />
						<label> Địa chỉ </label>
						<input type="text" data-id="'.@$dataCustomer['Customer']['id'].'" class="form-control" value="'.@$dataCustomer['Customer']['address'].'" rel="customer" field="address" />
					</td>';

				if($col==2){
					$col = 0;
					echo '</tr>';
				}else{
					$col++;
				}
			}
		} ?>
		</table>
    </div>
</div>


<script type="text/javascript">

	$(document).ready(function(){
		$('.preview').hide();
		$('input[rel=slider_text]').change(function(){
			var id=$(this).attr('data-id');
			var field = $(this).attr('data-type');
			var value = $(this).val();
			value = value.toString();
			if(id!= null && field!= null){
				$.get( '/admin/images/text?id='+id+'&field='+field+'&val='+ value );
			}
		});

		$('select[rel=slider-position]').change(function(){
			var id=$(this).attr('data-id');
			var field = $(this).attr('data-type');
			var value = $(this).val();

			if(id!= null && field!= null){
				$.get('/admin/images/text?id='+id+'&field='+field+'&val='+value);

			}
		});


        $("#upload_file").change(function() {
        	var e = $(this).prop("files")[0],
	            t = new FileReader;
	        return e.type.match("image.*") ? (t.onload = function() {
	        	$('.preview').show();
	            $("#image_preview").attr("src", t.result).width(150);

	        	}, t.readAsDataURL(e), void 0) : (alert("Không thể load được hình ảnh"), void 0)
	   		})
		});

		$('input[rel=customer]').focusout(function(){
			var id= $(this).attr('data-id');
			var field = $(this).attr('field');
			var value = $(this).val();

			if(id!= null && field!= null){
				$.get('/admin/images/customer?id='+id+'&field='+field+'&val='+value);

			}

		});


</script>