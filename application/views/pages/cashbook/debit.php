
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
        *{
    padding: 0;
    margin: 0;
}
body{
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;
}
.main{
   
   width: 40%;
}
.header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}
img{
    height: 50px;
}
span{
    font-weight: 500;
    font-size: 14px;
    text-decoration: underline;
}
.content{
    display: flex;
   
}
.w-50{
    width: 50%;
}
.margin{
    margin-bottom: 20px;
}
.table{
   
    margin-right: 20px;
    
}
.div{
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.receipt-table {
    width: 50%;
   
    border-collapse: collapse;
}
.receipt-table th, .receipt-table td {
    border: 1px solid #000;
    padding: 0px;
    text-align: left;
}
.receipt-table th {
    background-color: #f2f2f2;
}
.checkbox-container {
    display: flex;
    align-items: center;
    padding: 10px;
}
.checkbox-container input {
    margin-left: 10px;
}
.P-17{
    padding: 0px 17px !important;
}
.balnce{
    margin-top: 7px;
}
.margin7{
    margin-top: 37px;
    display: flex;
}
.sp{
    width: 35%;
    display: block;
    border-bottom: 1px solid;
    text-decoration: none;
}
    </style>
  </head>
  <body>
    <div class="main">
      <div class="header">
        <div class="logo">
          <img src="<?php echo base_url()?>assets/img/logo/logo-fatf.png" alt="" />
        </div>
        <div class="heading">
          <h1>Cash Receipt </h1>
        </div>
        <div class="detail">
            <h4>Receipt No: <span>inv-0<?php echo $data[0]['id']?></span></h4>
            <h4>Date: 
                <span>
                    <?php $new_date_format = date('Y-m-d', strtotime($data[0]['created_at'])); echo $new_date_format;?>
                </span>
            </h4>
        </div>
      </div>
      <div class="content">
        <h4 class="w-50">Received From: <span><?php echo $data['0']['pname'];?></span></h4>
      </div>
      <h4 class="margin">Narration: <span><?php echo $data['0']['narration'];?></span></h4>
      <div class="div">
        <div class="balnce">
          <h4>Amount: <span><?php echo $data['0']['amount'];?></span></h4>
          <h4>Current Amount: <span><?php echo $data['0']['current_amount'];?></span></h4>
          
          <!-- <h4>Payment Amount: <span>dasfsdgdfgdfhf</span></h4>
          <h4>Balance due: <span>dasfsdgdfgdfhf</span></h4> -->
        </div>
        <div class="table">
            <table class="receipt-table">
                
                <tr>
                    <td>
                        <div class="checkbox-container">
                            
                        </div>
                    </td>
                    <td class="P-17">Cash</td>
                </tr>
                <tr>
                    <td>
                        <div class="checkbox-container">
                            
                        </div>
                    </td>
                    <td class="P-17">Cheque</td>
                </tr>
            </table>
        </div>

      </div>
      <h4 class="margin7">Recived By: <span class="sp"></span></h4>
    </div>
  </body>
</html>
