<script>
$('#user-list').DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
          buttons: [
              'excel'
          ],
          "ajax": {
              url : "<?php echo base_url(); ?>sell/sellListting",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "customer" },
                  { "data": "driver" },
                  { "data": "dno" },
                  { "data": "vno" },
                  { "data": "total_amount" },
                  { "data": "labour" },
                  { "data": "freight" },
                  { "data": "expences" },
                  { 
                        "data": null, 
                        "render": function(data, type, row) {
                            return (parseFloat(row.total_amount) - parseFloat(row.freight) - parseFloat(row.expences)- parseFloat(row.labour)).toFixed(2);
                        },
                        "orderable": false  // Make it non-orderable if necessary
                    },
                    { // Actions column
                     "data": "sid",
                    
                        "render": function(data, type, row) {
                            return '<div style="display:flex"><a class="dropdown-menu-item edit" href="sell-detail/'+data+'"><span>Detail</span></a>'+
                                      '<a class="dropdown-menu-item detail" href="sell-gate-pass/'+data+'"><span>Get Pass</span></a>'+
                                      '<a class="dropdown-menu-item detail" href="sell-bill-detail/'+data+'"><span>Bill</span></a>'+
                                      '</div>';
                        }
                                      
                  }
                  
              ]
      });
    </script>