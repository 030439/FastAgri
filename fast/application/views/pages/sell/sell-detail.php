<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <h4 class="text-[20px] font-bold text-heading mb-9">Sell Detail </h4>

        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
                <div
                    class="cashier-salereturns-table-inner-wrapperC border border-solid border-grayBorder border-b-0 mb-7">
                    <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                        <div class="cashier-salereturns-table-checkboxB default-light-theme">
                            <input type="checkbox" id="b-check" name="b-check" data-checkbox-name="cbi"
                                class="selectall">
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Tunnel</h5>
                        </div>
                        <div class="cashier-salereturns-table-referenceB">
                            <h5>Customer</h5>
                        </div>
                        <div class="cashier-salereturns-table-customerB">
                            <h5>Grade</h5>
                        </div>
                        <!-- <div class="cashier-salereturns-table-warehouseB">
                            <h5>Unit</h5>
                        </div> -->
                        <div class="cashier-salereturns-table-billerB">
                            <h5>Quantity</h5>
                        </div>
                        <div class="cashier-salereturns-table-totalB">
                            <h5>Rate</h5>
                        </div>
                        <div class="cashier-salereturns-table-remarkB">
                            <h5>Amount</h5>
                        </div>
                        <div class="cashier-salereturns-table-actionB">
                            <h5>Date</h5>
                        </div>
                    </div>
                    <?php if(!empty($data)): foreach($data as $d):?>
                    <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                        <div class="cashier-salereturns-table-checkboxB default-light-theme">
                            <input type="checkbox" id="cbi_1" name="cbi" value="1" data-select-all="b-check"
                                class="checkme">
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <span><?php echo  $d['tunnel'];?></span>
                        </div>
                        <div class="cashier-salereturns-table-referenceB">
                            <span><?php echo  $d['customer'];?></span>
                        </div>
                        <div class="cashier-salereturns-table-customerB">
                            <span><?php echo  $d['grade'];?></span>
                        </div>
                        <div class="cashier-salereturns-table-warehouseB">
                           <span><?php echo  $d['Quantity'];?></span>
                        </div>
                        <div class="cashier-salereturns-table-billerB">
                            <span><?php echo $d['Rate'];?></span>
                        </div>
                        <div class="cashier-salereturns-table-totalB">
                            <span><?php echo $d['amount'];?></span>
                        </div>
                        <div class="cashier-salereturns-table-remarkB">
                        <span><?php echo $d['selldate'];?></span>
                        </div>
                    </div>
                    <?php endforeach;endif;?>
                </div>
            </div>
        </div>
    </div>
</div>