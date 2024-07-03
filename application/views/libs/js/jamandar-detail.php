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
                  { "data": "TName" },
                  { "data": "lq" },
                  { "data": "rate" },
                  { "data": "total_amount" },
                  { "data": "create_at" },
              ],
              "footerCallback": function (row, data, start, end, display) {
                    var api = this.api();

                    // Recalculate total for dynamically rendered column
                    var total = 0;
                    data.forEach(function(row) {
                        var quantity = parseFloat(row.total_amount) || 0;
                        total += quantity ;
                    });

                    // Update footer
                    $(api.column(3).footer()).html(total.toFixed(2));
                }
      });
    </script>