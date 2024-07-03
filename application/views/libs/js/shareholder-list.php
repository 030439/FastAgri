<script>
$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',
    
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column
                }
            }
        ],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
          
          "ajax": {
              url : "<?php echo base_url(); ?>shareholders-list-js",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "Name" },
                  { "data": "phone" },
                  { "data": "cnic" },
                  { "data": "address" },
                  { "data": "capital_amount" },
                  { // Actions column
                     "data": "id",
                        "render": function(data, type, row) {
                            
                            return '<div style="display:flex"><a class="dropdown-menu-item edit" href="shareholders/edit/'+data+'"><span>Edit</span></a>'+
                                      '<a class="dropdown-menu-item detail" href="shareholders/detail/'+data+'"><span>Detail</span></a></div>';
                        }
                                      
                  }
              ]
      });
    </script>