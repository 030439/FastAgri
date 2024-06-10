<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-salereturns-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
        <div class="cashier-transection-selectors flex items-center justify-between pb-5 maxSm:block">
            <h4 class="text-[20px] text-heading mb-2.5 font-bold">Summary </h4>
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
                        <a href="tunnel/detailPdf/" class="pdf"><svg id="pdf-file" xmlns="http://www.w3.org/2000/svg"
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
                </div>
            </div>
        </div>

        <div class="cashier-salereturns-table-area" style="overflow:scroll">
            <div class="cashier-salereturns-table-innerS">
                <div
                    class="cashier-salereturns-table-inner-wrapperS border border-solid border-grayBorder border-b-0 mb-7">
                    <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                        <div class="cashier-salereturns-table-dateP">
                            <h5>Tunnel</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5>Acer</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5>Avge</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5>Sale</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5>Expense</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5>Net Amount</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <h5>Remarks</h5>
                        </div>
                        <?php if(!empty($data['snames'])):foreach($data['snames'] as $name):?>
                            <div class="cashier-salereturns-table-dateP">
                                <h5><?php echo $name;?></h5>
                            </div>
                        <?php endforeach; endif;?>
                    </div>
                    <?php $total=0;if($data['tunnel']):foreach($data['tunnel'] as $no=> $t):?>
                    <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                        <div class="cashier-salereturns-table-dateP">
                            <span><?php echo $t;?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <span><?php echo $data['acer'][$no];?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <span>10</span>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <span><?php echo intval($data['sale'][$no]);?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <span><?php echo intval($data['expense'][$no]);?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                        <span><?php echo intval($data['net'][$no]);?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateP">
                            <span> Detail</span>
                        </div>
                        <?php if(!empty($data['shareholders'])):foreach($data['shareholders'] as $sid):?>
                            <div class="cashier-salereturns-table-dateP">
                                <span> 
                                    <?php
                                     foreach($data['shares'][$no] as $c=> $share){
                                       if($c==$sid){
                                        echo intval($share);
                                       }
                                    }
                                    ?>
                                </span>
                            </div>
                        <?php endforeach; endif;?>
                    </div>
                    <?php endforeach; endif;?>

                    
                </div>
         
            </div>
        </div>
    </div>
</div>