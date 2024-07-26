<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-salereturns-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <div class="cashier-transection-info-area pb-2.5">
            <div class="grid grid-cols-12 xxl:grid-cols-5 gap-x-5 maxSm:gap-x-0">
                <div class="col-span-12 xxl:col-span-1 lg:col-span-4 md:col-span-6">
                    <div class="cashier-transection-info bg-[#EEF0F8] mb-5">
                        <div class="cashier-transection-info-text">
                            <h5>Total Cash Out</h5>
                            <h4><?php echo $data[0]['cashIn'];?></h4>
                        </div>
                        <div class="cashier-transection-info-percent">
                            <span class="bg-[#657CEE] inline-block">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 xxl:col-span-1 lg:col-span-4 md:col-span-6">
                    <div class="cashier-transection-info bg-[#F8F0E7] mb-5">
                        <div class="cashier-transection-info-text">
                            <h5>Cash In</h5>
                            <h4><?php echo $data[0]['cashOut'];?></h4>
                        </div>
                        <div class="cashier-transection-info-percent">
                            <span class="bg-[#E6AA69] inline-block">-</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 xxl:col-span-1 lg:col-span-4 md:col-span-6">
                    <div class="cashier-transection-info bg-[#E6F2E2] mb-5">


                        <div class="cashier-transection-info-text">
                            <h5>Running Balance</h5>
                            <h4><?php echo $data[0]['fb']?></h4>
                        </div>

                        
                        <div class="cashier-transection-info-percent">
                            <span class="bg-[#92D268] inline-block">Rs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cashier-transection-selectors flex items-center justify-between pb-5 maxSm:block">
            <h4 class="text-[20px] text-heading mb-2.5 font-bold">Transection</h4>
            <div>
                <label for="start-date">Start Date:</label>
                <input type="text" id="start-date" class="datepicker" style="border:2px solid #057C89">
                <label for="end-date">End Date:</label>
                <input type="text" id="end-date" class="datepicker"  style="border:2px solid #057C89">
                <button id="filter" style="background-color:#057C89;color:#fff;padding:5px 10px">Filter</button>
            </div>
        </div>
        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerS">
            <table id="user-list"  class="table table-bordered borderd table-striped display table-hover">
                <thead>
                    <tr>
                        <th>Voucher No</th>
                        <th>Date</th>
                        <th>Head</th>
                        <th>Narration</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Balance</th>
                        <th>Invoice</th>
                    </tr>
                </thead>
            </table>

             
            </div>
        </div>
    </div>
</div>

<?php $file="cash-flow.php";?>
