
<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Add Shareholder</h4>
    <form action="shareholder/update" method="POST">
    <div class="grid grid-cols-12 gap-x-5">
    
        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3"> Name</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" placeholder="Name" name="Name" value="<?= $edit->Name?>">
                        <?php if (form_error('name')): ?>
                        <div class="error-message" ><?= form_error('name'); ?></div>
                    <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="id" value="<?= $edit->id?>">
        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Phone</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" name="phone" value="<?= $edit->phone?>" placeholder="(+2) 455 025 327">
                        <?php if (form_error('phone')): ?>
                        <div class="error-message" ><?= form_error('phone'); ?></div>
                         <?php endif ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Address</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" value="<?= $edit->address?>" placeholder="Address">
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">CNIC Number</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" value="<?= $edit->cnic?>" placeholder="41111-1111111-1">
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Capital Amount</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" value="<?= $edit->capital_amount?>">
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