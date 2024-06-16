<script>
var sid=$("#supplier-detail-id").attr('title');
$('#user-list').DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
          buttons: [
              'excel'
          ],
          "ajax": {
              url : "<?php echo base_url(); ?>supplier/detail/listing/"+sid,
              type : 'get',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "Name" },
                  { "data": "company_name" },
                  { "data": "contact" },
                  { "data": "cnic" },
                  { "data": "Address" },
                  { "data": "close"},
                  
              ]
      });
    </script>