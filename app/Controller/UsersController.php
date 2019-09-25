<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');


class UsersController  extends AppController
{
    public $name = "users";
    public $layout = 'admin';
    public $viewPath = 'Users';
    public $uses = array('User');
    public $components = array('Paginator','Session','Auth','Upload');

    /**
     * [beforeFilter description]
     * @return [type] [description]
     */
    public function beforeFilter(){
        parent::__construct();
        config('system');
        $this->set('title_for_layout',SITE_NAME);

        $this->Auth->flashElement = null;
        $this->Auth->loginError = "Sai tên đăng nhập hoặc mật khẩu";
        $this->Auth->authError  = "Phiên đăng nhập đã kết thúc, phải đăng nhập lại";
        $this->Auth->userModel = 'User';
        $this->Auth->fields = array('username' => 'email', 'password' => 'password');
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array(SERVER. '/admin/users/index');

    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index(){
        $this->redirect('admin/users/index');
    }


    /**
     * [admin_login description]
     * @return [type] [description]
     */
    public function admin_login() {
        $this->redirect('/users/login');
    }


    /**
     * [admin_add description]
     * @return [type] [description]
     */
    public function admin_add(){
        $userCurrentLogin = $this->Session->read(SESSION_ADMIN_DATA);

        if(empty($userCurrentLogin)|| $userCurrentLogin['User']['role']!=='admin'){
            $this->Session->setFlash('Tài khoản không có quyền ','flash/error',array(),'auth');
            $this->redirect(array('controller'=>'users','action'=>'admin_index'));
        }

        if($this->request->is('post')){
            $this->User->set($this->request->data);
            if(!$this->User->save()){
                $this->Session->setFlash('Tài khoản không có quyền hoặc thiếu thông tin ','flash/error');
            }else{
                $this->Session->setFlash('Đã tạo thêm tài khoản sử dụng','flash/success');
            }

            $this->redirect(array('controller'=>'users','action'=>'admin_index'));
        }
    }

    /**
     * [admin_index description]
     * @return [type] [description]
     */
    public function admin_index(){
        $this->layout = 'admin';
        $breadCurmb = array(
            'title'=>array('title'=>'Quản lý thành viên'),
            'path'=>array(
                array('link'=>SERVER,'title'=>'Trang chủ'),
                array('title'=>'Quản lý tài khoản hệ thống','active'=>1)
            )
        );
        $this->set('breadCurmb',$breadCurmb);

        $this->Paginator->settings = $this->paginate;
        $conditions = array();

        $userData = $this->Paginator->paginate('User',$conditions);
        $this->set('userData', $userData);
    }

    /**
     * [changepassword description]
     * @return [type] [description]
     */
    function admin_changepassword($id = null ){
        $userCurrentLogin = $this->Session->read(SESSION_ADMIN_DATA);

        if( $userCurrentLogin['User']['role']!='admin' && $id != $userCurrentLogin['User']['id']){
            $this->Session->setFlash('Tài khoản không có quyền ','flash/message_error',array(),'auth');
            $this->redirect(array('controller'=>'users','action'=>'admin_index'));
        }

        $this->layout = 'admin';
        $breadCurmb = array(
            'title'=>array('title'=>''),
            'path'=>array(
                array('link'=>SERVER,'title'=>'Trang chủ'),
                array('title'=>'Quản lý tài khoản hệ thống','active'=>1)
            )
        );
        $this->set('breadCurmb',$breadCurmb);

        if(!empty($this->request->data['userId'])){
            $password = @$this->request->data['password'];
            $passwordConfirmtion = @$this->request->data['password_confirmtion'];
            if($password == '' || $passwordConfirmtion=='' || $passwordConfirmtion != $password){
                $this->Session->setFlash('Tên đăng nhập hoặc mật khẩu không chính xác','flash/message_error');
                $this->redirect(array('controller'=>'users','action'=>'admin_index'));
            }
            $data['User']['password'] = $password ;
            $data['User']['id'] = $id ;
            $this->User->set($data);
            if(!$this->User->save()){
                $this->Session->setFlash('Tên đăng nhập hoặc mật khẩu không chính xác','flash/message_error');
                $this->redirect(array('controller'=>'users','action'=>'admin_index'));
            }

            $this->Session->setFlash('Mật khẩu mới đã được thay đổi','flash/success');
            $this->redirect(array('controller'=>'users','action'=>'admin_index'));
        }else{
            $userData = $this->User->findById($id);
            if($userData==null){
                $this->Session->setFlash('Tên đăng nhập hoặc mật khẩu không chính xác','flash/message_error');
                $this->redirect(array('controller'=>'users','action'=>'admin_index'));
            }
            $this->set('userId', $id);
        }
    }

	
    function admin_delete_account($id = null){
	$this->autoRender = false;
        $userId = isset($this->params['pass'][0]) ? $this->params['pass']['0'] : null;
	if($userId == null){
		$this->redirect(array('controller'=>'users','action'=>'admin_index'));			
	}

	$userCurrentLogin = $this->Session->read(SESSION_ADMIN_DATA);

        if($userCurrentLogin['User']['role']!=='admin' &&  $id != $userCurrentLogin['User']['id']){
		$this->Session->setFlash('Tài khoản không có quyền ','flash/message_error',array(),'auth');
             	$this->redirect(array('controller'=>'users','action'=>'admin_index'));
        }
	
	$this->User->delete($userId);
	$this->Session->setFlash('Mật khẩu mới đã được thay đổi','flash/success');
        $this->redirect(array('controller'=>'users','action'=>'admin_index'));
		
    }

    /**
     * [adminChangEmail description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function admin_change_email($id = null){
        $userCurrentLogin = $this->Session->read(SESSION_ADMIN_DATA);

        if( $userCurrentLogin['User']['role']!=='admin' &&  $id != $userCurrentLogin['User']['id']){
            $this->Session->setFlash('Tài khoản không có quyền ','flash/message_error',array(),'auth');
                $this->redirect(array('controller'=>'users','action'=>'admin_index'));
        }
        $this->layout = 'admin';
        $breadCurmb = array(
            'title'=>array('title'=>''),
            'path'=>array(
                array('link'=>SERVER,'title'=>'Trang chủ'),
                array('title'=>'Quản lý tài khoản hệ thống','active'=>1)
            )
        );
        $this->set('breadCurmb',$breadCurmb);

        if(!empty($this->request->data['userId'])){
            $newEmail = @$this->request->data['newEmail'];

            if($newEmail == ''){
                $this->Session->setFlash('Tên đăng nhập hoặc mật khẩu không chính xác','flash/message_error');
                $this->redirect(array('controller'=>'users','action'=>'admin_index'));
            }
            $data['User']['email'] = $newEmail ;
            $data['User']['id'] = $id ;
            $this->User->set($data);
            if(!$this->User->save()){
                $this->Session->setFlash('Tên đăng nhập hoặc mật khẩu không chính xác','flash/message_error');
                $this->redirect(array('controller'=>'users','action'=>'admin_index'));
            }

            $this->Session->setFlash('Email mới đã được cấp mới','flash/success');
            $this->redirect('/users/logout');
        }else{
            $userData = $this->User->findById($id);
            if($userData==null){
                $this->Session->setFlash('Tên đăng nhập hoặc mật khẩu không chính xác','flash/message_error');
                $this->redirect(array('controller'=>'users','action'=>'admin_index'));
            }
            $this->set('userId', $id);
            $this->set('email', $userData['User']['email']);
        }

    }


    /**
     * [login description]
     * @return [type] [description]
     */
    public function login(){
        if(!empty($this->params->data) && $this->request->is('post')){
            $passwordHasher = new BlowfishPasswordHasher();
            $data['username'] = trim($this->request->data['user']['email']);
            $data['password'] = trim($this->request->data['user']['password']);


            $arrDataUser = $this->User->find('first',array('conditions'=>array('email'=>$data['username'])));

            if(!empty($arrDataUser)){
                if(isset($arrDataUser['User']['password']) && $passwordHasher->check($data['password'],$arrDataUser['User']['password'])==true ){
                    $this->Session->write(SESSION_ADMIN_DATA, $arrDataUser);
                    $this->Auth->login($arrDataUser);
                    return $this->redirect('/admin/users/index');
                }
                else{
                    $this->Session->setFlash('Tên đăng nhập hoặc mật khẩu không chính xác','flash/message_error',array(),'auth');
                }
            }
            else{
                $this->Session->setFlash('Tên đăng nhập hoặc mật khẩu không chính xác','flash/message_error',array(),'auth');
            }
        }
    }

    /**
     * [logout description]
     * @return [type] [description]
     */
    public function logout(){
        $this->autoRender = false;
        // Delete session
        $this->Session->delete(SESSION_ADMIN_DATA);
        $this->redirect(array('controller'=>'users','action'=>'login'));
    }

}
