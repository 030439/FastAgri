<script>
  var eid=$("#customer-indi-id").val();
  var table=$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>direct/customerDetailListing/"+eid,
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
                  { "data": "product_name" },
                  { "data": "Quantity" },
                  { "data": "pqrate" },
                  { "data": "total" },
                  { "data": "i_date" },
              ],
           
      });
      $('#filter').on('click', function() {
        table.ajax.reload();
    });
    </script>


