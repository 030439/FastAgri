<div class="cashier-content-area mt-[30px] px-7">
    <input type="hidden" value="<?php echo $id?>" id="p_id">
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
                            <th>Rate</th>
                            <th>PurchaseQty</th>
                            <th>Amount</th>
                            <th>Remaining Qty</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="2"></th>
                            <th >Total</th>
                            <th id="total-net"></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table> 
            </div>
        
        </div>
    </div>
</div>
<?php $file="purchase_detail.php";?>