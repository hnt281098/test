<?php
App::uses('AppController', 'Controller');
/**
 * Blogs Controller
 *
 * @property Blog $Blog
 * @property PaginatorComponent $Paginator
 * @property AuthComponent $Auth
 * @property SessionComponent $Session
 */
class RoadsController extends AppController {
	public $name ='Roads';
	public $uses = array('Road','Category', 'RoadImage');
	public $paginate = array('limit'=> 10,'order'=>'id DESC');
	public $paginateFrontEnd = array('limit'=> 10,'order'=>'id DESC');

	public $helpers = array('Html');
	public $components = array('Paginator','Session','Auth','Upload');

	/**
	 * [beforeFilter description]
	 * @return [type] [description]
	 */
	public function beforeFilter() {
		$this->set('title_for_content',SITE_NAME);
		$this->Auth->allow('index');

        parent::beforeFilter();
        $this->Auth->flashElement = null;
        $this->Auth->loginError = "Sai tên đăng nhập hoặc mật khẩu";
        $this->Auth->authError  = "Phiên đăng nhập đã kết thúc, phải đăng nhập lại";
        $this->Auth->userModel = 'User';
        $this->Auth->fields = array('username' => 'email', 'password' => 'password');
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'admin_index');
		$this->set('trip_car_type', trip_car_type());
		$this->set('car_type', car_type());
		$this->set('road_status', road_status());

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

		if(!empty($this->params->query)){
			if(!empty($this->params->query['searchByTitle'])){
				$conditions['title LIKE'] = "%". $this->params->query['searchByTitle']."%";
			}

			if(!empty($this->params->query['searchByCategoryId']) && $this->params->query['searchByCategoryId']!=1){
				$conditions['category_id'] = $this->params->query['searchByCategoryId'];
			}
		}

		$data = $this->Paginator->paginate('Road',$conditions);
		// Create beardcrumb
		$breadCurmb = array(
			'title'=>array('title'=>''),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('title'=>'Quản lý theo chuyến xe','active'=>1)
			)
		);

		$this->set('roads', roads());
		$this->set('breadCurmb',$breadCurmb);
		$this->set('data',$data);
	}

	/**
	 * [admin_add description]
	 * @return [type] [description]
	 */
	public function admin_add() {
		$this->layout = 'admin';
		$roadData = $this->Road->createDefault();
		$this->set('data',$roadData);
		$bInsert = false;

		// Create Breadcurmb
		$breadCurmb = array(
			'title'=>array('title'=>'Quản lý chuyến xe '),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('link'=>'/admin/roads/','title'=>'Chuyến xe '),
				array('link'=>'','title'=>'Thêm mới','active'=>1)
			)
		);
		$this->set('breadCurmb',$breadCurmb);

		if(isset($this->request->data['Road'])){
			$this->set('data', $this->request->data);
			$this->Road->set($this->request->data);

			if($this->Road->save()){
				$this->Session->setFlash('Hình ảnh cho blog đã được xóa','flash/success');
				$this->redirect('/admin/roads/index');
			}
		}

		if(!empty($this->Road->validationErrors) && isset($this->request->data['Road'])){
			$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
		}

		if($bInsert != false){
			$this->set('data',$roadData);
		}
		$this->set('trip_car_type', trip_car_type());
		$this->set('roads', roads());
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
		$this->layout = 'admin';

		if (!$this->Road->exists($id)) {
			$this->Session->setFlash('Không có dữ liệu để cập nhật!.','flash/error');
			$this->redirect(array('controller'=>'roads','action'=>'admin_index'));
		}

		$breadCurmb = array(
			'title'=>array('title'=>''),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('link'=>'/admin/roads/','title'=>'Quản lý chuyến xe '),
				array('link'=>'','title'=>'Chỉnh sửa chuyến xe','active'=>1)
			)
		);

		$this->set('breadCurmb', $breadCurmb);

		if ($this->request->is(array('post', 'put'))) {
			$this->set('data', $this->request->data);
			$this->Road->set($this->request->data);
			if($this->Road->save()){
				// Upload image
				if(!empty($this->request->data['RoadImage'])){
					$this->upload_image_roads($this->Road->id, $this->request->data['RoadImage']);
				}else{
					$this->Session->setFlash('Hình ảnh cho blog đã được cập nhật ','flash/success');
				}

				$this->redirect('/admin/roads/index');
			}

			if(!empty($this->Road->validationErrors) && isset($this->request->data['Road'])){
				$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
			}
			$this->redirect('/admin/roads/');
		}else{
			$options = array('conditions' => array('Road.' . $this->Blog->primaryKey => $id));
			$this->request->data = $this->Road->find('first', $options);
		}
		$this->set('data', $this->request->data);
		$this->set('roads', roads());
	}



	public function upload_image_roads($road_id = null, $data = null){
		if($road_id == null || $data == null){
			return false;
		}

		// Create blog folder
		@mkdir(WWW_ROOT.'images'.DS.'road');
		if($this->countFileUpload($data) > 0){
			$directory = WWW_ROOT.'images'.DS.'road'.DS.$road_id;
			// Upload to directory
			if(!is_dir($directory)){
				mkdir($directory);
			}
			$dateRoadImage = array();

			foreach ($data as $image) {
				$fileImageBlogUpload = $this->Upload->uploadBlogImage($image, $directory);
				if($fileImageBlogUpload===false){
					$this->Session->setFlash('Dữ liệu đã được cập nhật!, File hình ảnh không đúng định dạng.','flash/error');
					return false;
				}

				$dateRoadImage['RoadImage'] = array(
					'road_id'=> $road_id,
					'url'=>'/images/road/'. $road_id.'/'.$fileImageBlogUpload
				);

				$this->RoadImage->create();
				$this->RoadImage->set($dateRoadImage);
				if(!$this->RoadImage->save()){
					$this->Session->setFlash('Dữ liệu hình ảnh không thể cập nhật.','flash/error');
					return false;
				}
			}
		}
		$this->Session->setFlash('Thông tin và hình ảnh đã được cập nhật trong hệ thống .','flash/success');

	}


    /**
	 * [delete_image description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function admin_delete_image($id = null){
		$this->autoRender = false;
		$this->RoadImage->id = $id;

		if (!$this->RoadImage->delete()) {
			$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
			$this->redirect($this->referer());
		}

		$this->Session->setFlash('Hình ảnh đã được xóa','flash/success');
		$this->redirect($this->referer());
	}
}
