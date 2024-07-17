<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <div style="display:flex">
            <div class="cashier-managesale-top-btn default-light-theme">
                <button class="mb-1" onclick="document.location='stock/productList'">
                    Product List
                </button>
            </div>
            <h4 class="text-[20px] font-bold text-heading" style="width:60%;text-align:center;"><span style="border-bottom: 5px solid #ffc403"><?php echo productName_($id);?> Ledger</span></h4>
        </div>

        <div class="cashier-salereturns-table-area">
            <input  type="hidden" id="product-ledger-id" value="<?php echo $id;?>">
            <div class="cashier-salereturns-table-innerC">
                <table id="user-list" class="table display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Sell/Receive</th>
                            <th>Date</th>
                            <th> Credit</th>
                            <th> Debit</th>
                            <th>Running Balance</th>
                            <th> Detail</th>
                            <th> Detail</th>
                            <th> Detail</th>
                            <th> Detail</th>
                            <th> Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>
<?php $file="product-ledger.php";?>