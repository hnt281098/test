<?php

/**
* @file : ServicesController
* @author : Long Tran Thanh
* @date_create: 2015-03-19 06:40:52
*/

class WritingController extends AppController{
	public $name = 'Writing';
	public $layout = 'main';
	public $uses = array('Writing','Writer');
	public $paginate = array('limit'=> PAGINATE_NUMBER,'order'=>'id DESC');
	public $components = array('Paginator','Session','Auth','Upload');

	/**
	* [beforeFillter description]
	* @return [type] [description]
	*/
	function beforeFilter(){
		parent::beforeFilter();
		$this->set('title_for_content',SITE_NAME);
		$this->Auth->allow('post','signup','goout','signin');

		$this->Auth->flashElement = null;
		$this->Auth->loginError = "Sai tên đăng nhập hoặc mật khẩu";
		$this->Auth->authError  = "Phiên đăng nhập đã kết thúc, phải đăng nhập lại";
		$this->Auth->userModel = 'User';
		$this->Auth->fields = array('username' => 'email', 'password' => 'password');
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
		$this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'admin_index');
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->layout = 'admin';

		$this->Paginator->settings = $this->paginate;
		$conditions = array();

		$writingData = $this->Paginator->paginate('Writing',$conditions);
		// Create beardcrumb
		$breadCurmb = array(
			'title'=>array('title'=>'Quản lý thành viên'),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('title'=>'Quản lý tin tức','active'=>1)
			)
		);
		$this->set('breadCurmb',$breadCurmb);
		$this->set('writingData',$writingData);
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->Writing->id = $id;

		if (!$this->Writing->delete()) {
			$this->Session->setFlash('Dữ liệu bài viết không thể hủy bỏ','flash/error');
			$this->redirect($this->referer());
		}

		$this->Session->setFlash('Bài viết đã được xóa','flash/success');
		return $this->redirect(array('action' => 'index'));
	}

	/**
	 * [admin_writer description]
	 * @return [type] [description]
	 */
	public function admin_writer(){
		$this->layout = 'admin';

		$this->Paginator->settings = $this->paginate;
		$conditions = array();

		$writingData = $this->Paginator->paginate('Writer',$conditions);
		// Create beardcrumb
		$breadCurmb = array(
			'title'=>array('title'=>'Quản lý thành viên'),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('title'=>'Quản lý thành viên ','active'=>1)
			)
		);
		$this->set('breadCurmb',$breadCurmb);
		$this->set('writingData',$writingData);
	}

	/**
	 * [admin_writer description]
	 * @return [type] [description]
	 */
	public function admin_writer_delete($id){
		$this->Writer->id = $id;

		if (!$this->Writer->delete()) {
			$this->Session->setFlash('Thành viên này không xóa bỏ được','flash/error');
			$this->redirect($this->referer());
		}

		$this->Session->setFlash('Đã xóa bỏ thành viên','flash/success');
		return $this->redirect(array('action' => 'admin_writer'));
	}

	/**
	 * [post description]
	 * @return [type] [description]
	 */
	function post(){
		$this->layout = 'popup';
		$this->set('metaRefesh', true);
		$this->set('url', SERVER);

		// Insert data
		$writing['Writing']['full_name'] = @$this->request->data['full_name'];
		$writing['Writing']['email'] =@$this->request->data['emailWriting'];
		$writing['Writing']['phone'] =@$this->request->data['phone'];
		if(!empty($this->params['params']['form']['fileWriting'])){
			$resp = array('class'=>'danger', 'msg'=>'Thiếu thông tin không gởi được bài viết');
			$this->set('resp', $resp);
			return;
		}


		$this->Writing->set($writing);
		if(!$this->Writing->save()){
			debug($this->Writing->validationErrors);

			$resp = array('class'=>'danger', 'msg'=>'Thiếu thông tin không gởi được bài viết, hệ thống sẽ tự động chuyển trang sau 5 giây');
			$this->set('resp', $resp);
			return;
		}

		$writingId = $this->Writing->id;
		// Upload file
		$directory = WWW_ROOT.'files'.DS.'writing';
		if(!is_dir($directory)){
			mkdir($directory);
		}

		$fileUpload = $this->params['form']['fileWriting'];
		$fileWritingUpload = $this->Upload->uploadFileWriting($fileUpload, $directory);
		if($fileWritingUpload===false){
			// Delete writing
			$this->Writing->delete($writingId);
			$resp = array('class'=>'danger', 'msg'=>'File gởi được không được phép chấp nhận, hệ thống sẽ tự động chuyển trang sau 5 giây');
			$this->set('resp', $resp);
			return;
		}

		$this->Writing->set(array('file'=>$fileWritingUpload));
		if(!$this->Writing->save()){
		 	$resp = array('class'=>'danger', 'msg'=>'Không được bài viết vào lúc hiện tại, hệ thống sẽ tự động chuyển trang sau 5 giây');
		 	$this->set('resp', $resp);
			return;
		}

		$resp = array('class'=>'success', 'msg'=>'Chúng tôi đã nhận được bài viết bạn gởi. Cám ơn , hệ thống sẽ tự động chuyển trang sau 5 giây');
		$this->set('resp', $resp);
	}


	/**
	 * [signin description]
	 * @return [type] [description]
	 */
	function signin(){
		$this->autoRender = false;
		$params['Writer'] = $this->request->data;

		if(empty($params['Writer']['email']) || empty($params['Writer']['password'])){
			return json_encode(array('status'=>0, 'msg'=>'Tên đăng nhập và mật khẩu không chính xác'));
		}

		$writer = $this->Writer->findByEmail($params['Writer']['email'] );
		if(empty($writer) || $writer['Writer']['password'] != sha1($params['Writer']['password'])) {
			return json_encode(array('status'=>0, 'msg'=>'Tên đăng nhập và mật khẩu không chính xác'));
		}

		$this->Session->write(SESSION_USER_DATA, $writer['Writer']);
		return json_encode(array('status'=>1, 'msg'=>'Đăng nhập thành công'));
	}


	/**
	 * Đăng ký thành viên
	 * @return [type] [description]
	 */
	function signup(){
		$this->autoRender = false;
		$params['Writer'] = $this->request->data;

		// Change field
		if(!isset($params['Writer']['captcha_code']) || $this->Session->read(CAPTCHA_CODE) != $params['Writer']['captcha_code'] ){
			return json_encode(array('status'=>0, 'msg'=>'Mã xác nhận không chính xác'));
		}

		if(empty($params['Writer']['password']) ||
				empty($params['Writer']['password_confirm']) ||
				$params['Writer']['password_confirm']!= $params['Writer']['password']){
			return json_encode(array('status'=>0, 'msg'=>'Mật khẩu không chính xác'));
		}

		if(strlen($params['Writer']['password_confirm']) < 6){
			return json_encode(array('status'=>0, 'msg'=>'Mật khẩu phải có ít nhất 6 ký tự'));
		}

		$this->Writer->set($params);
		if(!$this->Writer->save()){
			$validationMsg = $this->_displayValidation($this->Writer->validationErrors);
			return json_encode(array('status'=>0, 'msg'=> $validationMsg));
		}
		// Create PopUp
		$this->Session->write(SESSION_USER_DATA, $params['Writer']);
		return json_encode(array('status'=>1, 'msg'=>'Đăng ký thành công!'));
	}

	/**
	 * [logout description]
	 * @return [type] [description]
	 */
	function goout(){
		$this->Session->delete(SESSION_USER_DATA);
		$this->redirect(SERVER);
	}

	/**
	 * [_displayValidation description]
	 * @param  [type] $validationErrors [description]
	 * @return [type]                   [description]
	 */
	private function _displayValidation($validationErrors = null){
		if($validationErrors == null){
			return null;
		}

		$validationMsg = '<ul>';
		foreach ($validationErrors as $key => $field) {
			if(is_array($field)){
				$validationMsg .= '<li>'. implode($field) .'</li>';
			}
		}

		return $validationMsg.'</ul>';
	}


}