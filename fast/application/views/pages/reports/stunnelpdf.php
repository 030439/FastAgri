
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Example</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->

    <style>

        body {
                margin: 20px auto; 
                padding: 20px;
            }

            table {
        border-collapse: collapse;
        width: 100%;
        }

        th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }

        th {
        background-color: #f2f2f2;
        }

        .Heading {
        background-color: #d3d3d3;
        /* border: 1px solid #dddddd; */
        color: black;
        }
        .Heading h3{
        text-align:center;
        }
        .Heading,body{
            padding:0px 30px;
        }
    </style>
</head>
<body>
    <div class="Heading">
        <h3>FAST AGRI TUNNEL FARM</h3>
        <h3>Expenditure Tunnel <?php echo $data['0']->tunnel?></h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Head</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>Credit</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($data)):foreach($data as $d):?>
            <tr>
                <td><?php echo $d->edate;?></td>
                <td><?php echo $d->head;?> </td>
                <td><?php echo $d->qty;?></td>
                <td><?php echo $d->rate;?></td>
                <td><?php echo $d->amount?></td>
            </tr>
            <?php endforeach; endif;?>
            <!-- Additional rows go here -->
        </tbody>
    </table>
</body>
</html>
