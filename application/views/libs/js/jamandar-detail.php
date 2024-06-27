<script>
    var jid=$("#jid-detail").val();
$('#user-list').DataTable({
    responsive: true,
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
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
                  
                //   { // Actions column
                //      "data": "id",
                //         "render": function(data, type, row) {
                            
                //             return '<div style="display:flex"><a class="dropdown-menu-item edit" href="shareholders/edit/'+data+'"><span>Edit</span></a>'+
                //                       '<a class="dropdown-menu-item detail" href="customer/detail/'+data+'"><span>Detail</span></a></div>';
                //         }
                                      
                //   }
                  
              ]
      });
    </script>