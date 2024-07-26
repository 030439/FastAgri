<script>
 var table =$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>stock/issueStockJs",
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
                  { "data": "TName" },
                  { "data": "employee" },
                  { "data": "product_name" },
                  { "data": "Quantity" },
                  { "data": "pqrate" },
                  { "data": "i_date" },
                  
              ]

      });
      $('#filter').on('click', function() {
                table.ajax.reload();
            });

    </script>