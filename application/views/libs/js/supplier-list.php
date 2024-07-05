<script>
$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>supplier/list",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "Name" },
                  { "data": "company_name" },
                  { "data": "contact" },
                  { "data": "cnic" },
                  { "data": "Address" },
                  { "data": "close"},
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
                            
                            return '<div style="display:flex">'+
                                      '<a class="dropdown-menu-item" style="background-color:#16ced4; margin:0px 2px" href="supplier/'+data+'"><span>Detail</span></a>'+
                                      '<a class="dropdown-menu-item" style="background-color:#18c173" href="supplier/ledger/'+data+'"><span>Ledger</span></a></div>';
                        }
                                      
                  }
                  
              ]
      });
    </script>