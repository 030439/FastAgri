
<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <style>
        button:hover{
            background-color:#ffc403 !important;
            color:green;
        }
    </style>
    <div style="display:flex">
        <div style="width:40%;margin-top:-5px;margin-left:-20px;padding:1px !important;height:10px" class="cashier-managesale-top-btn default-light-theme mb-7">
            <button style="background:none"  class="" onclick="document.location='shareholders'">
            <i style="background:none"class="far fa-arrow-left inline-block"></i> 
            </button>
           
        </div>
        <h4 style="border-bottom:5px solid #ffc403" class="text-[20px] font-bold text-heading mb-9" style="">Add Shareholder</h4>
    </div>
    <form action="shareholder/create" method="POST">
    <div class="grid grid-cols-12 gap-x-5">
    
        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3"> Name</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" placeholder="" name="name">
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
                        <input type="number" name="phone" min="0" placeholder="">
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
                        <input type="number" id="cnic" maxlength="15" name="cnic" pattern="\d{5}-\d{7}-\d{1}" placeholder="">
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
                        <input type="number" min="0"  name="capital_amount" placeholder="">
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