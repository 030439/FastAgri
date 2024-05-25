<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-salereturns-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
        <div class="cashier-transection-selectors flex items-center justify-between pb-5 maxSm:block">
            <h4 class="text-[20px] text-heading mb-2.5 font-bold"><?php echo $data['expenses']['0']->tunnel;?> : Expenses</h4>
            <!-- <div class="cashier-transection-selector flex gap-x-4 maxSm:gap-x-0 items-center justify-end maxSm:justify-start maxXs:block">
                <div class="cashier-transection-selector-single w-[120px] mb-2.5">
                    <div class="cashier-select-field">
                        <div class="cashier-select-field-style">
                            <select class="block" style="display: none;">
                                <option selected="" value="default">Monthly</option>
                                <option value="language-1">Monthly</option>
                                <option value="language-2">Yearly</option>
                            </select>
                            <div class="nice-select block" tabindex="0"><span class="current">Monthly</span>
                                <ul class="list">
                                    <li data-value="default" class="option selected">Monthly</li>
                                    <li data-value="language-1" class="option">Monthly</li>
                                    <li data-value="language-2" class="option">Yearly</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cashier-transection-selector-single w-[270px] mb-2.5 maxXs:w-full">
                    <div class="cashier-select-field">
                        <div class="cashier-select-field-style">
                            <select class="block" style="display: none;">
                                <option selected="" value="default">01 Jan 2022 - 30 Jul 2022</option>
                                <option value="language-1">01 Jan 2022 - 30 Jul 2022</option>
                                <option value="language-2">01 Jan 2022 - 12 Dec 2022</option>
                            </select>
                            <div class="nice-select block" tabindex="0"><span class="current">01 Jan 2022 - 30 Jul
                                    2022</span>
                                <ul class="list">
                                    <li data-value="default" class="option selected">01 Jan 2022 - 30 Jul 2022</li>
                                    <li data-value="language-1" class="option">01 Jan 2022 - 30 Jul 2022</li>
                                    <li data-value="language-2" class="option">01 Jan 2022 - 12 Dec 2022</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
       <style>
        @media (max-width: 1400px) {
    .cashier-salereturns-table-dateP {
        width: 16%;
        min-width: 150px;
    }
}
       </style>
        <div class="cashier-table-header-search-area">
            <div class="grid grid-cols-12 gap-x-5 mb-7 pb-0.5">
                <div class="lg:col-span-5 md:col-span-6 col-span-12">
                    <div class="cashier-table-header-search relative maxSm:mb-4">
                        
                    </div>
                </div>
                <div class="lg:col-span-7 md:col-span-6 col-span-12">
                    <div class="cashier-table-header-search-action-btn text-right maxSm:text-left">
                        <a href="tunnel/detailPdf/<?php echo ($data['expenses'][0]->tid); ?>" class="pdf"><svg id="pdf-file" xmlns="http://www.w3.org/2000/svg"
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
                        <!-- <button type="button" class="csv"><svg id="csv" xmlns="http://www.w3.org/2000/svg"
                                width="18.105" height="18.105" viewBox="0 0 18.105 18.105">
                                <path id="Path_184" data-name="Path 184"
                                    d="M16.514,8.558h-.566V4.774a.535.535,0,0,0-.155-.375h0L11.55.155A.535.535,0,0,0,11.174,0H3.748A1.593,1.593,0,0,0,2.157,1.591V8.558H1.591A1.593,1.593,0,0,0,0,10.149v6.365a1.593,1.593,0,0,0,1.591,1.591H16.514a1.593,1.593,0,0,0,1.591-1.591V10.149A1.593,1.593,0,0,0,16.514,8.558ZM11.7,1.811l2.432,2.432h-1.9a.531.531,0,0,1-.53-.53Zm-8.487-.22a.531.531,0,0,1,.53-.53h6.9V3.713A1.593,1.593,0,0,0,12.235,5.3h2.652V8.558H3.218ZM17.045,16.514a.531.531,0,0,1-.53.53H1.591a.531.531,0,0,1-.53-.53V10.149a.531.531,0,0,1,.53-.53H16.514a.531.531,0,0,1,.53.53Z"
                                    transform="translate(0 0)" fill="#27db8d"></path>
                                <path id="Path_185" data-name="Path 185"
                                    d="M92.591,303.061a.531.531,0,0,1,.53.53.53.53,0,1,0,1.061,0,1.591,1.591,0,0,0-3.183,0v2.122a1.591,1.591,0,1,0,3.183,0,.53.53,0,0,0-1.061,0,.53.53,0,1,1-1.061,0v-2.122A.531.531,0,0,1,92.591,303.061Z"
                                    transform="translate(-87.782 -291.321)" fill="#27db8d"></path>
                                <path id="Path_186" data-name="Path 186"
                                    d="M212.591,304.122a.53.53,0,1,1,.375-.906.53.53,0,0,0,.75-.75,1.591,1.591,0,1,0-1.125,2.717.53.53,0,1,1-.375.906.53.53,0,1,0-.75.75,1.591,1.591,0,1,0,1.125-2.717Z"
                                    transform="translate(-203.539 -291.321)" fill="#27db8d"></path>
                                <path id="Path_187" data-name="Path 187"
                                    d="M333.778,302.013a.531.531,0,0,0-.643.386l-.546,2.185-.546-2.185a.53.53,0,1,0-1.029.257l1.061,4.243a.53.53,0,0,0,1.029,0l1.061-4.243A.53.53,0,0,0,333.778,302.013Z"
                                    transform="translate(-319.293 -291.317)" fill="#27db8d"></path>
                            </svg>
                        </button> -->
                     
                    </div>
                </div>
            </div>
        </div>

        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerS">
                <div
                    class="cashier-salereturns-table-inner-wrapperS border border-solid border-grayBorder border-b-0 mb-7">
                    <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                        <div class="cashier-salereturns-table-dateP">
                            <h5>Expense Type</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5>Product/Person</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5>Rate</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5>Quantity</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5>Amount</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5>Date</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5>Detail</h5>
                        </div>
                    </div>
                    <?php $total=0;if($data['expenses']):foreach($data['expenses'] as $d):?>
                    <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                        <div class="cashier-salereturns-table-dateP">
                            <span><?php echo $d->expense_type;?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <span><?php echo $d->head;?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <span><?php echo $d->rate;?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <span><?php echo $d->qty;?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <span><?php echo $d->amount; $total+=$d->amount;?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                        <span><?php echo $d->edate;?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <span> Detail</span>
                        </div>
                    </div>
                    <?php endforeach; endif;?>
                    <div style="background-color:#dfd9d9;margin-top:10px;" class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                        <div class="cashier-salereturns-table-dateP">
                            <h5></h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5></h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5></h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5>Total Amount :</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5><?= $total;?></h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5></h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5></h5>
                        </div>
                    </div>
                </div>
         
            </div>
        </div>
    </div>
</div>