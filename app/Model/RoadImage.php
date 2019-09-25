<?php
class RoadImage extends AppModel{

	/**
	 * [beforeDelete description]
	 * @param  boolean $cascade [description]
	 * @return [type]           [description]
	 */
	public function beforeDelete($cascade = true) {
		if($this->id==null){
			return null;
		}

		$dataImage = $this->findById($this->id);
		if(!empty($dataImage)){
			@unlink(WWW_ROOT. $dataImage['RoadImage']['url']);
		}
	}

	/**
	 * [deleteByroadId description]
	 * @param  [type] $roadId [description]
	 * @return [type]         [description]
	 */
	public function deleteByRoadId($roadId = null){
		if($roadId == null){
			return null;
		}
		$params = array(
			'conditions'=>array(
				'road_id'=> $roadId
			)
		);

		$dataRoadImage = $this->find('all', $params);
		foreach ($dataRoadImage as $key => $roadImage) {
			$this->id = $roadImage['RoadImage']['id'];
			@unlink(WWW_ROOT. $roadImage['RoadImage']['url']);
			$this->delete();
		}

		@rmdir(WWW_ROOT. 'img'. DS. 'road' . DS. $roadId);
	}

	/**
	 * [$validate description]
	 * @var array
	 */
	public $validate = array(
		'url' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Tiêu đề của bài viết không được để trống',
				'last' => true,
			)
		),
		'road_id'=> array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Nội dung của bài viết không được để trống',
			),
		)
	);

}