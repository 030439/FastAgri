<script>
$('#user-list').DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
          buttons: [
              'excel'
          ],
          "ajax": {
              url : "<?php echo base_url(); ?>list-jamandars",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "name" },
                  { "data": "address" },
                  { "data": "contact" },
                  { "data": "payable" },
                  { "data": "advance" },
                  { "data": "remaing" },
                  
                  { // Actions column
                     "data": "id",
                        "render": function(data, type, row) {
                            
                            return '<div style="display:flex"><a class="dropdown-menu-item edit" href="jamandar-detail/'+data+'"><span>Detail</span></a>'+
                                      '</div>';
                        }
                                      
                  }
                  
              ]
      });
    </script>