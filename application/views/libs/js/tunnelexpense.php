<script>
  var tid=$("#tunnel-expense-id").val();
$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
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
              ],
              "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();
            var totalBalance = api.column(4, { page: 'current'} ).data().reduce(function(a, b) {
                return a + (parseFloat(b) || 0);
            }, 0);

            // Update footer
            $(api.column(4).footer()).html(totalBalance.toFixed(2));
        }
      });
    </script>


