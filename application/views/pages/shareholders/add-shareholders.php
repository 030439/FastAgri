
<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Add Shareholder</h4>
    <form action="shareholder/create" method="POST">
    <div class="grid grid-cols-12 gap-x-5">
    
        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3"> Name</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" placeholder="Name" name="name">
                        <?php if (form_error('name')): ?>
                        <div class="error-message" ><?= form_error('name'); ?></div>
                    <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
<!-- section -->
        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Phone</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="number" name="phone" min="0" placeholder="(+2) 455 025 327">
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
                        <input type="text" name="address" placeholder="Address">
                        <?php if (form_error('address')): ?>
                        <div class="error-message" ><?= form_error('address'); ?></div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">CNIC Number</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="number" id="cnic" maxlength="15" name="cnic" pattern="\d{5}-\d{7}-\d{1}" placeholder="4111111111111">
                        <p id="cnicValidationMessage"></p>
                        <?php if (form_error('cnic')): ?>
                        <div class="error-message" ><?= form_error('cnic'); ?></div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Capital Amount</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="number" min="0"  name="capital_amount" placeholder="5000">
                        <?php if (form_error('capital_amount')): ?>
                        <div class="error-message" ><?= form_error('capital_amount'); ?></div>
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