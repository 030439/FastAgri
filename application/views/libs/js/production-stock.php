<script>
$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>Production-stock-list",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "product" },
                  { "data": "ac" },
                  { "data":"bc"},
                  { // Actions column
                     "data": "pid",
                        "render": function(data, type, row) {       
                            return (parseFloat(row.ac)+parseFloat(row.bc));
                        }
                                      
                  },
              ],
      });
    </script>