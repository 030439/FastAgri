<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice Design</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    /* styles.css */
@page {
  size: A4;
  margin: 10mm;
}

body {
  font-family: Arial, sans-serif;
  font-size: 12pt;
}

header {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  border-bottom: 1px solid #ccc;
}

/* .logo {
  position: absolute;
  top: 10px;
  left: 10px;
} */

.logo img {
  width: 100px;
  height: 100px;
}

h1 {
  font-size: 24pt;
  margin-bottom: 10px;
}

address {
  font-style: normal;
  text-align: center;
}

address p {
  margin-bottom: 5px;
}

.invoice-info {
  display: flex;
  justify-content: space-between;
  padding: 10px;
  border-bottom: 1px solid #ccc;
}

.date {
  text-align: left;
}

.voucher-no {
  text-align: right;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

th, td {
  border: 1px solid #ccc;
  padding: 10px;
  text-align: left;
}

th {
  background-color: #f0f0f0;
}

.total-amount {
    text-align: right;
  padding: 10px;
  /* border-top: 1px solid #ccc; */
}

.total-amount p {
  margin-bottom: 5px;
}
.section-container {
  display: flex;
  justify-content: space-between;
}

.section {
  flex-basis: calc(25% - 10px);
  margin-bottom: 20px;
 
  padding: 20px;
  box-sizing: border-box;
}
footer {
  padding: 20px;
  border-top: 1px solid #ccc;
  clear: both; /* Add this line */
  position: relative; /* Add this line */
  z-index: 1; /* Add this line */
}
footer {
  background-color: #f0f0f0;
  border: 1px solid #ccc;
}
body {
  display: flex; /* Add this line */
  flex-direction: column; /* Add this line */
  min-height: 100vh; /* Add this line */
} 
  </style>
</head>
<body>
  <header>
    <!-- <div class="logo">
      <img src="<?php echo base_url()?>assets/img/logo/logo-fatf.png" alt="Company Logo">
    </div> -->
    <h1> <img style="margin:0px 15px -28px 0px; height:80px" src="<?php echo base_url()?>assets/img/logo/logo-fatf.png" alt="Company Logo">فاسٹ ایگری ٹنل فارم</h1>
    <address>
      <p>Main Piyaro Lund Road To TandoAllahyar</p>
      <p>Sindh, Pakistan</p>
    </address>
    <h1>Payment Voucher</h1>
  </header>
  <div class="invoice-info">
    <div class="date">
      <p>Date:  <?php $new_date_format = date('Y-m-d', strtotime($data[0]['created_at'])); echo $new_date_format;?></p>
      <p><?php echo $data['0']['pname'];?></p>
    </div>
    <div class="voucher-no">
      <p>Voucher No: C-<?php echo $data[0]['id']?></p>
    </div>
  </div>
  <table>
    <thead>
      <tr>
        <th>S No.</th>
        <th>Narration</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td> 1</td>
        <td><?php echo $data['0']['narration'];?></td>
        <td></td>
      </tr>
      <tr>
        <td> </td>
        <td></td>
        <td><?php echo $data['0']['amount'];?></td>
      </tr>
    </tbody>
  </table>
  <div class="total-amount">
    <p>Amount in Words:</p>
    <p><?php echo ucfirst(convertNumberToWords($data['0']['amount']));?></p>
  </div>

	<div class="section-container">
  <div class="section" style="text-align: center;">
    <p>____________</p>
    <p>PREPARED BY.</p>
  </div>
  <div class="section" style="text-align: center;">
    <p>____________</p>
    <p>CHECKED BY.</p>
  </div>
  <div class="section" style="text-align: center;">
    <p>____________</p>
    <p>APPROVED BY.</p>
  </div>
  <div class="section" style="text-align: center;">
    <p>____________</p>
    <p>RECEIVED BY.</p>
  </div>
</div>
  
</body>
</html>