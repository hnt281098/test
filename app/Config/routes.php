<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */

/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */


 	Router::connect('/dich-vu/*',
		array('controller' => 'Page', 'action' => 'service'),
		array()
	);

	Router::connect('/tin-tuc/:id/:slug',
		array('controller' => 'Blogs', 'action' => 'detail'),
		array(
			'pass' => array('id', 'slug'),
			'id' => '[0-9]+'
		)
	);

	Router::connect('/tin-tuc/*',
		array('controller' => 'Blogs', 'action' => 'category'),
		array()
	);


	Router::connect('/thong-tin/:id-:slug',
		array('controller' => 'Page', 'action' => 'view'),
		array(
			'pass' => array('id', 'slug'),
			'id' => '[0-9]+'
		)
	);

	Router::connect('/thong-tin/gioi-thieu',
		array('controller' => 'Page', 'action' => 'introduction'),
		array(
			'pass' => array('id', 'slug'),
			'id' => '[0-9]+'
		)
	);

	Router::connect('/thong-tin/tuyen-dung',
		array('controller' => 'Page', 'action' => 'recruitment'),
		array(
			'pass' => array('id', 'slug'),
			'id' => '[0-9]+'
		)
	);

	Router::connect('/lien-he',
		array('controller' => 'Contact', 'action' => 'index')
	);

	Router::connect('/huong-dan-mua-ve',
		array('controller' => 'Page', 'action' => 'support')
	);

	Router::connect('/huong-dan-mua-ve-tham-quan',
		array('controller' => 'Page', 'action' => 'support')
	);

	Router::connect('/mua-ve-xe-khach',
		array('controller' => 'Ticket', 'action' => 'get_ticket')
	);

	Router::connect('/mua-ve-xe-p1',
		array('controller' => 'Ticket', 'action' => 'buy_ticket_p1')
	);

	Router::connect('/get_from_road',
		array('controller' => 'Ticket', 'action' => 'get_from_road')
	);

	Router::connect('/get_detail_road',
		array('controller' => 'Ticket', 'action' => 'get_detail_road')
	);


	Router::connect('/get_from_to_road',
		array('controller' => 'Ticket', 'action' => 'get_from_to_road')
	);

	Router::connect('/mua-ve-xe-p2',
		array('controller' => 'Ticket', 'action' => 'buy_ticket_p2')
	);

	Router::connect('/mua-ve-du-lich/:id-:slug',
		array('controller' => 'Ticket', 'action' => 'get_detail_ticket'),
		array(
			'pass' => array('id', 'slug'),
			'id' => '[0-9]+'
		)
	);

	Router::connect('/mua-ve-du-lich',
		array('controller' => 'Ticket', 'action' => 'get_ticket_tutorial')
	);

	Router::connect('/thong-tin-mua-ve',
		array('controller' => 'Ticket', 'action' => 'get_ticket_finish')
	);

	Router::connect('/thong-tin/lich-trinh-chay-xe',
		array('controller' => 'Page', 'action' => 'shedule')
	);

	Router::connect('/thong-tin/bang-gia',
		array('controller' => 'Page', 'action' => 'price')
	);

	Router::connect('/dich-vu-du-lich/:id/:slug',
		array('controller' => 'Page', 'action' => 'travel_detail'),
		array(
			'pass' => array('id', 'slug'),
			'id' => '[0-9]+'
		)
	);

	Router::connect('/dich-vu/dich-vu-du-lich',
		array('controller' => 'Page', 'action' => 'travel')
	);

	Router::connect('/tim-kiem/*',
		array('controller' => 'Search', 'action' => 'index')
	);

	Router::connect('/count_user_onlines', array('controller' => 'CounterUsers', 'action' => 'countUserOnline'));
	Router::connect('/count_user_in_day', array('controller' => 'CounterUsers', 'action' => 'countUserInDay'));
	Router::connect('/count_user_in_month', array('controller' => 'CounterUsers', 'action' => 'countUserInMonth'));

	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/', array('controller' => 'home', 'action' => 'index', ));
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	Router::parseExtensions('html', 'rss');
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
