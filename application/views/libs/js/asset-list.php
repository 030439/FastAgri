<script>
$('#user-list').DataTable({
    "processing": true,
    buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "serverSide": true,
      dom: 'Bfrtip',
         

          "ajax": {
              url : "<?php echo base_url(); ?>asset-list-js",
              type : 'post',
              error: function(xhr, error, thrown) {
              alert('Error: ' + xhr.responseText);
          }
          },        
           "columns": [
            { "data": "asset" },
            { "data": "cost" },
            { "data": "cDate" },
            
            { 
                "data": "status",
                "render": function(data, type, row) {
                    console.log(data);
                    if(data==1){
                        statusName="Active";
                    }else{
                        statusName="Close";
                    }
                    return '<button style="background-color:#86af49;padding:3px 5px;color:#fff" class="btn btn-primary">'+statusName+'</button> ';
                }
            }, 
            { 
                "data": "id",
                "render": function(data, type, row) {
                    
                    return '<button style="background-color:#ec6f16;padding:3px 5px;color:#fff" onclick="handleButtonClick(\'' + data + '\')" class="btn btn-primary">Shares</button> ';
                }
            }, 
            ]
      });
      
        
        function profitButtonClick(id) {
            window.location.href="tunnel/tunnle-profit/"+id
        }

        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementByClass("btn-primary");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
        modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }
        function handleButtonClick(id) {
            $.ajax({
                url:"getAssetShares",
                method:"post",
                data:{id:id},
                success:function(e){
                    $("#tbody-display").html(e);
                }
            })
            modal.style.display = "block";
        }
    </script>
