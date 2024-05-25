
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
    background-color:#d3d3d3;
}

.Heading {
    background-color: #d3d3d3;
    border: 1px solid #dddddd;
    color: black;
    padding:20px;
}
thead,tbody{
    padding:20px;
}

    </style>
</head>
<body>
    <div class="Heading">
        <h3>FAST AGRI TUNNEL FARM</h3>
        <hr>
        <h3>PAYMENT  LEDGER OF : <?php echo $data[0]->Name?></h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Detail Naration</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Balnce Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($data)):foreach($data as $d):?>
            <tr>
                <td><?php echo date("Y-m-d", strtotime($d->created));?></td>
                <td><?php echo ($d->narration);?></td>
                <td><?php  
                        if($d->pay_type=="cash-in"){
                            echo "Debit";
                        }
                    ?>
                </td>
                <td><?php echo $d->amount;?></td>
                <td><?php echo ($d->fb);?></td>
            </tr>
            <?php endforeach; endif;?>
        </tbody>
    </table>
</body>
</html>
