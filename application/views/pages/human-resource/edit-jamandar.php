<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Add Jamandar</h4>
    <form action="save-jamandar" method="post">
        <div class="grid grid-cols-12 gap-x-5">
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3"> Name</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" value="<?php echo set_value('name'); ?>"name="name">
                            <?php validator('name')?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Father</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder="Father" name="fatherName">
                            <?php validator('fatherName')?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">CNIC</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" value="<?php echo set_value('cnic'); ?>" name="cnic">
                            <?php validator('cnic')?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Address</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" value="<?php echo set_value('address'); ?>" name="address">
                            <?php validator('address')?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Contact</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" min="0" value="<?php echo set_value('contact'); ?>" name="contact">
                            <?php validator('contact')?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Jamandari</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" min="0" value="<?php echo set_value('jamandari'); ?>" name="jamandari">
                            <?php validator('jamandari')?>
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