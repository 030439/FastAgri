<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Add Customer</h4>
    <form action="cashbook-pay" method="POST">
    <div class="grid grid-cols-12 gap-x-5">
           <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Designation</h5>
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
                        <option value="default" selected disabled>Select an option</option>
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


        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Amount</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="number" name="amount" placeholder="Contact">
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