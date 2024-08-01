<script>
    var tid=$("#product-ledger-id").val();
    var table=$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
          "ajax": {
              url : "<?php echo base_url(); ?>product/productLederList/"+tid,
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
                  { "data": "date_" },
                  { "data": "tname" },
                  { "data": "employeeOrSupplier" },
                  { "data": "quantity" },
                  { "data": "rate" },
                  { "data": "amount" },
                  { "data": "running_balance" },
                  { 
                        "data": "type",
                        "render": function(data, type, row) {
                          var linker='';
                            if(data=="issue"){
                                linker="stock/listissue";
                            }else{
                              linker="purchase/detail/"+row.detail;
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