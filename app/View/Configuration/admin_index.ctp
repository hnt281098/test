<br/>
<form method="POST" action="/admin/configuration/update">
<div class="row">
	<div class="col-md-6" >
		<div class="form-group">
			<label>Tiêu đề website</label>
			<input type="text" value="<?= @$jsonConfigData['title'] ?>" name="title" class="form-control">
		</div>

		<div class="form-group">
			<label>Slogan</label>
			<input type="text" value="<?= @$jsonConfigData['slogan'] ?>" name="slogan" class="form-control">
		</div>

		<div class="form-group">
			<label>Tên công ty </label>
			<input type="text" value="<?= @$jsonConfigData['company'] ?>" name="company" class="form-control">
		</div>

		<div class="form-group">
			<label>Số đăng ký kinh doanh </label>
			<input type="text" value="<?= @$jsonConfigData['business_license'] ?>" name="business_license" class="form-control">
		</div>

		<div class="form-group">
			<label>Người đại diện </label>
			<input type="text" value="<?= @$jsonConfigData['owner'] ?>" name="owner" class="form-control">
		</div>

		<div class="form-group">
			<label>Địa chỉ </label>
			<input type="text" value="<?= @$jsonConfigData['company_address'] ?>" name="company_address" class="form-control">
		</div>

		<div class="form-group">
			<label>Hotline </label>
			<input type="text" value="<?= @$jsonConfigData['hotline'] ?>" name="hotline" class="form-control">
		</div>


		<div class="form-group">
			<label>Email</label>
			<input type="text" value="<?= @$jsonConfigData['email'] ?>" name="email" class="form-control">
		</div>

		<div class="form-group">
			<label>Tổng đài đặt vé  </label>
			<input type="text" value="<?= @$jsonConfigData['ticket_phone'] ?>" name="ticket_phone" class="form-control">
		</div>

		<div class="form-group">
			<label>Hotline 2 </label>
			<input type="text" value="<?= @$jsonConfigData['hotline_1'] ?>" name="hotline_1" class="form-control">
		</div>

		<div class="form-group">
			<label>Hotline 3</label>
			<input type="text" value="<?= @$jsonConfigData['hotline_2'] ?>" name="hotline_2" class="form-control">
		</div>

		<div class="form-group">
			<label>Mã số thuế</label>
			<input type="text" value="<?= @$jsonConfigData['tax'] ?>" name="tax" class="form-control">
		</div>
		<button type="submit" class="btn btn-primary ">Lưu dữ liệu</button>
	</div>

	<div class="col-md-6" rel="edit">

		<div class="form-group">
			<label>Banner quảng cáo bên trái </label>
			<input name="left_adv" class="form-control" value="<?= @$jsonConfigData['left_adv'] ?>" />
		</div>

		<div class="form-group">
			<label>Link quảng cáo bên trái </label>
			<input name="link_left_adv" class="form-control" value="<?= @$jsonConfigData['link_left_adv'] ?>" />
		</div>

		<div class="form-group">
			<label>Banner quảng cáo bên phải </label>
			<input name="right_adv" class="form-control" value="<?= @$jsonConfigData['right_adv'] ?>" />
		</div>

		<div class="form-group">
			<label>Link quảng cáo bên phải </label>
			<input name="link_right_adv" class="form-control" value="<?= @$jsonConfigData['link_right_adv'] ?>" />
		</div>


		<div class="form-group">
			<label>Meta Tag Description</label>
			<textarea name="meta_description" class="form-control" rows="5"><?= @$jsonConfigData['meta_description'] ?></textarea>
		</div>

		<div class="form-group">
			<label>Meta Tag Keywords</label>
			<textarea name="meta_tag_keyword"class="form-control" rows="5" ><?= @$jsonConfigData['meta_tag_keyword'] ?> </textarea>
		</div>

		<div class="form-group">
			<label>Meta author</label>
			<textarea name="meta_author" class="form-control"  rows="8"><?= @$jsonConfigData['meta_author'] ?></textarea>
		</div>

		<div class="form-group">
			<label>Bản quyền footer </label>
			<input type="text" value="<?= @$jsonConfigData['footer_content'] ?>" name="footer_content" class="form-control">
		</div>

		<div class="form-group">
			<label>Backlink </label>
			<input type="text" value="<?= @$jsonConfigData['backlink'] ?>" name="backlink" class="form-control">
		</div>


	</div>

</div>
</form>



