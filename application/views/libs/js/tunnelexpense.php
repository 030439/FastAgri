<script>
$('#expense-list').DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
          buttons: [
              'excel'
          ],
          "ajax": {
              url : "<?php echo base_url(); ?>stock/issueStockJs",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "expense_type" },
                  { "data": "head" },
                  { "data": "rate" },
                  { "data": "qty" },
                  { "data": "amount" },
                  { "data": "edate" },
                  
              ]
      });
    </script>