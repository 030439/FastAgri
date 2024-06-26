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
$route['getShareSolders']="shareholders/getShareSolders";
$route['shareholder/detail/(:num)']="shareholders/detail/$1";
$route['shareholder/detailListing']="shareholders/detailListing";
$route['shareholder/detailPdf/(:num)']="shareholders/detailPdf/$1";
$route['shareholders-list-js']="shareholders/jsList";
// $route['shareholder/delete/(:num)'] = 'shareholders/delete/$1'; //data delete
// tunnels routes
$route['tunnels'] = "tunnels/index"; //tunnels list
$route['tunnels/save'] = "tunnels/save"; //tunnels form data submission
$route['tunnels/detail/(:num)']="tunnels/detail/$1";
$route['tunnel/tunnle-expense/(:num)']="tunnels/tunnleExpense/$1";
$route['tunnel/getunnelsExpenseList']="tunnels/getunnelsExpenseList";
$route['tunnel/getunnelsProfitList']="tunnels/getunnelsProfitList";
$route['tunnel/tunnle-profit/(:num)']="tunnels/tunnleProfit/$1";
$route['tunnel/detailPdf/(:num)']="tunnels/detailPdf/$1";
$route['tunnels-list-js'] = "tunnels/tunnelJsList"; //tunnels list
$route['tunnels/summary']="tunnels/summary";
//Custmer routes
$route['customer/create'] = 'customer/create';
$route['customer/detail/(:num)']='customer/customerDetail/$1';
$route['getcustomers']="customer/getcustomers";
$route['customer/list']="customer/listing";
$route['customer-detail/(:num)']="customer/customerDetailList/$1";
$route['customer/customerDetailListing']="customer/customerDetailListing";
//supplier
$route['fetch-suppliers']="Supplier/fetchAll";
$route['createAlgo']="Stock/createAlgo";
$route['insert-supplier']='Supplier/create';
$route['supplierExport']="Supplier/supplierExport";
$route['supplierFilter']="Supplier/supplierFilter";
$route['supplier/(:num)']="Supplier/detail/$1";
$route['getSuppliers']="Supplier/getSuppliers";
$route['supplier/list']="Supplier/listing";
$route['supplier/detail/listing/(:num)']="Supplier/detailListing/$1";
// purchase routes
$route['purchase/add'] = "purchase/add"; //purchase form view
$route['purchase'] = "purchase/index"; //purchase list
$route['create-purchase'] = "purchase/save"; //purchase form data submission
$route['purchase-seed']='purchase/purchaseSeedFrom';
$route['seed-purchase']='purchase/purchaseSeed';
$route['purchased/seed-list']='purchase/purchasedSeedList';
$route['purchased/seed-list-js']='purchase/purchasedSeedListJS';

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
$route['getStockRate']="Stock/getStockRate";
$route['getStockQty']="Stock/getStockQty";
$route['issue-product']="Stock/issueProduct";
$route['issue-stock/issuePdf']="Stock/issuePdf";
//Employee 
$route['add-employee']='Employee/add';
$route['designation']='Employee/designation';
$route['save-designation']='Employee/Savedesignation';
$route['save-category']='Employee/saveCategory';
$route['save-employee']='Employee/saveEmployee';
$route['employees']='Employee/index';
$route['employees-listing']='Employee/listing';
$route['getPermanentEmployees']='Employee/getPermanentEmployees';
$route['getDailyEmployees']='Employee/getDailyEmployees';
$route['employee-advance-add']="Employee/employeeAdvanceAdd";
$route['generate-pays']='Employee/generatePays';
$route['getEmployees']="Employee/getEmployees";
$route['getEmployeeById']="Employee/getEmployeePayById";
$route['getEmployeesList']="Employee/getEmployeesList";
$route['employee-loan-listing']="Employee/employeeLoanListing";
//Jammandar 
$route['jamandars']='Jamandar/index';
$route['getJamandars']='Jamandar/getJamandars';
$route['add-jamandar']='Jamandar/add';
$route['save-jamandar']='Jamandar/save';
$route['jamandar-detail/(:num)']="Jamandar/detail/$1";
$route['jamandars/Advance']="Jamandar/Advance";
$route['jamandars-loan-listing']="Jamandar/jamandarsLoanListing";
$route['jamandar-advance-add']="Jamandar/jamandarAdvanceAdd";
$route['jamandariAccount']="Jamandar/jamandariAccount";
$route['getJamandariById']="Jamandar/getJamandariById";
$route['list-jamandars']="Jamandar/listing";
$route['issued-jamandar-labour']="Jamandar/issuedJamandarLabour";
//labour
$route['labour-rate']='hr/labourRate';
$route['add-rate']='hr/updateRate';
$route['labour-issue']='hr/labourIssue';
$route['issued-labour-list']='hr/labourList';
$route['issued-labour-listing']="hr/issuedLabourListing";
//Production 
$route['tunnelProduct']="tunnels/tunnelProduct";
$route['ready-product']="Production/ready";
$route['load-product/(:num)']="Production/load/$1";
$route['ready-production-sell']="Production/sell";
$route['readyQuantity']="Production/readyQuantity";
$route['load-for-sell']="Sell/loadForSale";
$route['sell-detail/(:num)']="Sell/detail/$1";
$route['Production-stock']="Production/stocks";
$route['sell-gate-pass/(:num)']="Sell/getPass/$1";
$route['sell-bill-detail/(:num)']="Sell/sellBillDetail/$1";
$route['bill-detail-invoice']="Sell/billDetailInvoice";
$route['sell/sellPdf']="Sell/sellPdf";
$route['production/getProductionListing']=['Production/getProductionListing'];
//Reports
$route['tunnel/profit-expense']="Report/profitExpense";
$route['tunnels/expense']="Report/expense";
$route['tunnels/profit']="Report/profit";
$route['tunnels/profitListing']="Report/profitListing";
$route['tunnels/expenseListing']="Report/expenseListing";


//loan

//pdfs
$route['create-pdf'] = "Welcome/CreatePdf";
$route['getJmanadarsReports']="Jamandar/getJmanadarsReports";
$route['dailyProductionReports']="Production/dailyProductionReports";

//cash book
$route['cashbook']="Cashbook/add";
$route['cashbook-pay']="Cashbook/cashbookPay";
$route['OtherExpense']="AccountHeads/OtherExpense";
$route['addAccountHead']="AccountHeads/addAccountHead";
$route['cashbook/print/(:num)']="Cashbook/printSlip/$1";
$route['cash-flow']="Cashbook/cashFlow";
$route['daily-expenses']="Report/dailyExpense";
$route['expense-listing']="Report/dailyExpenseListing";
$route['add/expense']="Report/addExpense";