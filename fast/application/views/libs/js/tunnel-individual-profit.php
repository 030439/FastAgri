<script>
    $(document).ready(function() {
  var tid=$("#tunnel-expense-id").val();
  var table = $('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>tunnel/getunnelsProfitList/"+tid,
              type : 'post',
              data: function(d) {
                        d.startDate = $('#start-date').val();
                        d.endDate = $('#end-date').val();
                    },
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                { "data": "selldate" },
                { "data": "customer" },
                { "data": "grade" },
                { "data": "Quantity" },
                { "data": "Rate" },
                { "data": "amount" },
                { "data": "Labour" },
                { "data": "commission" },
                { "data": "fre" },
                { "data": "NetAmount" },
               
              ],
              "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();
            var totalBalance = api.column(4, { page: 'current'} ).data().reduce(function(a, b) {
                return a + (parseFloat(b) || 0);
            }, 0);
            var totalNet = api.column(5, { page: 'current'} ).data().reduce(function(a, b) {
                return a + (parseFloat(b) || 0);
            }, 0);

            // Update footer
            $(api.column(4).footer()).html(totalBalance.toFixed(2));
            $(api.column(5).footer()).html(totalNet.toFixed(2));
        }
      });
      $('#filter').on('click', function() {
                table.ajax.reload();
            });
});
    </script>


