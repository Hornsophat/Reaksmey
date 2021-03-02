<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = 'user/index';
$route['404_override'] = '';

/*admin*/
$route['admin'] = 'user/index';
$route['admin/signup'] = 'user/signup';
$route['admin/create_member'] = 'user/create_member';
$route['admin/login'] = 'user/index';
$route['admin/logout'] = 'user/logout';
$route['admin/login/validate_credentials'] = 'user/validate_credentials';

$route['admin/dashboard'] = 'admin_dashboard/index';

$route['admin/customer'] = 'admin_customer/index';
$route['signup'] = 'member/signup';
$route['admin/customer/search'] = 'admin_customer/search';
$route['admin/customer/show/(:any)'] = 'admin_customer/get_customer/$1';
$route['admin/customer/verify'] = 'admin_customer/verify';
$route['admin/customer/add'] = 'admin_customer/add';
$route['admin/customer/update'] = 'admin_customer/update';
$route['admin/customer/update/(:any)'] = 'admin_customer/update/$1';
$route['admin/customer/delete/(:any)'] = 'admin_customer/delete/$1';
$route['admin/customer/(:any)'] = 'admin_customer/index/$1'; //$1 = page number

$route['admin/checkin'] = 'admin_checkin/index';
$route['admin/checkin/add'] = 'admin_checkin/add';
$route['admin/checkin/multi_add'] = 'admin_checkin/multi_add';
$route['admin/checkin/total_checkin'] = 'admin_checkin/total_checkin';
$route['admin/checkin/update'] = 'admin_checkin/update';
$route['admin/checkin/update/(:any)'] = 'admin_checkin/update/$1';
$route['admin/checkin/delete/(:any)'] = 'admin_checkin/delete/$1';
$route['admin/checkin/(:any)'] = 'admin_checkin/index/$1'; //$1 = page number 
$route['admin/view_checkin'] = 'admin_checkin/view_checkin/$1';

$route['admin/reservation'] = 'admin_reservation/index';
$route['admin/reservation/confirm'] = 'admin_reservation/confirm';
$route['admin/reservation/add'] = 'admin_reservation/add';
$route['admin/reservation/add_multi'] = 'admin_reservation/add_multi';
$route['admin/reservation/update'] = 'admin_reservation/update';
$route['admin/reservation/update/(:any)'] = 'admin_reservation/update/$1';
$route['admin/reservation/cancel/(:any)'] = 'admin_reservation/cancel/$1';
$route['admin/reservation/delete/(:any)'] = 'admin_reservation/delete/$1';
$route['admin/reservation/(:any)'] = 'admin_reservation/index/$1'; //$1 = page number
$route['admin/view_reservation'] = 'admin_reservation/view_reservation/$1'; //$1 = page number


$route['admin/checkout'] = 'admin_checkout/index';
$route['admin/checkout/out/(:any)'] = 'admin_checkout/out/$1';
$route['admin/checkout/(:any)'] = 'admin_checkout/index/$1'; //$1 = page number

$route['admin/room'] = 'admin_room/index';
$route['admin/room/get_by_id'] = 'admin_room/get_by_roomtype';
$route['admin/room/get_by_roomtype_ajax'] = 'admin_room/get_by_roomtype_ajax';
$route['admin/staying/get_by_stay_ajax'] = 'admin_staytime/get_by_stay_ajax';
$route['admin/room/total_reservation'] = 'admin_room/total_reservation';
$route['admin/room/get_multi_by_id'] = 'admin_room/get_multiroom_by_id';
$route['admin/room/get_multiromm_ajax'] = 'admin_room/get_multiromm_ajax';
$route['admin/room/total_reservation_multy'] = 'admin_room/total_reservation_multy';
$route['admin/room/add'] = 'admin_room/add';
$route['admin/room/update'] = 'admin_room/update';
$route['admin/room/update/(:any)'] = 'admin_room/update/$1';
$route['admin/room/delete/(:any)'] = 'admin_room/delete/$1';
$route['admin/room/(:any)'] = 'admin_room/index/$1'; //$1 = page number
$route['admin/room/getPriceByDay'] = 'admin_staytime/getPriceByDay';

$route['admin/roomtype'] = 'admin_roomtype/index';
$route['admin/roomtype/add'] = 'admin_roomtype/add';
$route['admin/roomtype/update'] = 'admin_roomtype/update';
$route['admin/roomtype/update/(:any)'] = 'admin_roomtype/update/$1';
$route['admin/roomtype/delete/(:any)'] = 'admin_roomtype/delete/$1';	
$route['admin/roomtype/(:any)'] = 'admin_roomtype/index/$1'; //$1 = page number

$route['admin/staying'] = 'admin_staytime/index';
$route['admin/staying/add'] = 'admin_staytime/add';
$route['admin/staying/update/(:any)'] = 'admin_staytime/update/$1';
$route['admin/staying/delete/(:any)'] = 'admin_staytime/delete/$1';
$route['admin/staying/get_price_id'] = 'admin_staytime/get_price';
$route['admin/staying/get_by_id'] = 'admin_staytime/get_available';
$route['admin/staying/get_room_ajax'] = 'admin_staytime/get_room_ajax';

