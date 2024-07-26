
<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg">
        <div class="cashier-managesale-top-btn default-light-theme ">
            <button class="" onclick="document.location='stock/addProduct'">
                <i class="fa-light fa-plus"></i> Insert Product
            </button>
            <button class="" onclick="document.location='add-seed'">
                <i class="fa-light fa-plus"></i> Add Seed
            </button>
            </div>
    </div>
</div>

<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <div class="cashier-managesale-top-btn default-light-theme mb-7">
            
            <p class="text-[20px] font-bold text-heading" style="text-align:center;width:100%">Product List</p>
        </div>
        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
                <table id="user-list" class="table display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Unit</th>
                            <th>RemainingQuality</th>
                            <th>Ledger</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                </table> 
            </div>
           
        </div>
    </div>
</div>

<?php $file="products.php";?>