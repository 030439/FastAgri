<script>
$(document).ready(function() {
    
    var table = $('#user-list').DataTable({
        responsive: true,
        buttons: ['pageLength',  'excelHtml5', 'csvHtml5', 'pdfHtml5'],
        "processing": true,
        "serverSide": true,
        dom: 'Bfrtip',
        "ajax": {
            url: "<?php echo base_url(); ?>cash-flow",
            type: 'post',
            data: function(d) {
                        d.startDate = $('#start-date').val();
                        d.endDate = $('#end-date').val();
                    },
            error: function(xhr, error, thrown) {
                alert('Error: ' + xhr.responseText);
            }
        },
        "columns": [
            {
                "data": null,
                "render": function(data, type, full, meta) {
                    if (full.cash_s === 'cash-in') {
                        return "CR-" + data.id;
                    } else {
                        return "PV-" + data.id;
                    }
                }
            },
            { "data": "cdate" },
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
            {
                "data": "id",
                "render": function(data, type, row) {
                    return '<div style="display:flex"><a class="btn-design btn-detail" href="cashbook/invoice/' + data + '"><span>Print</span></a>'+
                    '<a class="btn-design btn-edit" href="cashbook/edit/' + row.id + '"><span>Edit</span></a></div>';
                }
            }
        ]
    });
    $('#filter').on('click', function() {
        table.ajax.reload();
    });
});
</script>
