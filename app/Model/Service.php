<?php

/**
* @author : Long Tran Thanh
* @date_create: 2015-03-19 06:41:06
*/

class Service extends AppModel{
	public $name = 'Service';
	public $primaryKey = 'id';

	public $validate = array(
		'id'=> array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Không tìm thấy dữ liệu '
			)
		),
		'title'=> array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Không tìm thấy dữ liệu '
			)
		),
		'description'=> array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Không tìm thấy dữ liệu '
			)
		),
	);
}