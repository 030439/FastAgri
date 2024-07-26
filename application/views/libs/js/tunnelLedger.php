<script>
   $(document).ready(function() {
  var tid=$("#tunnel-expense-id").val();
  var table =  $('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>tunnels/tunnle-ledger-listing/"+tid,
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
                  { "data": "type" },
                  { "data": "head" },
                  { "data": "rate_" },
                  { "data": "qty_" },
                  { "data": "amount" },
                  { "data": "entryDate" },
                  { 
                        "data": "type",
                        "render": function(data, type, row) {
                          var linker='';
                            if(data=="Sell"){
                                linker="sell-detail/"+row.entry_id;
                            }else{
                              linker="report/"+row.entry_id;
                            }
                            return '<a href='+linker+' style="background-color:#86af49;padding:3px 5px;color:#fff" class="btn btn-primary">Detail</a> ';
                        }
                    }, 
                  // { "data": "edate" },
              ],
        //       "footerCallback": function ( row, data, start, end, display ) {
        //     var api = this.api();
        //     var totalBalance = api.column(4, { page: 'current'} ).data().reduce(function(a, b) {
        //         return a + (parseFloat(b) || 0);
        //     }, 0);

        //     // Update footer
        //     $(api.column(4).footer()).html(totalBalance.toFixed(2));
        // }
      });
      $('#filter').on('click', function() {
                table.ajax.reload();
            });
});
    </script>


