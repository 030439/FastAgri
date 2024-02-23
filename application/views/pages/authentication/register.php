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
    <base href="<?= base_url() ?>" />
    <title>Register</title>

    <script src="assets/js/tailwind-config.js"></script>
    <link rel="stylesheet" href="assets/output.css" />
</head>

<body class="bg-bodyBg">
    <main>
        <div class="cashier-login-area flex justify-center items-center w-full h-full">
            <div class="cashier-login-wrapper" style="padding-top: 0;padding-bottom: 10px;">
                <div class="cashier-login-logo text-center" style="margin-bottom: 20px;">

                    <!-- logo img -->
                    <img src=" assets/img/logo/logo.png" alt="logo not found">

                    <!--  -->
                </div>
                <div class="cashier-select-field mb-5">
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder="Name" />
                        </div>
                        <span class="input-icon">
                            <i class="fa-light fa-user"></i>
                        </span>
                    </div>
                </div>
                <div class="cashier-select-field mb-5">
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder="Username" />
                        </div>
                        <span class="input-icon">
                            <i class="fa-light fa-user"></i>
                        </span>
                    </div>
                </div>
                <div class="cashier-select-field mb-5">
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="email" placeholder="Email" />
                        </div>
                        <span class="input-icon">
                            <i class="fa-light fa-envelope"></i>
                        </span>
                    </div>
                </div>
                <div class="cashier-select-field mb-5">
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder="Phone" />
                        </div>
                        <span class="input-icon">
                            <i class="fa-light fa-phone"></i>
                        </span>
                    </div>
                </div>
                <div class="cashier-select-field mb-5">
                    <div class="cashier-select-field-style">
                        <div class="single-input-field w-full">
                            <select class="block">
                                <option selected disabled value="default">
                                    Select Vendor
                                </option>
                                <option value="language-1">Admin</option>
                                <option value="language-2">Staff</option>
                                <option value="language-3">Customer</option>
                            </select>
                        </div>
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
                <div class="cashier-login-btn mb-7">
                    <div class="cashier-login-btn-full default-light-theme">
                        <button class="btn-primary" type="submit">Register</button>
                    </div>
                </div>
                <div class="cashier-login-footer">
                    <div class="cashier-login-footer-account text-center">
                        <span class="text-[16px] inline-block text-bodyText">Already have an account?
                            <a href="login.html" class="text-[16px] text-themeBlue">Login</a></span>
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