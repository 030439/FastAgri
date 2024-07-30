<script>
$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>stock/productListJs",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "Name" },
                  { "data": "unit" },
                  { "data":"RemainingQuality"},
                  { // Actions column
                     "data": "id",
                        "render": function(data, type, row) {
                            
                            return '<div style="display:flex"><a class="btn-design btn-ledger" href="products/ledger/'+data+'"><span>Ledger</span></a>'+
                            '<a class="btn-design btn-edit" href="stock/editProduct/'+data+'"><span>Edit</span></a></div>';
                        }
                                      
                  }
                  
              ]
      });
    </script>