<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-salereturns-area bg-white p-7 custom-shadow rounded-lg pt-5 ">
        <div class="cashier-transection-selectors flex items-center justify-between  maxSm:block">
            <h4 class="text-[20px] text-heading  font-bold"><?php echo tunnelName_($id)?>: Ledger</h4>
            <div style="float:right">
                <label for="start-date">Start Date:</label>
                <input type="text" id="start-date" class="datepicker" style="border:2px solid #057C89">
                <label for="end-date">End Date:</label>
                <input type="text" id="end-date" class="datepicker"  style="border:2px solid #057C89">
                <button id="filter" style="background-color:#057C89;color:#fff;padding:5px 10px">Filter</button>
            </div>
        </div>
       <style>
        @media (max-width: 1400px) {
    .cashier-salereturns-table-dateP {
        width: 16%;
        min-width: 150px;
    }
}
       </style>
        <div class="cashier-table-header-search-area">
            <div class="grid grid-cols-12 gap-x-5  pb-0.5">
                <div class="lg:col-span-5 md:col-span-6 col-span-12">
                    <div class="cashier-table-header-search relative maxSm:mb-4">
                        <input id="tunnel-expense-id" type="hidden" value="<?php echo $id?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="cashier-salereturns-table-area">
            <table id="user-list"  class="table table-bordered borderd table-striped display table-hover">
                <thead>
                    <tr>
                        <th>Sell/Expense</th>
                        <th>Product/Employee/Customer</th>
                        <th>Rate</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <!-- <th>Debit</th>
                        <th>Credit</th> -->
                        <th>Date</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="3"></th>
                        <th>Total</th>
                        <th id="total-balance"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table> 
        </div>
    </div>
</div>
<?php $file="tunnelLedger.php";?>