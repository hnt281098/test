<?php

/**
* @author : Long Tran Thanh
* @date_create: 2015-03-19 06:41:06
*/


class Writer extends AppModel{
	public $name = 'Writer';
	public $primaryKey = 'id';
	public $ustTable = 'writer';

	public $validate = array(
		'email'=> array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Không tìm thấy dữ liệu ',
				'last'=>true
			),
		 	'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Email đã tồn tại trong hệ thống',
                'last'=>true
            ),
			'email'=>array(
				'rule'=>'email',
				'last'=>true,
				'message' => 'Email không đúng định dạng.'
			),
		),
		'name'=> array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Tên của thành viên '
			)
		),
		'phone'=> array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Không tìm thấy điện thoại liên lạc'
			)
		),

	);

	/**
	 * [beforeSave description]
	 * @param  array  $options [description]
	 * @return [type]          [description]
	 */
	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $this->data[$this->alias]['password'] = sha1($this->data[$this->alias]['password']);
	    }
	    return true;
	}
}