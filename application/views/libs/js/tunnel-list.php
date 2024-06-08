<script>
$('#user-list').DataTable({
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
          buttons: [
              'excel'
          ],

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
                    console.log(data);
                    return '<button style="background-color:#86af49;padding:3px 5px;color:#fff" onclick="handleButtonClick(\'' + data + '\')" class="btn btn-primary">Expense</button> ';
                }
            },
            { 
                "data": "id",
                "render": function(data, type, row) {
                    console.log(data);
                    return '<button style="background-color:#b5e7a0;padding:3px 5px;color:#fff" onclick="profitButtonClick(\'' + data + '\')" class="btn btn-primary">Profit</button> ';
                }
            },
            { "data": "status" },
            { // Actions column
                "data": null,
                "defaultContent": '<div class="dropdown">'+
                            '<button class="common-action-menu-style">Action<i class="fa-sharp fa-solid fa-caret-down"></i></button><div class="dropdown-list">'+
                                '<button class="dropdown-menu-item"><img src="assets/img/icon/action-2.png"><span>Update</span></button>'+
                                '<button class="dropdown-menu-item"><img src="assets/img/icon/action-6.png"><span>Delete</span></button></div></div>'
            },
                  
              ]
      });
        function handleButtonClick(id) {
            window.location.href="tunnel/tunnle-expense/"+id
        }
        function profitButtonClick(id) {
            window.location.href="tunnel/tunnle-profit/"+id
        }
    </script>