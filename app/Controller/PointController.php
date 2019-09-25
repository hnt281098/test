<?php

/**
* @file : PageController
* @author : Long Tran Thanh
* @date_create: 2015-03-18 08:45:23
*/

class PointController extends AppController{
    public $name = 'Point';
    public $layout = 'admin';
    public $uses = array('Point');
    public $paginate = array('limit'=> PAGINATE_NUMBER);
    public $components = array('Paginator','Session','Auth','Upload');

    /**
    * [beforeFillter description]
    * @return [type] [description]
    */
    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->flashElement = null;
        $this->Auth->allow('view');
        $this->Auth->loginError = "Sai tên đăng nhập hoặc mật khẩu";
        $this->Auth->authError  = "Phiên đăng nhập đã kết thúc, phải đăng nhập lại";
        $this->Auth->userModel = 'User';
        $this->Auth->fields = array('username' => 'email', 'password' => 'password');
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'admin_index');
        $this->Auth->allow('introduction','recruitment','support','shedule','travel','travel_detail');

        $this->set('widgets', $this->getWidget());
    }

    /**
    * [index description]
    * @return [type] [description]
    */
    function admin_index(){
        $this->layout = 'admin';
        $conditions = array();

        $this->Paginator->settings = $this->paginate;
        $pageData = $this->Paginator->paginate('Point',$conditions);
        // Create beardcrumb
        $breadCurmb = array(
            'title'=>array('title'=>'Quản lý trạm - chi nhánh'),
            'path'=>array(
                array('link'=>SERVER,'title'=>'Trang chủ'),
                array('link'=>SERVER.'admin/point/index','title'=>'Quản lý trạm - chi nhánh'),
                array('link'=>'','title'=>'','active'=>1)
            )
        );
        $this->set('breadCurmb',$breadCurmb);
        $this->set('pageData',$pageData);
    }

    /**
    * [admin_edit description]
    * @return [type] [description]
    */
    function admin_edit($id = null){
        $this->layout = 'admin';

        if (!$this->Point->exists($id)) {
            $this->Session->setFlash('Không có dữ liệu để cập nhật!.','flash/error');
            $this->redirect(array('action'=>'admin_index'));
        }
        // Create beardcrumb
        $breadCurmb = array(
            'title'=>array('title'=>'Quản lý trạm - chi nhánh'),
            'path'=>array(
                array('link'=>SERVER,'title'=>'Trang chủ'),
                array('link'=>SERVER.'admin/point/index','title'=>'Quản lý trang tĩnh'),
                array('link'=>'','title'=>'','active'=>1)
            )
        );

        $this->set('breadCurmb',$breadCurmb);
        if ($this->request->is(array('post', 'put'))) {
            $bInsert = $this->_updatePage($this->request->data);
            if(!empty($this->Point->validationErrors) && isset($this->request->data['Point'])){
                $this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
            }
            $this->redirect($this->referer());
        }else{
            $options = array('conditions' => array('Point.'. $this->Point->primaryKey =>$id));
            $this->request->data = $this->Point->find('first', $options);
        }
        $this->set('data', $this->request->data);
    }




    /**
    * [admin_add description]
    * @return [type] [description]
    */
    function admin_add($id = null){
        $this->layout = 'admin';

        $pageData= $this->Point->createDefault();
        $this->set('data',$pageData);
        $bInsert = false;
        // Create beardcrumb
        $breadCurmb = array(
            'title'=>array('title'=>'Quản lý trạm - chi nhánh'),
            'path'=>array(
                array('link'=>SERVER,'title'=>'Trang chủ'),
                array('link'=>SERVER.'admin/point/index','title'=>'Quản lý trang tĩnh'),
                array('link'=>'','title'=>'','active'=>1)
            )
        );
        $this->set('breadCurmb',$breadCurmb);
        if(isset($this->request->data['Point'])){
            $this->set('data', $this->request->data);
            $bInsert = $this->_updatePage($this->request->data);

            if(!empty($this->Point->validationErrors) && isset($this->request->data['Page'])){
                $this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
                $this->redirect($this->referer());
            }else{
                $pageId = $this->Point->getLastInsertID();
                $this->redirect('/admin/point/edit/'.$pageId);
            }
        }

        if($bInsert == true){
            $this->set('data',$pageData);
        }


        $this->render('admin_edit');
    }


    /**
    * [update description]
    * @return [type] [description]
    */
    private function _updatePage($data = null){
        if($data == null){
            return false;
        }
        $flagUploadFile = false;
        if(!empty($data['Point']['image'])){
            $directory = WWW_ROOT.'images'.DS.'point';
            // Upload to directory
			if(!is_dir($directory)){
				mkdir($directory);
			}

            $fileImagePageUpload = $this->Upload->uploadBlogImage($data['Point']['image'], $directory);
            if($fileImagePageUpload!==false){
                $data['Point']['image'] = '/images/point/'. $fileImagePageUpload;
                $flagUploadFile = true;
            }
        }

        if($flagUploadFile == false){
            unset($data['Point']['image']);
        }

        // Clear all of image files;
        $this->Point->set($data['Point']);
        if(!$this->Point->save()){
            return false;
        }

        return true;
    }
}
