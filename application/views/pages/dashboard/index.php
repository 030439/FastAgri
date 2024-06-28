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