<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
  <title>Fast Agri Tunnel System</title>
  <script src="https://cdn.tailwindcss.com/"></script>
</head>

<body class="bg-bodyBg" style="background-color:#f6f6f6">
  <main>
    <form action="<?php base_url('auth/login');?>" method="post">
        <div class="cashier-login-area flex justify-center items-center w-full h-full">
        <div class="cashier-login-wrapper">
            <div class="cashier-login-logo text-center mb-12">
            <img src="<?php echo base_url();?>assets/img/logo/logo-fatf.png" style="height:200px" alt="logo not found">
            </div>
            <div class="cashier-select-field mb-5">
            <div class="cashier-input-field-style">
                <div class="single-input-field w-full">
                <input type="text" name="email" placeholder="Username" >
                <?php validator('email')?>
                </div>
                <span class="input-icon">
                <i class="fa-light fa-user"></i>
                </span>
            </div>
            </div>
            <div class="cashier-select-field mb-5">
            <div class="cashier-input-field-style cashier-input-field-style-eye">
                <div class="single-input-field w-full">
                <input id="password-field" type="password" class="form-control" name="password" value="123456">
                <?php validator('password')?>
                <button formaction="#password-field" class="fal fa-fw fa-eye-slash field-icon toggle-password"></button>
                </div>
            </div>
            </div>
            <!-- <div class="cashier-login-footer-forgot mb-5">
            <a href="forgotpassword.html" class="text-[16px] inline-block text-themeBlue">Forgot Password?</a>
            </div> -->
            <div class="cashier-login-btn mb-7">
            <div class="cashier-login-btn-full default-light-theme">
                <button class="btn-primary" type="submit">Log
                in</button>
            </div>
            </div>
        </div>
        </div>
    </form>
  </main>
</body>
</html>