
<?php echo $this->Html->loadFancyBox();?>
<?php echo $this->Html->createEditor();?>
<div class='clearfix'></div>
<br/>
<form action="/admin/blogs/<?= empty($data['Blog']['id'])?'add':'edit/'.  $data['Blog']['id'] ;?>" method='POST' enctype="multipart/form-data" accept-charset="utf-8">
<div class="row" >
	<div class="col-md-12 pull-right"  >
		<button type='submit' class='btn btn-success' name='btnSubmit'>Cập nhật</button>
		<button type='button' class='btn btn-danger' name='btnAddService'>Cho thuê xe</button>
		<a href="/admin/blogs/index" class="btn btn-primary" >Quay lại</a>
	</div>
</div>
<br class="clearfix" />

<div class="row">
	<div rel="edit" class="col-md-8" style="border-right: 1px dotted #CCCCCC">
		<input type='hidden' name='data[Blog][id]' value='<?php echo $data['Blog']['id']; ?>'>

		<div class="form-group">
			<label>Phân loại</label>
			<?php echo $this->Html->selectCategory($categories, $data['Blog']['category_id'], array('name'=>'data[Blog][category_id]'));?>
			<?php echo $this->Html->displayValidationError($this->validationErrors['Blog'],'category_id');?>
		</div>

		<div class="form-group">
			<label>Tiêu đề</label>
			<input type='text' placeholder='' rel="title" class='form-control' name='data[Blog][title]' value='<?php echo $data['Blog']['title']; ?>'>
			<?php echo $this->Html->displayValidationError($this->validationErrors['Blog'],'title');?>
		</div>
		
		<div class="form-check mt-1 mb-1">
    	<input type="checkbox" name='data[Blog][event_flg]' class="form-check-input" id="event_flag" value="1" <?php echo ($data['Blog']['event_flg'] == 1 ? 'checked="checked"':"" ); ?>>
    	<label class="form-check-label" for="event_flag">Gim bài viết </label>
  		</div>
  		<hr/>

		<div class="form-group">
			<label>Nội dung bài viết</label>
			<textarea id="description" name="data[Blog][description]"><?php echo $data['Blog']['description']; ?></textarea>
			<?php echo $this->Html->displayValidationError($this->validationErrors['Blog'],'description');?>
		</div>

		<div class="form-group">
			<label>Meta Description</label>
			<textarea  name="data[Blog][meta_description]" class='form-control'><?php echo $data['Blog']['meta_description']; ?></textarea>
		</div>

		<div class="form-group">
			<label>Meta keyword</label>
			<textarea  name="data[Blog][meta_keyword]" class='form-control'><?php echo $data['Blog']['meta_keyword']; ?></textarea>
		</div>
	</div>

	<div rel="upload_image" class="col-md-4" style="background:#ffffcc" >
		<table class='table '>
		<tr>
			<td>
				<h4>Upload hình </h4> <br\>
				<input type="file" name="data[BlogImage][files][]" value=""  multiple />
			</td>
		</tr>

		<?php if(!empty($data['BlogImage'])){ ?>
			<?php foreach ($data['BlogImage']  as $blogImage) { ?>
			<tr>
				<td>
					<img class="col-md-3" src="<?= $blogImage['url'] ?>"/>
					<input type="radio" data-blog-image-id="<?php echo $blogImage['id']; ?>" value="<?= $blogImage['url'] ?>"
						<?= ($blogImage['thumbnail']==1) ?'checked="checked"':'';?> rel="select-thumbnail" name="txtSelectImage">
					Hình đại diện
					<a class="pull-right" onclick="return confirm('Hình ảnh này sẽ bị xóa..?')" href="/admin/blogs/delete_image/<?php echo $blogImage['id']; ?>">
						Xóa
					</a>
				</td>
			</tr>
			<?php } ?>
		<?php } ?>
		</table>

	</div>
</div>
</form>
<script type="text/javascript">
    $(document).ready(function() {
    	CKEDITOR.replace('description',{
			height: '200px',
		});

    	if($('div[rel=edit]').height() > $('div[rel=upload_image]').height()){
    		$('div[rel=upload_image]').height($('div[rel=edit]').height());
    	}else{
    		$('div[rel=edit]').height($('div[rel=upload_image]').height());
    	}

    	$('button[name=btnAddTemplate]').click(function(){
    		$('select').val(19);
    		$('input[rel=title]').val('Thông tin tuyển dụng');

    		$.get('/files/template_category_19.html',{},function(resp){
    			CKEDITOR.instances['description'].insertHtml(resp);
    		});
    	});

		$('button[name=btnAddService]').click(function(){
    		$('select').val(61);
    		$('input[rel=title]').val('Cho thuê xe');

    		$.get('/files/template_category_60.html',{},function(resp){
    			CKEDITOR.instances['description'].insertHtml(resp);
    		});
    	});

    	$('button[name=btnAddProjectTemplate]').click(function(){
    		$('select').val(22);
    		$('input[rel=title]').val('Dự án');

    		$.get('/files/template_category_22.html',{},function(resp){
    			CKEDITOR.instances['description'].insertHtml(resp);
    		});
    	});

    	$('input[rel=select-thumbnail]').change(function(){
    		var blogId = "<?php echo $data['Blog']['id']; ?>";
    		var blogImageId = $(this).attr('data-blog-image-id');
    		$.post('/blogs/update_image_thumbnail',{'blogId': blogId,'blogImageId': blogImageId});

    	});


    });
</script>
