<script>
var sid=$("#supplier-detail-id").attr('title');
var table =$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>supplier/detail/listing/"+sid,
              type : 'post',
              data: function(d) {
                d.startDate = $('#start-date').val();
                d.endDate = $('#end-date').val();
              },
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
                  
              ],
              "footerCallback": function (row, data, start, end, display) {
                    var api = this.api();

                    // Recalculate total for dynamically rendered column
                    var total = 0;
                    data.forEach(function(row) {
                        var quantity = parseFloat(row.purchased_quantity) || 0;
                        var rate = parseFloat(row.rate) || 0;
                        total += quantity * rate;
                    });

                    // Update footer
                    $(api.column(3).footer()).html(total.toFixed(2));
                }
      });
      $('#filter').on('click', function() {
        table.ajax.reload();
    });
    </script>