<script>
$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>issued-labour-listing",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "TName" },
                  { "data": "jamander" },
                  { "data": "lq" },
                  { "data": "rate" },
                  { "data": "deduction" },
                  { "data": "total_amount" },
                  { "data": "ldate" },
                  { // Actions column
                     "data": "issue_stock_id",
                        "render": function(data, type, row) {
                            
                            return '<div style="display:flex"><a class="dropdown-menu-item edit" href="issued-labour-edit/'+data+'"><span>Edit</span></div>';
                        }
                                      
                  }
              ],
              "footerCallback": function (row, data, start, end, display) {
                    var api = this.api();

                    // Recalculate total for dynamically rendered column
                    var total = 0;
                    data.forEach(function(row) {
                        var quantity = parseFloat(row.total_amount) || 0;
                        total += quantity ;
                    });

                    // Update footer
                    $(api.column(5).footer()).html(total.toFixed(2));
                }
      });
    </script>