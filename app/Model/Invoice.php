<?php

/**
* @author : Long Tran Thanh
* @date_create: 2015-03-18 06:10:39
*/

class Invoice extends AppModel
{
    public $useDbConfig = 'order';
	public $name = 'Invoice';
	public $primaryKey = 'ID';
    public $useTable = 'invoices';
}
