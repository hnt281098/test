<?php
class BlogImage extends AppModel{
	/**
	 * [beforeDelete description]
	 * @param  boolean $cascade [description]
	 * @return [type]           [description]
	 */
	public function beforeDelete($cascade = true) {
		if($this->id==null){
			return null;
		}

		$dataImageBlog = $this->findById($this->id);
		if(!empty($dataImageBlog)){
			@unlink(WWW_ROOT. $dataImageBlog['BlogImage']['url']);
		}
	}

	/**
	 * [deleteByBlogId description]
	 * @param  [type] $blogId [description]
	 * @return [type]         [description]
	 */
	public function deleteByBlogId($blogId = null){
		if($blogId == null){
			return null;
		}
		$params = array(
			'conditions'=>array(
				'blog_id'=> $blogId
			)
		);

		$dataBlogImage = $this->find('all', $params);
		foreach ($dataBlogImage as $key => $blogImage) {
			$this->id = $blogImage['BlogImage']['id'];
			@unlink(WWW_ROOT. $dataImageBlog['BlogImage']['url']);
			$this->delete();
		}

		@rmdir(WWW_ROOT. 'img'. DS. 'blog' . DS. $blogId);
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
		'blog_id'=> array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Nội dung của bài viết không được để trống',
			),
		)
	);

}