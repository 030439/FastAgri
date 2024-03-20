<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|    example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|    https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|    $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|    $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|    $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:    my-controller/index    -> my_controller/index
|        my-controller/my-method    -> my_controller/my_method
 */
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
//shareholder routes
$route['shareholders'] = "shareholders/index"; //shareholder list/read
$route['shareholder/add'] = "shareholders/add"; //shareholder form view
$route['shareholder/create'] = "shareholders/create"; //shareholder form data submission
$route['shareholder/edit/(:num)'] = 'shareholders/edit/$1'; //form for edit
$route['shareholder/update'] = 'shareholders/update'; //data update
// $route['shareholder/delete/(:num)'] = 'shareholders/delete/$1'; //data delete
// tunnels routes
$route['tunnels'] = "tunnels/index"; //tunnels list
$route['tunnels/save'] = "tunnels/save"; //tunnels form data submission
//Custmer routes
$route['customer/create'] = 'customer/create';
//supplier
$route['insert-supplier']='Supplier/create';
// purchase routes
$route['purchase/add'] = "purchase/add"; //purchase form view
$route['purchase'] = "purchase/index"; //purchase list
$route['create-purchase'] = "purchase/save"; //purchase form data submission
$route['purchase-seed']='purchase/purchaseSeedFrom';
$route['seed-purchase']='purchase/purchaseSeed';
$route['purchased/seed-list']='purchase/purchasedSeedList';

//Unit Curd
$route['unit/create'] = "Unit/create"; //purchase form view 
$route['units/list'] = "Unit/index"; //purchase form view
//Stock
$route['stock/add']='Stock/add';
$route['add-seed']='Stock/seedAdd';
$route['stock/seeds']="Stock/seedList";
$route['stock/add-product']="Stock/addProduct";
$route['product-insert']="Stock/insertProduct";
$route['seed-insert']="Stock/insertSeed";
$route['stock/products']="Stock/productList";
//Employee 
$route['save-category']='Employee/saveCategory';