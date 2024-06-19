<script>
  var tid=$("#tunnel-expense-id").val();
$('#user-list').DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
          buttons: [
              'excel'
          ],
          "ajax": {
              url : "<?php echo base_url(); ?>tunnel/getunnelsExpenseList",
              type : 'post',
              data:{id:tid},
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
                  // { "data": "edate" },
              ]
      });
    </script>


