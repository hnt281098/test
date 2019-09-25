<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CategoriesController extends AppController {
	public $name ='Categories';
	public $uses = array('Category');
	public $paginate = array('limit'=> PAGINATE_NUMBER);
	public $helpers = array('Html');
	public $components = array('Paginator','Session','Auth');
	public $layout = 'admin';


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

        $this->_getCategoryList();
    }

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$breadCurmb = array(
			'title'=>array('title'=>''),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('title'=>'Quản lý danh mục','active'=>1)
			)
		);
		$this->set('breadCurmb',$breadCurmb);
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		$categoryData = $this->Category->createDefault();

		if ($this->request->is('post')) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash('Dữ liệu đã được cập nhật!.','flash/success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
			}
		}
		$this->set('categoryData', $categoryData);
		$this->render('admin_edit');
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$breadCurmb = array(
			'title'=>array('title'=>''),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('title'=>'Quản lý danh mục','active'=>1)
			)
		);
		$this->set('breadCurmb',$breadCurmb);
		$this->set('categoryId', $id);

		if ($this->request->is(array('post', 'put'))) {

			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash('Dữ liệu đã được cập nhật!.','flash/success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
			}
			$this->set('categoryData', $this->request->data);
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$categoryData = $this->Category->find('first', $options);
			$this->set('categoryData', $categoryData);
		}
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($categoryId = null) {
		if($categoryId==null){
			$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
			return $this->redirect(array('action' => 'index'));
		}

		$this->Category->id = $categoryId;
		if ($this->Category->delete()) {
			$this->Session->setFlash('Dữ liệu đã được cập nhật!.','flash/success');
		} else {
			$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
		}
		return $this->redirect(array('action' => 'index'));
	}


	/**
	 * [_getCategoryList description]
	 * @return [type] [description]
	 */
	private function _getCategoryList(){
		$categories = $this->Category->generateTreeList(array('parent_id <>'=> null), null, null, '<span class="text-danger">--</span> ', $recursive = -1 );
        $this->set('categories', $categories);
	}
}
