<?php

/**
* @author : Long Tran Thanh
* @date_create: 2015-03-18 06:10:39
*/

class Customer extends AppModel
{
	var $name = 'Customer';
	var $primaryKey = 'id';


	/**
	 * [insert description]
	 * @param  [type] $imageUrl [description]
	 * @return [type]           [description]
	 */
	public function insert($imageUrl = null){
		if($imageUrl == null){
			return null;
		}

		$imageData = $this->findByLogo($imageUrl);
		if(empty($imageData)){
			$data['Customer']['logo'] = $imageUrl;
			$data['Customer']['title'] = null;
			$data['Customer']['address'] = null;
			$data['Customer']['website'] = null;

			$data['Customer']['created'] = date('Y-m-d H:i:s');
			$data['Customer']['updated'] = date('Y-m-d H:i:s');

			$this->set($data);
			$this->save();
		}
	}

	/**
	 * [findByImageList description]
	 * @param  [type] $imageList [description]
	 * @return [type]            [description]
	 */
	public function findByImageList($imageList = null){
		if($imageList == null){
			return null;
		}

		$conditions = array(
			'fields'=> array('id','logo','title','website','address'),
			'conditions'=>array(
				'logo'=>$imageList
				)
			);
		return $this->find('all',$conditions);
	}

	/**
	 * [updateText description]
	 * @param  [type] $id    [description]
	 * @param  [type] $field [description]
	 * @param  [type] $text  [description]
	 * @return [type]        [description]
	 */
	public function updateData($id = null, $field = null , $text = null){
		if($id == null || $field == null || $text == null){
			return null;
		}

		$this->updateAll(
			array($field => "'". mysql_escape_string($text) ."'"),
			array('id'=> $id)
		);
	}
}