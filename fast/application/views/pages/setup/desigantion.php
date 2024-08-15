<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Add  Designation</h4>
    <form action="save-designation" method="post">
        <div class="grid grid-cols-12 gap-x-5">
            <div class="lg:col-span-18 md:col-span-5 col-span-12 flex items-center">

                <div class="cashier-select-field  flex items-center flex-1">
                    <label class="text-[15px] text-heading font-semibold  mr-2" for="fasalInput"> Designation :</label>
                    <div class="cashier-input-field-style flex-1 mr-2">
                        <div class="single-input-field w-full">
                            <input id="" type="text" name='name' placeholder="Category">
                            <?php validator('name');?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-6 md:col-span-6 col-span-12 flex items-center">
                <div class="col-span-12">
                    <div class="cashier-managesale-top-btn default-light-theme ">
                        <button class="btn-primary ml-auto" type="submit" style="margin-bottom: 0;">Add Now</button>
                    </div>
                </div>
            </div>


        </div>
    </form>

</div>




<div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Designation List</h4>
    <div class="cashier-salereturns-table-area">
        <div class="cashier-salereturns-table-innerC">
            <div class="cashier-salereturns-table-inner-wrapperC border border-solid border-grayBorder border-b-0 mb-7">
                <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                    <div class="cashier-salereturns-table-checkboxB default-light-theme">
                        <input type="checkbox" id="b-check" name="b-check" data-checkbox-name="cbi" class="selectall">
                    </div>
                    <div class="cashier-salereturns-table-dateB">
                        <h5>Designation Name</h5>
                    </div>
                    
                    <div class="cashier-salereturns-table-actionB">
                        <h5>Action</h5>
                    </div>
                </div>
                <?php if(!empty($data)): foreach($data as $d):?>
                <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                    <div class="cashier-salereturns-table-checkboxB default-light-theme">
                        <input type="checkbox" id="cbi_1" name="cbi" value="1" data-select-all="b-check"
                            class="checkme">
                    </div>
                    <div class="cashier-salereturns-table-dateB">
                         <span><?php ShowVal($d->name);?></span>
                    </div>
                    
                    <div class="cashier-salereturns-table-actionB">
                        <div class="dropdown">
                            <button class="common-action-menu-style">Action
                                <i class="fa-sharp fa-solid fa-caret-down"></i>
                            </button>
                            <div class="dropdown-list">
                                <button class="dropdown-menu-item">
                                    <img src="assets/img/icon/action-2.png" alt="icon not found">
                                    <span>Update</span>
                                </button>
                                <button class="dropdown-menu-item">
                                    <img src="assets/img/icon/action-6.png" alt="icon not found">
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;endif;?>
            </div>
        </div>
    </div>
</div>
