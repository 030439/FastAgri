<style>
    .billinputs{
    border:1px solid red; 
    max-width:100px;
}
</style>
<div class="cashier-content-area mt-[30px] px-7">
    <form action="bill-detail-invoice" method="post">
        <input type="hidden" value="<?=$data[0]['sid']?>">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <h4 class="text-[20px] font-bold text-heading mb-9">Sell Detail </h4>
            <div class="mb-7">
                <span>Commission </span>
                <input class="billinputs" id="bill-labour" type="number" placeholder="Labour" value="<?php echo $data[0]['expences'];?>">
                <span>Labour </span>
                <input class="billinputs" id="bill-expense" type="number" placeholder="Labour" value="<?php echo $data[0]['expences'];?>">
            </div>
            all-total-bill
        
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
                    </div>
                    <?php if(!empty($data)): foreach($data as $c=> $d):?>
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
                           <span id="quantity-<?php echo $c;?>"><?php echo  $d['Quantity'];?></span>
                        </div>
                        <div class="cashier-salereturns-table-billerB rate-class">
                            <span><input class="get-rate-bill billinputs"  title="<?php echo $c?>" id="rate-<?php echo $c;?>" type="number" name="rate[]" value="<?php echo $d['Rate']?>" min="0"></span>
                        </div>
                        <div class="cashier-salereturns-table-totalB">
                        <span><input class="total-bill-amount " disabled title="<?php echo $c?>" id="amount-<?php echo $c;?>" type="number" name="amount[]" value="<?php echo $d['amount']?>" min="0"></span>
                           
                        </div>
                    </div>
                    <?php endforeach;endif;?>
                </div>
            </div>
            <div class="cashier-pagination-area">
                <div class="cashier-pagination-wrapper">
                    <div class="grid grid-cols-12">
                        <div class="lg:col-span-9 md:col-span-6 col-span-12">
                            <div class="cashier-pagination text-right maxSm:text-center">
                               <input class="billinputs" id="all-total-bill" value="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>