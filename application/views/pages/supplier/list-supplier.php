<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg">
        <div style="display:flex">
            <div class="cashier-managesale-top-btn default-light-theme">
                <button class="mb-1" onclick="document.location='supplier/add'">
                    <i class="fa-light fa-plus"></i> Create Supplier
                </button>
            </div>
            <h4 class="text-[20px] font-bold text-heading" style="width:60%; text-align:center">Supplier List</h4>
        </div>
        <div class="cashier-table-header-search-area">
            <div class="grid grid-cols-12 gap-x-5  pb-0.5">
                <div class="md:col-span-6 col-span-12">
                    <div class="cashier-table-header-search relative maxSm:mb-4">
                        
                    </div>
                </div>
                <div class="md:col-span-6 col-span-12">
                    <div class="cashier-table-header-search-action-btn text-right maxSm:text-left">
                        <button  onclick="document.location='supplierExport'" type="button" class="csv"><svg id="csv" xmlns="http://www.w3.org/2000/svg"
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
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
                    <table id="user-list" class="table display table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Contact No</th>
                                <th>CNIC</th>
                                <th>Address</th>
                                <th>Balance</th>
                                <th>Detail |Status |Edit |Ledger</th>
                            </tr>
                            
                        </thead>
                    </table> 
            </div>
        </div>
    </div>
</div>

<?php $file="supplier-list.php";?>