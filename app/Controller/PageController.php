<?php

/**
* @file : PageController
* @author : Long Tran Thanh
* @date_create: 2015-03-18 08:45:23
*/

class PageController extends AppController{
    public $name = 'Page';
    public $layout = 'admin';
    public $uses = array('Page','Road','Slider','PageImage','Point','Address');
    public $paginate = array('limit'=> PAGINATE_NUMBER);
    public $components = array('Paginator','Session','Auth','Upload');

    /**
    * [beforeFillter description]
    * @return [type] [description]
    */
    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->flashElement = null;
        $this->Auth->allow('view');
        $this->Auth->loginError = "Sai tên đăng nhập hoặc mật khẩu";
        $this->Auth->authError  = "Phiên đăng nhập đã kết thúc, phải đăng nhập lại";
        $this->Auth->userModel = 'User';
        $this->Auth->fields = array('username' => 'email', 'password' => 'password');
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'admin_index');
        $this->Auth->allow('introduction','recruitment','support','shedule','travel','travel_detail','service','price');

        $this->set('widgets', $this->getWidget());
    }


    function service(){
        $this->layout = 'default';
        $page = isset($this->params['pass'][0]) ? $this->params['pass'][0] : 'van-tai-hanh-khach';
		
        $services = $this->Page->getContentByGroup(SERVICE_CATEGORY_ID, 'all');
		$this->set('services', $services);

        $points = $this->Point->find('all');
		$this->set('points', $points);

        $this->set('provinces', provinces());
        $this->set('address', $this->Address->find('all'));
        $this->set('roads', roads());
        $this->set('trip_car_type', trip_car_type());
		
		$this->set('content', $this->Page->findByGroup(FRONT_END_PAGE_ID));
	
		
		$contentPage = $this->Page->getByKey($this->params['pass'][0]);
		$this->set('meta_description_ext', @$contentPage['Page']['meta_description']);
        $this->set('meta_keyword_ext', @$contentPage['Page']['meta_keyword']);
        $this->set('title_ext', @$contentPage['Page']['title']);
        
        if($page=='van-chuyen-hanh-khach'){
            $this->render('service_van_tai_hanh_khach');
        }elseif($page=='van-chuyen-hang-hoa'){
            $this->render('service_van_tai_hang_hoa');
        }elseif($page=='cho-thue-xe-hop-dong-dua-don-cnv'){
            $this->render('service_cho_thue_xe_du_lich');
        }elseif($page=='tram-dung-chan'){
            $this->render('service_tram_dung_chan');
        }elseif($page=='ben-xe'){
            $this->render('service_dich_vu_ben_bai');
        }elseif($page=='tram-xang-dau'){
            $this->render('service_tram_xang_dau');
        }
    }



    /**
    * [index description]
    * @return [type] [description]
    */
    function admin_index(){
        $this->layout = 'admin';
        $conditions = array('hide'=>1);

        // Get  page grouping
        $pageGroup = $this->Category->findByKey('page-grouping-category');

        $pageGroupId = isset($pageGroup['Category']['id']) ? $pageGroup['Category']['id'] : 0;
        $pageGroupIds = $this->Category->find('list',array(
                'conditions'=>array(
                    'parent_id' => $pageGroupId,
                )
            )
        );

        $this->Paginator->settings = $this->paginate;
        $pageData= $this->Paginator->paginate('Page',$conditions);
        // Create beardcrumb
        $breadCurmb = array(
            'title'=>array('title'=>'Trang giới thiệu HTML'),
            'path'=>array(
                array('link'=>SERVER,'title'=>'Trang chủ'),
                array('link'=>SERVER.'admin/page/index','title'=>'Quản lý trang tĩnh'),
                array('link'=>'','title'=>'','active'=>1)
            )
        );
        $this->set('breadCurmb',$breadCurmb);
        $this->set('pageData',$pageData);
        $this->set('pageGroupIds',$pageGroupIds);
    }

    function admin_edit($id = null){
        $this->layout = 'admin';

        if (!$this->Page->exists($id)) {
            $this->Session->setFlash('Không có dữ liệu để cập nhật!.','flash/error');
            $this->redirect(array('action'=>'admin_index'));
        }
        // Create beardcrumb
        $breadCurmb = array(
            'title'=>array('title'=>'Trang giới thiệu HTML'),
            'path'=>array(
                array('link'=>SERVER,'title'=>'Trang chủ'),
                array('link'=>SERVER.'admin/page/index','title'=>'Quản lý trang tĩnh'),
                array('link'=>'','title'=>'','active'=>1)
            )
        );

        // Get  page grouping
        $pageGroup = $this->Category->findByKey('page-grouping-category');
        $pageGroupId = isset($pageGroup['Category']['id']) ? $pageGroup['Category']['id'] : 0;
        $pageGroupIds = $this->Category->getCategoryList($pageGroupId);

        $this->set('breadCurmb',$breadCurmb);
        if ($this->request->is(array('post', 'put'))) {
            $bInsert = $this->_updatePage($this->request->data);
            if(!empty($this->Page->validationErrors) && isset($this->request->data['Page'])){
                $this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
            }

            if(!empty($this->request->data['PageImage'])){
                $this->upload_page_image($this->Page->id, $this->request->data['PageImage']);
            }else{
                $this->Session->setFlash('Hình ảnh cho blog đã được cập nhật ','flash/success');
            }


            $this->redirect($this->referer());
        }else{
            $options = array('conditions' => array('Page.'. $this->Page->primaryKey =>$id));
            $this->request->data = $this->Page->find('first', $options);
        }
        $this->set('pageGroupIds',$pageGroupIds);
        $this->set('data', $this->request->data);
    }
	
	public function admin_access(){
		if($this->request->query['field'] == null){
			die(json_encode(array('error'=>1)));
		}

		$this->Page->updateAll(
			array("description"=> "'". mysql_escape_string(trim($this->request->query['content']))."'") ,
			array("key"=> trim($this->request->query['field']))
		);

		die(json_encode(array('error'=>0)));
	}
	
    public function upload_page_image($page_id = null, $data = null){
		if($page_id == null || $data == null){
			return false;
		}

		// Create blog folder
		@mkdir(WWW_ROOT.'images'.DS.'pages');
		if($this->countFileUpload($data) > 0){
			$directory = WWW_ROOT.'images'.DS.'pages'.DS.$page_id;
			// Upload to directory
			if(!is_dir($directory)){
				mkdir($directory);
			}
			$dataPageImage = array();

			foreach ($data as $image) {
				$fileImageBlogUpload = $this->Upload->uploadBlogImage($image, $directory);
				if($fileImageBlogUpload===false){
					$this->Session->setFlash('Dữ liệu đã được cập nhật!, File hình ảnh không đúng định dạng.','flash/error');
					return false;
				}

				$dataPageImage['PageImage'] = array(
					'page_id'=> $page_id,
					'url'=>'/images/pages/'. $page_id.'/'.$fileImageBlogUpload
				);

                $this->PageImage->create();
				$this->PageImage->set($dataPageImage);
				if(!$this->PageImage->save()){
					$this->Session->setFlash('Dữ liệu hình ảnh không thể cập nhật.','flash/error');
					return false;
				}
			}
		}
		$this->Session->setFlash('Thông tin và hình ảnh đã được cập nhật trong hệ thống .','flash/success');

	}

	public function admin_delete_image($id = null){
		$this->autoRender = false;
		$this->PageImage->id = $id;

		if (!$this->PageImage->delete()) {
			$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
			$this->redirect($this->referer());
		}

		$this->Session->setFlash('Hình ảnh đã được xóa','flash/success');
		$this->redirect($this->referer());
	}

    function admin_add($id = null){
        $this->layout = 'admin';

        $pageData= $this->Page->createDefault();
        $this->set('data',$pageData);
        $bInsert = false;
        // Create beardcrumb
        $breadCurmb = array(
            'title'=>array('title'=>'Trang giới thiệu HTML'),
            'path'=>array(
                array('link'=>SERVER,'title'=>'Trang chủ'),
                array('link'=>SERVER.'admin/page/index','title'=>'Quản lý trang tĩnh'),
                array('link'=>'','title'=>'','active'=>1)
            )
        );
        $this->set('breadCurmb',$breadCurmb);
        if(isset($this->request->data['Page'])){
            $this->set('data', $this->request->data);
            $bInsert = $this->_updatePage($this->request->data);

            if(!empty($this->Page->validationErrors) && isset($this->request->data['Page'])){
                $this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
                $this->redirect($this->referer());
            }else{
                $pageId = $this->Page->getLastInsertID();
                $this->redirect('/admin/page/edit/'.$pageId);
            }
        }

        if($bInsert == true){
            $this->set('data',$pageData);
        }

        $pageGroup = $this->Category->findByKey('page-grouping-category');
        $pageGroupId = isset($pageGroup['Category']['id']) ? $pageGroup['Category']['id'] : 0;
        $pageGroupIds = $this->Category->getCategoryList($pageGroupId);

        $this->set('pageGroupIds',$pageGroupIds);
        $this->render('admin_edit');
    }

    function admin_delete($id = null){
        $this->autoRender = false;
        if($id == null){
            $this->Session->setFlash('Dữ liệu blog hiện tại không thể hủy bỏ','flash/error');
            $this->redirect($this->referer());
        }

        $this->Page->id = $id;
        if(!$this->Page->delete()) {
            $this->Session->setFlash('Dữ liệu blog hiện tại không thể hủy bỏ','flash/error');
            $this->redirect($this->referer());
        }

        $this->Session->setFlash('Dữ liệu blog hiện tại không thể hủy bỏ','flash/error');
        $this->redirect($this->referer());
    }

    public function view($id = null, $slug = null){
        if($id == null ){
            $this->redirect($this->referer());
        }

        $this->layout = 'default';
        $contentPage = $this->Page->findById($id);

        if(empty($contentPage)){
            $this->redirect($this->referer());
        }

        $services = $this->Page->getContentByGroup(SERVICE_CATEGORY_ID, 'all');
        $this->set('services', $services);

        $points = $this->Point->find('all');
        $this->set('points', $points);
        
        $this->set('contentPage', $contentPage);
        $this->set('meta_description_ext', $contentPage['Page']['meta_description']);
        $this->set('meta_keyword_ext', $contentPage['Page']['meta_keyword']);
        $this->set('title_ext', $contentPage['Page']['title']);
        $this->set('services', $this->Page->getContentByGroup(SERVICE_CATEGORY_ID,'all'));
        $this->set('id', $id);
    }

    public function introduction(){
        $this->layout = 'default';
        $this->set('content', $this->Page->findByGroup(FRONT_END_PAGE_ID));

        $pages = $this->Page->findAllByGroup(INTRODUCTION_PAGE_ID);
        $this->set('pages',$pages);

        $services = $this->Page->getContentByGroup(SERVICE_CATEGORY_ID, 'all');
		$this->set('services', $services);

		$points = $this->Point->find('all');
		$this->set('points', $points);
		
		$contentPage = $this->Page->findByKey('gioi-thieu-cong-ty	');
		$this->set('meta_description_ext', @$contentPage['Page']['meta_description']);
        $this->set('meta_keyword_ext', @$contentPage['Page']['meta_keyword']);
        $this->set('title_ext', @$contentPage['Page']['title']);

    }

    public function recruitment(){
        $this->layout = 'default';
        $contentPage = $this->Page->findByKey('tuyen-dung');
        $this->set('page', $contentPage);

        $services = $this->Page->getContentByGroup(SERVICE_CATEGORY_ID, 'all');
		$this->set('services', $services);

        $points = $this->Point->find('all');
		$this->set('points', $points);
	
		$contentPage = $this->Page->findByKey('gioi-thieu');
		$this->set('meta_description_ext', @$contentPage['Page']['meta_description']);
        $this->set('meta_keyword_ext', @$contentPage['Page']['meta_keyword']);
        $this->set('title_ext', @$contentPage['Page']['title']);

    }

    public function support(){
        $this->layout = 'default';
        $contentPage = $this->Page->findByKey('huong-dan-mua-ve');
        $this->set('page', $contentPage);
		

		$this->set('meta_description_ext', @$contentPage['Page']['meta_description']);
        $this->set('meta_keyword_ext', @$contentPage['Page']['meta_keyword']);
        $this->set('title_ext', @$contentPage['Page']['title']);
        
        if($this->request->url == 'huong-dan-mua-ve.html'){
            $this->render('huong-dan-mua-ve');
        }else{
            $this->render('huong-dan-mua-ve-tham-quan');
        }
    }

    public function travel(){
        $this->layout = 'default';
        $this->set('travels', $this->Road->find('all',
            array(
                'conditions'=>array(
                    'car_type'=> TRAVEL_ID,
                    'active'=>ENABLED
                ),
                'order'=>'id DESC')
            )
        );

    }

    public function travel_detail($id = null, $slug = null){
        if($id == null ){
            $this->redirect($this->referer());
        }

        $this->layout = 'default';
        $this->set('travel', $this->Road->findFirstById($id));

        $this->set('travel_others', $this->Road->find('all',
            array(
                'conditions'=>array(
                    'car_type'=> TRAVEL_ID,
                    'active'=>ENABLED,
                    'id <> '=> $id
                ),
                'order'=>'id DESC')
            )
        );
    }

    public function shedule(){
        $this->layout = 'default';
        $this->set('trip_car_type', trip_car_type());

        // Get roads
    }


    public function price(){
        $this->layout = 'default';
        $this->set('trip_car_type', trip_car_type());

        $services = $this->Page->getContentByGroup(SERVICE_CATEGORY_ID, 'all');
		$this->set('services', $services);

        $points = $this->Point->find('all');
		$this->set('points', $points);

        $this->set('provinces', provinces());
        $this->set('address', $this->Address->find('all'));
        $this->set('roads', roads());
        $this->set('trip_car_type', trip_car_type());
        
        $contentPage = $this->Page->findByKey('bang-gia');
		$this->set('meta_description_ext', @$contentPage['Page']['meta_description']);
        $this->set('meta_keyword_ext', @$contentPage['Page']['meta_keyword']);
        $this->set('title_ext', @$contentPage['Page']['title']);
    }


    /**
    * [update description]
    * @return [type] [description]
    */
    private function _updatePage($data = null){
        if($data == null){
            return false;
        }
        $flagUploadFile = false;
        if(!empty($data['Page']['images'])){
            $directory = WWW_ROOT.'images'.DS.'page';
            // Upload to directory
			if(!is_dir($directory)){
				mkdir($directory);
			}

            $fileImagePageUpload = $this->Upload->uploadBlogImage($data['Page']['images'], $directory);
            if($fileImagePageUpload!==false){
                $data['Page']['images'] = '/images/page/'. $fileImagePageUpload;
                $flagUploadFile = true;
            }
        }

        if($flagUploadFile == false){
            unset($data['Page']['images']);
        }

        // Clear all of image files;
        $this->Page->set($data['Page']);
        if(!$this->Page->save()){
            return false;
        }

        return true;
    }
}
