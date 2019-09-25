<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */


App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array('Cookie','Session','Captcha');
	public $uses = array('Category','Page','Blog');



	/**
	 * [beforeFillter description]
	 * @return [type] [description]
	 */
	public function beforeFilter()	{
		parent::beforeFilter();
		// Set title
		$websiteInfo = $this->getJsonDataFile();
		$menuHeader = $this->Category->getCategoryDatas(MENU_WEBSITE_ID,"all", "ord ASC ");
		$this->set('menuHeader', $menuHeader);

		$menuTops = $this->Category->getCategoryDatas(TOP_MENU_WEBSITE_ID,"all", "ord ASC ");
		$this->set('menuTops', $menuTops);

		$this->set('websiteInfo',$websiteInfo);
		$this->set('token_key', md5(uniqid(rand(), true)));
		// Create tokenKey
		// Count user access
		$this->counterUser();
	}



    /**
     * [_getWidget description]
     * @return [type] [description]
     */
    public function getWidget(){

    	$widget = $this->Blog->getWidget(5, NEWS_CATEGORY_ID);
    	$widget['page'] = $this->Page->getByKeys(
    		array(
    			'loi-gioi-thieu',
    			'lich-su-hinh-thanh',
    			'cac-nganh-nghe-kinh-doanh',
    			'ho-so-nang-luc'
    			)
    		);

    	return $widget;
    }


	/**
	 * [countFileUpload description]
	 * @return [type] [description]
	 */
	public function countFileUpload($insertFile = null){
		if(isset($insertFile[0]['size'])  && $insertFile[0]['size']==0){
			return false;
		}
		$totalFileUpload = 0;
		foreach ($insertFile as $image) {
			if($image['size'] > 0){
				$totalFileUpload++;
			}
		}

		return $totalFileUpload;
	}

	/**
	 * [getSlider description]
	 * @return [type] [description]
	 */
	public function getSlider(){
		$handle = opendir(LIBRARY_DIR.DS.'slider' );
		$imageSlider = array();
        while($file = readdir($handle)){
            if($file !== '.' && $file !== '..' ){
                $imageSlider[] = $file;
            }
        }

        return $imageSlider;
	}

	/**
	 * [getSlider description]
	 * @return [type] [description]
	 */
	public function getCustomer(){
		$handle = opendir(LIBRARY_DIR.DS.'customer' );
		$imageSlider = array();
        while($file = readdir($handle)){
            if($file !== '.' && $file !== '..' ){
                $imageSlider[] = $file;
            }
        }

        return $imageSlider;
	}


	/**
	 * [getFooter description]
	 * @return [type] [description]
	 */
	public function getFooter(){
		$this->loadModel('Page');
		$footer = $this->Page->getByKey('address-footer');
		$this->set('footer', $footer);
	}

	/**
	 * [layoutForFrontEnd description]
	 * @return [type] [description]
	 */
	public function layoutForFrontEnd(){
		$menuHeader = $this->Category->getCategoryDatas(WEBSITE_CATEGORY_ID);
		// Get slider
		$slider = $this->getSlider();
		//Get footer
		$this->getFooter();

		$this->set('menuHeader', $menuHeader);
		$this->set('title_for_content',SITE_NAME);
		$this->set('slider',$slider);

	}


	/**
	 * [getRate description]
	 * @return [type] [description]
	 */
	public function getRate(){
		$fileExport = ROOT . DS . APP_DIR.DS.'tmp' .DS. 'cache'. DS. 'rateExchange.xml';

		if (file_exists($fileExport) && date ("Ymd", filemtime($fileExport)) === date('Ymd')) {
			$jsonExrate = file_get_contents($fileExport);
			return json_decode($jsonExrate, true);
		}else{

			@unlink($fileExport);
			$url = 'http://www.vietcombank.com.vn/ExchangeRates/ExrateXML.aspx';
			$xmlData = file_get_contents($url);
			// Create file
			$jsonExrate = json_encode($this->_createDataXml($xmlData));
			// Write file
			$handle = fopen($fileExport, 'w+');
			fwrite($handle, $jsonExrate);
			fclose($handle);

			return json_decode($jsonExrate, true);
		}
	}

	/**
	 * [_getDataXml description]
	 * @return [type] [description]
	 */
	private function _createDataXml($xmlData = null){
		if($xmlData == null){
			return null;
		}

		$respExrate = null;
		$foreign = array('USD','EUR','SGD','AUD','JPY');
		App::uses('Xml', 'Utility');
		$foreignExchange = Xml::toArray(Xml::build($xmlData));

		foreach ($foreignExchange['ExrateList']['Exrate'] as $key => $exrate) {
			$currencyCode =  $exrate['@CurrencyCode'];
			if(in_array($exrate['@CurrencyCode'],$foreign )){
				$respExrates[] = $exrate;
			}
		}

		return array(
			'data'=>$respExrates,
			'DateTime'=>$foreignExchange['ExrateList']['DateTime'],
			'source'=>$foreignExchange['ExrateList']['Source']
		);
	}

	/**
	 * [getJsonDataFile description]
	 * @param  [type] $fileExport [description]
	 * @return [type]             [description]
	 */
	public function getJsonDataFile($fileExport = CONFIGURATION_FILE){
		if (!file_exists($fileExport)) {
				return null;
		}

		$jsonExrate = file_get_contents($fileExport);
		return json_decode($jsonExrate, true);
	}

	/**
	 * [setJsonDataFile description]
	 * @param [type] $jsonData [description]
	 */
	public function setJsonDataFile($jsonData = null, $fileExport = CONFIGURATION_FILE){
		if ($jsonData == null || $fileExport == null) {
			return null;
		}

		// Write file
		$handle = fopen($fileExport, 'w+');
		fwrite($handle, $jsonData);
		fclose($handle);

		return true;
	}

	/**
	 * [getImageLibrary description]
	 * @return [type] [description]
	 */
	public function getImageLibrary(){
		$handle = opendir(LIBRARY_DIR.DS.'library' );
		$imageLibrary = array();
        while($file = readdir($handle)){
            if($file !== '.' && $file !== '..' ){
                $imageLibrary[] = $file;
            }
        }
        return $imageLibrary;
	}

	/**
	 * [_createCaptra description]
	 * @return [type] [description]
	 */
	public function get_captcha()
	{
	    $this->autoRender = false;
	    App::import('Component','Captcha');
	    //generate random charcters for captcha
	    $random = mt_rand(10000, 99999);

	    //save characters in session
	    $this->Session->write(CAPTCHA_CODE, $random);

	    $settings = array(
			'characters' => $random,
			'winHeight' => 40,         // captcha image height
			'winWidth' => 220,		   // captcha image width
			'fontSize' => 16,          // captcha image characters fontsize
			// 'fontPath' => WWW_ROOT.'tahomabd.ttf',    // captcha image font
			'noiseColor' => '#ccc',
			'bgColor' => '#fff',
			'noiseLevel' => '100',
		  	'textColor' => '#000'
	    );

      	header('Content-type: image/jpeg');
	    $img = $this->Captcha->ShowImage($settings);
	    echo $img;
	}

	/**
	 * [_counterUser description]
	 * @return [type] [description]
	 */
	function counterUser() {
		//set ip, current time, time out
        $now = time();
        $time_out = 120;
        $ip_address = $_SERVER['REMOTE_ADDR'];

		$this->loadModel('CounterUser');
		//get user by ip client
        $user_online = $this->CounterUser->find(
            'first',
            array(
                'conditions' => array('ip_address' => $ip_address),
                'order' => array('CounterUser.id DESC'),
            )
		);
		//count user
        if(empty($user_online) || strtotime($user_online['CounterUser']['last_visit']) + $time_out < $now) {
            $user_online_new = $this->CounterUser->create();
            $user_online_new['ip_address'] = $ip_address;
            $user_online_new['last_visit'] = date('Y-m-d H:i:s', time());
            $this->CounterUser->save($user_online_new);
        }
    }
}
