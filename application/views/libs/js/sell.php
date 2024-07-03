<script>
$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
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
                  
              ],
              "footerCallback": function (row, data, start, end, display) {
                    var api = this.api();

                    // Recalculate total for dynamically rendered column
                    var total = 0;
                    var labour_ = 0;
                    var freight_ = 0;
                    var com = 0;
                    var net = 0;
                    data.forEach(function(row) {
                        var total_amount = parseFloat(row.total_amount) || 0;
                        total += total_amount ;

                        var labour = parseFloat(row.labour) || 0;
                        labour_ += labour ;

                        var freight = parseFloat(row.freight) || 0;
                        freight_ += freight ;
                        var expences = parseFloat(row.expences) || 0;
                        com += expences ;
                        var net_=parseFloat(row.total_amount) - parseFloat(row.freight) - parseFloat(row.expences)- parseFloat(row.labour)||0;
                        net +=net_;
                    });

                    // Update footer
                    $(api.column(4).footer()).html(total.toFixed(2));
                    $(api.column(5).footer()).html(labour_.toFixed(2));
                    $(api.column(6).footer()).html(freight_.toFixed(2));
                    $(api.column(7).footer()).html(com.toFixed(2));
                    $(api.column(8).footer()).html(net.toFixed(2));
                }
      });
    </script>