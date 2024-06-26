<script>
  var tid=$("#tunnel-expense-id").val();
$('#user-list').DataTable({
    responsive: true,
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
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


