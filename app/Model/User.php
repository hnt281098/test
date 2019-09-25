<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	public $name = 'User';
    public $validate = array(
        'email' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Tên đăng nhập không được để trống'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Email đã tồn tại trong hệ thống'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Mật khẩu đăng nhập không được để trống'
            ),
            'minLength'=>array(
                'rule' => array('minLength', '6'),
                'message' => 'Mật khẩu phải có ít nhất 6 ký tự'
            ),
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'user')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );

	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new BlowfishPasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    return true;
	}
}