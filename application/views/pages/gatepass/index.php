<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gate pass</title>
    <style>
      * {
        margin: 0;
        padding: 0;
      }
      .main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 500px;
      }
      .pass {
        display: flex;
        justify-content: center;
      }
      .header {
        display: flex;
        align-items: center;
        gap: 70px;
      }
      .center {
        text-align: center;
      }
      .date {
        margin: 20px 0;
        display: flex;
        justify-content: space-between;
      }
      .ques {
        font-weight: bold;
      }
      .ans {
        font-weight: 400;
        text-decoration: underline;
      }
      .detail{
        margin-bottom: 20px;
      }
      .signature{
        display: flex;
        justify-content: space-between;

      }
      .detail{
        display: flex;
    justify-content: space-between;
      }
    </style>
  </head>
  <body>
    <div class="main">
      <div class="pass-container">
        <div class="pass">
          <div class="header">

            <div class="logo" style="margin-top: 10px;">
                <img src="<?=  base_url()?>assets/img/logo/logo-fatf.png" alt="" width="60px" height="60px">
            </div>
            <div class="center">
              <h2>FAST AGRI TUNNEL FARM</h2>
              <p>GATE PASS OF WARE HOUSE</p>
            </div>
            <div class="phone">
              <p>03003327696</p>
              <p>03005124842</p>
            </div>
          </div>
        </div>

        <div class="date">
          <div class="gate-nbr">
            <p class="ques">Gate pass NO: <span class=""><?php if($data[0]['data'][0]['sid']){
              echo $data[0]['data'][0]['sid'];
            }?></span></p>
          </div>
          <div class="date-nbr">
            <p class="ques">Date: <span class="ans"><?php echo  $data[0]['data'][0]['selldate']?></span></p>
          </div>
        </div>
        <div class="detail">
        <div class="name">
          <p class="ques">Buyer Name: <span class="ans"><?php echo $data[0]['data'][0]['customer'];?></span></p>
          <p class="ques">Buyer No: <span class="ans"><?php echo $data[0]['data'][0]['cno'];?></span></p>
          <p class="ques">Location: <span class="ans"><?php echo $data[0]['data'][0]['caddress'];?></span></p>
        </div>
        
        <div class="driv">
          <p class="ques" style="text-align-last: end;">Driver Name: <span class="ans"><?php echo $data[0]['data'][0]['driver']?></span></p>
          <p class="ques" >Vehicl No: <span class="ans"><?php echo $data[0]['data'][0]['vno']?></span></p>
          <p class="ques" >Contact No: <span class="ans"><?php echo $data[0]['data'][0]['dno']?></span></p>
        </div>
        </div>
        

        <!-- table -->

        <table border="1"  style="width: 100%; text-align: center; border-spacing: inherit;">
            <thead >
                <tr >
                    <th>Tunnel</th>
                    <th>Product</th>
                    <th>A</th>
                    <th>B</th>
                    <th>Total Bags</th>
                    <th>Unit</th>
                </tr>
            </thead>
            <tbody >
              <?php $t=0; if($data):$total=0; $cc=0; foreach($data as $count=> $d): ?>
                <?php
                $ga=$d['data'][0]['Quantity'];
                $gb=0;
                if(!empty($d['data'][1])){
                  $gb=$d['data'][1]['Quantity'];
                }
                $total=$ga+$gb;
                $t+=$total;
                  ?>
               <tr >
                <td><?php echo $d['tunnel'][$cc];?></td>
                <td><?php productByTunnelName($d['tunnel'][$cc]);?></td>
                <td><?php echo $ga;?></td>
                <td><?php echo $gb;?></td>
                <td><?php echo $total;?></td>
                <td></td>
                
               </tr>
               <?php endforeach; endif?>
               <tr>   
                <td colspan="4" >Total</td>
                <td><?php echo $t;?></td>
                <td></td>
               </tr>
                <th  style="    font-size: 14px;">Description  </th>
                <td colspan="2"></td>
                <th  style="    font-size: 14px;">Bilty  </th>
                <td colspan="2"></td>
               </tr>
               <tr>
                
                <th  style="    font-size: 14px;">Grade  </th>
                <td colspan="2"></td>
                <th  style="    font-size: 14px;">Weight  </th>
                <td colspan="2"></td>
               </tr>
             
               <tr>
                
                <th  style="    font-size: 14px;">Freight  Rate</th>
                <td colspan="7"><?php //echo $data[0]['freight'];?></td>
                
               </tr>
             
               <tr>
                
                <td  >From</td>
                <td colspan="7">Main piyaro lund road vai Tando Allahyar Road </td>
                
               </tr>
               
            </tbody>
        </table>

        <div class="signature" style="    margin: 60px 0 0 0;">
            <div class="driver" style="width: 75px;
            text-align: center;">
                <h5 style="border-top: 1px solid black;">Driver </h5>
            </div>
            <div class="incharge">
                <h5 style="border-top: 1px solid black;">WareHouse Incharge </h5>
            </div>
            <div class="manager">
                <h5 style="border-top: 1px solid black;">Manager</h5>
            </div>
        </div>
        
      </div>
    </div>
  </body>
