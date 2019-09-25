<?php

/**
* @author : Long Tran Thanh
* @date_create: 2015-03-18 06:10:39
*/

class Road extends AppModel
{
	public $name = 'Road';
	public $primaryKey = 'id';

	public $hasMany = array(
        'RoadImage' => array(
            'className' => 'RoadImage',
            'foreignKey'=> 'road_id',
            'order'=>'id ASC'
        ),
    );

	public $validate = array(
		'title'=> array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Không tìm thấy dữ liệu '
			)
		),
	);

	public function getByList($status = ENABLED, $car_type = null){
		return $this->find('all', array(
			'conditions'=>array(
				'active'=> $status
			),
			'order'=>'from, to, start_time'
			)
		);
	}

	public function getPriceRoad($id = null){
		if ($id == null){
			return 0;
		}

		$road = $this->findFirstById($id);
		if(empty($road)){
			return 0;
		}
		return $road['Road']['price'];

	}
}
