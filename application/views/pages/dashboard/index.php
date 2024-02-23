<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <base href="<?= base_url() ?>">
    <?php include(APPPATH . 'views/libs/css.php'); ?>
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Cashiar</title>
</head>

<body class="bg-bodyBg">
    <main>
        <div class="cashier-dashboard-area">
            <?php include(APPPATH . 'views/libs/asidebar.php'); ?>



            <div class="cashier-dashboard-main">
                <?php include(APPPATH . 'views/libs/header.php'); ?>

                <!-- inner page  -->
                <div class="cashier-content-area mt-[30px] px-7">
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 xxl:col-span-9 xl:col-span-8">
                            <div class="invention-quickreport-area pl-0.5">
                                <div class="cashier-quickview-area p-7 pt-5 pb-2 bg-white rounded-lg mb-5">
                                    <div
                                        class="cashier-dashboard-supplier-header flex flex-wrap items-center justify-between mb-6 m-0.5">
                                        <h5 class="text-[18px] text-heading font-bold maxSm:mb-2 maxSm:text-[16px]">
                                            Shortcut Report</h5>
                                        <a href="profitreport.html"
                                            class="text-[15px] font-semibold text-bodyText maxSm:mb-2 maxSm:text-[14px]">View
                                            Report <i class="far fa-arrow-right inline-block ml-1"></i></a>
                                    </div>
                                    <div
                                        class="cashier-quickview-wrapper flex items-center justify-between gap-x-5 maxXs:gap-x-0">
                                        <div class="cashier-quickview bg-[#EEF0F8] mb-5 rounded-lg">
                                            <a href="accountsbalance.html" class="p-[30px] inline-block">
                                                <div class="cashier-quickview-box">
                                                    <div class="cashier-quickview-box-icon mb-5">
                                                        <img src="assets/img/icon/quick-1.png" alt="icon not found"
                                                            class="inline-block rounded-[15px]">
                                                    </div>
                                                    <h4 class="text-[22px] font-extrabold text-heading">$24,575</h4>
                                                    <span
                                                        class="block text-[15px] font-semibold text-bodyText mb-8">Opening
                                                        Balance</span>
                                                    <span
                                                        class="h-[35px] rounded-[17px] bg-white inline-block text-[14px] font-semibold leading-[35px] px-3 min-w-[70px] text-center text-heading">+65%</span>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="cashier-quickview bg-[#F8F0E7] mb-5 rounded-lg">
                                            <a href="transection.html" class="p-[30px] inline-block">
                                                <div class="cashier-quickview-box">
                                                    <div class="cashier-quickview-box-icon mb-5">
                                                        <img src="assets/img/icon/quick-2.png" alt="icon not found"
                                                            class="inline-block rounded-[15px]">
                                                    </div>
                                                    <h4 class="text-[22px] font-extrabold text-heading">$5,786</h4>
                                                    <span
                                                        class="block text-[15px] font-semibold text-bodyText mb-8">Today's
                                                        Transection</span>
                                                    <span
                                                        class="h-[35px] rounded-[17px] bg-white inline-block text-[14px] font-semibold leading-[35px] px-3 min-w-[70px] text-center text-heading">+3.47%</span>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="cashier-quickview bg-[#F9E8E8] mb-5 rounded-lg">
                                            <a href="expensereport.html" class="p-[30px] inline-block">
                                                <div class="cashier-quickview-box">
                                                    <div class="cashier-quickview-box-icon mb-5">
                                                        <img src="assets/img/icon/quick-3.png" alt="icon not found"
                                                            class="inline-block rounded-[15px]">
                                                    </div>
                                                    <h4 class="text-[22px] font-extrabold text-heading">$57,575</h4>
                                                    <span
                                                        class="block text-[15px] font-semibold text-bodyText mb-8">Today's
                                                        Expense</span>
                                                    <span
                                                        class="h-[35px] rounded-[17px] bg-white inline-block text-[14px] font-semibold leading-[35px] px-3 min-w-[70px] text-center text-heading">-2.8%</span>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="cashier-quickview bg-[#E6F2E2] mb-5 rounded-lg">
                                            <a href="netincomereport.html" class="p-[30px] inline-block">
                                                <div class="cashier-quickview-box">
                                                    <div class="cashier-quickview-box-icon mb-5">
                                                        <img src="assets/img/icon/quick-4.png" alt="icon not found"
                                                            class="inline-block rounded-[15px]">
                                                    </div>
                                                    <h4 class="text-[22px] font-extrabold text-heading">$24,575</h4>
                                                    <span
                                                        class="block text-[15px] font-semibold text-bodyText mb-8">Today's
                                                        Net Income</span>
                                                    <span
                                                        class="h-[35px] rounded-[17px] bg-white inline-block text-[14px] font-semibold leading-[35px] px-3 min-w-[70px] text-center text-heading">+65%</span>
                                                </div>
                                            </a>
                                        </div>

                                        <div
                                            class="cashier-quickview-last rounded-lg border-[1.5px] border-dashed p-[30px] mb-5 border-[#DCE0EB] h-full flex flex-col justify-center items-center">
                                            <div class="cashier-quickview-box ">
                                                <i class="far fa-plus text-[#B4BBD2] text-[20px]"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-x-5">


                                <div class="col-span-12 lg:col-span-6 xl:hidden">
                                    <div class="cashier-dashboard-user-area">
                                        <div class="cashier-dashboard-user-wrapper p-7 pt-5 bg-white rounded-lg mb-5">
                                            <div class="cashier-dashboard-user mb-6 m-0.5">
                                                <h5 class="text-[18px] text-heading font-bold">User</h5>
                                            </div>
                                            <div class="cashier-dashboard-user">
                                                <div
                                                    class="cashier-dashboard-user-list flex flex-wrap justify-between items-center mb-5">
                                                    <div
                                                        class="cashier-dashboard-user-list-left flex flex-wrap items-center">
                                                        <div
                                                            class="cashier-dashboard-user-list-left-img min-w-[60px] mr-4">
                                                            <a href="userlist.html"><img
                                                                    src="assets/img/user/user-1.png"
                                                                    alt="user not found"></a>
                                                        </div>
                                                        <div class="cashier-dashboard-user-list-left-text">
                                                            <h5 class="text-[16px] text-heading font-semibold mb-1"><a
                                                                    href="userlist.html">John
                                                                    David</a></h5>
                                                            <span
                                                                class="text-[14px] text-bodyText font-normal block">Manager</span>
                                                            <span
                                                                class="text-[12px] text-themeBlue font-normal block">Sign
                                                                in - 09:30</span>
                                                        </div>
                                                    </div>
                                                    <div class="cashier-dashboard-user-list-right">
                                                        <span
                                                            class="h-5 px-1.5 border border-solid border-themeGreenDark text-[12px] leading-18 text-themeGreenDark inline-block">Online</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="cashier-dashboard-user-list flex flex-wrap justify-between items-center mb-5">
                                                    <div
                                                        class="cashier-dashboard-user-list-left flex flex-wrap items-center">
                                                        <div
                                                            class="cashier-dashboard-user-list-left-img min-w-[60px] mr-4">
                                                            <a href="userlist.html"><img
                                                                    src="assets/img/user/user-2.png"
                                                                    alt="user not found"></a>
                                                        </div>
                                                        <div class="cashier-dashboard-user-list-left-text">
                                                            <h5 class="text-[16px] text-heading font-semibold mb-1"><a
                                                                    href="userlist.html">Killiyan
                                                                    Ampa</a></h5>
                                                            <span
                                                                class="text-[14px] text-bodyText font-normal block">Manager</span>
                                                            <span
                                                                class="text-[12px] text-themeBlue font-normal block">Sign
                                                                in - 09:25</span>
                                                        </div>
                                                    </div>
                                                    <div class="cashier-dashboard-user-list-right">
                                                        <span
                                                            class="h-5 px-1.5 border border-solid border-themeGreenDark text-[12px] leading-18 text-themeGreenDark inline-block">Online</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="cashier-dashboard-user-list flex flex-wrap justify-between items-center mb-5">
                                                    <div
                                                        class="cashier-dashboard-user-list-left flex flex-wrap items-center">
                                                        <div
                                                            class="cashier-dashboard-user-list-left-img min-w-[60px] mr-4">
                                                            <a href="userlist.html"><img
                                                                    src="assets/img/user/user-3.png"
                                                                    alt="user not found"></a>
                                                        </div>
                                                        <div class="cashier-dashboard-user-list-left-text">
                                                            <h5 class="text-[16px] text-heading font-semibold mb-1"><a
                                                                    href="userlist.html">Brandon
                                                                    Tylors</a></h5>
                                                            <span
                                                                class="text-[14px] text-bodyText font-normal block">Manager</span>
                                                            <span
                                                                class="text-[12px] text-themeBlue font-normal block">Sign
                                                                in - 09:20</span>
                                                        </div>
                                                    </div>
                                                    <div class="cashier-dashboard-user-list-right">
                                                        <span
                                                            class="h-5 px-1.5 border border-solid border-themeGreenDark text-[12px] leading-18 text-themeGreenDark inline-block">Online</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="cashier-dashboard-user-list flex flex-wrap justify-between items-center mb-5">
                                                    <div
                                                        class="cashier-dashboard-user-list-left flex flex-wrap items-center">
                                                        <div
                                                            class="cashier-dashboard-user-list-left-img min-w-[60px] mr-4">
                                                            <a href="userlist.html"><img
                                                                    src="assets/img/user/user-4.png"
                                                                    alt="user not found"></a>
                                                        </div>
                                                        <div class="cashier-dashboard-user-list-left-text">
                                                            <h5 class="text-[16px] text-heading font-semibold mb-1"><a
                                                                    href="userlist.html">William
                                                                    John</a></h5>
                                                            <span
                                                                class="text-[14px] text-bodyText font-normal block">Manager</span>
                                                            <span
                                                                class="text-[12px] text-themeBlue font-normal block">Sign
                                                                in - 09:29</span>
                                                        </div>
                                                    </div>
                                                    <div class="cashier-dashboard-user-list-right">
                                                        <span
                                                            class="h-5 px-1.5 border border-solid border-themeWarn text-[12px] leading-18 text-themeWarn inline-block">Offline</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="cashier-dashboard-user-list flex flex-wrap justify-between items-center">
                                                    <div
                                                        class="cashier-dashboard-user-list-left flex flex-wrap items-center">
                                                        <div
                                                            class="cashier-dashboard-user-list-left-img min-w-[60px] mr-4">
                                                            <a href="userlist.html"><img
                                                                    src="assets/img/user/user-5.png"
                                                                    alt="user not found"></a>
                                                        </div>
                                                        <div class="cashier-dashboard-user-list-left-text">
                                                            <h5 class="text-[16px] text-heading font-semibold mb-1"><a
                                                                    href="userlist.html">Mendela
                                                                    Peter</a></h5>
                                                            <span
                                                                class="text-[14px] text-bodyText font-normal block">Manager</span>
                                                            <span
                                                                class="text-[12px] text-themeBlue font-normal block">Sign
                                                                in - 09:22</span>
                                                        </div>
                                                    </div>
                                                    <div class="cashier-dashboard-user-list-right">
                                                        <span
                                                            class="h-5 px-1.5 border border-solid border-themeGreenDark text-[12px] leading-18 text-themeGreenDark inline-block">Online</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12">
                                    <div class="cashier-dashboard-transaction-area">
                                        <div
                                            class="cashier-dashboard-transaction-wrapper p-7 pt-5 bg-white rounded-lg mb-5">
                                            <div
                                                class="cashier-dashboard-supplier-header flex flex-wrap items-center justify-between mb-6 m-0.5">
                                                <h5 class="text-[18px] text-bold font-bold maxSm:mb-2 text-heading">
                                                    Recent Voucher</h5>
                                                <span class="common-blue-badge maxSm:mb-2">List 5</span>
                                            </div>
                                            <div class="cashier-dashboard-transaction">
                                                <div class="cashier-dashboard-transaction-row-heading">
                                                    <div class="cashier-dashboard-transaction-dateR">
                                                        <h5>Date</h5>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-referenceR">
                                                        <h5>Customer</h5>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-customerR">
                                                        <h5>Voucher No</h5>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-duedateR">
                                                        <h5>Due Date</h5>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-modeR">
                                                        <h5>Mode</h5>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-statusR">
                                                        <h5>Status</h5>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-priceR">
                                                        <h5>Amount</h5>
                                                    </div>
                                                </div>
                                                <div class="cashier-dashboard-transaction-row">
                                                    <div class="cashier-dashboard-transaction-dateR">
                                                        <span>30/12/2021</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-referenceR">
                                                        <span>Peter</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-customerR">
                                                        <span>58755</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-duedateR">
                                                        <span>30/12/2021</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-modeR">
                                                        <span>Cheque</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-statusR">
                                                        <span>
                                                            <span
                                                                class="status-tag text-[12px] font-semibold leading-[20px] text-white px-2.5 h-5 rounded-[3px] inline-block bg-themeGreen">
                                                                Completed</span>
                                                        </span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-priceR">
                                                        <span>$4,582</span>
                                                    </div>
                                                </div>
                                                <div class="cashier-dashboard-transaction-row">
                                                    <div class="cashier-dashboard-transaction-dateR">
                                                        <span>28/12/2021</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-referenceR">
                                                        <span>Wileen Mylchreest</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-customerR">
                                                        <span>53755</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-duedateR">
                                                        <span>28/07/2021</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-modeR">
                                                        <span>-------</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-statusR">
                                                        <span>
                                                            <span
                                                                class="status-tag text-[12px] font-semibold leading-[20px] text-white px-2.5 h-5 rounded-[3px] inline-block bg-themeWarn">
                                                                Unpaid</span>
                                                        </span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-priceR">
                                                        <span>$5,582</span>
                                                    </div>
                                                </div>
                                                <div class="cashier-dashboard-transaction-row">
                                                    <div class="cashier-dashboard-transaction-dateR">
                                                        <span>25/12/2021</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-referenceR">
                                                        <span>Steve Walken</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-customerR">
                                                        <span>58725</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-duedateR">
                                                        <span>25/04/2021</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-modeR">
                                                        <span>Transfer</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-statusR">
                                                        <span>
                                                            <span
                                                                class="status-tag text-[12px] font-semibold leading-[20px] text-white px-2.5 h-5 rounded-[3px] inline-block bg-themeGreen">
                                                                Completed</span>
                                                        </span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-priceR">
                                                        <span>$6,882</span>
                                                    </div>
                                                </div>
                                                <div class="cashier-dashboard-transaction-row">
                                                    <div class="cashier-dashboard-transaction-dateR">
                                                        <span>30/12/2021</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-referenceR">
                                                        <span>Peter</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-customerR">
                                                        <span>58755</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-duedateR">
                                                        <span>20/03/2021</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-modeR">
                                                        <span>Cheque</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-statusR">
                                                        <span>
                                                            <span
                                                                class="status-tag text-[12px] font-semibold leading-[20px] text-white px-2.5 h-5 rounded-[3px] inline-block bg-themeGreen">
                                                                Completed</span>
                                                        </span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-priceR">
                                                        <span>$4,582</span>
                                                    </div>
                                                </div>
                                                <div class="cashier-dashboard-transaction-row">
                                                    <div class="cashier-dashboard-transaction-dateR">
                                                        <span>18/01/2021</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-referenceR">
                                                        <span>Maria Elizabeth</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-customerR">
                                                        <span>65755</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-duedateR">
                                                        <span>06/02/2021</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-modeR">
                                                        <span>Cash</span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-statusR">
                                                        <span>
                                                            <span
                                                                class="status-tag text-[12px] font-semibold leading-[20px] text-white px-2.5 h-5 rounded-[3px] inline-block bg-themePerple">
                                                                Partial</span>
                                                        </span>
                                                    </div>
                                                    <div class="cashier-dashboard-transaction-priceR">
                                                        <span>$5,540</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xxl:col-span-3 xl:col-span-4">
                            <div class="grid grid-cols-12 gap-x-5 maxSm:gap-x-0">
                                <div class="col-span-12 xl:col-span-12 lg:col-span-6">
                                    <div class="cashier-dashboard-topseller-area">
                                        <div class="cashier-balance-area p-7 pt-5 bg-white rounded-lg mb-5">
                                            <div
                                                class="cashier-dashboard-supplier-header flex flex-wrap items-center justify-between mb-6 m-0.5">
                                                <h5 class="text-[18px] text-bold font-bold maxSm:mb-2 text-heading">
                                                    Recent Clients</h5>
                                                <span class="common-blue-badge maxSm:mb-2">List 5</span>
                                            </div>
                                            <div
                                                class="cashier-dashboard-supplier border border-solid border-grayBorder m-0.5 border-b-0 ">
                                                <div
                                                    class="cashier-dashboard-supplier-list h-10 flex justify-between items-center border-b-[1px] border-solid border-grayBorder">
                                                    <div class="cashier-dashboard-supplier-list-name pl-7">
                                                        <h5 class="text-[15px] font-semibold text-heading">Name</h5>
                                                    </div>
                                                    <div
                                                        class="cashier-dashboard-supplier-list-amount border-l-[1px] border-solid border-grayBorder pl-7">
                                                        <h5 class="text-[15px] font-semibold text-heading">Amount</h5>
                                                    </div>
                                                </div>
                                                <div
                                                    class="cashier-dashboard-supplier-list h-20 flex justify-between items-center border-b-[1px] border-solid border-grayBorder">
                                                    <div class="cashier-dashboard-supplier-list-name pl-7">
                                                        <span
                                                            class="text-[14px] font-normal text-bodyText block mb-1">Manuyel
                                                            Macron</span>
                                                        <span
                                                            class="text-[14px] font-normal text-bodyText block">01711-525236</span>
                                                    </div>
                                                    <div
                                                        class="cashier-dashboard-supplier-list-amount border-l-[1px] border-solid border-grayBorder pl-7">
                                                        <span
                                                            class="text-[14px] font-normal text-bodyText">$9,587</span>
                                                    </div>
                                                </div>

                                                <div
                                                    class="cashier-dashboard-supplier-list h-20 flex justify-between items-center border-b-[1px] border-solid border-grayBorder">
                                                    <div class="cashier-dashboard-supplier-list-name pl-7">
                                                        <span
                                                            class="text-[14px] font-normal text-bodyText block mb-1">Daniyel
                                                            Brayn</span>
                                                        <span
                                                            class="text-[14px] font-normal text-bodyText block">01811-525236</span>
                                                    </div>
                                                    <div
                                                        class="cashier-dashboard-supplier-list-amount border-l-[1px] border-solid border-grayBorder pl-7">
                                                        <span
                                                            class="text-[14px] font-normal text-bodyText">$10,357</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="cashier-dashboard-supplier-list h-20 flex justify-between items-center border-b-[1px] border-solid border-grayBorder">
                                                    <div class="cashier-dashboard-supplier-list-name pl-7">
                                                        <span
                                                            class="text-[14px] font-normal text-bodyText block mb-1">Robert
                                                            Ainstone</span>
                                                        <span
                                                            class="text-[14px] font-normal text-bodyText block">01611-525236</span>
                                                    </div>
                                                    <div
                                                        class="cashier-dashboard-supplier-list-amount border-l-[1px] border-solid border-grayBorder pl-7">
                                                        <span
                                                            class="text-[14px] font-normal text-bodyText">$7,547</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="cashier-dashboard-supplier-list h-20 flex justify-between items-center border-b-[1px] border-solid border-grayBorder">
                                                    <div class="cashier-dashboard-supplier-list-name pl-7">
                                                        <span
                                                            class="text-[14px] font-normal text-bodyText block mb-1">Brayan
                                                            D Silva</span>
                                                        <span
                                                            class="text-[14px] font-normal text-bodyText block">01711-569236</span>
                                                    </div>
                                                    <div
                                                        class="cashier-dashboard-supplier-list-amount border-l-[1px] border-solid border-grayBorder pl-7">
                                                        <span
                                                            class="text-[14px] font-normal text-bodyText">$6,967</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="cashier-dashboard-supplier-list h-20 flex justify-between items-center border-b-[1px] border-solid border-grayBorder">
                                                    <div class="cashier-dashboard-supplier-list-name pl-7">
                                                        <span
                                                            class="text-[14px] font-normal text-bodyText block mb-1">Jonathan
                                                            Doe</span>
                                                        <span
                                                            class="text-[14px] font-normal text-bodyText block">01711-525936</span>
                                                    </div>
                                                    <div
                                                        class="cashier-dashboard-supplier-list-amount border-l-[1px] border-solid border-grayBorder pl-7">
                                                        <span
                                                            class="text-[14px] font-normal text-bodyText">$4,659</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-12 xl:col-span-12 lg:col-span-6 maxLg:hidden">
                                    <div class="cashier-dashboard-user-area">
                                        <div class="cashier-dashboard-user-wrapper p-7 pt-5 bg-white rounded-lg mb-5">
                                            <div class="cashier-dashboard-user mb-6 m-0.5">
                                                <h5 class="text-[18px] text-heading font-bold">User</h5>
                                            </div>
                                            <div class="cashier-dashboard-user">
                                                <div
                                                    class="cashier-dashboard-user-list flex flex-wrap justify-between items-center mb-5">
                                                    <div
                                                        class="cashier-dashboard-user-list-left flex flex-wrap items-center">
                                                        <div
                                                            class="cashier-dashboard-user-list-left-img min-w-[60px] mr-4">
                                                            <a href="userlist.html"><img
                                                                    src="assets/img/user/user-1.png"
                                                                    alt="user not found"></a>
                                                        </div>
                                                        <div class="cashier-dashboard-user-list-left-text">
                                                            <h5 class="text-[16px] text-heading font-semibold mb-1"><a
                                                                    href="userlist.html">John
                                                                    David</a></h5>
                                                            <span
                                                                class="text-[14px] text-bodyText font-normal block">Manager</span>
                                                            <span
                                                                class="text-[12px] text-themeBlue font-normal block">Sign
                                                                in - 09:30</span>
                                                        </div>
                                                    </div>
                                                    <div class="cashier-dashboard-user-list-right">
                                                        <span
                                                            class="h-5 px-1.5 border border-solid border-themeGreenDark text-[12px] leading-18 text-themeGreenDark inline-block">Online</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="cashier-dashboard-user-list flex flex-wrap justify-between items-center mb-5">
                                                    <div
                                                        class="cashier-dashboard-user-list-left flex flex-wrap items-center">
                                                        <div
                                                            class="cashier-dashboard-user-list-left-img min-w-[60px] mr-4">
                                                            <a href="userlist.html"><img
                                                                    src="assets/img/user/user-2.png"
                                                                    alt="user not found"></a>
                                                        </div>
                                                        <div class="cashier-dashboard-user-list-left-text">
                                                            <h5 class="text-[16px] text-heading font-semibold mb-1"><a
                                                                    href="userlist.html">Killiyan
                                                                    Ampa</a></h5>
                                                            <span
                                                                class="text-[14px] text-bodyText font-normal block">Manager</span>
                                                            <span
                                                                class="text-[12px] text-themeBlue font-normal block">Sign
                                                                in - 09:25</span>
                                                        </div>
                                                    </div>
                                                    <div class="cashier-dashboard-user-list-right">
                                                        <span
                                                            class="h-5 px-1.5 border border-solid border-themeGreenDark text-[12px] leading-18 text-themeGreenDark inline-block">Online</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="cashier-dashboard-user-list flex flex-wrap justify-between items-center mb-5">
                                                    <div
                                                        class="cashier-dashboard-user-list-left flex flex-wrap items-center">
                                                        <div
                                                            class="cashier-dashboard-user-list-left-img min-w-[60px] mr-4">
                                                            <a href="userlist.html"><img
                                                                    src="assets/img/user/user-3.png"
                                                                    alt="user not found"></a>
                                                        </div>
                                                        <div class="cashier-dashboard-user-list-left-text">
                                                            <h5 class="text-[16px] text-heading font-semibold mb-1"><a
                                                                    href="userlist.html">Brandon
                                                                    Tylors</a></h5>
                                                            <span
                                                                class="text-[14px] text-bodyText font-normal block">Manager</span>
                                                            <span
                                                                class="text-[12px] text-themeBlue font-normal block">Sign
                                                                in - 09:20</span>
                                                        </div>
                                                    </div>
                                                    <div class="cashier-dashboard-user-list-right">
                                                        <span
                                                            class="h-5 px-1.5 border border-solid border-themeGreenDark text-[12px] leading-18 text-themeGreenDark inline-block">Online</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="cashier-dashboard-user-list flex flex-wrap justify-between items-center mb-5">
                                                    <div
                                                        class="cashier-dashboard-user-list-left flex flex-wrap items-center">
                                                        <div
                                                            class="cashier-dashboard-user-list-left-img min-w-[60px] mr-4">
                                                            <a href="userlist.html"><img
                                                                    src="assets/img/user/user-4.png"
                                                                    alt="user not found"></a>
                                                        </div>
                                                        <div class="cashier-dashboard-user-list-left-text">
                                                            <h5 class="text-[16px] text-heading font-semibold mb-1"><a
                                                                    href="userlist.html">William
                                                                    John</a></h5>
                                                            <span
                                                                class="text-[14px] text-bodyText font-normal block">Manager</span>
                                                            <span
                                                                class="text-[12px] text-themeBlue font-normal block">Sign
                                                                in - 09:29</span>
                                                        </div>
                                                    </div>
                                                    <div class="cashier-dashboard-user-list-right">
                                                        <span
                                                            class="h-5 px-1.5 border border-solid border-themeWarn text-[12px] leading-18 text-themeWarn inline-block">Offline</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="cashier-dashboard-user-list flex flex-wrap justify-between items-center">
                                                    <div
                                                        class="cashier-dashboard-user-list-left flex flex-wrap items-center">
                                                        <div
                                                            class="cashier-dashboard-user-list-left-img min-w-[60px] mr-4">
                                                            <a href="userlist.html"><img
                                                                    src="assets/img/user/user-5.png"
                                                                    alt="user not found"></a>
                                                        </div>
                                                        <div class="cashier-dashboard-user-list-left-text">
                                                            <h5 class="text-[16px] text-heading font-semibold mb-1"><a
                                                                    href="userlist.html">Mendela
                                                                    Peter</a></h5>
                                                            <span
                                                                class="text-[14px] text-bodyText font-normal block">Manager</span>
                                                            <span
                                                                class="text-[12px] text-themeBlue font-normal block">Sign
                                                                in - 09:22</span>
                                                        </div>
                                                    </div>
                                                    <div class="cashier-dashboard-user-list-right">
                                                        <span
                                                            class="h-5 px-1.5 border border-solid border-themeGreenDark text-[12px] leading-18 text-themeGreenDark inline-block">Online</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end inner page  -->

                <!-- copy right -->
                <div class="cashier-copyright-area">
                    <div class="cashier-copyright text-center bg-themeBlue h-20 leading-[80px] mt-20">
                        <span class="text-[15px] text-white font-normal">© Copyright by BDevs -2022-2023</span>
                    </div>
                </div>
                <!-- end copy right -->
            </div>
        </div>
    </main>

    <?php include(APPPATH . 'views/libs/footer.php'); ?>
</body>

</html>