</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gate pass</title>
    <style>
      * {
        margin: 0;
        padding: 0;
      }
      .main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 500px;
      }
      .pass {
        display: flex;
        justify-content: center;
      }
      .header {
        display: flex;
        align-items: center;
        gap: 70px;
      }
      .center {
        text-align: center;
      }
      .date {
        margin: 20px 0;
        display: flex;
        justify-content: space-between;
      }
      .ques {
        font-weight: bold;
      }
      .ans {
        font-weight: 400;
        text-decoration: underline;
      }
      .detail{
        margin-bottom: 20px;
      }
      .signature{
        display: flex;
        justify-content: space-between;

      }
      .detail{
        display: flex;
    justify-content: space-between;
      }
    </style>
  </head>
  <body>
    <div class="main">
      <div class="pass-container">
        <div class="pass">
          <div class="header">

            <div class="logo" style="margin-top: 10px;">
                <img src="<?=  base_url()?>assets/img/logo/logo-fatf.png" alt="" width="60px" height="60px">
            </div>
            <div class="center">
              <h2>FAST AGRI TUNNEL FARM</h2>
              <p>GATE PASS OF DRIVER</p>
            </div>
            <div class="phone">
              <p>03003327696</p>
              <p>03005124842</p>
            </div>
          </div>
        </div>

        <div class="date">
          <div class="gate-nbr">
            <p class="ques">Gate pass NO: <span class=""><?php if($data[0]['data'][0]['sid']){
              echo $data[0]['data'][0]['sid'];
            }?></span></p>
          </div>
          <div class="date-nbr">
            <p class="ques">Date: <span class="ans"><?php echo  $data[0]['data'][0]['selldate']?></span></p>
          </div>
        </div>
        <div class="detail">
        <div class="name">
          <p class="ques">Buyer Name: <span class="ans"><?php echo $data[0]['data'][0]['customer'];?></span></p>
          <p class="ques">Buyer No: <span class="ans"><?php echo $data[0]['data'][0]['cno'];?></span></p>
          <p class="ques">Location: <span class="ans"><?php echo $data[0]['data'][0]['caddress'];?></span></p>
        </div>
        
        <div class="driv">
          <p class="ques" style="text-align-last: end;">Driver Name: <span class="ans"><?php echo $data[0]['data'][0]['driver']?></span></p>
          <p class="ques" >Vehicl No: <span class="ans"><?php echo $data[0]['data'][0]['vno']?></span></p>
          <p class="ques" >Contact No: <span class="ans"><?php echo $data[0]['data'][0]['dno']?></span></p>
        </div>
        </div>
        

        <!-- table -->

        <table border="1"  style="width: 100%; text-align: center; border-spacing: inherit;">
            <thead >
                <tr >
                    <th>Tunnel</th>
                    <th>Product</th>
                    <th>A</th>
                    <th>B</th>
                    <th>Total Bags</th>
                    <th>Unit</th>
                </tr>
            </thead>
            <tbody >
              <?php $t=0; if($data):$total=0; $cc=0; foreach($data as $count=> $d): ?>
                <?php
                $ga=$d['data'][0]['Quantity'];
                $gb=0;
                if(!empty($d['data'][1])){
                  $gb=$d['data'][1]['Quantity'];
                }
                $total=$ga+$gb;
                $t+=$total;
                  ?>
               <tr >
                <td><?php echo $d['tunnel'][$cc];?></td>
                <td><?php productByTunnelName($d['tunnel'][$cc]);?></td>
                <td><?php echo $ga;?></td>
                <td><?php echo $gb;?></td>
                <td><?php echo $total;?></td>
                <td></td>
                
               </tr>
               <?php endforeach; endif?>
               <tr>   
                <td colspan="4" >Total</td>
                <td><?php echo $t;?></td>
                <td></td>
               </tr>
                <th  style="    font-size: 14px;">Description  </th>
                <td colspan="2"></td>
                <th  style="    font-size: 14px;">Bilty  </th>
                <td colspan="2"></td>
               </tr>
               <tr>
                
                <th  style="    font-size: 14px;">Grade  </th>
                <td colspan="2"></td>
                <th  style="    font-size: 14px;">Weight  </th>
                <td colspan="2"></td>
               </tr>
             
               <tr>
                
                <th  style="    font-size: 14px;">Freight  Rate</th>
                <td colspan="7"><?php //echo $data[0]['freight'];?></td>
                
               </tr>
             
               <tr>
                
                <td  >From</td>
                <td colspan="7">Main piyaro lund road vai Tando Allahyar Road </td>
                
               </tr>
               
            </tbody>
        </table>

        <div class="signature" style="    margin: 60px 0 0 0;">
            <div class="driver" style="width: 75px;
            text-align: center;">
                <h5 style="border-top: 1px solid black;">Driver </h5>
            </div>
            <div class="incharge">
                <h5 style="border-top: 1px solid black;">WareHouse Incharge </h5>
            </div>
            <div class="manager">
                <h5 style="border-top: 1px solid black;">Manager</h5>
            </div>
        </div>
        
      </div>
    </div>
  </body>
</html>
