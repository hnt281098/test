<?php

class HomeController extends AppController{
	public $name ='Home';
	public $layout = 'default';
	public $uses = array('Category','Page','Blog','Slider','Customer','Package','Point');


	/**
	 * [beforeFilter description]
	 * @return [type] [description]
	 */
	public function beforeFilter(){
		parent::beforeFilter();
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */

	public function index(){
		$pages = $this->Page->getContentByGroup(SERVICE_CATEGORY_ID, 'all');
		$this->set('pages', $pages);

		$pages = $this->Page->getContentByGroup(INFORMATION_REQUIRED_ID, 'all');
		$this->set('infomartion_requireds', $pages);

		$points = $this->Point->find('all');
		$this->set('points', $points);

		$blogs = $this->Blog->getBlogData(NEWS_CATEGORY_ID, 3);
		$this->set('blogs', $blogs);


		$this->set('sliders', $this->Slider->find('all'));

	}

	/**
	 * [updateTextForSlider description]
	 * @param  [type] $images [description]
	 * @return [type]         [description]
	 */
	function getDataSlider($images = null){
		if(empty($images) ){
			return null;
		}
		return $this->Slider->findByImageList($images);
	}

	/**
	 * [getDataCustomer description]
	 * @param  [type] $images [description]
	 * @return [type]         [description]
	 */
	function getDataCustomer($images = null){
		if(empty($images) ){
			return null;
		}
		return $this->Customer->findByImageList($images);
	}
}

?>

