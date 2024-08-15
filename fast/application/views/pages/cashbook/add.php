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

<style>
 .toggle-next {
  border-radius: 0;
}

label {
  cursor: pointer;
}

.ellipsis {
  text-overflow: ellipsis;
  width: 100%;
  white-space: nowrap;
  overflow: hidden;
}

.apply-selection {
  display: none;
  width: 100%;
  margin: 0;
  padding: 5px 10px;
  border-bottom: 1px solid #ccc;
}
.apply-selection .ajax-link {
  display: none;
}

.checkboxes {
  margin: 0;
  display: none;
  border: 1px solid #ccc;
  border-top: 0;
}
.checkboxes .inner-wrap {
  padding: 5px 10px;
  max-height: 140px;
  overflow: auto;
}
</style>
            
            <div class="lg:col-span-4 md:col-span-6 col-span-12" id="tunnel-field" style="display:none">
                <div class="cashier-select-field mb-5 select-list">
                    <div class="cashier-select-field-style block select-options" id="select-"  name="select-tunnel">
                    <div class="col-md-4">
                        <div class="wrapper" style="background-color:#f6f6f6;min-height:50px;margin-top:35px;border-radius:5px">
                        <a class="form-control toggle-next ellipsis" style="margin:10px">Click to Select Tunnel </a>
                        <div class="checkboxes" id="Lorems">
                            <label class="apply-selection">
                            <input type="checkbox" value="" class="ajax-link" />
                            &#x2714; apply selection
                            </label>
                            
                            <div class="inner-wrap" id="select-tunnel">
                            
                            </div>
                        </div>
                        </div>
                    </div>
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
                            <input type="number" name="installment" id="ins-amount" value="0" >
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