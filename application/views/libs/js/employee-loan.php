<script>
    var jid=$("#jid-detail").val();
$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
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