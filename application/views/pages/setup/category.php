<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Add Employyee Category</h4>
    <form action="save-category" method="post">
        <div class="grid grid-cols-12 gap-x-5">
            <div class="lg:col-span-18 md:col-span-5 col-span-12 flex items-center">

                <div class="cashier-select-field  flex items-center flex-1">
                    <label class="text-[15px] text-heading font-semibold  mr-2" for="fasalInput">Employyee Category :</label>
                    <div class="cashier-input-field-style flex-1 mr-2">
                        <div class="single-input-field w-full">
                            <input id="" type="text" name='Name' placeholder="Category">
                            <?php validator('Name');?>
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
    <h4 class="text-[20px] font-bold text-heading mb-9">Employee Category List</h4>
    
 

    <div class="cashier-salereturns-table-area">
        <div class="cashier-salereturns-table-innerC">
            <div class="cashier-salereturns-table-inner-wrapperC border border-solid border-grayBorder border-b-0 mb-7">
                <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                    <div class="cashier-salereturns-table-checkboxB default-light-theme">
                        <input type="checkbox" id="b-check" name="b-check" data-checkbox-name="cbi" class="selectall">
                    </div>
                    <div class="cashier-salereturns-table-dateB">
                        <h5>Category Name</h5>
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
                         <span><?php ShowVal($d->Name);?></span>
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
        <div class="cashier-pagination-area">
            <div class="cashier-pagination-wrapper">
                <div class="grid grid-cols-12">
                    <div class="lg:col-span-3 md:col-span-6 col-span-12">
                        <div
                            class="cashier-pagination-sort flex items-center flex-wrap maxSm:mb-4 maxSm:justify-center">
                            <figure class="text-[14px] font-normal text-gray mr-1.5">Rows per page : </figure>
                            <div class="cashier-select-field-style w-16">
                                <div class="single-input-field w-full">
                                    <select class="block" style="display: none;">
                                        <option selected="" value="language-1">20</option>
                                        <option value="language-2">25</option>
                                        <option value="language-3">35</option>
                                        <option value="language-4">45</option>
                                        <option value="language-5">50</option>
                                    </select>
                                    <div class="nice-select block" tabindex="0"><span class="current">20</span>
                                        <ul class="list">
                                            <li data-value="language-1" class="option selected">20</li>
                                            <li data-value="language-2" class="option">25</li>
                                            <li data-value="language-3" class="option">35</li>
                                            <li data-value="language-4" class="option">45</li>
                                            <li data-value="language-5" class="option">50</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-9 md:col-span-6 col-span-12">
                        <div class="cashier-pagination text-right maxSm:text-center">
                            <ul>
                                <li><a href="javascript:void(0)">
                                        <i class="fa-light fa-angle-left"></i>
                                    </a></li>
                                <li><a href="javascript:void(0)" class="active">01</a></li>
                                <li><a href="javascript:void(0)">02</a></li>
                                <li><a href="javascript:void(0)">03</a></li>
                                <li><a href="javascript:void(0)">04</a></li>
                                <li><a href="javascript:void(0)">
                                        <i class="fa-light fa-angle-right"></i>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
