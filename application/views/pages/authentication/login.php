<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/font-awesome-pro.css" />
    <link rel="stylesheet" href="assets/css/metisMenu.css" />
    <link rel="stylesheet" href="assets/css/swiper-bundle.css" />
    <link rel="stylesheet" href="assets/css/nice-select.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <base href="<?= base_url() ?>">
    <title>login</title>


    <script src="assets/js/tailwind-config.js"></script>
    <link rel="stylesheet" href="assets/output.css" />
</head>

<body class="bg-bodyBg">
    <main>
        <div class="cashier-login-area flex justify-center items-center w-full h-full">
            <div class="cashier-login-wrapper">
                <div class="cashier-login-logo text-center mb-12">
                    <!-- here logo -->
                    <img src="assets/img/logo/logo.png" alt="logo not found" />
                    <!--  -->
                </div>
                <div class="cashier-select-field mb-5">
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder="Username" value="Admin" />
                        </div>
                        <span class="input-icon">
                            <i class="fa-light fa-user"></i>
                        </span>
                    </div>
                </div>
                <div class="cashier-select-field mb-5">
                    <div class="cashier-input-field-style cashier-input-field-style-eye">
                        <div class="single-input-field w-full">
                            <input id="password-field" type="password" class="form-control" name="password"
                                value="123456" />
                            <button formaction="#password-field"
                                class="fal fa-fw fa-eye-slash field-icon toggle-password"></button>
                        </div>
                    </div>
                </div>
                <div class="cashier-login-footer-forgot mb-5">
                    <a href="forgotpassword.html" class="text-[16px] inline-block text-themeBlue">Forgot Password?</a>
                </div>
                <div class="cashier-login-btn mb-7">
                    <div class="cashier-login-btn-full default-light-theme">
                        <button class="btn-primary" onclick="document.location='dashboard.html'" type="submit">
                            Log in
                        </button>
                    </div>
                </div>
                <div class="cashier-login-footer">
                    <div class="cashier-login-footer-account text-center">
                        <span class="text-[16px] inline-block text-bodyText">Have not an account?
                            <a href="register.html" class="text-[16px] text-themeBlue">Register</a></span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/metisMenu.js"></script>
    <script src="assets/js/jquery.nice-select.js"></script>
    <script src="assets/js/apexcharts.js"></script>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>