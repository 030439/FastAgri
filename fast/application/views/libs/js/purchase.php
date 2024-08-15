<script>
 var table =$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
      dom: 'Bfrtip',
         
          "ajax": {
              url : "<?php echo base_url(); ?>purchase/purchaseListJs",
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
                  { "data": "supplier_name" },
                  { "data": "pdate" },
                  { "data": "amount" },
                  { "data": "expenses" },
                  { "data": "paid_amount" },
                  { "data": "total_amount" },
                  { // Actions column
                     "data": "id",
                        "render": function(data, type, row) {
                            return '<div style="display:flex"><a class="btn-design btn-detail" href="purchase/detail/'+data+'"><span>Detail</span></a>'+
                            '<a class="btn-design btn-edit" href="purchase/edit/'+data+'"><span>Edit</span></a></div>';
                        }
                                      
                  }
              ],
              "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();
            var amount = api.column(2, { page: 'current'} ).data().reduce(function(a, b) {
                return a + (parseFloat(b) || 0);
            }, 0);
            var exp = api.column(3, { page: 'current'} ).data().reduce(function(a, b) {
                return a + (parseFloat(b) || 0);
            }, 0);
            var paid = api.column(4, { page: 'current'} ).data().reduce(function(a, b) {
                return a + (parseFloat(b) || 0);
            }, 0);
            var totalBalance = api.column(5, { page: 'current'} ).data().reduce(function(a, b) {
                return a + (parseFloat(b) || 0);
            }, 0);
            $(api.column(2).footer()).html(amount.toFixed(2));
            $(api.column(3).footer()).html(exp.toFixed(2));
            $(api.column(4).footer()).html(paid.toFixed(2));
            $(api.column(5).footer()).html(totalBalance.toFixed(2));
        }
      });
      $('#filter').on('click', function() {
            table.ajax.reload();
        });
    </script>