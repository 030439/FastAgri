<script>
var sid=$("#supplier-detail-id").attr('title');
$('#user-list').DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
          buttons: [
              'excel'
          ],
          "ajax": {
              url : "<?php echo base_url(); ?>supplier/detail/listing/"+sid,
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "product_name" },
                  { "data": "purchased_quantity" },
                  { "data": "rate" },
                  { 
                        "data": null, 
                        "render": function(data, type, row) {
                            return (parseFloat(row.purchased_quantity) * parseFloat(row.rate)).toFixed(2);
                        },
                        "orderable": false  // Make it non-orderable if necessary
                    },
                  { "data": "purchase_date" },
                  
              ]
      });
    </script>