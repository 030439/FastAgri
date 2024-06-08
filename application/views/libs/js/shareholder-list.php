<script>
$('#user-list').DataTable({
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
          buttons: [
              'excel'
          ],
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
                      "data": null,
                      "defaultContent": '<div class="dropdown">'+
                                  '<button class="common-action-menu-style">Action<i class="fa-sharp fa-solid fa-caret-down"></i></button><div class="dropdown-list">'+
                                      '<button class="dropdown-menu-item"><img src="assets/img/icon/action-2.png"><span>Update</span></button>'+
                                      '<button class="dropdown-menu-item"><img src="assets/img/icon/action-6.png"><span>Delete</span></button></div></div>'
                  }
              ]
      });
    </script>