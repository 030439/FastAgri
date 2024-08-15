<script>
$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>direct/list",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "Name" },
                  { "data": "contact" },
                  { "data": "cnic" },
                  { "data": "Address" },
                  { 
                        "data": "status",
                        "render": function(data, type, row) {
                            if(row.status==1){
                                statusName="Active";
                                color_="#27DB8D";
                            }else{
                                statusName="Close";
                                color_="#FFC403";
                            }
                            return '<a href="direct/detail/'+row.id+'" class="btn-design btn-exp">Detail</a>'+
                            '<a style="background-color:'+color_+';" class="btn-design">'+statusName+'</a>'+
                            '<a  href="direct/edit/'+row.id+'" class="btn-design btn-edit">Edit</a>'+
                            '<a  href="direct/ledger/'+row.id+'" class="btn-design btn-ledger">Ledger</a> ';
                        }
                    }
                  
              ]
      });
    </script>