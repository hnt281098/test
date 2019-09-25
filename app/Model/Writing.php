<?php

/**
* @author : Long Tran Thanh
* @date_create: 2015-03-19 06:41:06
*/

class Writing extends AppModel{
	public $name = 'Writing';
	public $primaryKey = 'id';
	public $ustTable = 'writing';

	public $validate = array(
		'email'=> array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Không tìm thấy dữ liệu '
			),
			'email'=>array(
				'rule'=>'email'
				),
		),
		'full_name'=> array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Không tìm thấy dữ liệu '
			)
		),
		'phone'=> array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Không tìm thấy dữ liệu '
			)
		),
	);
}