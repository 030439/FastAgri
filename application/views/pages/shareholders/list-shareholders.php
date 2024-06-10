<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-3 custom-shadow rounded-lg mb-5">
        <div style="display:flex">
        <div class="cashier-managesale-top-btn default-light-theme">
            <button class="mb-1" onclick="document.location='shareholder/create'">
                <i class="fa-light fa-plus"></i> Add Shareholder
            </button>
        </div>
        <h4 class="text-[20px] font-bold text-heading " style="width:60%;text-align:center">Shareholders List</h4>
        
        </div>
        <style>th{border:1px solid gray;}</style>
        <div class="cashier-salereturns-table-area">
        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
                <table id="user-list" class="table display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone No</th>
                            <th>CNIC</th>
                            <th>Address</th>
                            <th>Capital Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table> 
            </div>
        </div>
    </div>
</div>
<?php $file="shareholder-list.php";?>