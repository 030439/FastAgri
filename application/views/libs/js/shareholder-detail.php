<script>
var sid=$("#shareholder-detail-id").attr('title');
$('#user-list').DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
          buttons: [
              'excel'
          ],
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