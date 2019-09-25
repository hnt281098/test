<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
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
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/controllers/', '/next/path/to/controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 *
 */

/**
 * Custom Inflector rules can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. Make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */

/**
 * To prefer app translation over plugin translation, you can set
 *
 * Configure::write('I18n.preferApp', true);
 */

/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter. By default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 *		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 *		'MyCacheFilter' => array('prefix' => 'my_cache_'), //  will use MyCacheFilter class from the Routing/Filter package in your app with settings array.
 *		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 *		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 *		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));

define('TOKEN_KEY','7686c00e4d30d58a58919807fcd7a72b');
define('SITE_NAME', 'Công ty cỔ phần đầu tư Nam hưng');

define('SESSION_ADMIN_DATA','Session.AdminData');
define('SESSION_USER_DATA','Session.UserData');
define('SESSION_TICKET_CODE', 'Session.TicketCode');
define('CAPTCHA_CODE','Session.CaptchaCode');
define('SERVER',$_SERVER['SERVER_NAME']=="localhost"?APP_DIR . '/' . WEBROOT_DIR . '/':Router::url('/', true) );
define('ENABLED','1');
define('DISABLED','0');
define('USER_GROUP_ID',1);

define('FLAG_ON',1);
define('FLAG_OFF',0);
define('PAGINATE_NUMBER',100);
define('PAGINATE_NUMBER_FRONT_END',15);
define("LIBRARY_DIR",WWW_ROOT.'images');
define("EXPLODE_BLOG",'<div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>');
define("CONFIGURATION_FILE", ROOT . DS . APP_DIR . DS .'tmp' .DS . 'configuration.json');
define("MENU_WEBSITE_ID", 2);
define("TOP_MENU_WEBSITE_ID", 72);
define("NEWS_CATEGORY_ID", 71);
define("SERVICE_CATEGORY_ID", 68);
define("INTRODUCTION_PAGE_ID",79);
define("INFORMATION_REQUIRED_ID",86);

define("BUS_ID","0");
define("TRAVEL_ID","1");
define("FRONT_END_PAGE_ID",89);

function get_provinces($province_id = null){
    $provinces = provinces();
    if(!isset($provinces[$province_id])){
        return "";
    }
    return $provinces[$province_id];
}

function provinces(){
    return array(
        '1'=>'TP Hồ Chí Minh',
        '4'=>'Bình Dương',
        '2'=>'Bà rịa - Vũng tàu',
        '3'=>'Bình phước'
    );
}

function get_roads($road_id){
    $roads = roads();
    if(!isset($roads[$road_id])){
        return "";
    }
    return $roads[$road_id];
}

function roads(){
    return array(
        '1'=>'Xuất phát từ Phước Long ',
        '2'=>'Xuất phát từ Bù Đăng ',
        '3'=>'Xuất phát từ Đồng Xoài '
    );
}

function road_status(){
    return array(
        '0'=>'Không hoạt động',
        '1'=>'Đang hoạt động'
    );
}


function trip_car_type(){
    return array(
        '0'=>'Xe giường nằm',
        '1'=>'Xe ghế ngồi CLC',
        '2'=>'Limousine',
        '3'=>'Xe VIP'
    );
}


function car_type(){
    return array(
        '0'=>'Xe khách ',
        '1'=>'Du lịch'
    );
}

function imageFileFormats(){
	return  array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
}

function fileUpload(){
    return  array("doc", "docx","pdf","zip");
}

/**
 * [_rename description]
 * @param  [type] $file_name [description]
 * @return [type]            [description]
 */
function _rename($file_name, $allow_strtolower = false)
{
	$file_name = strtolower( $file_name);
	$file_name = str_replace(array(" ",'”','“',"\n","\r","/",":"), "-", $file_name);

	$unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd'=>'đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i'=>'í|ì|ỉ|ĩ|ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D'=>'Đ',
        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    );

    foreach($unicode as $nonUnicode=>$uni){
        $file_name = preg_replace("/($uni)/i", $nonUnicode, $file_name);
    }

    if($allow_strtolower==true){
        return strtolower($file_name);
    }

	return strtolower( $file_name );
}

/**
 * [dispImage description]
 * @param  [type] $image [description]
 * @return [type]        [description]
 */
function dispImage($imageUrl = null){
    if($imageUrl == null){
        return null;
    }

    if(strpos($imageUrl, "http://") !== false || strpos($imageUrl, "https://")!==false){
        return $imageUrl;
    }else{
        return SERVER. $imageUrl;
    }


}