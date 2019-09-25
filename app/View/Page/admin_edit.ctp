<?php echo $this->Html->createEditor();?>
<div class='clearfix'></div>
<hr/>
<div class="row">
	<div class='col-md-12'>
	<form action="/admin/page/<?=  empty($data['Page']['id']) ? 'add':'edit/'.$data['Page']['id'];?>" method='POST' enctype="multipart/form-data" accept-charset="utf-8">
	<input type='hidden' name='data[Page][id]' value='<?php echo $data['Page']['id']; ?>'>
	<?php if(!empty($data['Page']['id'])){?>
	<input type='hidden' name='data[Page][key]' value='<?php echo $data['Page']['key']; ?>'>
	<?php } ?>
	<div class="row">
		<div class="col-md-8" >
			<div class="form-group">
				<label>Tiêu đề - Title <span class="text-danger">(*)</span></label>
				<input type='text' placeholder='' class='form-control' name='data[Page][title]' value='<?php echo $data['Page']['title']; ?>'>
			</div>

			<div class="form-group">
				<label>Nhóm trang </label>
				<select name="data[Page][group]" class="form-control">
					<option value="<?php echo (null ==  $data['Page']['id'] ? 'selected="selected"' : "");?>"> -- Chọn nhóm tin -- </option>

					<?php foreach($pageGroupIds as $group){ ?>
						<option value="<?php echo $group['Category']['id'];?>" <?php echo ($group['Category']['id'] ==  $data['Page']['group'] ? 'selected="selected"' : "");?>>
							<?php echo $group['Category']['name'] ?>
						</option>
					<?php } ?>
				</select>
			</div>
			<?php if(empty($data['Page']['id'])){?>
			<div class="form-group">
				<label>Key <span class="text-danger">(*)</span></label>
				<input type='text' placeholder='' class='form-control' name='data[Page][key]' value='<?php echo $data['Page']['key']; ?>'>
			</div>
			<?php } ?> 
			<div class="form-group">
				<label>Image URL Thumbnail </label>
				<input type='text' placeholder='' class='form-control' name='data[Page][image]' value='<?php echo $data['Page']['image']; ?>'>
			</div>

			<div class="form-group">
				<label>Link URL/ Embed Youtube </label>
				<input type='text' placeholder='' class='form-control' name='data[Page][link]' value='<?php echo $data['Page']['link']; ?>'>
				<small>Sử dụng khi muốn tạo link từ bài viết đên trang khác, hoặc sử dụng embed trong youtube, google. </small>
			</div>

			<div class="checkbox">
				<?php if(empty($data['Page']['id'])){?>
				<label><input type="checkbox" checked="checked" name='data[Page][hide]' value="1">Hiển thị  bài viết </label>
				<?php }else{ ?>
				<label><input type="checkbox" <?php echo ($data['Page']['hide']==0?'':'checked'); ?> name='data[Page][hide]' value="1">Hiển thị  bài viết </label>
				<?php }?>

			</div>

			<div class="form-group">
				<label>Content </label>
				<textarea class='form-control' id="description" name="data[Page][description]"><?php echo $data['Page']['description']; ?></textarea>
			</div>

			<div class="form-group">
				<label>Meta Description</label>
				<textarea class='form-control' name="data[Page][meta_description]"><?php echo $data['Page']['meta_description']; ?></textarea>
			</div>

			<div class="form-group">
				<label>Meta Keyword</label>
				<textarea class='form-control' name="data[Page][meta_keyword]"><?php echo $data['Page']['meta_keyword']; ?></textarea>
			</div>
		</div>


		<div  class="col-md-4" style="background:#ffffcc" >

			<table class='table'>
			<tr>
				<td>
					<h4>Upload hình đại diện </h4> <br\>
					<input type="file" name="data[Page][images]" value="" />
				</td>
			</tr>

			<?php if(!empty($data['Page']['images'])){ ?>
			<tr>
				<td>
					<img class="img-thumbnail" src="<?php echo $data['Page']['images']; ?>"/>
					<?php echo $data['Page']['images']; ?>
				</td>
			</tr>
			<?php } ?>
			</table>

			<table class='table'>
			<tr>
				<td>
					<h4>Upload hình cho slider </h4> <br\>
					<input type="file" name="data[PageImage][images]" value="" />
				</td>
			</tr>

			<?php if(!empty($data['PageImage'])){ ?>
				<?php foreach ($data['PageImage']  as $page_image) { ?>
				<tr>
					<td>
						<img class="img-thumbnail" src="<?php echo $page_image['url']; ?>"/>
						<a class="float-right" onclick="return confirm('Hình ảnh này sẽ bị xóa..?')" href="/admin/page/delete_image/<?php echo $page_image['id']; ?>">Xóa</a>
					</td>
				</tr>
				<?php } ?>
			<?php } ?>
			</table>
		</div>
	</div>
<br/>
<div class="row">
	<div class="col-md-12 pull-right">
		<button type='submit' class='btn btn-success' name='btnSubmit' >Cập nhật</button>
		<a class='btn btn-primary' href="/admin/Page/index"> Quay lại </a>
	</div>
</div>
</div>

</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		CKEDITOR.replace('description',{
			height: '200px',
			contentsCss: ['https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'],
            allowedContent: true,
		});
	});


</script>
