<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report of Daily Production</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            /* grid-template-columns: 1fr minmax(auto, 20%); */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        thead th {
            background-color: #d3d3d3;
        }

        tfoot td {
            font-weight: bold;
            background-color: #d3d3d3;
        }

        tfoot td:first-child {
            border: none; /* Remove left border of the first cell in tfoot */
        }

        /* Apply colspan="2" to every second td element */
        /* tbody td:nth-child(2n) {
            colspan: 2;
        } */
    </style>
</head>
<body>

<div class="container">
    <table>
        <thead>
            <tr>
                <th colspan="6">REPORT Stock Issue Product</th>
            </tr>
            <tr>
                <th>Tunnel</th>
                <th>Employee </th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Issued Date</th>
            </tr>
        </thead>
      
    </table>
</div>


<div class="container">
    <table>
        
        <tbody>
            <?php if(!empty($data)):foreach($data as $d):?>
            <tr>
                <td><?php echo $d->TName;?></td>
                <td><?php echo $d->employee;?></td>
                <td><?php echo $d->product_name;?></td>
                <td><?php echo $d->Quantity;?></td>
                <td><?php pqrate($d->PqId,$d->pid)?></td>
                <td><?php echo $d->i_date;?></td>
            </tr>
            <?php endforeach; endif;?>
        </tbody>
    </table>
</div>
</body>
</html>
