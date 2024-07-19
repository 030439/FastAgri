<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-3">
        <div style="display:flex">
            <div class="cashier-managesale-top-btn default-light-theme">
                <button class="" onclick="document.location='payroll/generate'">
                    <i class="fa-light fa-plus"></i> Generate Payroll
                </button>
            </div>
            <h4 class="text-[20px] font-bold text-heading" style="width:60%; text-align:center;">Pays List</h4>
        </div>
        <style>
            .cashier-salereturns-table-dateB {
                width: 9%;
                min-width: 13px;
            }
            input{
                width: 80%;
            }
        </style>
         <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
                <table id="user-list" class="table display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Basic</th>
                            <th>Medical</th>
                            <th>Allowance</th>
                            <th>Total</th>
                            <th>Installment</th>
                            <th>Addition</th>
                            <th>Deduction</th>
                            <th>Net</th>
                            <!-- <th>Status</th>
                            <th>Action</th> -->
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $file="list-payroll.php";?>