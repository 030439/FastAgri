<style>


  .loader {
    margin:200px 600px;
    display: inline-block;
    width: 80px;
    height: 80px;
    border: 8px solid #333;
    border-radius: 50%;
    border-top-color: #ff4500;
    animation: spin 1s ease-in-out infinite;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
</style>
 <!-- pre loader area start -->
 <!-- <div id="loading">
 <div class=" loader">
 </div> -->
 <div class=""></div>

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
 <script>
  $(document).ready(function(e){
    $('#issue-stock-product').on('change', function(){  
      $.ajax({
        url: "getStockQty",
        method: 'post',
        data: {
          id: $(this).val(),
        },
        success: function(result){
          $("#issue-stock-product-qty").attr("title", result);
          $('#issue-stock-product-qty').text("Remaining stock for this Product is :"+result);
        }
      });

    });
    $("#issue-quantity-val").on("keyup", function(){
        var RemainingQty=parseInt($("#issue-stock-product-qty").attr('title'));
        var inputValue = $(this).val(); // Get the value from the input field
        var cint=parseInt(inputValue);
          if(inputValue > RemainingQty){
            $("#issue-stock-qty").text("Quantity is out of Stock: " + inputValue);
          }else{
            $("#issue-stock-qty").text('');
          }
    });
  })
 </script>