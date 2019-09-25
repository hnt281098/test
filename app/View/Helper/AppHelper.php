<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {

	var $helpers = array ('Html', 'Form', 'Session');

	/**
	 * [displayValidationError description]
	 * @param  [type] $validationErrors [description]
	 * @param  [type] $key              [description]
	 * @return [type]                   [description]
	 */
	function displayValidationError($validationErrors = null, $key = null){
		if($validationErrors == null){
			return null;
		}

		if(!empty($validationErrors[$key])){
			return '<p class="text-danger">'. implode('<br> - ', $validationErrors[$key]) .'</p>';
		}
	}

	/**
	 * [loadFancyBox description]
	 * @return [type] [description]
	 */
	function loadFancyBox(){
		$libraries = array(
			'<link rel="stylesheet" href="/css/jquery.fancybox.css">',
			'<script src="/js/jquery.fancybox.js"></script>'
		);

		return implode('', $libraries);
	}

	/**
	 * [createEditor description]
	 * @return [type] [description]
	 */
	function createEditor(){
		$libraries = array(
			'<script src="/js/ckeditor/ckeditor.js"></script>'
		);

		return implode('', $libraries)	;
	}

	/**
	 * [RecursiveCategories description]
	 * @param [type] $array [description]
	 */
	function recursiveCategories($categories = null, $count = null) {
	    if (count($categories)) {
	        echo "\n<ul ". ($count==null?"class=\"list-group\"":'' ) .">\n";
	        $count = empty($count) ? $count : 1;
	        foreach ($categories as $category) {

	            echo "<li  id=\"".$category['Category']['id']."\">".$category['Category']['name'];
	            if (count($category['children'])) {
	                $this->recursiveCategories($category['children'], $count);
	            }
	            echo "</li>\n";
	        }
	        echo "</ul>\n";
	    }
	}

	/**
	 * [selectCategory description]
	 * @param  [type] $categoryId [description]
	 * @return [type]             [description]
	 */
	function selectCategory($categoryList = null, $categoryIdSelected = null, $options = null){
		if($categoryList == null){
			return null;
		}

		$resp = '<select class="form-control" name="'.$options['name'] .'">';
		$resp .= '<option value="1" '. ($categoryIdSelected == 1?"selected='Selected'":"") .' >-- Danh mục gốc ---</option>';

		foreach ($categoryList as $categoryTempId => $categoryTitle){
			if( $categoryIdSelected == $categoryTempId){
				$resp .='<option selected="selected" value="'. $categoryTempId .'">'.$categoryTitle .'</option>';
			}else{
				$resp .='<option value="'. $categoryTempId .'">'.$categoryTitle .'</option>';
			}
	 	}

		$resp .= '</select>';
		return $resp;
	}

	/**
	 *
	 * @param  [type] $str [description]
	 * @return [type]      [description]
	 */
	function slug($string = null){

		$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($string));
   		return $slug;
	}

	/**
	 *
	 * @param  [type] $slider [description]
	 * @param  [type] $image  [description]
	 * @return [type]         [description]
	 */
	function getTextSlider($sliders = null, $image = null){
		if($sliders == null || $image == null){
			return null;
		}
		foreach ($sliders as $key => $slider) {
			if($image == $slider['Slider']['image']){
				return '<input type="text" placeholder="Alt tag cho image" class="form-control" name="slider_'. $slider['Slider']['id'].'" data-type="text1" data-id="'.$slider['Slider']['id'].'" rel="slider_text" value="'. $slider['Slider']['text1']  .'"> <br/>
						<select rel="slider-position" class="form-control" data-type="position" data-id="'.$slider['Slider']['id'].'">
							<option value="0"'. ($slider['Slider']['id'] == 0 ?'selected="selected"':'' ) .'> PC </option>
							<option value="1"'. ($slider['Slider']['id'] == 1 ?'selected="selected"':'' ) .'> Mobile - Tablet </option>
						</select>';
			}
		}
	}

	/**
	 * [getTextSlider description]
	 * @param  [type] $sliders [description]
	 * @param  [type] $image   [description]
	 * @return [type]          [description]
	 */
	function getTextForSlider($sliders = null, $image = null, $field = null){
		if($sliders == null || $image == null ||  $field == null){
			return null;
		}

		foreach ($sliders as $key => $slider) {
			if($image == $slider['Slider']['image']){
				return  isset($slider['Slider'][$field]) ? $slider['Slider'][$field] : null;
			}
		}
	}

	/**
	 * [contentPage description]
	 * @param  [type] $key [description]
	 * @return [type]      [description]
	 */
	public function contentPage($key = null, $field = 'description'){
		App::import('Model', 'Page');
		$this->Page = new Page();

		$page = $this->Page->findByKey($key);
		if(empty($page)){
			return null;
		}

		if($key!=null && isset($page['Page'][$field])){
			return $page['Page'][$field];
		}else{
			return $page['Page'];
		}
	}

	/**
	 * [contentEmbed description]
	 * @param  [type] $key [description]
	 * @return [type]      [description]
	 */
	public function contentEmbed($key, $caseResp = false){
		App::import('Model', 'Page');
		$this->Page = new Page();

		$page = $this->Page->findByKey($key);
		if(empty($page)){
			return null;
		}

		switch($caseResp){
			case 'youtube':
				$youTubeId = str_replace('https://www.youtube.com/embed/','',$page['Page']['link']);
				$youTubeId = str_replace('/','',$youTubeId);
				return $youTubeId;
			break;
		}
		return $page['Page']['link'];
	}

	public function getYoutubeId($youtubeUrl = none){

		$youTubeId = str_replace('https://www.youtube.com/watch?v=','',$youtubeUrl);
		$youTubeId = str_replace('/','',trim($youTubeId));

		return $youTubeId;
	}


	/**
	 * [contentImage description]
	 * @param  [type]  $key    [description]
	 * @param  integer $number [description]
	 * @return [type]          [description]
	 */
	public function contentImage($key, $number = 0){
		App::import('Model', 'Page');
		$this->Page = new Page();

		$page = $this->Page->findByKey($key);
		if(empty($page)){
			return null;
		}

		$images = explode(";", $page['Page']['images']);
		return (isset($images[$number]) ? $images[$number] : null);
	}

	/**
	 * [getDataCustomer description]
	 * @param  [type] $customerData [description]
	 * @param  [type] $image        [description]
	 * @return [type]               [description]
	 */
	function getDataCustomer($customerData = null, $image = null){
		if($customerData == null || $image == null){
			return null;
		}

		foreach ($customerData as $customer) {
			if($image == $customer['Customer']['logo']) {
				return $customer;
			}
		}

		return null;
	}

	/**
	 * [getShortDescription description]
	 * @param  [type] $words [description]
	 * @return [type]        [description]
	 */
	function getShortDescription($words = null, $stripTags = true){
		if($words == null){
			return null;
		}

		$description = explode(EXPLODE_BLOG, $words);
		return ($stripTags == true ? strip_tags($description[0]) : $description[0] ) ;
	}



	public function findKeyInPage($groupId = null, $key = null){
		App::import('Model', 'Page');
		$this->Page = new Page();

		return $this->Page->find('first', array('conditions'=>array(
					'group'=>$groupId,
					'key'=> $key
				)
			)
		);

	}

	public function createBlankPage($groupId = null, $key = null){
		App::import('Model', 'Page');
		$this->Page = new Page();

		$pageData['Page']['key']  = trim($key);
		$pageData['Page']['title']  = trim($key);
		$pageData['Page']['group']  = $groupId;
		$pageData['Page']['description']  = null;

		$this->Page->set($pageData);
		$this->Page->save();
	}


	public function getPageByKey($pages= null, $key = null){
		if($pages == null || $key == null){
			return Null;
		}

		foreach($pages as $page){
			if($page['Page']['key']== $key){
				return $page;
			}
		}
		return null;
	}


	public function findByCategoryKey($pages, $key = null, $field = null){
		if (empty($pages)){
			return null;
		}

		foreach($pages as $page){
			if ($page['Page']['key'] == $key){
				if(isset($page['Page'][$field])){
					return $page['Page'][$field];
				}else{
					return $page;
				}

			}
		}

		return null;
	}


	public function findByCategoryKeyList($pages, $key = null){
		if (empty($pages)){
			return null;
		}
		App::import('Model', 'Category');
		$this->Category = new Category();
		$pageGroup = $this->Category->findByKey($key);
		if($pageGroup == null){
			return null;
		}

		$resp = null;
		foreach($pages as $page){
			if ($page['Page']['group'] == $pageGroup['Category']['id']){
				$resp[] =  $page;
			}
		}

		return $resp;
	}

	
	public function renderLink($nameInput = null, $valueInput = null, $groupId = null, $inputType = 'textarea'){
		if(!$this->Session->read(SESSION_ADMIN_DATA)){
			return null;
		}

		if(!isset($valueInput[$nameInput])){// Create it 
			// Find it before create
			$pageData = $this->findKeyInPage($groupId, $nameInput);
			if(empty($pageData)){
				$this->createBlankPage($groupId, $nameInput);
				$valueInput[$nameInput] = null;
			}else{
				$valueInput[$nameInput] = $pageData['Page']['description'];
			}
		}

		return $this->renderDisplay($nameInput, $valueInput[$nameInput], null).
					$this->renderInput($nameInput,$valueInput[$nameInput], $inputType);
	}


	public function renderImg($nameInput = null, $valueInput = null, $groupId = null, $inputType = 'input'){
		if(!$this->Session->read(SESSION_ADMIN_DATA)){
			return null;
		}

		if(!isset($valueInput[$nameInput])){// Create it 
			// Find it before create
			$pageData = $this->findKeyInPage($groupId, $nameInput);
			if(empty($pageData)){
				$this->createBlankPage($groupId, $nameInput);
				$valueInput[$nameInput] = null;
			}else{
				$valueInput[$nameInput] = $pageData['Page']['description'];
			}
		}

		return $this->renderDisplay($nameInput, $valueInput[$nameInput], null).
					$this->renderInput($nameInput,$valueInput[$nameInput], $inputType);
	}

	public function renderRaw($nameInput = null, $groupId){
		$pageData = $this->findKeyInPage($groupId, $nameInput);
		return @$pageData['Page']['description'];
	}
	
	public function render($nameInput = null, $valueInput = null, $groupId = null, $inputType = 'input'){
		if(!isset($valueInput[$nameInput])){// Create it 
			// Find it before create
			$pageData = $this->findKeyInPage($groupId, $nameInput);
			if(empty($pageData)){
				$this->createBlankPage($groupId, $nameInput);
				$valueInput[$nameInput] = null;
			}else{
				$valueInput[$nameInput] = $pageData['Page']['description'];
			}
		}
		
		if(!$this->Session->read(SESSION_ADMIN_DATA)){
			return $valueInput[$nameInput];
		}

        return $this->renderDisplay($nameInput, $valueInput[$nameInput]).
					$this->renderInput($nameInput,$valueInput[$nameInput], $inputType);
    }

    public function renderDisplay($nameInput = null, $valueInput = null, $img = '/images/edit.png'){
		if($img == null){
			return '<a href="javascript:void(0)" rel="edit" element-id="'.$nameInput.'">
						[Chỉnh sửa hình ảnh]
                	</a>';
		}else{
			return '<anchor id="dsp_'.$nameInput.'"><desc>' . ($valueInput) .'</desc>
                	<a href="javascript:void(0)" rel="edit" element-id="'.$nameInput.'">
						[ Chỉnh sửa ]
                	</a>
				</anchor>';
		}
    }

    public function renderInput($nameInput = null, $valueInput = null, $inputType = null,  $displayStyle = 'display:none'){
		if($inputType == 'input'){
			$content =  '<input rel="'.$nameInput.'" style="width:100%;" class="form-control" type="text" name="input_'.$nameInput.'" id="input_'.$nameInput.'" value="'.$valueInput.'">';
		}elseif($inputType == 'textarea'){
			$content =  '<textarea id="input_'. $nameInput. '" style="width:100%;" class="form-control" name="input_'. $nameInput. '">'.$valueInput.'</textarea>';
		}

		$content = '<div id="grp_input_'.$nameInput.'" style="'.$displayStyle.'">'.$content.'
						<button rel="btn-save" data-field="'.$nameInput.'"  >Save</button> </div>';

		return $content;
    }
    
    	


	public function getRoads(){
		App::import('Model', 'Road');
		$this->Road = new Road();

		return $this->Road->find('all', array('sort'=>'point'));
	}


	public function getTimeRangeRoad($from, $to, $trip_car_type = null){
		App::import('Model', 'Road');
		$this->Road = new Road();
		
		return $this->Road->query("
			SELECT DISTINCT start_time
			FROM roads
			WHERE roads.from = '".$from."' AND roads.to = '".$to."'  AND trip_car_type = '".$trip_car_type."' ORDER BY start_time");
	}

	public function getAddress(){
		App::import('Model', 'Address');
		$this->Address = new Address();
		return $this->Address->find('all');
	}


	public function getPoints(){
		App::import('Model', 'Point');
		$this->Point = new Point();
		return $this->Point->find('all');
	}


	public function getServices(){
		App::import('Model', 'Page');
		$this->Page = new Page();
		return $this->Page->find('all', array(
			'conditions'=>array(
				'group'=> SERVICE_CATEGORY_ID
				)
			)
		);

	}

}
