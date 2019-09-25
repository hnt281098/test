<?php
class BlogComment extends AppModel{

	/**
	 * [getCommentNews description]
	 * @param  [type] $categoryId [description]
	 * @return [type]             [description]
	 */
	public function getCommentNews($categoryId = null, $limit = 3){
		if($categoryId == null){
			return null;
		}

		$params = array(
			'fields'=>array(
				'Blog.id',
				'count(BlogComment.id) as total_comment',
				'Blog.title',
			),
			'joins'=>array(
				array(
					'table'=>'blogs',
					'alias'=>'Blog',
					'type'=>'INNER',
					'conditions'=>array(
						'Blog.id = BlogComment.blog_id'
					)
				)
			),
			'conditions'=>array(
				'category_id IN '=> $categoryId,
				'visiabled'=> ENABLED
			),
			'group'=>'blog_id',
			'order'=>'total_comment DESC',
			'limit'=>$limit
		);

		return $this->find('all', $params);

	}


}