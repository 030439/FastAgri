<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <base href="<?= base_url() ?>">
    <?php include(APPPATH . 'views/libs/css.php'); ?>

    <!-- <script src="assets/js/supplier.js"></script> -->
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
                    <?php include(APPPATH .'views/'.$page.'.php')?>
                </div>
                <!-- end inner page  -->

                <!-- copy right -->
                <div class="cashier-copyright-area">
                    <div class="cashier-copyright text-center bg-themeBlue h-20 leading-[80px] mt-20">
                        <span class="text-[15px] text-white font-normal">© Copyright by Techs & Designs -2023-2024</span>
                    </div>
                </div>
                <!-- end copy right -->
            </div>
        </div>
    </main>
    <?php include(APPPATH . 'views/libs/footer.php'); ?>
    
    <?php if(isset($file)):include(APPPATH . 'views/libs/js/'.$file); endif; ?>
</body>

</html>