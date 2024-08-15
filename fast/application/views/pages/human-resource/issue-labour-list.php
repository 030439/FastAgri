<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <h4 class="text-[20px] font-bold text-heading mb-9">Issued Labour List</h4>
        <div class="cashier-managesale-top-btn default-light-theme mb-7">
            <button class="mb-1" onclick="document.location='hr/issuelabour'">
                <i class="fa-light fa-plus"></i> Issue Labour
            </button>
        </div>
        
        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
                <table id="user-list" class="table display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Tunnel</th>
                            <th>Jamandar</th>
                            <th>Labour Quantity</th>
                            <th>Rate</th>
                            <th>Deduction</th>
                            <th>Total Amount</th>
                            <th>Date-Time</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="3"></th>
                            <th></th>
                            <th >Total</th>
                            <th id="total-net"></th>
                            
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $file="list-issued-labour.php";?>