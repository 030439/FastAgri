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
                "data": "status",
                "render": function(data, type, row) {
                    if(row.status==1){
                        statusName="Active";
                        color_="#27DB8D";
                    }else{
                        statusName="Close";
                        color_="#FFC403";
                    }
                    return '<button  onclick="handleButtonClick(\'' + data + '\')" class="btn-design btn-exp">Expense</button>'+
                    '<button  onclick="profitButtonClick(\'' + data + '\')" class="btn-design btn-detail">Profit</button>'+
                    '<button style="background-color:'+color_+';padding:3px 5px;color:#fff; margin:0px 3px" onclick="statusButtonClick(\'' + row.id + '\')" class="btn btn-primary">'+statusName+'</button>'+
                    '<button  onclick="editButtonClick(\'' + data + '\')" class="btn-design btn-edit">Edit</button>'+
                    '<button  onclick="ledgerButtonClick(\'' + row.id + '\')" class="btn-design btn-ledger">Ledger</button> ';
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