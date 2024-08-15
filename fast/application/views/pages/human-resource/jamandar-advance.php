<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Jamandar Advance/ Loan</h4>
    <form action='jamandar-advance-add' method="post">
        <div class="grid grid-cols-12 gap-x-5">
                <div class="lg:col-span-2 md:col-span-6 col-span-12">
                    <div class="cashier-select-field mb-5">
                        <h5 class="text-[15px] text-heading font-semibold mb-3">Name</h5>
                        <div class="cashier-select-field-style">
                            <select id="loan-employee-names" name="employee_id" >
                                <option disabled selected>Select Jamandar</option>
                            <?php if(!empty($jamandar)):foreach($jamandar as $j):?>
                                <option value="<?php echo $j->id?>"><?php echo $j->name;?></option>
                            <?php endforeach; endif;?>
                            </select>
                            <?php validator('employee_id')?>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 md:col-span-6 col-span-12">
                    <div class="cashier-select-field mb-5">
                        <h5 class="text-[15px] text-heading font-semibold mb-3">Amount</h5>
                        <div class="cashier-input-field-style">
                            <div class="single-input-field w-full">
                                <input type="number" value="<?php echo set_value('amount'); ?>" name="amount">
                                <?php validator('amount')?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 md:col-span-6 col-span-12">
                    <div class="cashier-select-field mb-5">
                        <h5 class="text-[15px] text-heading font-semibold mb-3">Installment</h5>
                        <div class="cashier-input-field-style">
                            <div class="single-input-field w-full">
                                <input type="number" value="<?php echo set_value('installment'); ?>" name="installment">
                                <?php validator('installment')?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-2 md:col-span-6 col-span-12">
                    <div class="cashier-select-field mb-5">
                        <h5 class="text-[15px] text-heading font-semibold mb-3">Date</h5>
                        <div class="cashier-input-field-style">
                            <div class="single-input-field w-full">
                                <input type="date" value="<?php echo set_value('date_'); ?>" name="date_">
                                <?php validator('date_')?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 md:col-span-6 col-span-12">
                    <div class="cashier-managesale-top-btn default-light-theme pt-2.5" style="margin-top:25px">
                        <button class="btn-primary" type="submit">Add Now</button>
                    </div>
                </div>
        </div>
    </form>
</div>

<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <h4 class="text-[20px] font-bold text-heading mb-9">Jamandars Loan List</h4>
       

        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
            <table id="user-list" class="table display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Jamandar</th>
                            <th>Advance</th>
                            <th>Installment</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $file="jamandars-loan.php";?>