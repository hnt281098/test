<?php
App::uses('AppModel', 'Model');
/**
 * Contact Model
 *
 */
class Contact extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'contact';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),

		'email' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'last'=>true,
			),
			'email'=>array(
				'rule'=>array('email'),
				'message'=>'Email khong dung dinh dang'
			)
		),
	);
}
