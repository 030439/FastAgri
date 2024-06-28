<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <div style="display:flex">
        <div class="cashier-managesale-top-btn default-light-theme mb-7">
            <button class="mb-1" onclick="document.location='tunnels/add'">
                <i class="fa-light fa-plus"></i> Create Tunnel
            </button>
        </div>
        <h4 class="text-[20px] font-bold text-heading mb-9" style="width:60%;text-align:center;underline">Tunnels List</h4>
        
        </div>

        
        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-area">
                <div class="cashier-salereturns-table-innerC">
                    <table id="user-list"  class="table table-bordered borderd table-striped display table-hover">
                        <thead>
                            <tr>
                                <th>Asset Name</th>
                                <th>Cost</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table> 
                </div>
            </div>
    </div>
</div>
<?php $file="asset-list.php";?>