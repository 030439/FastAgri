<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Add Employye</h4>
    <form action="save-employee" method="post">
        <div class="grid grid-cols-12 gap-x-5">
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3"> Name</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder=" Name" name="Name">
                            <?php validator('Name')?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Father</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder="Father" name="FatherName">
                            <?php validator('FatherName')?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">CNIC</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" placeholder="CNIC" name="Nic">
                            <?php validator('Nic')?>
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
                            <?php validator('Address')?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Contact</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" placeholder="Contact" name="ContactNo">
                            <?php validator('ContactNo')?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Category</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" name="employee_cat_id" style="display: none;">
                            <option selected="" disabled="" value="default">Select Category</option>
                            <?php
                        if(!empty($data)):
                            foreach($data['category'] as $d):
                        ?>
                            <option value="<?= $d->id;?>"><?php ShowVal($d->Name);?></option>
                            <?php endforeach; endif;?>

                        </select>
                        <?php validator('employee_cat_id')?>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Designation</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" name="designation_id" style="display: none;">
                            <option selected="" disabled="" value="default">Select Designation</option>
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
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Basic Salary</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" placeholder="Basic Salary" name="BasicSalary">
                            <?php validator('BasicSalary')?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">allowance</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" placeholder="allowance" name="Allowances">
                            <?php validator('Allowances')?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Medical</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" placeholder="Medical" name="Medical">
                            <?php validator('Medical')?>
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