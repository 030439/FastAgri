<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <div style="display:flex">
        <div class="cashier-managesale-top-btn default-light-theme mb-7">
            <button class="mb-1" onclick="document.location='asset/add'">
                <i class="fa-light fa-plus"></i> Add Asset
            </button>
        </div>
        <h4 class="text-[20px] font-bold text-heading mb-9" style="width:60%;text-align:center;underline">Assets List</h4>
        
        </div>

        
        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-area">
                <div class="cashier-salereturns-table-innerC">
                <button id="myBtn">Open Modal</button>
                    <table id="user-list"  class="table table-bordered borderd table-striped display table-hover">
                        <thead>
                            <tr>
                                <th>Asset Name</th>
                                <th>Cost</th>
                                <th>Date</th>
                                <th>Edit</th>
                                <th>Shares</th>
                            </tr>
                        </thead>
                    </table> 
                </div>
            </div>
    </div>
</div>
<style>
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 1;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 40%;
}
/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}
.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
th ,td{
    width:33%;
    text-align:center;
}
</style>
<?php $file="asset-list.php";?>