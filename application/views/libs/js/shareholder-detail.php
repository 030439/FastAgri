<script>
var sid=$("#shareholder-detail-id").attr('title');
$('#user-list').DataTable({
    responsive: true,
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>shareholder/detailListing",
              type : 'post',
              data:{id:sid},
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "created" },
                  { "data": "narration" },
                  { "data": "pay_type" },
                  { "data": "amount" },
                  { "data": "fb" },
                  
              ]
      });
    </script>