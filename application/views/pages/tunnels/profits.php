<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-salereturns-area bg-white p-7 custom-shadow rounded-lg pt-5 ">
        <div class="cashier-transection-selectors flex items-center justify-between pb-5 maxSm:block">
            <h4 class="text-[20px] text-heading  font-bold"><?php if($data['profits']): echo $data['profits'][0]['tunnel'];endif;?>-Profits</h4>
        </div>
       
        <div class="cashier-table-header-search-area">
            <div class="grid grid-cols-12 gap-x-5  pb-0.5">
                <div class="lg:col-span-5 md:col-span-6 col-span-12">
                    <div class="cashier-table-header-search relative maxSm:mb-4">
                        <input id="tunnel-expense-id" type="hidden" value="<?php echo $data['profits'][0]['tid']?>">
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
                                <th>Net Amount</th>
                                <th>Sell Date</th>
                            </tr>
                        </thead>
                    </table> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
<?php $file="tunnel-individual-profit.php";?>