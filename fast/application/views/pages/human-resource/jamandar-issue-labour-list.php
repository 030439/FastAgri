<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg">
        <h4 class="text-[20px] font-bold text-heading ">Labour Issued By :<?php if(!empty($data)): echo $data[0]->jamander; endif;?></h4>
        <div class="cashier-table-header-search-area">
            <div class="grid grid-cols-12 gap-x-5  pb-0.5">
                <div class="md:col-span-6 col-span-12">
                    <div class="cashier-table-header-search relative maxSm:mb-4">
                        <input type="hidden" id="jid-detail" value="<?php echo $id?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
                <table id="user-list" class="table display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Date-Time</th>
                            <th>Tunnel/Jamandari</th>
                            <th>Labour Quantity</th>
                            <th>Rate</th>
                            <th>Deduction</th>
                            <th>Credit</th>
                            <th>Debit</th>
                            <th>Running Balance</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="3"></th>
                            <th >Total</th>
                            <th id="total-net"></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $file="jamandar-detail.php";?>