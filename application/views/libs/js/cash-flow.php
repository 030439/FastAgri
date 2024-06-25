<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

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
              url : "<?php echo base_url(); ?>cash-flow",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                        { 
                        "data": "created_at",
                        "render": function(data, type, full, meta) {
                            return moment(data).format('YYYY-MM-DD');
                        }
                    },
                  { "data": "name" },
                  { "data": "narration" },
                  {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            if (full.cash_s === 'cash-in') {
                                return full.amount;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        if (full.cash_s === 'cash-out') {
                            return full.amount;
                        } else {
                            return '-';
                        }
                    }
                },
                  { "data": "famount" }, 
                  { // Actions column
                     "data": "id",
                        "render": function(data, type, row) {
                            
                            return '<div style="display:flex"><a class="dropdown-menu-item edit" href="cashbook/invoice/'+data+'"><span>Print</span></a>';
                        }
                                      
                  } 
              ]
      });
    </script>