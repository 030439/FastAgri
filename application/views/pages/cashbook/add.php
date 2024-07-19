<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Cashbook Entry</h4>
    <form action="cashbook-pay" method="POST">
    <div class="grid grid-cols-12 gap-x-5">
           <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Cash</h5>
                    <div class="cashier-select-field-style">
                        <select id="cash-selection" class="block" name="cash-selection" style="display: none;">
                            <option selected="" disabled="" value="default">Select cash </option>
                            <option value="cash-in">Cash In</option>
                            <option value="cash-out">Cash Out</option>
                            <?php
                        if(!empty($data)):
                            foreach($data['designation'] as $de):
                        ?>
                            <option value="<?= $de->id;?>"><?php ShowVal($de->name);?></option>
                            <?php endforeach; endif;?>
                        </select>
                        <?php validator('designation_id')?>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Cash Selection Type</h5>
                    <div class="cashier-select-field-style">
                        <select id="cash-selection-type" class="block" name="cash-selection-type">
                        </select>
                        <?php validator('designation_id')?>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Cash Selection Party</h5>
                    <div class="cashier-select-field-style">
                        <select id="cash-selection-party" class="block" name="cash-selection-party">
                       
                        </select>
                        <?php validator('designation_id')?>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 md:col-span-6 col-span-12" id="narration-field" style="display:none">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Naration</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" name="narration" placeholder="Narration">
                        </div>
                    </div>
                </div>
            </div>


            
            <div class="lg:col-span-4 md:col-span-6 col-span-12" id="tunnel-field">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Select Tunnel</h5>
                    <div class="cashier-select-field-style">
                        <select id="select-tunnel" class="block" name="select-tunnel">
                       
                        </select>
                    </div>
                </div>
            </div>


            <div class="lg:col-span-4 md:col-span-6 col-span-12" id="e-amount" style="display:none">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Payable Amount</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" readonly id="e-pay" name="e-amount" placeholder="Payable Amount">
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12" id="e-installment" style="display:none">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Installment</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" name="installment" value="0" >
                        </div>
                    </div>
                </div>
            </div>

        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Amount</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="number" name="amount" placeholder="amount">
                        <?php if (form_error('amount')): ?>
                        <div class="error-message" ><?= form_error('amount'); ?></div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12">
            <div class="cashier-managesale-top-btn default-light-theme pt-2.5">
                <button class="btn-primary" type="submit">Add Now</button>
            </div>
        </div>
    </div>
    </form>
</div>