<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Advance/ Loan</h4>
    <div class="grid grid-cols-12 gap-x-5">
        <form action='employee-advance-add' method="post">
            <div class="lg:col-span-3 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Designation</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" id="loan-employee-type" name="employee_type" style="display: none;">
                            <option value="1">Permanent Employees</option>
                            <option value="2">Daily  Employees</option>
                            <option value="3">Jamandars</option>
                        </select>
                        <?php validator('employee_type')?>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-3 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Name</h5>
                    <div class="cashier-select-field-style">
                        <select id="loan-employee-names" name="employee" >
                        
                        </select>
                        <?php validator('employee')?>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Amount</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" placeholder="Amount" name="amount">
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Installment</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" placeholder="Installment" name="installment">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12">
                <div class="cashier-managesale-top-btn default-light-theme pt-2.5">
                    <button class="btn-primary" type="submit">Add Now</button>
                </div>
            </div>
        </form>

    </div>
</div>