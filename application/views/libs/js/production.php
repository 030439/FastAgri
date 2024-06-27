<script>
$('#user-list').DataTable({
    responsive: true,
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>production/getProductionListing",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "tunnel" },
                  { "data": "ProductName" },
                  { "data":"grade"},
                  { "data": "unit" },
                  { "data":"qty"},
                  { "data":"pdate"},
                  {
                     "data": "id",
                        "render": function(data, type, row) {
                            
                            return '<div style="display:flex"><a class="dropdown-menu-item edit" href="load-product/'+data+'"><span>Sell Out</span></a></div>';
                        }
                                      
                  }
                  
              ]
      });
    </script>