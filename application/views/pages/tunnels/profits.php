<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-salereturns-area bg-white p-7 custom-shadow rounded-lg pt-5 ">
        <div class="cashier-transection-selectors flex items-center justify-between pb-5 maxSm:block">
            <h4 class="text-[20px] text-heading  font-bold"><?php echo tunnelName_($id);?>-Profits</h4>
            <div style="float:right">
                <label for="start-date">Start Date:</label>
                <input type="text" id="start-date" class="datepicker" style="border:2px solid #057C89">
                <label for="end-date">End Date:</label>
                <input type="text" id="end-date" class="datepicker"  style="border:2px solid #057C89">
                <button id="filter" style="background-color:#057C89;color:#fff;padding:5px 10px">Filter</button>
            </div>
        </div>
       
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
            <div class="cashier-salereturns-table-innerS">
                <div class="cashier-salereturns-table-area">
                    <div class="cashier-salereturns-table-innerC">
                    <table id="user-list"  class="table table-bordered borderd table-striped display table-hover">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Grade</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Amount</th>
 <th>Labour</th>
 <th>Commission</th>
 <th>Freight</th>
                                <th>Net Amount</th>
                                <th>Sell Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                    <tr>
                        <th colspan="3"></th>
                        <th>Total</th>
                        <th id="total-balance"></th>
                        <th id="total-net"></th>
                        <th></th>
                    </tr>
                </tfoot>
                    </table> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
<?php $file="tunnel-individual-profit.php";?>