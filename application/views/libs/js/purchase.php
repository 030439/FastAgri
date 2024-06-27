<script>
$('#user-list').DataTable({
    responsive: true,
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>purchase/purchaseListJs",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "product_name" },
                  { "data": "supplier_name" },
                  { "data": "rate" },
                  { "data": "amount" },
                  { "data": "purchased_quantity" },
                  { "data": "RemainingQuantity" },
                  
              ]
      });
    </script>