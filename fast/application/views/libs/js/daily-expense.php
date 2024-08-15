<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>expense-listing",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "name" },
                  { "data": "narration" },
                  { "data": "amount" },
                  { 
                    "data": "created_at",
                    "render": function(data, type, full, meta) {
                        return moment(data).format('YYYY-MM-DD');
                    }
                },
              ],
              "footerCallback": function (row, data, start, end, display) {
                    var api = this.api();

                    // Recalculate total for dynamically rendered column
                    var total = 0;
                    data.forEach(function(row) {
                        var quantity = parseFloat(row.amount) || 0;
                        total += quantity ;
                    });

                    // Update footer
                    $(api.column(2).footer()).html(total.toFixed(2));
                }
      });
    </script>