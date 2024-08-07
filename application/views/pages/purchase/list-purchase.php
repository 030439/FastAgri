<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <div >
            <div class="cashier-managesale-top-btn default-light-theme ">
                <button class="mb-1" onclick="document.location='purchase/add'">
                    <i class="fa-light fa-plus"></i> Create Purchase
                </button>
                <h4 class="text-[20px] font-bold text-heading " style="width:60%;text-align:center">Purchase List</h4>
            </div>
            <div style="float:right;margin-bottom:10px">
                <label for="start-date">Start Date:</label>
                <input type="text" id="start-date" class="datepicker" style="border:2px solid #057C89">
                <label for="end-date">End Date:</label>
                <input type="text" id="end-date" class="datepicker"  style="border:2px solid #057C89">
                <button id="filter" style="background-color:#057C89;color:#fff;padding:5px 10px">Filter</button>
            </div>
            
        <div>
        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
                <table id="user-list" class="table display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Purchase Date</th>
                            <th>Amount</th>
                            <th>Expense</th>
                            <th>Paid Amount</th>
                            <th>Total Amout</th>
                            <th>Detail | Edit</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                             <th></th>
                            <th >Total</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table> 
            </div>
        
        </div>
    </div>
</div>
<?php $file="purchase.php";?>