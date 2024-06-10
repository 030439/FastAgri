<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <div class="cashier-managesale-top-btn default-light-theme mb-7">
            <button class="mb-1" onclick="document.location='stock/addProduct'">
                <i class="fa-light fa-plus"></i> Insert Product
            </button>
            <h4 class="text-[20px] font-bold text-heading" style="width:60%;text-align:center">Product List</h4>
        </div>
        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
                <table id="user-list" class="table display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Unit</th>
                        </tr>
                    </thead>
                </table> 
            </div>
           
        </div>
    </div>
</div>

<?php $file="products.php";?>