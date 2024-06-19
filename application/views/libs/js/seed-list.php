<script>
$('#user-list').DataTable({
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
          buttons: [
              'excel'
          ],
          "ajax": {
              url : "<?php echo base_url(); ?>purchased/seed-list-js",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "product_name" },
                  { "data": "supplier_name" },
                  { "data": "rate" },
                  { "data": "amount" },
                  { "data": "purchased_quantity" },
                  { "data": "RemainingQuantity" },
                //   { "data": "purchase_detail_id" },
                //   { // Actions column
                //       "data": null,
                //       "defaultContent": '<div class="dropdown">'+
                //                   '<button class="common-action-menu-style">Action<i class="fa-sharp fa-solid fa-caret-down"></i></button><div class="dropdown-list">'+
                //                       '<button class="dropdown-menu-item"><img src="assets/img/icon/action-2.png"><span>Update</span></button>'+
                //                       '<button class="dropdown-menu-item"><img src="assets/img/icon/action-6.png"><span>Delete</span></button></div></div>'
                //   }
              ]
      });
    </script>