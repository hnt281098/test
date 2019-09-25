<?php
App::uses('AppModel', 'Model');
/**
 * Blog Model
 *
 */
class Blog extends AppModel {


	public $hasMany = array(
        'BlogImage' => array(
            'className' => 'BlogImage',
            'foreignKey'=> 'blog_id',
            'order'=>'thumbnail DESC'
        ),

        'BlogComment'=>array(
        	'className'=>'BlogComment',
        	'conditions' => array('visiabled' => ENABLED),
        	'foreignKey'=> 'blog_id',
    	)
    );


	public $validate = array(

		'title' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Tiêu đề của bài viết không được để trống',
				'last' => true,
			),
			'maxLength' => array(
				'rule' => array('maxLength','255'),
				'message' => 'Tiêu đề bài viết không quá 255 ký tự',
			),
		),

		'description'=> array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Nội dung của bài viết không được để trống',
			),
		)
	);


	/**
	 * [beforeSave description]
	 * @param  array  $options [description]
	 * @return [type]          [description]

	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['description'])) {
	        $this->data[$this->alias]['description'] = strip_tags($this->data[$this->alias]['description'],'<table><tr><td><th><p><br><b><i><a><img>');
	    }
	    return true;
	}
	*/
	/**
	 * [getBlogbyCategory description]
	 * @param  [type] $categoryId [description]
	 * @return [type]             [description]
	 */
	public function getBlogByCategory($categoryId = null, $bGetSub = false){
		if($categoryId ==null){
			return null;
		}
        $allCategoryId[] = $categoryId;

		if($bGetSub == true){
			App::import('model','Category');
			$category = new Category;
			$subCategory = $category->find('list',array('conditions'=>array('parent_id'=> $categoryId)));
			$allCategoryId = array_merge($allCategoryId,array_keys($subCategory));
		}


		$params = array(
			'conditions'=>array(
                        'category_id'=> $allCategoryId
                        )
                );

		return $this->find('all', $params);
	}

	/**
	 * [getWidget description]
	 * @return [type] [description]
	 */
	public function getWidget($limit = 3, $categoryId = null){
		// Get news lastest
		$params = array(
			'fields'=>array('id','title'),
			'conditions'=>array(
				'category_id'=> $categoryId,
				),
			'order'=>'id DESC',
			'limit'=>$limit,
		);

		$widget['news'] = $this->find('all', $params);

		return $widget;
	}

	/**
	 * [planningNews description]
	 * @return [type] [description]
	 */
	public function getPlanning(){
		// Get news lastest
		$params = array(
			'conditions'=>array(
				'category_id'=>PLANING_CATEGORY_ID,
				),
			'order'=>'id DESC',
			'limit'=>7,
		);

		return $this->find('all', $params);
	}

	/**
	 * [getOtherBlogs description]
	 * @return [type] [description]
	 */
	public function getEachByCategories($categoriesId = null, $getSubCategories = false, $limitGroup = 5){
		if($categoriesId == null){
			return false;
		}

		if($getSubCategories == true){

			App::import('Model','Category');
			$category = new Category;
			$tmpSubCategory = $category->getSubCategoriesByParentId($categoriesId);
           	$tmpSubCategory[] = $categoriesId ;

            $params = array(

				'conditions'=>array(
					'category_id'=> $tmpSubCategory
				),
				'order'=> 'created DESC',
				'limit'=> $limitGroup
			);
		}else{
			$params = array(
				'conditions'=>array(
					'category_id'=> $categoriesId
				),
				'limit'=> $limitGroup,
				'order'=> 'category_id, id DESC'
			);
		}

		return $this->find('all', $params);
	}

	/**
	 * [blogOtherBlog description]
	 * @param  [type]  $blogId [description]
	 * @param  integer $limit  [description]
	 * @return [type]          [description]
	 */
	public function getOtherBlogs($blogId = null, $categoryId = null, $limit = 10){
		$params = array(
			'fields'=>array('id','title'),
			'conditions'=>array(
				'id <>'=> $blogId,
				'category_id'=> $categoryId
				),
			'order'=>'id DESC',
			'limit'=> $limit,
			);

		return $this->find('all', $params);
	}

	/**
	 * [getAllSubCategories description]
	 * @param  [type] $parentId [description]
	 * @return [type]           [description]
	 */
	public function getBlogData($categoryId = null,$limit = 9 ,$paging = 1){
		if($categoryId == null ){
			return null;
		}

		$conditions = array(
			'conditions'=> array(
				'category_id' => $categoryId,
				),
			'order'=> 'event_flg DESC, id DESC',
			'limit'=> $limit,
		);

		return $this->find('all', $conditions);
	}

	/**
	 * Get blog data by Groups
	 */
	public function getBlogDataByGroups($categories = null, $groupLimit = 4){
		if(empty($categories) && $groupLimit < 1 ){
			return null;
		}

		$respBlogData = null;
		foreach($categories as $categoryId){
			$respBlogData[$categoryId] = $this->getBlogData($categoryId, $groupLimit);
		}

		return $respBlogData;
	}

}
