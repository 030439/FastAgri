<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <h4 class="text-[20px] font-bold text-heading mb-9">Seed Purchase List</h4>
        <div class="cashier-managesale-top-btn default-light-theme mb-7">
            <button class="mb-1" onclick="document.location='purchase-seed'">
                <i class="fa-light fa-plus"></i> Create Purchase
            </button>
        </div>
        <div style="float:right">
                <label for="start-date">Start Date:</label>
                <input type="text" id="start-date" class="datepicker" style="border:2px solid #057C89">
                <label for="end-date">End Date:</label>
                <input type="text" id="end-date" class="datepicker"  style="border:2px solid #057C89">
                <button id="filter" style="background-color:#057C89;color:#fff;padding:5px 10px">Filter</button>
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
<?php $file="seed-list.php";?>