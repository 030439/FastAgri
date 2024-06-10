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
                        <div class="col-span-12 xxl:col-span-12 xl:col-span-12">
                            <div class="invention-quickreport-area pl-0.5">
                                <div class="cashier-quickview-area p-7 pt-5 pb-2 bg-white rounded-lg mb-5">
                                    <div
                                        class="cashier-dashboard-supplier-header flex flex-wrap items-center justify-between mb-6 m-0.5">
                                        
                                    <div
                                        class="cashier-quickview-wrapper flex items-center justify-between gap-x-5 maxXs:gap-x-0">
                                        <div class="cashier-quickview bg-[#EEF0F8] mb-5 rounded-lg">
                                            <a href="#" class="p-[30px] inline-block">
                                                <div class="cashier-quickview-box">
                                                    <div class="cashier-quickview-box-icon mb-5">
                                                        <img src="assets/img/icon/quick-1.png" alt="icon not found"
                                                            class="inline-block rounded-[15px]">
                                                    </div>
                                                    <h4 class="text-[22px] font-extrabold text-heading"><?php echo $data['tunnels'];?></h4>
                                                    <span
                                                        class="block text-[15px] font-semibold text-bodyText mb-8">Active 
                                                        Tunnels</span>
                                                    <span
                                                        class="h-[35px] rounded-[17px] bg-white inline-block text-[14px] font-semibold leading-[35px] px-3 min-w-[70px] text-center text-heading">+65%</span>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="cashier-quickview bg-[#F8F0E7] mb-5 rounded-lg">
                                            <a href="#" class="p-[30px] inline-block">
                                                <div class="cashier-quickview-box">
                                                    <div class="cashier-quickview-box-icon mb-5">
                                                        <img src="assets/img/icon/quick-2.png" alt="icon not found"
                                                            class="inline-block rounded-[15px]">
                                                    </div>
                                                    <h4 class="text-[22px] font-extrabold text-heading"><?php echo $data['shareholders'];?></h4>
                                                    <span
                                                        class="block text-[15px] font-semibold text-bodyText mb-8"> Share Holders
                                                        </span>
                                                    <span
                                                        class="h-[35px] rounded-[17px] bg-white inline-block text-[14px] font-semibold leading-[35px] px-3 min-w-[70px] text-center text-heading">+3.47%</span>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="cashier-quickview bg-[#F9E8E8] mb-5 rounded-lg">
                                            <a href="#" class="p-[30px] inline-block">
                                                <div class="cashier-quickview-box">
                                                    <div class="cashier-quickview-box-icon mb-5">
                                                        <img src="assets/img/icon/quick-3.png" alt="icon not found"
                                                            class="inline-block rounded-[15px]">
                                                    </div>
                                                    <h4 class="text-[22px] font-extrabold text-heading"><?php echo $data['employees'];?></h4>
                                                    <span
                                                        class="block text-[15px] font-semibold text-bodyText mb-8">Total Employees
                                                        </span>
                                                    <span
                                                        class="h-[35px] rounded-[17px] bg-white inline-block text-[14px] font-semibold leading-[35px] px-3 min-w-[70px] text-center text-heading">-2.8%</span>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="cashier-quickview bg-[#E6F2E2] mb-5 rounded-lg">
                                            <a href="#" class="p-[30px] inline-block">
                                                <div class="cashier-quickview-box">
                                                    <div class="cashier-quickview-box-icon mb-5">
                                                        <img src="assets/img/icon/quick-4.png" alt="icon not found"
                                                            class="inline-block rounded-[15px]">
                                                    </div>
                                                    <h4 class="text-[22px] font-extrabold text-heading"><?php echo $data['famount'];?></h4>
                                                    <span
                                                        class="block text-[15px] font-semibold text-bodyText mb-8">Runnig Balance
                                                        </span>
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
                                                            <a href="#"><img
                                                                    src="assets/img/user/user-1.png"
                                                                    alt="user not found"></a>
                                                        </div>
                                                        <div class="cashier-dashboard-user-list-left-text">
                                                            <h5 class="text-[16px] text-heading font-semibold mb-1"><a
                                                                    href="#">John
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
                                                            <a href="#"><img
                                                                    src="assets/img/user/user-2.png"
                                                                    alt="user not found"></a>
                                                        </div>
                                                        <div class="cashier-dashboard-user-list-left-text">
                                                            <h5 class="text-[16px] text-heading font-semibold mb-1"><a
                                                                    href="#">Killiyan
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
                                                            <a href="#"><img
                                                                    src="assets/img/user/user-3.png"
                                                                    alt="user not found"></a>
                                                        </div>
                                                        <div class="cashier-dashboard-user-list-left-text">
                                                            <h5 class="text-[16px] text-heading font-semibold mb-1"><a
                                                                    href="#">Brandon
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
                                                            <a href="#"><img
                                                                    src="assets/img/user/user-4.png"
                                                                    alt="user not found"></a>
                                                        </div>
                                                        <div class="cashier-dashboard-user-list-left-text">
                                                            <h5 class="text-[16px] text-heading font-semibold mb-1"><a
                                                                    href="#">William
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
                                                            <a href="#"><img
                                                                    src="assets/img/user/user-5.png"
                                                                    alt="user not found"></a>
                                                        </div>
                                                        <div class="cashier-dashboard-user-list-left-text">
                                                            <h5 class="text-[16px] text-heading font-semibold mb-1"><a
                                                                    href="#">Mendela
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
                    <span class="text-[15px] text-white font-normal">© Applet Services <?php echo date("Y"); ?></span> </div>
                </div>
                <!-- end copy right -->
            </div>
        </div>
    </main>

    <?php include(APPPATH . 'views/libs/footer.php'); ?>
</body>

</html>