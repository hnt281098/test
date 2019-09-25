<?php echo $this->Html->createEditor();?>
<div class='clearfix'></div>
<div class='col-md-9'>
<form action="/admin/services/<?=  empty($data['Service']['id']) ? 'add':'edit/'.$data['Service']['id'];?>" method='POST'>
<input type='hidden' name='data[Service][id]' value='<?php echo $data['Service']['id']; ?>'>
<div class="row">
	<div class="col-md-12 pull-right">
		<button type='submit' class='btn btn-success' name='btnSubmit' >Cập nhật</button>
		<a class='btn btn-primary' href="/admin/services/index"> Quay lại </a>
	</div>
</div>
<br/>
	<table class='table table-hover'>
		<tr>
			<td>Tiêu đề</td>
			<td><input type='text' placeholder='' class='form-control' name='data[Service][title]' value='<?php echo $data['Service']['title']; ?>'></td>
		</tr>
		<tr>
			<td>Giới thiệu</td>
			<td>
				<textarea class='form-control'  id="description" name="data[Service][description]"><?php echo $data['Service']['description']; ?></textarea>
			</td>
		</tr>
	</table>
</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		CKEDITOR.replace('description',{
			toolbar: [
				{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
				[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
				{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] },
				{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
				{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
			],
			height: '500px',
		});
	});


</script>