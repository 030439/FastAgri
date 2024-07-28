<script>
var table =$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>production/getProductionListing",
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
                  { "data": "tunnel" },
                  { "data": "ProductName" },
                  { "data":"grade"},
                  { "data": "unit" },
                  { "data":"qty"},
                  { "data":"pdate"},
                  { // Actions column
                     "data": "id",
                        "render": function(data, type, row) {
                            
                            return '<div style="display:flex"><a class="dropdown-menu-item edit" href="production/edit/'+data+'"><span>Update</span></div>';
                        }
                                      
                  },
              ],
              "footerCallback": function (row, data, start, end, display) {
                    var api = this.api();

                    // Recalculate total for dynamically rendered column
                    var total = 0;
                    data.forEach(function(row) {
                        var quantity = parseFloat(row.qty) || 0;
                        total += quantity ;
                    });

                    // Update footer
                    $(api.column(4).footer()).html(total.toFixed(2));
                }
      });
      $('#filter').on('click', function() {
            table.ajax.reload();
        });
    </script>