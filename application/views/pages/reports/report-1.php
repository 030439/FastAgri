<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-salereturns-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
        <div class="cashier-transection-selectors flex items-center justify-between pb-5 maxSm:block">
            <h4 class="text-[20px] text-heading mb-2.5 font-bold">Transection</h4>
            <div
                class="cashier-transection-selector flex gap-x-4 maxSm:gap-x-0 items-center justify-end maxSm:justify-start maxXs:block">
                <div class="cashier-transection-selector-single w-[120px] mb-2.5">
                    <div class="cashier-select-field">
                        <div class="cashier-select-field-style">
                            <select class="block" style="display: none;">
                                <option selected="" value="default">Monthly</option>
                                <option value="language-1">Monthly</option>
                                <option value="language-2">Yearly</option>
                            </select>
                            <div class="nice-select block" tabindex="0"><span class="current">Monthly</span>
                                <ul class="list">
                                    <li data-value="default" class="option selected">Monthly</li>
                                    <li data-value="language-1" class="option">Monthly</li>
                                    <li data-value="language-2" class="option">Yearly</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cashier-transection-selector-single w-[270px] mb-2.5 maxXs:w-full">
                    <div class="cashier-select-field">
                        <div class="cashier-select-field-style">
                            <select class="block" style="display: none;">
                                <option selected="" value="default">01 Jan 2022 - 30 Jul 2022</option>
                                <option value="language-1">01 Jan 2022 - 30 Jul 2022</option>
                                <option value="language-2">01 Jan 2022 - 12 Dec 2022</option>
                            </select>
                            <div class="nice-select block" tabindex="0"><span class="current">01 Jan 2022 - 30 Jul
                                    2022</span>
                                <ul class="list">
                                    <li data-value="default" class="option selected">01 Jan 2022 - 30 Jul 2022</li>
                                    <li data-value="language-1" class="option">01 Jan 2022 - 30 Jul 2022</li>
                                    <li data-value="language-2" class="option">01 Jan 2022 - 12 Dec 2022</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cashier-transection-info-area pb-2.5">
            <div class="grid grid-cols-12 xxl:grid-cols-5 gap-x-5 maxSm:gap-x-0">
                <div class="col-span-12 xxl:col-span-1 lg:col-span-4 md:col-span-6">
                    <div class="cashier-transection-info bg-[#EEF0F8] mb-5">
                        <div class="cashier-transection-info-text">
                            <h5>Total Cash In</h5>
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
                            <h5>Cash Out</h5>
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

        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerS">
                    <table id="user-list"  class="table table-bordered borderd table-striped display table-hover">
                        <thead>
                            <tr>
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
