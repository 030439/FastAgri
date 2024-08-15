<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Updare Customer Cashbook Entry</h4>
    <form action="update-cashbook-pay" method="POST">
    <div class="grid grid-cols-12 gap-x-5">
    <input type="hidden" name="record" value="customer">
    <input type="hidden" name="id" value="<?php echo $data['record'][0]['id'];?>">
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Cash Selection Party</h5>
                    <div class="cashier-select-field-style">
                        <select id="cash-selection-party" class="block" name="cash-selection-party">
                            <?php foreach($data['cutomers'] as $customer):?>
                            <option <?php is_qual($customer->id,$data['record'][0]['cash_sP']); echo " "; set_value($customer->id);?>><?php echo $customer->Name;?></option>
                            <?php endforeach;?>
                        </select>
                        <?php validator('designation_id')?>
                    </div>
                </div>
            </div>

            <!-- <div class="lg:col-span-4 md:col-span-6 col-span-12" id="narration-field" style="display:none">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Naration</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" name="narration" placeholder="Narration">
                        </div>
                    </div>
                </div>
            </div> -->

        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Amount</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                    <input type="number" name="amount" <?php set_value($data['record'][0]['amount']);?> placeholder="amount">
                        <?php if (form_error('amount')): ?>
                        <div class="error-message" ><?= form_error('amount'); ?></div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12">
            <div class="cashier-managesale-top-btn default-light-theme pt-2.5">
                <button class="btn-primary" type="submit">Update Now</button>
            </div>
        </div>
    </div>
    </form>
</div>