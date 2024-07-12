<script>
$('#user-list').DataTable({
    "processing": true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "serverSide": true,
      dom: 'Bfrtip',
         

          "ajax": {
              url : "<?php echo base_url(); ?>asset-list-js",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
            { "data": "asset" },
            { "data": "cost" },
            { "data": "cDate" },
            
            { 
                "data": "id",
                "render": function(data, type, row) {
                    return '<a style="background-color:#86af49;padding:3px 5px;color:#fff" href="asset-edit/'+data+'" class="btn btn-primary">Update</a> ';
                }
            }, 
            { 
                "data": "id",
                "render": function(data, type, row) {
                    
                    return '<a style="background-color:#ec6f16;padding:3px 5px;color:#fff" href="asset-detail/'+data+'" class="btn btn-primary">Detail</a> ';
                }
            }, 
            ]
      });
      
        
       

        

    </script>
