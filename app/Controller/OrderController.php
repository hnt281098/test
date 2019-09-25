<?php
define('_PATH_BANK_SERVER','http://viettanphat.com/online/ketoan_api_link/');

class OrderController extends AppController{
	public $name ='order';
	public $layout = 'home';
	public $uses = array('Invoice');


    public $namefileSev="finance_c73d43g78d0309bd0292.php";
    public $client;

	/**
	 * Connect to API
	 */
	private function _connectApi(){
		include ROOT . DS . APP_DIR.DS.'Lib'.DS.'nusoap.php';
        $this->client = new nusoap_client(_PATH_BANK_SERVER.$this->namefileSev."?wsdl","wsdl");
	}


    /**
     * Get banks list
     */
    public function banks($type = "string"){
		$this->_connectApi();
        $result = $this->client->call('BANK.listbank',array("clientcode"=>'admin',"type"=>$type));

        die(json_encode(unserialize($result)));
    }

	/**
	 * Get account banks
	 */
	public function account($bankName = null){
		if($bankName == null){
			return null;
		}

		$this->_connectApi();
		$result = $this->client->call('BANK.listBankAccount',array("gateway"=>$bankName,"type"=>"_","return"=>"string"));
        $result = json_decode($result,true);

		$account = array_keys($result);
		die(implode("",$account));
	}

	/**
	 * Update into database
	 */
	public function store(){
		if(!isset($this->data['name']) ||
			!isset($this->data['phone']) ||
			!isset($this->data['banks']) ||
			!isset($this->data['recived_account']) ||
			!isset($this->data['amount']) ||
			!isset($this->data['send_account']) ||
			!isset($this->data['token_key'])
		){
			$this->Session->setFlash('Dữ liệu nhập vào đang bị lỗi.--','flash/error');
			$this->redirect($this->referer());
		}

		$note = '<span style=\"font-weight:bold\">Ngày: ' . date ( "d-m-Y H:i:s" ) . '</span>\n';
		$note .= 'Người gửi: ' . $this->data['name'] . "\n";
		$note .= 'SĐT: ' . $this->data['phone'] . "\n";
		$note .= 'Tên Ngân hàng: ' . $this->data['banks'] . "(". $this->data['recived_account']. ")"."\n";
		$note .= 'Mã gửi tiền: ' . $this->data['send_account']  . "\n";
		$note .= 'Số tiền: ' . $this->data['amount'] . "\n";
		$note .= 'Ghi chú: ' . $this->data['note'] . "\n";

		$invoice = array (
            "userid" => $this->data['name'],
            "promotion" => $this->data['phone'],
            "orderid" => strtotime ( date ( "Y-m-d H:i:s" ) ),
            "balance" => (float) $this->data['amount'],
            "note" => $note,
            "status_code" => 0,
            "type" => 'deposit',
            "created_by" => 'web',
            "created_at" => strtotime ( date ( "Y-m-d H:i:s" ) ),
            "`status`" => 0,
            "gateway" => $this->data['banks'],
            "bank_transactionlog" => '',//$cus_note,
            "bno" => $this->data['recived_account']
        );

		if(!$this->Invoice->save($invoice)){
			$this->Session->setFlash('Dữ liệu nhập vào đang bị lỗi.','flash/error');
			$this->redirect($this->referer());
		}

		$this->Session->setFlash('Yêu cầu của bạn đã được gởi.  Vui lòng  chờ chúng tôi xử lý trong 5 phút.','flash/success');
		$this->redirect($this->referer());

	}
}
?>
