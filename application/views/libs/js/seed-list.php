<script>
$('#user-list').DataTable({
  buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
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
              ],
              "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();
            var totalBalance = api.column(3, { page: 'current'} ).data().reduce(function(a, b) {
                return a + (parseFloat(b) || 0);
            }, 0);
            $(api.column(3).footer()).html(totalBalance.toFixed(2));
        }
      });
    </script>