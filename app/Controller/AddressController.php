<?php

/**
* @file : ServicesController
* @author : Long Tran Thanh
* @date_create: 2015-03-19 06:40:52
*/

class AddressController extends AppController{
	public $name = 'Address';
	public $layout = 'main';
	public $uses = array('Address');
	public $paginate = array('limit'=> PAGINATE_NUMBER,'order'=>'id DESC');
	public $components = array('Paginator','Session','Auth','Upload');

	/**
	* [beforeFillter description]
	* @return [type] [description]
	*/
	function beforeFilter(){
		parent::beforeFilter();
		$this->set('title_for_content',SITE_NAME);
		$this->Auth->allow();

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

		$addressData = $this->Paginator->paginate('Address',$conditions);
		// Create beardcrumb
		$breadCurmb = array(
			'title'=>array('title'=>'Quản lý địa chỉ'),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('title'=>'Quản lý địa chỉ','active'=>1)
			)
		);
		$this->set('breadCurmb',$breadCurmb);
		$this->set('addressData',$addressData);
	}

    function admin_add($id = null){
        $this->layout = 'admin';
		$addressData = $this->Address->createDefault();
		$this->set('data',$addressData);
		$bInsert = false;
		// Create Breadcurmb
		$breadCurmb = array(
            'title'=>array('title'=>'Quản lý địa chỉ'),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('link'=>'/admin/address/','title'=>'Quản lý địa chỉ'),
				array('link'=>'','title'=>'Thêm mới','active'=>1)
			)
		);
        $this->set('breadCurmb',$breadCurmb);

		if(isset($this->request->data['Address'])){
			$this->set('data', $this->request->data);
			$addressId = $this->updateAddress($this->request->data);
			$this->redirect('/admin/address/edit/'.$addressId );
		}

		if(!empty($this->Address->validationErrors) && isset($this->request->data['Address'])){
			$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
		}

		if($bInsert != false){
			$this->set('data',$addressData);
		}

        $this->set('provinces', provinces());
		$this->render('admin_edit');
    }


    function admin_edit($id = null){
        $this->layout = 'admin';

        if (!$this->Address->exists($id)) {
            $this->Session->setFlash('Không có dữ liệu để cập nhật!.','flash/error');
            $this->redirect(array('action'=>'admin_index'));
        }
        // Create beardcrumb
        $breadCurmb = array(
            'title'=>array('title'=>'Quản lý địa chỉ'),
            'path'=>array(
                array('link'=>SERVER,'title'=>'Trang chủ'),
                array('link'=>SERVER.'admin/address/index','title'=>'Quản lý địa chỉ'),
                array('link'=>'','title'=>'','active'=>1)
            )
        );

		$this->set('breadCurmb',$breadCurmb);
        $data = array();

		if ($this->request->is(array('post', 'put'))) {
			$addressId = $this->updateAddress($this->request->data);
			if(!empty($this->Address->validationErrors) && isset($this->request->data['Address'])){
				$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
			}
			$this->redirect('/admin/address/edit/'. $addressId);
		}else{
			$data = $this->Address->findFirstById($id);
		}

		$this->set('provinces', provinces());
		$this->set('data', $data);
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
    */
    public function updateAddress($data = null){
		$this->Address->set($data['Address']);
		if(!$this->Address->save()){
			return false;
		}

		$this->Session->setFlash('Dữ liệu đã được cập nhật!.','flash/success');
		return $this->Address->id;
    }
}