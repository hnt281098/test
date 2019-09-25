<br/>

<div class="row">
	<div class="col-md-3" style="border-right: 1px dotted #CCCCCC ">
		<?php echo $this->Element('category_list');?>
	</div>
	<div class="col-md-8">
		<form class="form-horizontal" action="/admin/categories/<?= empty($categoryData['Category']['id'])?'add':'edit/'.$categoryData['Category']['id'] ;?>" method='POST' enctype="multipart/form-data" accept-charset="utf-8">
			<input type='hidden' name='data[Category][id]' value='<?php echo $categoryData['Category']['id']; ?>'>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Phân loại</label>
				<div class="col-sm-10">
					<?php echo $this->Html->selectCategory($categories, $categoryData['Category']['parent_id'], array('name'=>'data[Category][parent_id]'));?>
					<?php echo $this->Html->displayValidationError($this->validationErrors['Category'],'category_id');?>
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="data[Category][name]" value="<?= $categoryData['Category']['name'];?>" />
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">URL</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="data[Category][url]" value="<?= $categoryData['Category']['url'];?>" />
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Icon </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="data[Category][icon]" value="<?= $categoryData['Category']['icon'];?>" />
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">key </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="data[Category][key]" value="<?= $categoryData['Category']['key'];?>" />
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">STT </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="data[Category][ord]" value="<?= $categoryData['Category']['ord'];?>" />
				</div>
			</div>

			<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
			    </div>
			  </div>
		</form>
	</div>
</div>
