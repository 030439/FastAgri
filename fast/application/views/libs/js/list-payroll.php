<script>
$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>pays-list",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "pdate" },
                  { "data": "employee" },
                  { "data": "basic" },
                  { "data": "medical" },
                  { "data": "allowance" },
                  { "data": "total" },
                  { "data": "installment" },
                  { "data": "addition" },
                  { "data": "deduction" },
                  { "data": "net" },
                  // { "data": "ContactNo" },
                  // { "data": "ContactNo" }
                  
                  // { // Actions column
                  //    "data": "id",
                  //       "render": function(data, type, row) {
                            
                  //           return '<div style="display:flex"><a class="dropdown-menu-item edit" href="shareholders/edit/'+data+'"><span>Edit</span></a>'+
                  //                     '<a class="dropdown-menu-item detail" href="customer/detail/'+data+'"><span>Detail</span></a></div>';
                  //       }
                                      
                  // }
                  
              ]
      });
    </script>