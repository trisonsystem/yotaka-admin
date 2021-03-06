<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] 	= 'LoginController';
$route['login'] 				= 'LoginController';
$route['login/update_login'] 	= 'LoginController/update_login';
$route['logout'] 				= 'LoginController/logout';
$route['chkLogin'] 				= 'LoginController/chkLogin';
$route['maintenance'] 			= 'LoginController/maintenance';


$route['main'] 					= 'MainController';
$route['main/(:any)'] 			= 'MainController/$1';
$route['mainPage'] 				= 'MainController/mainPage';

$route['manage_quotation/(:any)']  			= 'QuotationController/$1';
$route['manage_quotation/(:any)/(:any)']  	= 'QuotationController/$1/$2';

## autocomplete
{
	$route['autoc/(:any)'] 		= 'MainController/autoc/$1';
}

## import
{
	$route['importOrder'] 		= 'ImportOrderController/index';
	$route['saveImportOrder'] 	= 'ImportOrderController/saveImportOrder';
}

## member
{
	$route['adminList'] 			= 'MainController/adminList';
	// $route['changeLang/(:any)'] 	= 'MainController/changeLang/$1';
}
##--

## employee
$route['employee/(:any)']  			= 'Employee/EmployeeController/$1';
$route['employee/(:any)/(:any)']  	= 'Employee/EmployeeController/$1/$2';
##--

## employee status
$route['employeestatus/(:any)']  			= 'Employee/EmployeestatusController/$1';
$route['employeestatus/(:any)/(:any)']  	= 'Employee/EmployeestatusController/$1/$2';
##--

## division
$route['division/(:any)']  			= 'Division/DivisionController/$1';
$route['division/(:any)/(:any)']  	= 'Division/DivisionController/$1/$2';
##--

## hotel
$route['hotel/(:any)']  			= 'Hotel/HotelController/$1';
$route['hotel/(:any)/(:any)']  		= 'Hotel/HotelController/$1/$2';
##

## hotel status
$route['hotelstatus/(:any)']  			= 'Hotel/HotelstatusController/$1';
$route['hotelstatus/(:any)/(:any)']  		= 'Hotel/HotelstatusController/$1/$2';
##

## department
$route['department/(:any)']  			= 'Department/DepartmentController/$1';
$route['department/(:any)/(:any)']  	= 'Department/DepartmentController/$1/$2';
##--

## position
$route['position/(:any)']  			= 'Position/PositionController/$1';
$route['position/(:any)/(:any)']  	= 'Position/PositionController/$1/$2';
##--

## promotion
$route['promotion/(:any)']  			= 'promotion/PromotionController/$1';
$route['promotion/(:any)/(:any)']  		= 'promotion/PromotionController/$1/$2';
##--

## bank
$route['bank/(:any)']  			= 'Bank/BanknumberlistController/$1';
$route['bank/(:any)/(:any)']  		= 'Bank/BanknumberlistController/$1/$2';
##--

$route['language/(:any)']  			= 'Language/LanguageController/$1';
$route['room/(:any)']  				= 'Room/RoomController/$1';
$route['roomtype/(:any)']  			= 'Room/RoomtypeController/$1';
$route['roomitem/(:any)']  			= 'Room/RoomitemController/$1';
$route['customer/(:any)']  			= 'Customer/CustomerController/$1';
$route['book/(:any)']  				= 'Book/BookController/$1';
$route['payment/(:any)']  			= 'PaymentController/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
