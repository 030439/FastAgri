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
 <script src="assets/js/datatable.js"></script>
 <script src="assets/js/toaster.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

 <script>
 

 
</script>
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
   $(document).ready(function() {
 
    $('#cnic').on('input', function() {
        let cnic = $(this).val().trim().replace(/-/g, ''); // Remove existing dashes

        if (isValidCNIC(cnic)) {
            $('#cnicValidationMessage').text('CNIC is valid.').css('color', 'green');
        } else {
            $('#cnicValidationMessage').text('Invalid CNIC. Please enter a valid CNIC.').css('color', 'red');
        }

        $(this).val(cnic); // Update the input value without dashes
    });

    function isValidCNIC(cnic) {
        // CNIC validation logic without dashes
        const cnicRegex = /^\d{13}$/; // CNIC should be exactly 13 digits long
        return cnicRegex.test(cnic);
    }
});


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
    function getcustomers(){
      $.ajax({
        url: "getcustomers",
        method: 'post',
        success: function(result){
           $("#cash-selection-party").html(result);
           $('#cash-selection-party').css('display', 'block');
        }
      });
    }
    function getEmployees(){
      $.ajax({
        url: "getEmployees",
        method: 'post',
        success: function(result){
           $("#cash-selection-party").html(result);
           $('#cash-selection-party').css('display', 'block');
        }
      });
    }
    function getSuppliers(){
      $.ajax({
        url: "getSuppliers",
        method: 'post',
        success: function(result){
           $("#cash-selection-party").html(result);
           $('#cash-selection-party').css('display', 'block');
        }
      });
    }
    function OtherExpense(){
      $.ajax({
        url: "OtherExpense",
        method: 'post',
        success: function(result){
           $("#cash-selection-party").html(result);
           $('#cash-selection-party').css('display', 'block');
        }
      });
    }
    function getShareSolders(){
      $.ajax({
        url: "getShareSolders",
        method: 'post',
        success: function(sresult){
           $("#cash-selection-party").html(sresult);
           $('#cash-selection-party').css('display', 'block');
        }
      });
    }
    function jamandariAccount(){
      $.ajax({
        url: "jamandariAccount",
        method: 'post',
        success: function(sresult){
           $("#cash-selection-party").html(sresult);
           $('#cash-selection-party').css('display', 'block');
        }
      });
    }
    function getEmployeeById(id){
      $.ajax({
        url: "getEmployeeById",
        method: 'post',
        data:{id:id},
        success: function(edbi){
           $("#e-pay").val(edbi);
        }
      });
    }
    function getJamandariById(id){
      $.ajax({
        url: "getJamandariById",
        method: 'post',
        data:{id:id},
        success: function(edbi){
           $("#e-pay").val(edbi);
        }
      });
    }
    $("#cash-selection").on('change', function(){ 
      $("#e-amount").hide();
      $("#cash-selection-type").empty();
      var cashtype=$(this).val();
      if(cashtype=="cash-in"){
        var options = [
        { value: '', text: 'Select Selection Type' },
        { value: 'customer', text: 'Customer' },
        { value: 'shareholder', text: 'Shareholder' },
        { value: 'direct', text: 'Direct' }
        ];
        $.each(options, function(index, option) {
            $('#cash-selection-type').append($('<option>', option));
            $('#cash-selection-type').css('display', 'block');
        });
      }
      else if(cashtype=="cash-out"){
        var options = [
        { value: '', text: 'Select Selection Type' },
        { value: 'supplier', text: 'Supplier' },
        { value: 'shareholder', text: 'Share Holder' },
        { value: 'pay', text: 'Salary' },
        { value: 'expense', text: 'Expense' },
        { value: 'jamandari', text: 'Jamandar' }
        ];
        $.each(options, function(index, option) {
            $('#cash-selection-type').append($('<option>', option));
            $('#cash-selection-type').css('display', 'block');
        });
      }
    });
    $("#cash-selection-type").on('change', function(){ 
      var cst=$(this).val();
      var cashtype=$("#cash-selection").val();
      $("#narration-field").hide();
      $("#e-amount").hide();
      if(cashtype=="cash-in"){
        if(cst=="customer"){
          getcustomers();
        }
        else if(cst==""){
          $("#cash-selection-party").html("");
        }
        else if(cst=="shareholder"){
          getShareSolders();
          $("#narration-field").show();
        }
        else if(cst=="direct"){
          directPay();
          alert("cash out");
        }
      }
      else if(cashtype=="cash-out"){
        if(cst=="supplier"){
          getSuppliers();
          $("#narration-field").show();
        }
        else if(cst==""){
          $("#cash-selection-party").html("");
        }
        else if(cst=="pay"){
          getEmployees();
          $("#narration-field").show();
        }
        else if(cst=="shareholder"){
          getShareSolders();
          $("#narration-field").show();
        }
        else if(cst=="expense"){
          OtherExpense();
          $("#narration-field").show();
        }
        else if(cst=="jamandari"){
          jamandariAccount();
          $("#narration-field").show();
        }
      }
    });
    
    $("#cash-selection-party").on('change', function(){ 
      var cstp=$(this).val();
      var cashtype=$("#cash-selection").val();
      var cst=$("#cash-selection-type").val();
      if(cashtype=="cash-out"){
        if(cst=="pay"){
          getEmployeeById(cstp);
          $("#e-amount").show();
        }
        else if(cst=="jamandari"){
          getJamandariById(cstp);
          $("#e-amount").show();
        }
        else if(cst=="direct"){
          alert("cash out");
        }
      }
    });
</script>