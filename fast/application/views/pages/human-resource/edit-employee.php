<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Update Employye</h4>
    <form action="update-employee" method="post">
        <input type="hidden" name="id" value="<?php echo $data['employee']->id?>">
        <div class="grid grid-cols-12 gap-x-5">
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3"> Name</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text"  value="<?php echo $data['employee']->Name; ?>"  name="Name">
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
                            <input type="text" value="<?php echo  $data['employee']->FatherName; ?>"  name="FatherName">
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
                            <input type="number"  value="<?php echo $data['employee']->Nic; ?>"  name="Nic">
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
                            <input type="text"  value="<?php echo $data['employee']->Address; ?>"  name="Address">
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
                            <input type="number"  value="<?php echo $data['employee']->ContactNo; ?>"  name="ContactNo">
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
                            <option <?php if($data['employee']->employee_cat_id==$d->id){echo "selected";}?> value="<?= $d->id;?>"><?php ShowVal($d->Name);?></option>
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
                            <option  selected="" disabled="" value="default">Select Designation</option>
                            <?php
                        if(!empty($data)):
                            foreach($data['designation'] as $de):
                        ?>
                            <option <?php if($data['employee']->designation_id==$de->id){echo "selected";}?> value="<?= $de->id;?>"><?php ShowVal($de->name);?></option>
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
                            <input type="number"  value="<?php echo $data['employee']->BasicSalary; ?>"  name="BasicSalary">
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
                            <input type="number"  value="<?php echo $data['employee']->Allowances; ?>"  name="Allowances">
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
                            <input type="number"  value="<?php echo $data['employee']->Medical; ?>"  name="Medical">
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