<?php
class ContactController extends AppController{
	public $name ='Contact';
	public $layout = 'home';
	public $uses = array('Contact', 'Page','Road','Slider','PageImage','Point','Address');
	public $paginate = array('limit'=> PAGINATE_NUMBER,'order'=>'id DESC');
	public $components = array('Paginator','Session','Auth');


	/**
	 * [beforeFilter description]
	 * @return [type] [description]
	 */
	public function beforeFilter() {
		$this->set('title_for_content',SITE_NAME);
		$this->Auth->allow('send','index');

        parent::beforeFilter();
        $this->Auth->flashElement = null;
        $this->Auth->loginError = "Sai tên đăng nhập hoặc mật khẩu";
        $this->Auth->authError  = "Phiên đăng nhập đã kết thúc, phải đăng nhập lại";
        $this->Auth->userModel = 'User';
        $this->Auth->fields = array('username' => 'email', 'password' => 'password');
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'admin_index');
        $this->set('menuSelect','menu-lien-he' );
    }

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function admin_index(){
		$this->layout = 'admin';
		$this->Paginator->settings = $this->paginate;
		$conditions = array();

		$contactData = $this->Paginator->paginate('Contact',$conditions);
		// Create beardcrumb
		$breadCurmb = array(
			'title'=>array('title'=>''),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('title'=>'Quản lý liên hệ','active'=>1)
			)
		);
		$this->set('breadCurmb',$breadCurmb);
		$this->set('contactData',$contactData);
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->Contact->id = $id;

		if (!$this->Contact->delete()) {
			$this->Session->setFlash('Liên hệ này không thể hủy bỏ','flash/error');
			$this->redirect($this->referer());
		}

		$this->Session->setFlash('Liên hệ gởi tới đã được xóa','flash/success');
		return $this->redirect(array('action' => 'admin_index'));
	}


	/**
	 * [send description]
	 * @return [type] [description]
	 */
	public function send(){
		$this->autoRender = false;
		$contact['Contact']['email'] = $this->request['data']['email'];
		$contact['Contact']['name'] = $this->request['data']['name'];
		$contact['Contact']['phone'] = $this->request['data']['phone'];
		$contact['Contact']['subject'] = $this->request['data']['subject'];
		$contact['Contact']['content'] = $this->request['data']['content'];

		if(!isset($this->request['data']['token_key']) || $this->request['data']['token_key']===''){
			return json_encode(array('status'=>0, 'msg'=>'Dữ liệu không hợp lệ'));
		}

		if($contact['Contact']['email'] == null || $contact['Contact']['content'] ==''){
			return json_encode(array('status'=>0, 'msg'=>'Không có thông tin để liên hệ'));
		}

		$this->Contact->set($contact);
		if(!$this->Contact->save()){
			return json_encode(array('status'=>0, 'msg'=>'Dữ liệu không hợp lệ'));
		}

		return json_encode(array('status'=>1, 'msg'=>'Chúng tôi đã nhận được thông tin, xin cám ơn'));
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index(){

        $services = $this->Page->getContentByGroup(SERVICE_CATEGORY_ID, 'all');
		$this->set('services', $services);

        $points = $this->Point->find('all');
		$this->set('points', $points);
        $this->set('provinces', provinces());
        $this->set('address', $this->Address->find('all'));

		$this->set('meta_description_ext', "Địa chỉ: Số 604 đường Phú Riềng Đỏ, P. Tân Xuân, TX. Đồng Xoài, Bình Phước. Số điện thoại: 06513879072.");
        
        
		$this->layout = 'default';
	}
}

?>
