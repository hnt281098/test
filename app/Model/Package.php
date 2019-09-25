<?php

/**
* @author : Long Tran Thanh
* @date_create: 2015-03-18 06:10:39
*/

class Package extends AppModel
{
    public $useDbConfig = 'package';
	public $name = 'Package';
	public $primaryKey = 'phieu_id';
    public $useTable = 'tbl_phieu_chitiet';
}
