<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <h4 class="text-[20px] font-bold text-heading mb-9">Customer Name : <?php echo  $data[0]['customer'];?></h4>
        <div class="cashier-table-header-search-area">
            <div class="grid grid-cols-12 gap-x-5 mb-7 pb-0.5">
                <div class="md:col-span-6 col-span-12">
                    <div class="cashier-table-header-search relative maxSm:mb-4">
                        <input  id="customer-indi-id" type="hidden" value="<?php echo $id?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
            <table id="user-list" class="table display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Tunnel</th>
                            <th>Fasal</th>
                            <th>Grade</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Amount</th>
                            <th>Sell Date</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $file="customer-individual.php";?>