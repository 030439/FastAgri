<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Add Customer</h4>
    <form action="insert-supplier" method="POST">
        <div class="grid grid-cols-12 gap-x-5">
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Name</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" name="Name" placeholder=" Name">
                            <?php validator('Name');?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">CNIC</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" id="cnic" maxlength="15" name="cnic" pattern="\d{5}-\d{7}-\d{1}" placeholder="">
                            <p id="cnicValidationMessage"></p>
                            <?php validator('cnic');?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Company</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder="Company" name="company_name">
                            <?php validator('company_name');?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Contact</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" placeholder="Contact" name="contact">
                            <?php validator('contact');?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Address</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder="Address" name="Address">
                            <?php validator('Address');?>
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
    <form>
</div>