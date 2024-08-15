
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
        
            <tr>
                <th colspan="6">REPORT OF DAILY PRODUCTION</th>
            </tr>
            <tr>
                <th colspan="6">Date: <?php echo $date;?></th>
            </tr>
        <thead>
            <tr>
                <th>Name Of Tunnel</th>
                <th>Bags</th>
                <th>Kg</th>
                <th>Munds</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
            </tr>
            <?php $tmunds=0; $tbags=0; $tkg=0; if(!empty($data)):foreach($data as $d):?>
            <tr>
                <td><?php echo $d['tunnel']?></td>
                <td><?php echo $d['qty']; $tbags+=$d['qty'];?></td>
                <td><?php echo $d['qty']*10;$tkg+=$d['qty'];?></td>
                <td><?php  $munds=$d['qty']*10/40; echo $munds; $tmunds+=$munds?></td>
                <td><?php echo $d['tunnel']?></td>
            </tr>
            <?php  endforeach; endif;?>
            <tr>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>Total : </td>
                <td><?php echo $tbags;?></td>
                <td><?php echo $tkg;?></td>
                <td><?php echo $tmunds;?></td>
                <td></td>
            </tr>
        </tfoot>
       
    </table>
</div>


</body>
</html>
