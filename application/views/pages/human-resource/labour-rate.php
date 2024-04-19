<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Add Labour Rate</h4>
    <form action="add-rate" method="post">
        <div class="grid grid-cols-12 gap-x-5">
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3"> Rate</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder="update rate" name="rate" value="<?= $data['0']->amount?>">
                            <?php validator('rate')?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12">
                <div class="cashier-managesale-top-btn default-light-theme pt-2.5">
                    <button class="btn-primary" type="submit">update Rate</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="cashier-salereturns-table-area bg-white p-7 custom-shadow ">
            <div class="cashier-salereturns-table-innerC">
                <div
                    class="cashier-salereturns-table-inner-wrapperC border border-solid border-grayBorder border-b-0 mb-7">
                    <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                        <div class="cashier-salereturns-table-checkboxB default-light-theme">
                            <input type="checkbox" id="b-check" name="b-check" data-checkbox-name="cbi"
                                class="selectall">
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Rate</h5>
                        </div>
                    </div>
                    <?php if(!empty($data)): foreach($data as $d):?>
                    <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                        <div class="cashier-salereturns-table-checkboxB default-light-theme">
                            <input type="checkbox" id="cbi_1" name="cbi" value="1" data-select-all="b-check"
                                class="checkme">
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                        <span><?php ShowVal($d->amount);?></span>
                        </div>
                    </div>
                    <?php endforeach;endif;?>
                </div>
            </div>
         
        </div>