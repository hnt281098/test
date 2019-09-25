<?php

class LibraryController extends AppController{
	public $name ='Library';
	public $layout = 'default';
	public $uses = array('Category','Page','Blog');
	public $paginateFrontEnd = array(
		'fields' => array('id', 'title','created','updated','description'),
		'limit'=> 30,
		'order'=>'id DESC'
	);

	public $helpers = array('Html');
	public $components = array('Paginator','Session','Auth','Upload');

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index','detail','category','getByCategory','getMore');
        $this->Auth->flashElement = null;
        $this->Auth->loginError = "Sai tên đăng nhập hoặc mật khẩu";
        $this->Auth->authError  = "Phiên đăng nhập đã kết thúc, phải đăng nhập lại";
        $this->Auth->userModel = 'User';
        $this->Auth->fields = array('username' => 'email', 'password' => 'password');
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'admin', 'action' => 'index');
        $this->set('menuSelect','menu-thue-xe');

        $this->category = $this->Category->findByKey('menu-danh-muc-xe');
        $this->categoryList = $this->Category->getCategoryList($this->category['Category']['id']) ;

        $this->set('categoryList', $this->categoryList);


		/* Lelt menu */
		$keyLeftMenu = array(
			'ly-do-chon-chung-toi',
			'dia-danh-du-lich',
			'khuyen-mai-du-lich'
		);

		$pageLeftContent = $this->Page->getByKeys($keyLeftMenu);
		$this->set('pageLeftContent', $pageLeftContent);
    }

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index(){
		$breadCurmb = array(
			'title'=>array('title'=> 'Dịch vụ thuê xe'),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('link'=>'','title'=>'Cho thuê xe ','active'=>1)
			)
		);
		$this->set('breadCurmb',$breadCurmb);
		$category = $this->Category->findByKey('thue-xe');

		if(!isset($category)){
			return $this->redirect('/');
		}

		/** Set default first category  */
		$this->Paginator->settings = $this->paginateFrontEnd;

		//Load library category
		$categoryList = $this->Category->getSubCategories($this->category['Category']['id'],'ord DESC');
		$selectCategory = !empty($categoryList) ? array_keys($categoryList) : null;
		$this->set('categoryList', $categoryList);

		/** Blog list */
		$blogDatas = $this->Blog->getBlogDataByGroups($selectCategory , 30 );

		$this->set('blogDatas', $blogDatas);
		}

	/**
	 * [getMore description]
	 * @param  [type]  $categoryId [description]
	 * @param  integer $paging     [description]
	 * @return [type]              [description]
	 */
	public function getMore($categoryId = 0, $page = 2){
		$this->layout = 'ajax';
		if($categoryId == 0){
			$category = $this->Category->findByKey('thue-xe');
			$subCategories = $this->Category->getSubCategories($category['Category']['id'],'id ASC');
			$selectCategory = key($subCategories);

			/** Blog list */
			$subCategories = $this->Category->getSubCategories($selectCategory,'id ASC');

			$blogDatas = $this->Blog->getBlogData(array_keys($subCategories), 9, $page );
		}else{
			$blogDatas = $this->Blog->getBlogData($categoryId, 9, $page );
		}

		$this->set('blogDatas', $blogDatas);

	}

	/**
	 * [getByCategory description]
	 * @param  [type] $categoryId [description]
	 * @param  [type] $slug       [description]
	 * @return [type]             [description]
	 */
	public function getByCategory($categoryId = null, $slug = null){
		$breadCurmb = array(
			'title'=>array('title'=> 'Dịch vụ thuê xe '),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('link'=>'','title'=>'Dịch vụ thuê xe ','active'=>1)
			)
		);
		$this->set('breadCurmb',$breadCurmb);
		$category = $this->Category->findById($categoryId);
		if(!isset($category)){
			return $this->redirect('/');
		}
		//Load library category
		/** Blog list */

		$this->Paginator->settings = $this->paginateFrontEnd;
		$blogDatas = $this->Paginator->paginate('Blog',array('category_id'=> $categoryId ));

		$this->set('blogDatas', $blogDatas);
		$this->set('category',$category);
		$this->set('categoryId', $categoryId);

	}

	/**
	 * [detail description]
	 * @return [type] [description]
	 */
	public function detail($id = null, $slug = null){
		if($id == null || $slug == null){
			return $this->redirect('/');
		}

		$breadCurmb = array(
			'title'=>array('title'=> 'Dịch vụ cho thuê xe '),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('link'=>'','title'=>'Dịch vụ cho thuê xe ','active'=>1)
			)
		);

		$blogData = $this->Blog->findById($id);

		$this->set('breadCurmb',$breadCurmb);
		$this->set('blogData', $blogData);

		$widgets['libraries'] = $this->Blog->getOtherBlogs($id, (!empty($blogData['Blog']['category_id']) ?  $blogData['Blog']['category_id'] : null), 3);

		$this->set('widgets',$widgets);
	}
}

?>
