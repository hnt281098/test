<?php

class ImagesController extends AppController{
	public $name ='Images';
	public $layout = 'admin';
	public $components = array('Cookie','Auth','Session','Upload');
	public $uses = array('Slider','Customer');

	public $uploadDirectory = null;
	public $uploadSlider = null;
	public $allowedExt = null;

	/**
	 * [beforeFilter description]
	 * @return [type] [description]
	 */
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('view');
        $this->Auth->flashElement = null;
        $this->Auth->loginError = "Sai tên đăng nhập hoặc mật khẩu";
        $this->Auth->authError  = "Phiên đăng nhập đã kết thúc, phải đăng nhập lại";
        $this->Auth->userModel = 'User';
        $this->Auth->fields = array('username' => 'email', 'password' => 'password');
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'admin', 'action' => 'index');

        $this->uploadDirectory = WWW_ROOT. 'images'. DS.'uploads' .DS;
        $this->uploadSlider = WWW_ROOT. 'images'. DS .'slider'. DS;
        $this->imageLibrary = WWW_ROOT. 'images'. DS .'library'. DS;
        $this->imageCustomer = WWW_ROOT.'images'.DS.'customer'.DS;

        $this->allowedExt = array('jpg','jpeg','png','gif','bmp');
    }

    /**
	 * [admin_icon description]
	 * @return [type] [description]
	 */
	function admin_icon(){
		$files = file_get_contents(WWW_ROOT .'css'.DS.'font-awesome.min.css');
		preg_match_all("/.fa(.*?){/s", $files, $outputIcons);

		$this->set('files',$outputIcons[1]);

	}

	public function view(){
		$this->layout = 'default';
		$breadCurmb = array(
			'title'=>array('title'=>'Thư viện hình ảnh '),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('title'=>'Thư viện hình ảnh ','active'=>1)
			)
		);

		$handle = opendir( $this->imageLibrary );
		$imageUploaded = array();
        while($file = readdir($handle)){
            if($file !== '.' && $file !== '..' ){
                $imageUploaded[] =  '/images/library/'.$file;
            }
        }

		$this->set('imageLibrary',$imageUploaded);
		$this->set('breadCurmb',$breadCurmb);
	}

    /**
     * [admin_index description]
     * @return [type] [description]
     */
	function admin_index(){
		$breadCurmb = array(
			'title'=>array('title'=>'Quản lý hình ảnh '),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('title'=>'Quản lý hình ảnh ','active'=>1)
			)
		);

		$this->set('breadCurmb',$breadCurmb);
		$imageUploaded = $this->_getImageFile();
		$imageSlider = $this->_getImageSlider();
		$imageCustomer = $this->_getImageCustomer();

		$textSlider = $this->retriveText($imageSlider);
		$textCustomer = $this->retriveText($imageCustomer,'customer');

		$imageLibrary = $this->_getImageLibrary();
		$this->set('imageUploaded', $imageUploaded);
		$this->set('imageSlider', $imageSlider);
		$this->set('imageLibrary',$imageLibrary);
		$this->set('textSlider', $textSlider);
		$this->set('imageCustomer', $imageCustomer);
		$this->set('textCustomer',$textCustomer);
	}

	/**
	 * [updateTextForSlider description]
	 * @param  [type] $images [description]
	 * @return [type]         [description]
	 */
	function retriveText($images = null, $directory = 'slider'){
		if(empty($images) ){
			return null;
		}
		$imageList = array();
		foreach ($images as $directoryImage => $imageTag) {

			if($directory == 'slider'){
				$imageList[] = str_replace("slider/", "",  $directoryImage);
			}else{
				$imageList[] = str_replace("customer/", "",  $directoryImage);
			}
		}

		if($directory == 'slider'){
			return $this->Slider->findByImageList($imageList);
		}else{
			return $this->Customer->findByImageList($imageList);
		}
	}

	/**
	 * [admin_text description]
	 * @return [type] [description]
	 */
	function admin_text(){
		$id = isset($this->request->query['id']) ? $this->request->query['id'] : null;
		$field = isset($this->request->query['field']) ? $this->request->query['field'] : null;
		$text = isset($this->request->query['val']) ? $this->request->query['val'] : null;
		
		if($id != null){

			$this->Slider->updateText($id, $field, $text);
		}
		die();
	}

	function admin_customer(){
		$id = isset($this->request->query['id']) ? $this->request->query['id'] : null;
		$field = isset($this->request->query['field']) ? $this->request->query['field'] : null;
		$text = isset($this->request->query['val']) ? $this->request->query['val'] : null;

		if($id != null){
			$this->Customer->updateData($id, $field, $text);
		}
		die();
	}

	/**
	 * [admin_thumb description]
	 * @return [type] [description]
	 */
	function admin_thumb(){
		$breadCurmb = array(
			'title'=>array('title'=>'Quản lý hình ảnh '),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('title'=>'Quản lý hình ảnh ','active'=>1)
			)
		);
		$this->set('breadCurmb',$breadCurmb);
		$imageUploaded = $this->_getImageFile();
		$this->set('imageUploaded', $imageUploaded);
		$this->layout ='default';
	}

	/**
	 * [admin_upload description]
	 * @return [type] [description]
	 */
	function admin_upload(){
		$this->autoRender = false;
		$data = $this->request->data;
		$folder = isset($data['folder']) ? $data['folder'] : 'uploads';
		$imageUpload = isset($data['ImageFile']) ? $data['ImageFile'] : null;

		if($this->countFileUpload($imageUpload) == 0){
			$this->Session->setFlash('Không tìm thấy file để upload.','flash/error');
			$this->redirect($this->referer);
		}

		$directory = WWW_ROOT.'images'.DS.$folder;
		// Upload to directory
		if(!is_dir($directory)){
			mkdir($directory);
		}

		foreach ($data['ImageFile'] as $image) {
			$uploadImage = $this->Upload->uploadBlogImage($image, $directory);
			if($uploadImage == false){
				$this->Session->setFlash('File upload không phù hợp.','flash/error');
				$this->redirect($this->referer);
				return false;
			}

			switch($directory){
				case WWW_ROOT.'images'.DS. 'slider':
					$this->Slider->insert($uploadImage);
				break;

				case WWW_ROOT.'images'.DS. 'customer':
					$this->Customer->insert($uploadImage);
				break;
			}

		}
		$this->Session->setFlash('Hình ảnh mới đã được tải lên hệ thống.','flash/success');
		$this->redirect('/admin/images');
	}

	/**
	 * [_getImageFile description]
	 * @return [type] [description]
	 */
	private function _getImageFile(){
		$handle = opendir( $this->uploadDirectory );
		$imageUploaded = array();
        while($file = readdir($handle)){
            if($file !== '.' && $file !== '..' ){
                $imageUploaded['uploads'. '/'. $file] =  '<img width="150px" class="img-thumbnail thumb " src="/images/uploads/'.$file.'"  />';
            }
        }

        return $imageUploaded;
	}


	private function _getImageLibrary(){
		$handle = opendir( $this->imageLibrary );
		$imageUploaded = array();
        while($file = readdir($handle)){
            if($file !== '.' && $file !== '..' ){
                $imageUploaded['uploads'. '/'. $file] =  '<img width="150px" class="img-thumbnail thumb " src="/images/library/'.$file.'"  />';
            }
        }

        return $imageUploaded;
	}


	private function _getImageCustomer(){
		$handle = opendir( $this->imageCustomer );
		$imageUploaded = array();
        while($file = readdir($handle)){
            if($file !== '.' && $file !== '..' ){
                $imageUploaded['customer'. '/'. $file] =  '<img width="150px" class="img-thumbnail thumb " src="/images/customer/'.$file.'"  />';
            }
        }

        return $imageUploaded;
	}

	

	/**
	 * [_getImageSlider description]
	 * @return [type] [description]
	 */
	private function _getImageSlider(){
		$handle = opendir( $this->uploadSlider );
		$imageSlider = array();
        while($file = readdir($handle)){
            if($file !== '.' && $file !== '..' ){
                $imageSlider['slider'.'/'.$file] =  '<img  width="250px" class="img-thumbnail " src="/images/slider/'.$file.'"  />';
            }
        }

        return $imageSlider;
	}

	/**
	 * [delete description]
	 * @param  [type] $file [description]
	 * @return [type]       [description]
	 */
	public function admin_delete($file = null){
		$this->autoRender = false;
		if(empty($this->params->query['file'])){
			$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
			$this->redirect('/admin/images');
		}
		$fileImage = WWW_ROOT. 'images'. DS.$this->params->query['file'];
		if(!file_exists($fileImage) ){
			$this->Session->setFlash('Không tìm thấy file để xóa.','flash/error');
			$this->redirect('/admin/images');
		}
		
		unlink($fileImage);
		
		//Delete in database 
		$image = str_replace("slider/","", $this->params->query['file']);
		$slider = $this->Slider->findFirstByImage($image);

		if (!empty($slider['Slider']['id'])){
			$this->Slider->delete($slider['Slider']['id']);
		}
		
		
		
		$this->Session->setFlash('Hình ảnh đã được xóa.','flash/success');
		$this->redirect($this->referer());
	}

	/**
	 * [responseMsg description]
	 * @param  [type] $str [description]
	 * @return [type]      [description]
	 */
	private function _responseMsg($str){
		return json_encode(array('status'=>$str));
	}

	/**
	 * [_getExtension description]
	 * @param  [type] $file_name [description]
	 * @return [type]            [description]
	 */
	private function _getExtension($file_name){
		$ext = explode('.', $file_name);
		$ext = array_pop($ext);
		return strtolower($ext);
	}
}
