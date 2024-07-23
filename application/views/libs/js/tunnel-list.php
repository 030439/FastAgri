<script>
$('#user-list').DataTable({
    "processing": true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "serverSide": true,
      dom: 'Bfrtip',
         

          "ajax": {
              url : "<?php echo base_url(); ?>tunnels-list-js",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
            { "data": "TName" },
            { "data": "product" },
            { "data": "CoveredArea" },
            { "data": "cDate" },
            { 
                "data": "id",
                "render": function(data, type, row) {
                    
                    return '<button style="background-color:#ec6f16;padding:3px 5px;color:#fff" onclick="handleButtonClick(\'' + data + '\')" class="btn btn-primary">Expense</button> ';
                }
            },
            { 
                "data": "id",
                "render": function(data, type, row) {
                    return '<button style="background-color:#86af49;padding:3px 5px;color:#fff" onclick="profitButtonClick(\'' + data + '\')" class="btn btn-primary">Profit</button> ';
                }
            },
            { 
                "data": "status",
                "render": function(data, type, row) {
                    console.log(data);
                    if(data==1){
                        statusName="Active";
                    }else{
                        statusName="Close";
                    }
                    return '<button style="background-color:#86af49;padding:3px 5px;color:#fff" onclick="statusButtonClick(\'' + row.id + '\')" class="btn btn-primary">'+statusName+'</button> ';
                }
            },
            { 
                "data": "id",
                "render": function(data, type, row) {
                    return '<button style="background-color:#86af49;padding:3px 5px;color:#fff" onclick="ledgerButtonClick(\'' + data + '\')" class="btn btn-primary">Ledger</button> ';
                }
            },  
            ]
      });
        function handleButtonClick(id) {
            window.location.href="tunnel/tunnle-expense/"+id
        }
        function statusButtonClick(id) {
            $.ajax({
                url:"tunnel-status",
                method:"post",
                data:{id:id},
                success:function(e){
                    window.location.reload();
                }

            })
        }
        function profitButtonClick(id) {
            window.location.href="tunnel/tunnle-profit/"+id
        }
        function ledgerButtonClick(id) {
            window.location.href="tunnels/tunnle-ledger/"+id
        }
    </script>