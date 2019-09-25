<?php

/**
* @author : Long Tran Thanh
* @date_create: 2015-03-18 06:10:39
*/

class Slider extends AppModel
{
	var $name = 'Slider';
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

		$imageData = $this->findByImage($imageUrl);
		if(empty($imageData)){
			$data['Slider']['image'] = $imageUrl;
			$data['Slider']['text1'] = null;
			$data['Slider']['text2'] = null;
			$data['Slider']['position'] = 0;
			$data['Slider']['color'] = null;
			$data['Slider']['created'] = date('Y-m-d H:i:s');
			$data['Slider']['updated'] = date('Y-m-d H:i:s');
			
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
			'fields'=> array('id','image','text1','text2','position','color'),
			'conditions'=>array(
				'image'=>$imageList
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
	public function updateText($id = null, $field = null , $text = null){
		if($id == null || $field == null ){
			return null;
		}
		
		$this->updateAll(
			array($field => "'". mysql_escape_string($text) ."'"),
			array('id'=> $id)
		);
	}
}