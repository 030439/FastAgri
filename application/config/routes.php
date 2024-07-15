<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['customer/ledger/(:num)']="customer/customerLedger/$1";
$route['customer/ledger/list/(:num)']="customer/customerLedgerList/$1";
$route['customer/detail/(:num)']='customer/customerDetail/$1';
$route['getcustomers']="customer/getcustomers";
$route['customer/list']="customer/listing";
$route['customer-detail/(:num)']="customer/customerDetailList/$1";
$route['customer/customerDetailListing']="customer/customerDetailListing";
//supplier
$route['fetch-suppliers']="Supplier/fetchAll";
$route['supplier/ledger/(:num)']='Supplier/supplierLedger/$1';
$route['supplier/ledger/list/(:num)']="Supplier/supplierLedgerList/$1";
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
$route['products/ledger/(:num)']="Stock/productLedger/$1";
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

//assets
$route['asset/add']="AccountHeads/addAsset";
$route['asset/save']="AccountHeads/saveAsset";
$route['asset-list-js']="AccountHeads/assetJsList";
$route['asset/list']="AccountHeads/asset";
$route['getAssetShares']="AccountHeads/getAssetShares";
$route["asset-detail/(:num)"]="AccountHeads/assetDetail/$1";
$route["asset-edit/(:num)"]="AccountHeads/assetEdit/$1";
$route['asset/update']="AccountHeads/updateAsset";