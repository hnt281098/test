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
class BlogsController extends AppController {
	public $name ='Blogs';
	public $uses = array('Blog','BlogImage','Category','BlogComment','Page', 'Road','Point');
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
		$this->Auth->allow('index', 'category','detail','insert_comment','projectByCategory','recruit','project','detailProject');

        parent::beforeFilter();
        $this->Auth->flashElement = null;
        $this->Auth->loginError = "Sai tên đăng nhập hoặc mật khẩu";
        $this->Auth->authError  = "Phiên đăng nhập đã kết thúc, phải đăng nhập lại";
        $this->Auth->userModel = 'User';
        $this->Auth->fields = array('username' => 'email', 'password' => 'password');
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'admin_index');

        // Get widget for right content
    	$this->set('widgets', $this->getWidget());
    }



    /**
     * [list description]
     * @return [type] [description]
     */
    public function category ( ){
    	$this->layout = 'default';
    	$this->Paginator->settings = $this->paginateFrontEnd;
    	$conditions = array();
    	$blogDatas = $this->Paginator->paginate('Blog',$conditions);
    	$this->set('blogDatas', $blogDatas);




        $services = $this->Page->getContentByGroup(SERVICE_CATEGORY_ID, 'all');
        $this->set('services', $services);

        $points = $this->Point->find('all');
        $this->set('points', $points);
    }

    /**
     * [recruit description]
     * @return [type] [description]
     */
    public function recruit(){
		$categoryData = $this->Category->findById(RECRUIT_CATEGORY_ID);

    	if(empty($categoryData)){
    		return $this->redirect(SERVER);
    	}

    	$categoryId = $categoryData['Category']['id'];
    	$breadCurmb = array(
			'title'=>array('title'=>$categoryData['Category']['name']),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('link'=>'','title'=>'Tuyển dụng','active'=>1)
			)
		);
		$this->set('breadCurmb',$breadCurmb);

    	$this->layout = 'default';
    	$this->Paginator->settings = $this->paginateFrontEnd;

    	$blogDatas = $this->Paginator->paginate('Blog',array('category_id'=> RECRUIT_CATEGORY_ID));

		$this->set('title', $categoryData['Category']['name']);
    	$this->set('blogDatas', $blogDatas);
    	$this->set('title_ext', $categoryData['Category']['name']);
    	$this->set('menuSelect',$categoryData['Category']['key'] );
    }


    /**
     * [memberHub description]
     * @return [type] [description]
     */
    public function explodeCategory($categoryId = null, $categoryList = null, $title = null ){
    	$this->layout = 'default';
    	$conditions = array('category_id'=> $categoryId );
		$categoryKeys = array_keys($categoryList);
		foreach($categoryKeys as $tmpCategoryId){
			$blogDatas[$tmpCategoryId] = $this->Blog->getEachByCategories($tmpCategoryId, true);
		}

   		//$blogDatas = $this->Blog->getEachByCategories(array_keys($categoryList),true);

    	// Get blogs list in the right panel
    	$blogDataRight = $this->Blog->getWidget(10);

    	$this->set('newsInFooter', $blogDatas);
    	$this->set('blogDataRight', $blogDataRight);
		$this->set('title', $title);
    	$this->set('memberCategoryId',$categoryList);
    	$this->render('member_hub');
    }

    /**
     * [detail description]
     * @return [type] [description]
     */
    public function detail($id=null, $slug = null){
		if($id==null){
			$this->redirect(SERVER);
		}

    	$this->layout = 'default';
    	$blogInfo = $this->Blog->findById($id);
    	// Get blogs list in the right panel

    	if(empty($blogInfo)){
    		$this->redirect(SERVER);
    	}


    	$this->set('blogInfo', $blogInfo);
		$this->set('others', $this->Blog->getOtherBlogs($id, $blogInfo['Blog']['category_id']));

    	$this->set('meta_description_ext', $blogInfo['Blog']['meta_description']);
		$this->set('meta_keyword_ext', $blogInfo['Blog']['meta_keyword']);
		$this->set('title_ext', $blogInfo['Blog']['title']);

        

        $services = $this->Page->getContentByGroup(SERVICE_CATEGORY_ID, 'all');
        $this->set('services', $services);

        $points = $this->Point->find('all');
        $this->set('points', $points);

    }

    /**
     * [insert_comment description]
     * @return [type] [description]
     */
    public function insert_comment(){
    	$this->autoRender = false;
    	$blogComment['BlogComment']['name'] = isset($this->params['data']['name']) ? $this->params['data']['name'] : null;
    	$blogComment['BlogComment']['content'] = isset($this->params['data']['comment']) ? $this->params['data']['comment'] : null;
    	$blogComment['BlogComment']['blog_id'] =  isset($this->params['data']['blogId']) ? $this->params['data']['blogId'] : null;

    	if(!in_array(null, $blogComment)){
  		$this->BlogComment->set($blogComment);
   		$this->BlogComment->save();
    	}
    	$this->redirect($this->referer());
    }

    /**
     * [update_image_thumbnail description]
     * @return [type] [description]
     */
    public function update_image_thumbnail(){
    	$this->autoRender = false;
    	$blogId = isset($this->params['data']['blogId']) ? $this->params['data']['blogId'] : null;
    	$data['BlogImage']['id'] = isset($this->params['data']['blogImageId']) ? $this->params['data']['blogImageId'] : null;

    	if($blogId == null || $data['BlogImage']['id']==null) {
    		return null;
    	}

    	// Set every image is 0
    	$this->BlogImage->updateAll(
			array('thumbnail' => 0),
 			array('blog_id ' => $blogId)
		);
    	// Turn on flag image
		$this->BlogImage->updateAll(
			array('thumbnail'=>1),
			array('id'=> $data['BlogImage']['id'])
		);
		return 'OK';
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index(){
    	$this->layout = 'home';
    }

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->layout = 'admin';
		$categoryList = $this->Category->getCategoryAll();
		$this->_getCategoryList();
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

		$arrData = $this->Paginator->paginate('Blog',$conditions);
		// Create beardcrumb
		$breadCurmb = array(
			'title'=>array('title'=>''),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('title'=>'Quản lý tin tức','active'=>1)
			)
		);
		$this->set('breadCurmb',$breadCurmb);
		$this->set('arrData',$arrData);
		$this->set('categoryList', $categoryList);
	}

	/**
	 * [admin_comment description]
	 * @return [type] [description]
	 */
	public function admin_comment(){
		$this->layout = 'admin';
		$blogId = isset($this->params['pass'][0]) ? $this->params['pass'][0] : null;
		if($blogId == null){
			$this->redirect($this->referer());
		}

		$breadCurmb = array(
			'title'=>array('title'=>'Quản lý mục Bình luận bài viêt'),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('link'=>'','title'=>'Quản lý bình luận bài viết','active'=>1)
			)
		);
		$this->set('breadCurmb',$breadCurmb);

		$this->Blog->hasMany = array(
                'BlogComment'=>array(
	        	'className'=>'BlogComment',
	        	'foreignKey'=> 'blog_id',
	        	'order' => 'BlogComment.created DESC'
    		)
    	);
    	$blogInfo = $this->Blog->findById($blogId);
    	$this->set('blogInfo', $blogInfo);
	}

	/**
	 * [admin_add description]
	 * @return [type] [description]
	 */
	public function admin_add() {
		$this->layout = 'admin';
		$blogData = $this->Blog->createDefault();
		$this->set('data',$blogData);
		$bInsert = false;
		// Create Breadcurmb
		$breadCurmb = array(
			'title'=>array('title'=>'Quản lý bài viết - blogs'),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('link'=>'/admin/blogs/','title'=>'Tin tức'),
				array('link'=>'','title'=>'Thêm mới','active'=>1)
			)
		);
		$this->_getCategoryList();
		$this->set('breadCurmb',$breadCurmb);

		if(isset($this->request->data['Blog'])){
			$this->set('data', $this->request->data);
			$blogId = $this->_updateBlogs($this->request->data);
			$this->redirect('/admin/blogs/edit/'.$blogId );
		}

		if(!empty($this->Blog->validationErrors) && isset($this->request->data['Blog'])){
			$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
		}

		if($bInsert != false){
			$this->set('data',$blogData);
		}
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

		if (!$this->Blog->exists($id)) {
			$this->Session->setFlash('Không có dữ liệu để cập nhật!.','flash/error');
			$this->redirect(array('controller'=>'blogs','action'=>'admin_index'));
		}

		$breadCurmb = array(
			'title'=>array('title'=>''),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('link'=>'/admin/blogs/','title'=>'Tin tức'),
				array('link'=>'','title'=>'Chỉnh sửa bài viết','active'=>1)
			)
		);

		$this->set('breadCurmb',$breadCurmb);
		$this->_getCategoryList();

		if ($this->request->is(array('post', 'put'))) {
			$blogId = $this->_updateBlogs($this->request->data);
			if(!empty($this->Blog->validationErrors) && isset($this->request->data['Blog'])){
				$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
			}
			$this->redirect('/admin/blogs/edit/'. $blogId);
		}else{
			$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
			$this->request->data = $this->Blog->find('first', $options);
		}
		$this->set('data', $this->request->data);
	}

	/**
	 * [_updateBlogs description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function _updateBlogs($data = null){
		// Check data's validation
		if(!isset($data['Blog']['event_flg'])){
			$data['Blog']['event_flg'] = DISABLED;
		}

		$this->Blog->set($data['Blog']);
		if(!$this->Blog->save()){
			return false;
		}

		// Create blog folder
		@mkdir(WWW_ROOT.'images'.DS.'blog');

		$blogId = $this->Blog->id;

		if($this->countFileUpload($data['BlogImage']['files']) > 0){
			$directory = WWW_ROOT.'images'.DS.'blog'.DS.$blogId;
			// Upload to directory
			if(!is_dir($directory)){
				mkdir($directory);
			}
			$dataBlogImage = array();

			foreach ($data['BlogImage']['files'] as $image) {
				$fileImageBlogUpload = $this->Upload->uploadBlogImage($image, $directory);
				if($fileImageBlogUpload===false){
					$this->Session->setFlash('Dữ liệu đã được cập nhật!, File hình ảnh không đúng định dạng.','flash/error');
					return false;
				}

				$dataBlogImage['BlogImage'] = array(
					'blog_id'=> $blogId,
					'url'=>'/images/blog/'. $blogId.'/'.$fileImageBlogUpload
				);

				$this->BlogImage->create();
				$this->BlogImage->set($dataBlogImage);
				if(!$this->BlogImage->save()){
					$this->Session->setFlash('Dữ liệu hình ảnh không thể cập nhật.','flash/error');
					return false;
				}
			}
		}

		$this->Session->setFlash('Dữ liệu đã được cập nhật!.','flash/success');
		return $blogId;
	}

	/**
	 * [delete_image description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function admin_delete_image($id = null){
		$this->autoRender = false;
		$this->BlogImage->id = $id;

		if (!$this->BlogImage->delete()) {
			$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
			$this->redirect($this->referer());
		}

		$this->Session->setFlash('Hình ảnh cho blog đã được xóa','flash/success');
		$this->redirect($this->referer());
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->Blog->id = $id;

		if (!$this->Blog->delete()) {
			$this->Session->setFlash('Dữ liệu blog hiện tại không thể hủy bỏ','flash/error');
			$this->redirect($this->referer());
		}

		$this->BlogImage->deleteByBlogId($id);
		$this->Session->setFlash('Hình ảnh cho blog đã được xóa','flash/success');
		return $this->redirect(array('action' => 'index'));
	}

	/**
	 * [admin_comment_delete description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function admin_comment_delete($id = null){
		$this->BlogComment->id = $id;
		if (!$this->BlogComment->delete()) {
			$this->Session->setFlash('Dữ liệu blog hiện tại không thể hủy bỏ','flash/error');
		}else{
			$this->Session->setFlash('Bình luận cho bài viết đã được xóa','flash/success');
		}

		$this->redirect($this->referer());
	}

	/**
	 * [admin_comment_approval description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function admin_comment_approval($id = null){
		$this->BlogComment->set(array(
			'id'=> $id,
			'visiabled'=> ENABLED)
		);

		if (!$this->BlogComment->save()) {
			$this->Session->setFlash('Dữ liệu blog hiện tại không thể hủy bỏ','flash/error');
		}else{
			$this->Session->setFlash('Bình luận cho bài viết đã được duyệt','flash/success');
		}

		$this->redirect($this->referer());
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
