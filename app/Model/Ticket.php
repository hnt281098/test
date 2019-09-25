<?php

/**
* @author : Long Tran Thanh
* @date_create: 2015-03-18 06:10:39
*/

class Ticket extends AppModel
{
    //public $useDbConfig = 'package';
    public $name = 'Ticket';
	public $primaryKey = 'id';
    public $useTable = 'tickets';

    public $belongsTo = array(
        'Road' => array(
            'className' => 'Road',
            'foreignKey' => 'road_id'
        )
    );


}
