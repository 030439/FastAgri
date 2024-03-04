 <!-- pre loader area start -->
 <div id="loading">
     <div id="loading-center">
         <div id="loading-center-absolute">
             <div class="loading-icon text-center flex flex-col items-center justify-center">
                 <img src="assets/img/logo/logo.png" alt="Cashiar" />
                 <img class="loading-logo" src="assets/img/logo/preloader.svg" alt="img" />
             </div>
         </div>
     </div>
 </div>
 <!-- pre loader area end -->


 <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
 <script src="assets/js/metisMenu.js"></script>
 <script src="assets/js/jquery.nice-select.js"></script>
 <script src="assets/js/swiper-bundle.min.js"></script>
 <script src="assets/js/apexcharts.js"></script>
 <script src="assets/js/main.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script type="text/javascript">

<?php if($this->session->flashdata('success')){ ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
<?php }else if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
<?php }else if($this->session->flashdata('warning')){  ?>
    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
<?php }else if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
<?php } ?>

</script>
 