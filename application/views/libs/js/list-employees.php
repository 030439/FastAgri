<script>
$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>employees-listing",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "Name" },
                  { "data": "designation" },
                  { "data": "category" },
                  { "data": "Address" },
                  { "data": "ContactNo" },
                  { "data": "BasicSalary" },
                  { // Actions column
                     "data": "id",
                        "render": function(data, type, row) {
                            
                            return '<a class="btn-design btn-ledger" href="employee/ledger/'+data+'">Ledger</a>'+
                            '<a class="btn-design btn-edit" href="employee/edit/'+data+'">Edit</a>';
                        }
                                      
                  }
                  
              ]
      });
    </script>