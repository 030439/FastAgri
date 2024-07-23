<script>
    var eid=$("#employee-ledger-id").val();
$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
          "ajax": {
              url : "<?php echo base_url(); ?>employee-ledger/"+eid,
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "_date_" },
                  { "data": "total" },
                  { "data": "additon" },
                  { "data": "deduction" },
                  { "data": "net" },
                  { "data": "pay_month" },
                  { "data": "type" },
                  { "data": "pay" },
                  { "data": "running_balance" },
                  { 
                        "data": "type",
                        "render": function(data, type, row) {
                          var linker='';
                            if(data=="Payable"){
                                linker="payroll";
                            }else{
                              linker="report";
                            }
                            return '<a href='+linker+' style="background-color:#86af49;padding:3px 5px;color:#fff" class="btn btn-primary">Detail</a> ';
                        }
                    }, 
                  
              ]
      });
    </script>