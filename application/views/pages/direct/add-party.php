<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Add Direct Party</h4>
    <form action="direct/save" method="POST">
    <div class="grid grid-cols-12 gap-x-5">
        <div class="lg:col-span-3 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Name</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" name="Name"  value="<?php echo set_value('Name'); ?>" >
                        <?php if (form_error('Name')): ?>
                        <div class="error-message" ><?= form_error('Name'); ?></div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="lg:col-span-3 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Contact</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" name="contact" value="<?php echo set_value('contact'); ?>" >
                        <?php if (form_error('contact')): ?>
                        <div class="error-message" ><?= form_error('contact'); ?></div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-3 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">CNIC</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" name="cnic" value="<?php echo set_value('cnic'); ?>" >
                        <?php if (form_error('cnic')): ?>
                        <div class="error-message" ><?= form_error('cnic'); ?></div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-3 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Address</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" name="address"  value="<?php echo set_value('address'); ?>" >
                        <?php if (form_error('address')): ?>
                        <div class="error-message" ><?= form_error('address'); ?></div>
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