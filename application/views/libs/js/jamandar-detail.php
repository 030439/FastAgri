<script>
    var jid=$("#jid-detail").val();
$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>issued-jamandar-labour",
              type : 'post',
              data:{id:jid},
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                 { "data": "date_" },
                  { "data": "TName" },
                  { "data": "lq" },
                  { "data": "rate" },
                  { "data": "deduction" },
                  { "data": "total_amount" },
                  { "data": "amount_" },
                  { "data": "running_balance" },
              ],
              "footerCallback": function (row, data, start, end, display) {
                    var api = this.api();

                    // Recalculate total for dynamically rendered column
                    var total = 0;
                    var total_debit=0;
                    var total_deduction=0;
                    data.forEach(function(row) {
                        var quantity = parseFloat(row.total_amount) || 0;
                        total += quantity ;
                        var debit = parseFloat(row.amount_) || 0;
                        total_debit += debit ;
                        var deduction= parseFloat(row.deduction) || 0;
                        total_deduction += deduction ;
                    });
                    

                    // Update footer
                    $(api.column(4).footer()).html(total_deduction.toFixed(2));
                    $(api.column(5).footer()).html(total.toFixed(2));
                    $(api.column(6).footer()).html(total_debit.toFixed(2));
                }
      });
    </script>