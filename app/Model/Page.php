<?php

/**
* @author : Long Tran Thanh
* @date_create: 2015-03-18 06:10:39
*/

class Page extends AppModel
{
	public $name = 'Page';
	public $primaryKey = 'id';

	public $validate = array(
		'title'=> array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Không tìm thấy dữ liệu '
			)
		),
	);

	public $hasMany = array(
        'PageImage' => array(
            'className' => 'PageImage',
            'foreignKey'=> 'page_id',
            'order'=>'id ASC'
        ),
    );


	/**
	 * [getByKey description]
	 * @param  [type] $key [description]
	 * @return [type]      [description]
	 */
	public function getByKey($key = null){
		if($key == null){
			return null;
		}

		$params = array(
			'conditions'=>array(
				'key'=> trim($key)
				)
			);

		return $this->find('first', $params);
	}

	/**
	 * [getByKeys description]
	 * @param  [type] $key [description]
	 * @return [type]      [description]
	 */
	public function getByKeys($key = null){
		if($key == null){
			return null;
		}

		$params = array(
			'fields'=>array('id','title','description','link'),
			'conditions'=>array(
				'OR'=> array(
					'key'=> $key
					)
				),
			);

		return $this->find('all', $params);
	}

	/**
	 * Get by Group
	 *
	 * @param [type] $key
	 * @return void
	 */
	public function getContentByGroup($groupId = null, $resp = 'list'){
		if($groupId == null){
			return null;
		}

		$params = array(
			'conditions'=>array(
				'group'=> $groupId
				)
			);

		return  $this->find($resp, $params);
	}
}
