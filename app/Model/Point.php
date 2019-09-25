<?php

/**
* @author : Long Tran Thanh
* @date_create: 2015-03-18 06:10:39
*/

class Point extends AppModel
{
	public $name = 'Point';
	public $primaryKey = 'id';
    public $useTable = 'points';

	public $validate = array(
		'title'=> array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Không tìm thấy dữ liệu '
			)
		),
	);
}
