<script>
    var jid=$("#jid-detail").val();
$('#user-list').DataTable({
    responsive: true,
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
      buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
          "ajax": {
              url : "<?php echo base_url(); ?>employee-loan-listing",
              type : 'post',
              data:{id:jid},
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "employee" },
                  { "data": "category" },
                  { "data": "amount" },
                  { "data": "installment" },
                  { "data": "date_" },
                  
              ]
      });
    </script>