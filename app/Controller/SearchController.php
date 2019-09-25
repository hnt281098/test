<?php

/**
* @file : PageController
* @author : Long Tran Thanh
* @date_create: 2015-03-18 08:45:23
*/

class SearchController extends AppController{
	public $name = 'Search';
	public $layout = 'admin';
	public $uses = array('Package');
	public $paginate = array('limit'=> 20);
	public $components = array('Paginator','Session');

	/**
	* [beforeFillter description]
	* @return [type] [description]
	*/
	function beforeFilter(){
		parent::beforeFilter();
	}

	function index(){
		if(empty($this->request->query)){
			$this->redirect('/');
		}
		$package = $this->Package->find('first',array(
			'conditions'=>array(
				'phieu_code'=> strtoupper(trim($this->request->query['phieu_code'])),
				'phieu_sdtnhan'=> strtoupper(trim(str_replace(array("."," ","-","(",")"),"",$this->request->query['phieu_sdtnhan']))),
			)
		));
		
		$this->layout = 'default';
		$this->set('package',$package);

	}


	/**
	* [index description]
	* @return [type] [description]
	*/
	function indexbk($title = null){
		if($title == null){
			return $this->redirect('/');
		}

		$this->layout = 'default';
		$conditions = array();
		$title = str_replace("-"," ",$title);
		$this->Paginator->settings = $this->paginate;
		$pageData= $this->Paginator->paginate('Page',$conditions);

		$blogDatas = $this->Paginator->paginate('Blog',
			array(
				'OR'=>array(
					"title LIKE '%". $title ."%'",
					"description LIKE '%" .$title."%'"
				)
			)
		);

		// Create beardcrumb
		$breadCurmb = array(
			'title'=>array('title'=>'Tìm kiếm'),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('link'=>'','title'=>'Tin tức','active'=>1)
			)
		);

		$categories = $this->Category->find('list');

		$this->set('breadCurmb',$breadCurmb);
		$this->set('pageData',$pageData);
		$this->set('blogDatas',$blogDatas);
		$this->set('categories', $categories);
		$this->set('title_search', $title);
	}


}
