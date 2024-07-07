<script>
var pid_ = $("#p_id").val();
$('#user-list').DataTable({
    responsive: true,
    buttons: ['pageLength', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "processing": true,
    "serverSide": true,
    dom: 'Bfrtip',
    "ajax": {
        url: "<?php echo base_url(); ?>purchase/pdetail/" + pid_,
        type: 'post',
        error: function(xhr, error, thrown) {
            alert('Error: ' + xhr.responseText);
        }
    },
    "columns": [
        { "data": "product_name" },
        { "data": "rate" },
        { "data": "purchased_quantity" },
        { "data": "total_amount" },
        { "data": "RemainingQuantity" }
    ],
   "footerCallback": function(row, data, start, end, display) {
    var api = this.api();
    var totalBalance = api.column(3, { page: 'current' }).data().reduce(function(a, b) {
        return a + (parseFloat(b) || 0);
    }, 0);

    console.log("Data in column 3:", api.column(3, { page: 'current' }).data());
    console.log("Total balance:", totalBalance);

    $(api.column(3).footer()).html('Total: ' + totalBalance.toFixed(2));
}

});
</script>
