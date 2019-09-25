<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Content-Style-Type" content="text/css" />
	<meta name="Content-Script-Type" content="text/javascript" />
	<?php echo $this->Html->charset(); ?>
	<title>Website XE THÀNH CÔNG  </title>
	<link href="/favicon.ico" type="image/x-icon" rel="shortcut icon" />
	<!-- Load css files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/admin.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="/js/parsley.min.js"></script>
</head>
<body>
<?php $userLoginData = $this->Session->read(SESSION_ADMIN_DATA);?>
<?php if(!empty($userLoginData)){?>
	<div class="nav-scroller shadow-sm" >
	<nav class="nav nav-underline" style="background-color: #e3f2fd;">
		<a class="nav-link active" href="#">Trang chủ</a>
		<a class="nav-link" href="/admin/users/index">Tài khoản</a>
		<a class="nav-link" href="/admin/blogs/index">Bài viết</a>
		<a class="nav-link" href="/admin/page/index">Trang tĩnh</a>
		<a class="nav-link" href="/admin/images/index">Thư viện </a>
		<a class="nav-link" href="/admin/contact/index">Xem liên hệ</a>
		<a class="nav-link" href="/admin/configuration/index">Thông tin</a>
		<a class="nav-link" href="/admin/categories/index">Danh mục </a>
		<a class="nav-link" href="/admin/address/index">Địa điểm</a>
		<a class="nav-link" href="/admin/point/index">Trạm - Chi nhánh </a>
		<a class="nav-link" href="/admin/roads/index">Chuyến xe</a>
		<a class="nav-link" href="/admin/ticket/index">Đặt vé </a>
		<a class="nav-link" href="/users/logout">Thoát</a>
	</nav>
	</div>
<?php }?>
<div class="container-fluid" >
<?php if(!empty($userLoginData)){?>
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->Element('breadcrumb');?>
<?php }?>
	<?php echo $content_for_layout;?>
</div>

<br class="clearfix" />
<?php echo $this->element('sql_dump'); ?>

</body>
</html>
