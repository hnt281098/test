<?php
class PageImage extends AppModel{

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
			@unlink(WWW_ROOT. $dataImage['PageImage']['url']);
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
				'page_id'=> $roadId
			)
		);

		$dataPageImage = $this->find('all', $params);
		foreach ($dataPageImage as $key => $pageImage) {
			$this->id = $pageImage['PageImage']['id'];
			@unlink(WWW_ROOT. $pageImage['PageImage']['url']);
			$this->delete();
		}

		@rmdir(WWW_ROOT. 'img'. DS. 'page' . DS. $roadId);
	}

	/**
	 * [$validate description]
	 * @var array
	 */
	public $validate = array(
		'page_id'=> array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Không tìm thấy nội dung bài viết ',
			),
		)
	);

}