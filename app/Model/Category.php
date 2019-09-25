<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 */
class Category extends AppModel {
	public $actsAs = array('Tree');
	public $categories = null;
	/**
	 * [beforeDelete description]
	 * @param  boolean $cascade [description]
	 * @return [type]           [description]
	 */
	public function beforeDelete($cascade = true) {
		if($this->id==null){
			return null;
		}
		$this->deleteByParentId($this->id);
	}

	/**
	 * [deleteByParentId description]
	 * @param  [type] $categoryId [description]
	 * @return [type]             [description]
	 */
	public function deleteByParentId($categoryId = null){
		if($categoryId == null){
			return null;
		}

		$conditions = array('parent_id'=> $categoryId);
		$this->deleteAll($conditions);
	}

	/**
	 * [getCategoryDatas description]
	 * @param  [type] $categoryId [description]
	 * @return [type]             [description]
	 */
	public function getCategoryDatas($categoryId = null, $findBy = 'all', $orderBy = null){
		if($categoryId== null){
			return null;
		}

		$params = array(
			'conditions'=>array(
				'parent_id'=>$categoryId
				)
			);

		if($orderBy!=null){
			$params['order'] = $orderBy;
		}

		return $this->find($findBy ,$params);
	}

	/**
	 * [getCategoryAll description]
	 * @return [type] [description]
	 */
	public function getCategoryAll(){
		return $this->find('list');
	}

	/**
	 * [getSubCategories description]
	 * @param  [type] $parentId [description]
	 * @return [type]           [description]
	 */
	public function getSubCategories($parentId = null,$sortBy = 'id DESC'){
        if($parentId == null){
            return null;
        }

        $params = array(
            'conditions'=>array(
                'parent_id'=> $parentId
            ),
         	'order'=>$sortBy,
        );

        return $this->find('list', $params);
    }

    /**
     * [getSubCategoriesByParentId description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getSubCategoriesByParentId($id){
    	$this->getChildren($id);
    	return $this->categories;
    }


    /**
     * [getAll description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    private function getChildren($id = null){
    	//return $this->children($id);
    	$categories =  $this->find('threaded',
						array('conditions'=>
							array(
								'parent_id'=>$id
							),
							'order'=>'ord ASC'
						)
					);

    	foreach ($categories as $key => $category) {
			if(!empty( $category['Category']['id'])){
				$this->categories[$category['Category']['parent_id']][] = array(
					'id'=>	$category['Category']['id'],
					'name'=>	$category['Category']['name'],
					'url'=> $category['Category']['url'],
					'icon'=> $category['Category']['icon'],
					'key'=> $category['Category']['key'],
					);
				$this->getChildren($category['Category']['id']);
			}
    	}
    }

    /**
     * [getCategoryList description]
     * @param  [type] $parentId [description]
     * @return [type]           [description]
     */
    public function getCategoryList($parentId = null){
    	if($parentId == null){
    		return null;
    	}

    	$subCategory = $this->children($parentId);
    	$respCategory = null;

    	foreach ($subCategory as $key => $category) {
    		if(!isset($respCategory[$category['Category']['parent_id']])){
    			$respCategory[$category['Category']['id']] = $category;
    		}else{
    			$respCategory[$category['Category']['parent_id']]['children'][] = $category;
    		}
    	}
    	return $respCategory;
    }


    /**
     * [getSubCategoriesKey description]
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public function getSubCategoriesKey($key = null, $findBy = 'all'){
    	if($key == null){
    		return null;
    	}

    	// Get key Id
    	$category = $this->findByKey($key);
    	if(!isset($category['Category']['id'])){
    		return null;
    	}

    	return $this->getCategoryDatas($category['Category']['id'], $findBy);
    }

}
