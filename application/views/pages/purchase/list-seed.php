<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <h4 class="text-[20px] font-bold text-heading mb-9">Seed Purchase List</h4>
        <div class="cashier-managesale-top-btn default-light-theme mb-7">
            <button class="mb-1" onclick="document.location='purchase-seed'">
                <i class="fa-light fa-plus"></i> Create Purchase
            </button>
        </div>
        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
                <table id="user-list" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th>Rate</th>
                            <th>Amount</th>
                            <th>Purchase QTY</th>
                            <th>Remaining QTY</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                </table> 
            </div>
        </div>
    </div>
</div>
<?php $file="seed-list.php";?>