<?php
App::uses('AppController', 'Controller');
/**
 * Blogs Controller
 *
 * @property Blog $Blog
 * @property PaginatorComponent $Paginator
 * @property AuthComponent $Auth
 * @property SessionComponent $Session
 */
class TicketController extends AppController {
	public $name ='Ticket';
	public $uses = array('Road','Ticket','Category');
	public $paginate = array('limit'=> 100,'order'=>'Ticket.id DESC');
	public $paginateFrontEnd = array('limit'=> 10,'order'=>'Ticket.id DESC');

	public $helpers = array('Html');
	public $components = array('Paginator','Session','Auth','Upload');

	/**
	 * [beforeFilter description]
	 * @return [type] [description]
	 */
	public function beforeFilter() {
		$this->set('title_for_content',SITE_NAME);
		$this->Auth->allow('get_ticket','get_ticket_finish','get_detail_ticket', 'buy_ticket_p1', 'buy_ticket_p2', 'get_ticket_tutorial','get_from_road','get_from_to_road');

        parent::beforeFilter();
        $this->Auth->flashElement = null;
        $this->Auth->loginError = "Sai tên đăng nhập hoặc mật khẩu";
        $this->Auth->authError  = "Phiên đăng nhập đã kết thúc, phải đăng nhập lại";
        $this->Auth->userModel = 'User';
        $this->Auth->fields = array('username' => 'email', 'password' => 'password');
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'admin_index');
		$this->set('trip_car_type', trip_car_type());
		$this->set('car_type', car_type());
    }



    public function get_from_road(){
		$roads = $this->Road->find('all',
            array(
				'fields'=>array(' DISTINCT from','to'),
				'order'=>'from ASC',
				'recursive'=>0,
			)
		);

		if(empty($roads)){
			die("<option value=''>Không có dữ liệu </option>");
		}

		$option_value = "";
		$options = array();

		foreach($roads as $key => $road){
			if (!isset($options[$road['Road']['from']])) {
				$options[$road['Road']['from']] =  $road['Road']['from'];

				$option_value .= "<option value='".$road['Road']['from']."'>".$road['Road']['from'].'</option>';
			}
		}

		die($option_value);

    }


    public function get_from_to_road($from = null){
    	$from = $this->request->query['from'];
    	$to = isset($this->request->query['to']) ? $this->request->query['to'] :'';

		$roads = $this->Road->find('all',
            array(
            	'fields'=>'to',
                'conditions'=>array(
					'from'=>trim($from),
				),
				'order'=>'to'
			)
		);

		if(empty($roads)){
			die("<option value=''></option>");
		}

		$option_value = "";
		$options = array();

		foreach($roads as $key => $road){
			if (!isset($options[$road['Road']['to']]) && $road['Road']['to'] != $from) {
				$options[$road['Road']['to']] =  $road['Road']['to'];
				$selected = "";
				if ($to == $road['Road']['to']){
					$selected = 'selected="selected"';
				}
				$option_value .= "<option ". $selected ." value='".$road['Road']['to']."'>".$road['Road']['to'].'</option>';
			}
		}

		die($option_value);
    }


    public function get_detail_road(){
    	$from =isset($this->request->query['from']) ? $this->request->query['from'] :'';
    	$to = isset($this->request->query['to']) ? $this->request->query['to'] :'';


    	$road = $this->Road->find('first',
            array(
                'conditions'=>array(
					'from'=>$from,
					'to'=> $to
				)
			)
		);



    	$resp = [
    		'title'=> isset($road['Road']['title']) ? $road['Road']['title'] : '',
    		'price'=> isset($road['Road']['price']) ? number_format($road['Road']['price']) : '',
    		'long_road' => isset($road['Road']['long_road']) ? $road['Road']['long_road'] : '',
    		'from' => isset($road['Road']['from']) ? $road['Road']['from'] : '',
    	];

    	die(json_encode($resp));
    }


    public function get_ticket(){
		if(!empty($this->request->data)){
			/*$csrf = $this->request->data['csrf'];
			if($csrf != $this->Session->read(CAPTCHA_CODE)){
				$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
				$this->redirect('/mua-ve-xe-khach.html');
			}*/

			$ticket['Ticket'] = array();
			$ticket['Ticket']['name'] = $this->request->data['name'];
			$ticket['Ticket']['dob'] = $this->request->data['dob'];
			$ticket['Ticket']['phone'] = $this->request->data['phone'];
			$ticket['Ticket']['phone2'] = $this->request->data['phone_2'];
			$ticket['Ticket']['email'] = $this->request->data['email'];
			$ticket['Ticket']['province'] = $this->request->data['province'];
			$ticket['Ticket']['district'] = $this->request->data['district'];
			$ticket['Ticket']['start_date'] = date('Y-m-d', strtotime($this->request->data['date']));
			$ticket['Ticket']['road_id'] = $this->request->data['road_id'];
			$ticket['Ticket']['quantity'] = $this->request->data['quantity'];
			$ticket['Ticket']['start_time'] = $this->request->data['start_time'];
			$ticket['Ticket']['amount'] =  $this->Road->getPriceRoad($ticket['Ticket']['road_id']) * $this->request->data['quantity'];
			$ticket['Ticket']['actived'] = DISABLED;
			$ticket['Ticket']['code'] = strtoupper(substr(md5(uniqid(rand(), true)), 1, 6));
			$this->Ticket->set($ticket);
			if($this->Ticket->save()){
				$this->Session->write(SESSION_TICKET_CODE, $ticket['Ticket']['code']);
				$this->redirect('/thong-tin-mua-ve.html');
			}
		}

		$roads = $this->Road->find('all',
            array(
                'conditions'=>array(
                    'car_type'=> BUS_ID,
                    'active'=>ENABLED
				),
			'order'=>'from ASC, to, start_time, trip_car_type ')
		);

		$this->set('roads', $roads);
		$csrf = md5(uniqid(rand(), true));
		$this->set('csrf', $csrf);
		$this->Session->write(CAPTCHA_CODE, $csrf);
    }



	public function buy_ticket_p1(){
		if(empty($this->request->query)){
			$this->redirect('/');
		}

		$from = $this->request->query['from'];
		$to = $this->request->query['to'];

		$road = $roads = $this->Road->find('first',
            array(
                'conditions'=>array(
					'from'=>trim($from),
					'to'=>trim($to)
				),
			'order'=>'from ASC, to, start_time, trip_car_type ')
		);


		$this->set('road', $road);
		$this->set('quantity', $this->request->query['quantity']);
		$this->set('date', $this->request->query['date']);
		$this->set('from', $this->request->query['from']);
		$this->set('to', $this->request->query['to']);
	}


	public function buy_ticket_p2(){
		if(empty($this->request->query)){
			$this->redirect('/');
		}

		$date = $this->request->query['date'];
		$quantity = $this->request->query['quantity'];
		$road = $this->request->query['roads'];

		$this->set('quantity', $this->request->query['quantity']);
		$this->set('date', $this->request->query['date']);
		$this->set('road', $this->request->query['roads']);
		$this->set('from', $this->request->query['from']);
		$this->set('to', $this->request->query['to']);
	}


	public function get_detail_ticket($id, $slug){
		$road =  $this->Road->findFirstById($id);

		if(!empty($this->request->data)){
			/*$csrf = $this->request->data['csrf'];
			if($csrf != $this->Session->read(CAPTCHA_CODE)){
				$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
				$this->redirect('/mua-ve-xe-khach.html');
			}*/

			$road = $this->Road->findFirstById($id);
			$trip_car_type =  trip_car_type();
			$car_type =  car_type();



			$ticket['Ticket'] = array();
			$ticket['Ticket']['name'] = $this->request->data['customer_name'];
			$ticket['Ticket']['phone'] = $this->request->data['customer_phone'];
			$ticket['Ticket']['road_id'] = $id;
			$ticket['Ticket']['quantity'] = $this->request->data['number_ticket'];
			$ticket['Ticket']['start_date'] = date('Y-m-d', strtotime($this->request->data['start_time']));
			$ticket['Ticket']['actived'] = DISABLED;
			$ticket['Ticket']['start_time'] = $road['Road']['start_time'];
			$ticket['Ticket']['end_time'] = $road['Road']['end_time'];
			$ticket['Ticket']['code'] = strtoupper(substr(md5(uniqid(rand(), true)), 1, 6));
			$ticket['Ticket']['note'] = "<p>Chuyến xe: ". $road['Road']['title']. "</p>
										<p>Bắt đầu: ".$road['Road']['start_time']."</p>
										<p>Loại xe ".$trip_car_type[$road['Road']['trip_car_type']]."</p>
										<p>Ghi chú:". trim($this->request->data['note'])."</p>".trim($this->request->data['note']);

			$this->Ticket->set($ticket);
			if($this->Ticket->save()){
				$this->Session->write(SESSION_TICKET_CODE, $ticket['Ticket']['code']);
				$this->redirect('/thong-tin-mua-ve.html');
			}
		}


		$bus = $this->Road->find('all',
            array(
                'conditions'=>array(
                    'car_type'=> BUS_ID,
                    'active'=>ENABLED,
					'from'=>$road['Road']['from'],
					'to'=>$road['Road']['to']
				),
			'order'=>'from ASC, to, start_time, trip_car_type ')
		);


		$csrf = md5(uniqid(rand(), true));
		$this->set('csrf', $csrf);
		$this->Session->write(CAPTCHA_CODE, $csrf);
		$this->set('road', $road );
		$this->set('bus', $bus);
	}


	public function get_ticket_tutorial(){
		if(!empty($this->request->data)){
			/*$csrf = $this->request->data['csrf'];
			if($csrf != $this->Session->read(CAPTCHA_CODE)){
				$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
				$this->redirect('/mua-ve-xe-khach.html');
			}*/

			$road = $this->Road->findFirstById( $this->request->data['roads']);
			$trip_car_type =  trip_car_type();
			$car_type =  car_type();

			$ticket['Ticket'] = array();
			$ticket['Ticket']['name'] = $this->request->data['customer_name'];
			$ticket['Ticket']['phone'] = $this->request->data['customer_phone'];
			$ticket['Ticket']['road_id'] = $this->request->data['roads'];
			$ticket['Ticket']['quantity'] = $this->request->data['number_ticket'];
			$ticket['Ticket']['start_date'] = date('Y-m-d', strtotime($this->request->data['start_time']));
			$ticket['Ticket']['amount'] =  $this->Road->getPriceRoad($ticket['Ticket']['road_id']) * $this->request->data['number_ticket'];
			$ticket['Ticket']['actived'] = DISABLED;
			$ticket['Ticket']['start_time'] = $road['Road']['start_time'];
			$ticket['Ticket']['end_time'] = $road['Road']['end_time'];
			$ticket['Ticket']['code'] = strtoupper(substr(md5(uniqid(rand(), true)), 1, 6));
			$ticket['Ticket']['note'] = "<p>Chuyến xe: ". $road['Road']['title']. "</p>
										<p>Bắt đầu: ".$road['Road']['start_time']."</p>
										<p>Loại xe ".$trip_car_type[$road['Road']['trip_car_type']]."</p>
										<p>Ghi chú:". trim($this->request->data['note'])."</p>";

			$this->Ticket->set($ticket);
			if($this->Ticket->save()){
				$this->Session->write(SESSION_TICKET_CODE, $ticket['Ticket']['code']);
				$this->redirect('/thong-tin-mua-ve.html');
			}
		}

		$this->set('roads', $this->Road->find('all',
            array(
                'conditions'=>array(
                    'car_type'=> TRAVEL_ID,
                    'active'=>ENABLED
                ),
                'order'=>'id DESC')
            )
        );

		$csrf = md5(uniqid(rand(), true));
		$this->set('csrf', $csrf);
		$this->Session->write(CAPTCHA_CODE, $csrf);
    }



	public function get_ticket_finish(){
		$ticket_code = $this->Session->read(SESSION_TICKET_CODE);

		if ($ticket_code == null){
			$this->redirect('/mua-ve-xe-khach.html');
		}
		$this->set('ticket_code', $ticket_code);
		$ticket =  $this->Ticket->findFirstByCode($ticket_code);
		$road = null;
		if (isset($ticket['Ticket']['road_id'])){
			$road = $this->Road->findFirstById($ticket['Ticket']['road_id']);
		}
		$this->set('ticket', $ticket);
		$this->set('road', $road);
	}


	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->layout = 'admin';
		$this->Paginator->settings = $this->paginate;
		$conditions = array();

		if(!empty($this->params->query)){
			if(!empty($this->params->query['searchByTitle'])){
				$conditions['title LIKE'] = "%". $this->params->query['searchByTitle']."%";
			}

			if(!empty($this->params->query['searchByCategoryId']) && $this->params->query['searchByCategoryId']!=1){
				$conditions['category_id'] = $this->params->query['searchByCategoryId'];
			}
		}

		$data = $this->Paginator->paginate('Ticket',$conditions);
		// Create beardcrumb
		$breadCurmb = array(
			'title'=>array('title'=>''),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('title'=>'Quản lý vé đặt trực tuyến ','active'=>1)
			)
		);
		$this->set('breadCurmb',$breadCurmb);
		$this->set('data',$data);
	}

	/**
	 * [admin_add description]
	 * @return [type] [description]
	 */
	public function admin_add() {
		$this->layout = 'admin';
		$roadData = $this->Road->createDefault();
		$this->set('data',$roadData);
		$bInsert = false;

		// Create Breadcurmb
		$breadCurmb = array(
			'title'=>array('title'=>'Quản lý chuyến xe '),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('link'=>'/admin/roads/','title'=>'Chuyến xe '),
				array('link'=>'','title'=>'Thêm mới','active'=>1)
			)
		);
		$this->set('breadCurmb',$breadCurmb);

		if(isset($this->request->data['Road'])){
			$this->set('data', $this->request->data);
			$this->Road->set($this->request->data);
			if($this->Road->save()){
				$this->Session->setFlash('Hình ảnh cho blog đã được xóa','flash/success');
				$this->redirect('/admin/roads/index');
			}
		}

		if(!empty($this->Road->validationErrors) && isset($this->request->data['Road'])){
			$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
		}

		if($bInsert != false){
			$this->set('data',$roadData);
		}
		$this->set('trip_car_type', trip_car_type());
		$this->set('car_type', car_type());
		$this->render('admin_edit');
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->layout = 'admin';

		if (!$this->Blog->exists($id)) {
			$this->Session->setFlash('Không có dữ liệu để cập nhật!.','flash/error');
			$this->redirect(array('controller'=>'blogs','action'=>'admin_index'));
		}

		$breadCurmb = array(
			'title'=>array('title'=>''),
			'path'=>array(
				array('link'=>SERVER,'title'=>'Trang chủ'),
				array('link'=>'/admin/roads/','title'=>'Quản lý chuyến xe '),
				array('link'=>'','title'=>'Chỉnh sửa chuyến xe','active'=>1)
			)
		);

		$this->set('breadCurmb', $breadCurmb);

		if ($this->request->is(array('post', 'put'))) {
			$this->set('data', $this->request->data);
			$this->Road->set($this->request->data);
			if($this->Road->save()){
				$this->Session->setFlash('Hình ảnh cho blog đã được xóa','flash/success');
				$this->redirect('/admin/roads/index');
			}

			if(!empty($this->Road->validationErrors) && isset($this->request->data['Road'])){
				$this->Session->setFlash('Dữ liệu không chính xác, vui lòng kiểm tra lại thông tin.','flash/error');
			}
			$this->redirect('/admin/roads/');
		}else{
			$options = array('conditions' => array('Road.' . $this->Blog->primaryKey => $id));
			$this->request->data = $this->Road->find('first', $options);
		}

		$this->set('data', $this->request->data);
	}



}
