<script>
$('#user-list').DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
          buttons: [
              'excel'
          ],
          "ajax": {
              url : "<?php echo base_url(); ?>tunnels/profitListing",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "tunnel" },
                  { "data": "customer" },
                  { "data": "grade" },
                  { "data": "Quantity" },
                  { "data": "Rate" },
                  { "data": "amount" },
                  { "data": "selldate" },
              ]
      });
    </script>


