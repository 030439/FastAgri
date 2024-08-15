
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
            width: 90%;
            margin: 20px auto; /* auto margins center the table horizontally */
            padding: 20px;
            }

th, td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

th {
    background-color: #d3d3d3;
}

h1 {
    text-align: center;
}

    </style>
</head>
<body>
    
<?php

foreach ($data as $jamandar => $items) { ?>

 <h1><?php echo $items[0]->jname;?></h1>
 <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Days</th>
                    <th>Rate</th>
                    <th>Amount</th>
                
                </tr>
            </thead>
            <tbody>
<?php
$Tamount=0;
$LQ=0;
    foreach ($items as $item) {?>
                <tr>
                    <td> <?php 
                    $LQ+=$item->lq;
                    $Tamount+=$item->total_amount;
                            $dateTime = new DateTime($item->create_at);
                            $formattedDate = $dateTime->format('j/M/y'); 
                            echo $formattedDate;
                            ?>
                    </td>
                    <td><?php echo $item->lq?></td>
                    <td><?php echo $item->rate?></td>
                    <td><?php echo $item->total_amount?></td>
                </tr>  
        <?php 
        // Add other fields as needed
    }
   ?>
    <tr>
        <td></td>
        <td>Jamandari</td>
        <td></td>
        <td>350</td>
    </tr> 
    <?php $ad=0; if($items[0]->advance>0):?>
    <tr>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td>Advance</td>
        <td><?php $ad+=$items[0]->advance; echo $items[0]->advance;?></td>
    </tr>
    <?php endif;?>
    <tr>
        <td>Sub Total</td>
        <td ><?php echo $LQ;?></td>
        <td></td>
        <td><?php $net=$Tamount+350; echo $net;?></td>
    </tr>
    <tr>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td>Net Amount</td>
        <td><?php echo $net-$ad;?></td>
    </tr>
    </tbody>
        </table>
   <?php
}
?>
</body>
</html>
