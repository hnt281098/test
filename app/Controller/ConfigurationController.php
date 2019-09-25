<?php
class ConfigurationController extends AppController {

	public $name ='Configuration';
	public $components = array('Paginator','Session','Auth');
	public $layout = 'admin';
	public $file = '';


	/**
	 * [beforeFilter description]
	 * @return [type] [description]
	 */
	public function beforeFilter() {
        parent::beforeFilter();

        $this->Auth->flashElement = null;
        $this->Auth->loginError = "Sai tên đăng nhập hoặc mật khẩu";
        $this->Auth->authError  = "Phiên đăng nhập đã kết thúc, phải đăng nhập lại";
        $this->Auth->userModel = 'User';
        $this->Auth->fields = array('username' => 'email', 'password' => 'password');
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'admin_index');
    }

    /**
     * [admin_index description]
     * @return [type] [description]
     */
    public function admin_index(){
    	$breadCurmb = array(
			'title'=>array('title'=>'Quản lý thông tin website'),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('title'=>'Quản lý thông tin website','active'=>1)
			)
		);

        $this->set('jsonConfigData',$this->getJsonDataFile());
		$this->set('breadCurmb',$breadCurmb);
    }

    /**
     * [admin_update description]
     * @return [type] [description]
     */
    public function admin_update(){
        $this->autoRender = false;
    	if(empty($this->request->data)){
    		$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
    		return $this->redirect(array('action' => 'index'));
    	}

        $this->setJsonDataFile(json_encode($this->request->data)) ;
        $this->Session->setFlash('Thông tin đã được lưu trên hệ thống','flash/success');
        $this->redirect($this->referer());
    }

}
