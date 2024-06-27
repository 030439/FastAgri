<script>
  var tid=$("#tunnel-expense-id").val();
$('#user-list').DataTable({
    responsive: true,
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>tunnel/getunnelsProfitList",
              type : 'post',
              data:{id:tid},
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "customer" },
                  { "data": "grade" },
                  { "data": "Quantity" },
                  { "data": "Rate" },
                  { "data": "amount" },
                  { "data": "NetAmount" },
                  { "data": "selldate" },
              ]
      });
    </script>


