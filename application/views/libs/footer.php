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
    $('#cnic').on('input', function() {
                let cnic = $(this).val().trim().replace(/-/g, ''); // Remove existing dashes
                cnic = addDashes(cnic); // Add dashes back

                if (isValidCNIC(cnic)) {
                    $('#cnicValidationMessage').text('CNIC is valid.');
                } else {
                    $('#cnicValidationMessage').text('Invalid CNIC. Please enter a valid CNIC.');
                }

                $(this).val(cnic); // Update the input value with the formatted CNIC
            });

          

    function isValidCNIC(cnic) {
      // CNIC validation logic
      const cnicRegex = /^\d{5}-\d{7}-\d{1}$/;
      return cnicRegex.test(cnic);
    }

    function addDashes(cnic) {
      // Add dashes to CNIC number
      const formattedCnic = [];
      for (let i = 0; i < cnic.length; i++) {
        formattedCnic.push(cnic[i]);
        if ((i === 4 || i === 11) && cnic[i] !== '-') {
          formattedCnic.push('-');
        }
      }
      return formattedCnic.join('');
    }

    $(document).ready(function() {
        $('#dataFilter').on('input', function() {
            let filterValue = $(this).val().toLowerCase().trim();
            filterData(filterValue);
        });

        function filterData(filterValue) {
            $.ajax({
                url: 'supplierFilter', // Backend script to handle filtering
                method: 'POST',
                data: { filterValue: filterValue },
                success: function(response) {
                    $('#filteredData').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>

 <script>
  $(document).ready(function(e){
    $('#issue-stock-product-with-price').on('change', function(){ 
         $.ajax({
        url: "getStockRate",
        method: 'post',
        data: {
          id: $(this).val(),
        },
        success: function(result){
         
          $("#avaiable-stock-rates").html (result);
           $('#avaiable-stock-rates').css('display', 'block');
          // $('.nice-select').remove();

        }
      });
    });

   
    $('#avaiable-stock-rates').on('change', function(){  
      var Qty = $(this).find('option:selected').attr('title');
    $('#issue-stock-product-qty').text("Remaining stock for this Product is :"+Qty);
    $("#issue-stock-product-qty").attr("title", Qty);

    });
    // $("#issue-quantity-val").on("keyup", function(){
    //     var RemainingQty=parseInt($("#issue-stock-product-qty").attr('title'));
    //     alert(RemainingQty);
    //     var inputValue = $(this).val(); // Get the value from the input field
    //     var cint=parseInt(inputValue);
    //       if(inputValue > RemainingQty){
    //         $("#issue-stock-qty").text("Quantity is out of Stock: " + inputValue);
    //       }else{
    //         $("#issue-stock-qty").text('');
    //       }
    // });
  })
  function checkQty(v){
    var RemainingQty=parseInt($("#issue-stock-product-qty").attr('title'));
        var inputValue = $(v).val(); // Get the value from the input field
        var cint=parseInt(inputValue);
          if(inputValue > RemainingQty){
            $("#issue-stock-qty-").text("Quantity is out of Stock: 2");
            $("#issue-stock-qty-").css("color", "red");
            $("#issue-stock-btn").prop("disabled", true);
          }else{
            $("#issue-stock-btn").prop("disabled", false);
            $("#issue-stock-qty-").text('');
          }
  }
  function productionTunnel(ele){
    var id = $(ele).val();
    getProductByTunnel(id);
  }
  function getProductByTunnel(id){
    $.ajax({
        url: "tunnelProduct",
        method: 'post',
        data: {
          id: id,
        },
        success: function(result){
          $("#production-product").val (result);
          $('#production-product').prop('disabled', true);
        }
      });
  }
  function readySell(e){
    var v=$(e).val();
    var title=$(e).attr('title');
    $.ajax({
        url: "tunnelProduct",
        method: 'post',
        data: {
          id: v,
        },
        success: function(result){
          $("#productSelect-"+title).val (result);
          $('#productSelect-'+title).prop('disabled', true);
        }
      });
  }
  function sellGrade(s){
    var vg=$(s).val();
    var titleg=$(s).attr('title');
    var gt=$("#tunnelSelect-"+titleg).val();
    
    if(gt==0){
      alert("select tunnel First");
      return false;
    }
    $.ajax({
        url: "readyQuantity",
        method: 'post',
        data: {
          grade: vg,tunnel:gt
        },
        success: function(result){
          console.log(result);
           $("#bagsInput-"+titleg).attr('data-tag',result);
           $("#bagsInputres-"+titleg).text("Ready Quantity"+result);
          // $('#productSelect-'+title).prop('disabled', true);
        }
      });
  }
  function checkValue(input) {
    var enteredValue = parseFloat(input.value);
    var dataTagValue = parseFloat(input.getAttribute('data-tag'));
    var title = parseFloat(input.getAttribute('title'));    
    const resultElement = document.getElementById('result');
    if (!isNaN(enteredValue) && enteredValue > dataTagValue) {
      $("#bagsInputres-"+title).text("Out of Stock");
      $("#bagsInputres-" + title).css('color', 'red');
    } else {
      $("#bagsInputres-"+title).text("Ready Quantity"+dataTagValue);
      $("#bagsInputres-" + title).css('color', 'green');
    }
}
  function calculateTotal() {
      var total = 0;
      // var bill_labour=parseInt($("#bill-labour").val());
      // var bill_expense=parseInt($("#bill-expense").val());
    
      $('.total-bill-amount').each(function() {
        var rate=$(this).val();
        var bill_amount=parseFloat(rate);
        total += bill_amount;
      });
      // total+=bill_labour;
      // total+=bill_expense
      $('#all-total-bill').val(total);
  }
  function getValues(row,v){
    var rv=$("#quantity-"+row).text();
    var vint = parseInt(rv);
    var total_=v*vint;
    $("#amount-"+row).val(total_);
    calculateTotal();
  }
 </script>
 <script>
   $(".get-rate-bill").keyup(function(e){
    var row=$(this).attr('title');
    var row_value=$(this).val();
    getValues(row,row_value);
   });
   function getPermanentEmployees(){
    $.ajax({
        url: "getPermanentEmployees",
        method: 'post',
        success: function(result){
           $("#loan-employee-names").html(result);
           $('#loan-employee-names').show();
        }
      });
   }
   function getDailyEmployees(){
    $.ajax({
        url: "getDailyEmployees",
        method: 'post',
        success: function(result){
           $("#loan-employee-names").html(result);
           $('#loan-employee-names').show();
        }
      });
   }
   function getJamandars(){
    $.ajax({
        url: "getJamandars",
        method: 'post',
        success: function(result){
           $("#loan-employee-names").html(result);
           $('#loan-employee-names').show();
        }
      });
   }
   $('#loan-employee-type').on('change', function(){  
    let loanEmployeeType=$(this).val();
    if(loanEmployeeType==1){
      getPermanentEmployees();
    }
    if(loanEmployeeType==2){
      getDailyEmployees();
    }
    if(loanEmployeeType==3){
      getJamandars();
    }

    });
    $(".net-sallary-by-installment").keyup(function(e){
      var netS = $(this).attr('title');
      var insta = parseInt($("#installment-" + netS).val());
      var addition = parseInt($("#additon-" + netS).val());
      var deduction = parseInt($("#deduction-" + netS).val());
      var total = parseInt($("#total-" + netS).val());
      var Total_ = total + addition - deduction - insta;
      $("#net-" + netS).val(Total_);

    });
    function reports(_url_){
      window.open(_url_, '_blank');
    }
</script>