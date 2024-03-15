<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <h4 class="text-[20px] font-bold text-heading mb-9">Seed List</h4>
        <div class="cashier-managesale-top-btn default-light-theme mb-7">
            <button class="mb-1" onclick="document.location='add-seed'">
                <i class="fa-light fa-plus"></i> Add Seed
            </button>
        </div>
        <div class="cashier-table-header-search-area">
            <div class="grid grid-cols-12 gap-x-5 mb-7 pb-0.5">
                <div class="md:col-span-6 col-span-12">
                    <div class="cashier-table-header-search relative maxSm:mb-4">
                        <input type="text" placeholder="Search List">
                        <span>
                            <i class="fa-light fa-magnifying-glass"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
                <div
                    class="cashier-salereturns-table-inner-wrapperC border border-solid border-grayBorder border-b-0 mb-7">
                    <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                        <div class="cashier-salereturns-table-checkboxB default-light-theme">
                            <input type="checkbox" id="b-check" name="b-check" data-checkbox-name="cbi"
                                class="selectall">
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Product Name</h5>
                        </div>
                    </div>
                    <?php if(!empty($data)): foreach($data as $d):?>
                    <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                        <div class="cashier-salereturns-table-checkboxB default-light-theme">
                            <input type="checkbox" id="cbi_1" name="cbi" value="1" data-select-all="b-check"
                                class="checkme">
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <span><?php echo $d->FasalName?></span>
                        </div>
                    </div>
                    <?php endforeach; endif;?>
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
</div>