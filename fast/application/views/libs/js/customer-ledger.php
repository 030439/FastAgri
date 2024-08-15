<script>
    var tid=$("#customer-ledger-id").val();
    var table = $('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>customer/ledger/list/"+tid,
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
                  { "data": "date" },
                  { "data": "amount" },
                  { "data": "total_amount" },
                  { "data": "running_balance" },
                  { 
                        "data": "type",
                        "render": function(data, type, row) {
                          var linker='';
                            if(data=="Sell"){
                                linker="sell-detail/"+row.id;
                            }else{
                              linker="cashbook/invoice/"+row.id;
                            }
                            return '<a href='+linker+' style="background-color:#86af49;padding:3px 5px;color:#fff" class="btn btn-primary">Detail</a> ';
                        }
                    }, 
                  
              ]
      });
      $('#filter').on('click', function() {
                table.ajax.reload();
            });
    </script>