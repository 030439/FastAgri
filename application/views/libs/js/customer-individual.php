<script>
  var tid=$("#customer-indi-id").val();
$('#user-list').DataTable({
    responsive: true,
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>customer/customerDetailListing",
              type : 'post',
              data:{id:tid},
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "tunnel" },
                  { "data": "Fasal" },
                  { "data": "grade" },
                  { "data": "Quantity" },
                  { "data": "Rate" },
                  { "data": "amount" },
                  { "data": "selldate" },
              ]
      });
    </script>


