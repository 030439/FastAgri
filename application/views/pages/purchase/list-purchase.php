<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <div >
            <div class="cashier-managesale-top-btn default-light-theme ">
                <button class="mb-1" onclick="document.location='purchase/add'">
                    <i class="fa-light fa-plus"></i> Create Purchase
                </button>
                <h4 class="text-[20px] font-bold text-heading " style="width:60%;text-align:center">Purchase List</h4>
            </div>
            
        <div>
        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
                <table id="user-list" class="table display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th>Rate</th>
                            <th>Amount</th>
                            <th>PurchaseQty</th>
                            <th>RemainingQty</th>
                        </tr>
                    </thead>
                </table> 
            </div>
        
        </div>
    </div>
</div>
<?php $file="purchase.php";?>