<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <div class="cashier-managesale-top-btn default-light-theme mb-7">
            <button class="mb-1" onclick="document.location='stock/issue'">
                <i class="fa-light fa-plus"></i> Issue Stock
            </button>
            <h4 class="text-[20px] font-bold text-heading" style="text-align:center;width:70%">Issue Stock  List</h4>
                        <a href="issue-stock/issuePdf" class="pdf"><svg id="pdf-file" xmlns="http://www.w3.org/2000/svg"
                                width="19.027" height="19.72" viewBox="0 0 19.027 19.72">
                                <path id="Path_188" data-name="Path 188"
                                    d="M82.8,209H81.578a.578.578,0,0,0-.578.58l.009,4.389a.578.578,0,1,0,1.155,0v-1.333l.636,0a1.817,1.817,0,1,0,0-3.634Zm0,2.478-.639,0c0-.246,0-.511,0-.664,0-.131,0-.4,0-.661H82.8a.662.662,0,1,1,0,1.323Z"
                                    transform="translate(-78.227 -200.95)" fill="#ff9720"></path>
                                <path id="Path_189" data-name="Path 189"
                                    d="M210.784,209h-1.207a.578.578,0,0,0-.578.579s.009,4.246.009,4.262a.578.578,0,0,0,.578.576h0c.036,0,.9,0,1.241-.009a2.449,2.449,0,0,0,2.253-2.7C213.083,210.088,212.159,209,210.784,209Zm.025,4.251c-.15,0-.407,0-.647.006,0-.5,0-2.581-.006-3.1h.628c1.06,0,1.143,1.188,1.143,1.553C211.927,212.467,211.582,213.238,210.81,213.251Z"
                                    transform="translate(-201.297 -200.95)" fill="#ff9720"></path>
                                <path id="Path_190" data-name="Path 190"
                                    d="M355.344,209a.578.578,0,1,0,0-1.155h-1.766a.578.578,0,0,0-.578.578v4.358a.578.578,0,0,0,1.155,0v-1.643H355.2a.578.578,0,1,0,0-1.155h-1.048V209Z"
                                    transform="translate(-339.75 -199.837)" fill="#ff9720"></path>
                                <path id="Path_191" data-name="Path 191"
                                    d="M26.294,5.585H25.87V5.42a2.877,2.877,0,0,0-.792-1.987L22.678.9a2.9,2.9,0,0,0-2.1-.9H12.89a1.735,1.735,0,0,0-1.733,1.733V5.585h-.424A1.735,1.735,0,0,0,9,7.318v6.933a1.735,1.735,0,0,0,1.733,1.733h.424v2A1.735,1.735,0,0,0,12.89,19.72H24.137a1.735,1.735,0,0,0,1.733-1.733v-2h.424a1.735,1.735,0,0,0,1.733-1.733V7.318A1.735,1.735,0,0,0,26.294,5.585ZM12.312,1.733a.578.578,0,0,1,.578-.578h7.691a1.74,1.74,0,0,1,1.258.541l2.4,2.531a1.726,1.726,0,0,1,.475,1.192v.165h-12.4Zm12.4,16.254a.578.578,0,0,1-.578.578H12.89a.578.578,0,0,1-.578-.578v-2h12.4Zm2.157-3.736a.578.578,0,0,1-.578.578H10.733a.578.578,0,0,1-.578-.578V7.318a.578.578,0,0,1,.578-.578h15.56a.578.578,0,0,1,.578.578Z"
                                    transform="translate(-9 0)" fill="#ff9720"></path>
                            </svg>
                        </a>
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
                            <h5>Tunnel</h5>
                        </div>
                        <div class="cashier-salereturns-table-referenceB">
                            <h5>Employee</h5>
                        </div>
                        <div class="cashier-salereturns-table-customerB">
                            <h5>Product</h5>
                        </div>
                        <div class="cashier-salereturns-table-warehouseB">
                            <h5>Quantity </h5>
                        </div>
                        <div class="cashier-salereturns-table-billerB">
                            <h5>Rate</h5>
                        </div>
                        <div class="cashier-salereturns-table-totalB">
                            <h5>Issued Date</h5>
                        </div>
                        
                        <!-- <div class="cashier-salereturns-table-actionB">
                            <h5>Action</h5>
                        </div> -->
                    </div>
                    <?php if(!empty($data)): foreach($data as $d):?>
                    <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                        <div class="cashier-salereturns-table-checkboxB default-light-theme">
                            <input type="checkbox" id="cbi_1" name="cbi" value="1" data-select-all="b-check" class="checkme">
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <span><?php ShowVal($d->TName)?></span>
                        </div>
                        <div class="cashier-salereturns-table-referenceB">
                            <span><?php ShowVal($d->employee)?></span>
                        </div>
                        <div class="cashier-salereturns-table-customerB">
                            <span><?php ShowVal($d->product_name)?></span>
                        </div>
                        <div class="cashier-salereturns-table-warehouseB">
                            <span><?php ShowVal($d->Quantity)?></span>
                        </div>
                        <div class="cashier-salereturns-table-billerB">
                            <span><?php pqrate($d->PqId,$d->pid)?></span>
                        </div>
                        <div class="cashier-salereturns-table-totalB">
                            <span><?php ShowVal($d->i_date)?></span>
                        </div>
                       
                        <!-- <div class="cashier-salereturns-table-actionB">
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
                        </div> -->
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