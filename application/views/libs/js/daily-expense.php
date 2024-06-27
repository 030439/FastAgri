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
              url : "<?php echo base_url(); ?>expense-listing",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
                  { "data": "name" },
                  { "data": "narration" },
                  { "data": "amount" },
                  { 
                    "data": "created_at",
                    "render": function(data, type, full, meta) {
                        return moment(data).format('YYYY-MM-DD');
                    }
                },
              ]
      });
    </script>