
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary Year</title>
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
            background-color: #d3d3d3;
            color: black;
        }

        .Heading {
            background-color: #d3d3d3;
            border: 1px solid #dddddd;
            color: black;
            text-align: center;
        }

    </style>
</head>

<body>
<div class="Heading">
<h1>Summary Of Year</h1>   
<h3>Acre/Averge/Sale/Expense of Tunnel Wise</h3>
</div>

<table>
    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Driver</th>
                <th>Driver No</th>
                <th>Vehicle No</th>
                <th>Labour</th>
                <th>Freight</th>
                <th>commission</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($data)):foreach($data as $d):?>
            <tr>
                <td>asdf</td>
                <td>asdf</td>
                <td>asdf</td>
                <td>asdf</td>
                <td>asdf</td>
                <td>asdf</td>
                <td>asdf</td>
                <td>asdf</td>
            </tr>
        <?php endforeach; endif;?>
        </tbody>
    </table>

</table>
</body>
</html>