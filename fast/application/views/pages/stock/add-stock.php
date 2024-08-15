<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Add product stock</h4>
    <form action="product-insert" method="post">
        <div class="grid grid-cols-12 gap-x-5">

            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Product Name</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder="Product Name" name="Name">
                            <?php if (form_error('Name')): ?>
                                <div class="error-message" ><?= form_error('Name'); ?></div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Company</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder="Company" name="company">
                            <?php if (form_error('company')): ?>
                                <div class="error-message" ><?= form_error('company'); ?></div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Unit</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                        <select class="block single-input-field w-full" name="unit_id" >
                            <option selected  disabled="disabled">Select Unit</option>
                            <?php 
                                if(!empty($data)):
                                foreach($data as $d):    
                            ?>
                            <option value="<?php echo $d->id?>"><?php echo $d->Name?></option>
                            <?php 
                                endforeach;
                                endif;
                            ?>
                        </select>
                        <?php if (form_error('unit_id')): ?>
                                <div class="error-message" ><?= form_error('unit_id'); ?></div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Quantity</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder="Quantity" name="qunatity">
                            <?php if (form_error('qunatity')): ?>
                                <div class="error-message" ><?= form_error('qunatity'); ?></div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Rate</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder="Rate" name="rate">
                            <?php if (form_error('rate')): ?>
                                <div class="error-message" ><?= form_error('rate'); ?></div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12">
                <div class="cashier-managesale-top-btn default-light-theme pt-2.5">
                    <button class="btn-primary" type="submit">add </button>
                </div>
            </div>
        </div>
    </form>
</div>