$route['admin/staying/(:any)'] = 'admin_staytime/index/$1'; // $1 = page number
$route['admin/staying/getDayType'] = 'admin_staytime/getDayType';

$route['admin/report'] = 'admin_report/index';
$route['admin/report/daily'] = "admin_report/daily";
$route['admin/report/customer'] = 'admin_report/customer_report';
$route['admin/report/checkin'] = 'admin_report/checkin_report';
$route['admin/report/checkout'] = 'admin_report/checkout_report';
$route['admin/report/today-checkin'] = 'admin_report/today_checkin';
$route['admin/report/last-week-checkin'] = 'admin_report/last_week_checkin';
$route['admin/report/today-checkout'] = 'admin_report/today_checkout';
$route['admin/report/last-week-checkout'] = 'admin_report/last_week_checkout';
$route['admin/report/room'] = 'admin_report/room_report';
$route['admin/report/free-room'] = 'admin_report/free_room';
$route['admin/report/Busy-room'] = 'admin_report/busy_room';
$route['admin/report/unpay'] = 'admin_report/unpay_report';
$route['admin/report/profit-report'] = 'admin_report/profit_report';
$route['admin/report/get-all-amount-in'] = 'admin_report/get_all_amount_in';
$route['admin/report/payment_report'] = 'admin_report/payment_report/$1/$2';
$route['admin/report/report_room_by_date'] = 'admin_report/report_room_by_date/$1/$2';
$route['admin/report/report_room_by_month'] = 'admin_report/report_room_by_month/$1/$2';



$route['member/dashboard'] = 'member_dashboard/index';
$route['member/profile'] = 'member_dashboard/update_profile';
$route['member/search'] = 'member_dashboard/search_rooms';
$route['member/reservation/add'] = 'member_dashboard/add_reserve';
$route['member/reservation/cancel/(:any)'] = 'member_dashboard/cancel_reserve/$1';
$route['admin/reciept/(:any)'] = "admin_checkin/reciept/$1/$2";
$route['admin/payment_befor_checkout'] = "admin_checkin/payment_befor_checkout";

$route['admin/extra/(:any)'] = "admin_checkin/extra/$1";
$route['admin_checkin/save_all_item'] = "admin_checkin/save_all_item";
$route['admin/item'] = "admin_item/index";
$route['item/add'] = "admin_item/add";
$route['item/save'] = "admin_item/save";
$route['item/edit/(:any)'] = "admin_item/edit/$1";
$route['item/del/(:any)'] = "admin_item/del/$1";
$route['item/update'] = "admin_item/update";
$route['admin_checkin/getItemPrice'] = "admin_checkin/getItemPrice";
$route['admin/checkout_all'] = "admin_checkout/checkout_all";
$route['admin_checkin/delectItem'] = "admin_checkin/delectItem";
$route['admin/get_reciept_all'] = "admin_checkout/get_reciept_all";
$route['admin/user'] = "admin_checkout/create_user";
$route['admin/user/add'] = "admin_checkout/add_user";
$route['admin/user/save'] = "admin_checkout/save_user";
$route['admin/user/edit/(:any)'] = "admin_checkout/edit_user/$1";
$route['admin/user/del/(:any)']  = "admin_checkout/del_user/$1";
$route['admin/user/save_edit'] = "admin_checkout/save_edit";
$route['admin/profile'] = "admin_home/profile";
$route['admin/eject/(:any)'] = "admin_checkout/eject/$1";
$route['admin_checkin/dis_invoice'] = "admin_checkin/dis_invoice";
$route['admin/report/banks'] = 'admin_report/banks/$1/$2';


$route['admin/print/reciept/(:any)'] = "admin_checkout/reciept/$1/$2";
$route['admin/pay/(:any)'] = "admin_checkout/pay/$1";


$route['admin/show_rooms'] = "admin_dashboard/view_rooms";
$route['admin/show_rooms/reserv_cancel'] = "admin_dashboard/reserve_cancel";

$route['admin/cleaning']  = "admin_cleaning/index";
$route['admin/cleaning/update'] = 'admin_cleaning/update';
$route['admin/cleaning/update/(:any)'] = 'admin_cleaning/update/$1';

$route['admin/cleaning/addHoliday']  = 'admin_cleaning/addHoliday';

$route['admin/cleaning/list_holiday'] = 'admin_cleaning/list_holiday';

$route['admin/cleaning/updateHoliday'] = 'admin_cleaning/updateHoliday';
$route['admin/cleaning/updateHoliday'] = 'admin_cleaning/updateHoliday';
$route['admin/cleaning/editHoliday'] = 'admin_cleaning/editHoliday';
$route['admin/cleaning/deletHoliday'] = 'admin_cleaning/deletHoliday';

$route['setting/role'] = 'setting/role/index';




/* End of file routes.php */
/* Location: ./application/config/routes.php */
