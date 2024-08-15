<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <h4 class="text-[20px] font-bold text-heading mb-4" style="text-align:center">Products Stock List</h4>
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
                            <h5>Product Name</h5>
                        </div>
                        <div class="cashier-salereturns-table-actionB">
                            <h5>Available Stocks</h5>
                        </div>
                    </div>
                    <?php if(!empty($data)): foreach($data as $d):?>
                    <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                        <div class="cashier-salereturns-table-checkboxB default-light-theme">
                            <input type="checkbox" id="cbi_1" name="cbi" value="1" data-select-all="b-check"
                                class="checkme">
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <span><?php echo $d['ProductName']?></span>
                        </div>
                        <div class="cashier-salereturns-table-totalB">
                            <span><?php echo $d['RemainingQuality'];?></span>
                        </div> 
                    </div>
                    <?php endforeach; endif;?>
                </div>
            </div>
        </div>
    </div>
</div>