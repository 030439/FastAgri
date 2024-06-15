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
              url : "<?php echo base_url(); ?>customer/list",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "Name" },
                  { "data": "company" },
                  { "data": "contact" },
                  { "data": "cnic" },
                  { "data": "Address" },
                  { 
                        "data": "status",
                        "render": function(data, type, row) {
                            console.log(data);
                            if(data==1){
                                statusName="Active";
                            }else{
                                statusName="Close";
                            }
                            return '<button style="background-color:#86af49;padding:3px 5px;color:#fff" class="btn btn-primary">'+statusName+'</button> ';
                        }
                    }, 
                  { // Actions column
                     "data": "id",
                        "render": function(data, type, row) {
                            
                            return '<div style="display:flex"><a class="dropdown-menu-item edit" href="shareholders/edit/'+data+'"><span>Edit</span></a>'+
                                      '<a class="dropdown-menu-item detail" href="customer/detail/'+data+'"><span>Detail</span></a></div>';
                        }
                                      
                  }
                  
              ]
      });
    </script>