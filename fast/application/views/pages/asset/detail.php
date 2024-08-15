<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
        <div class="cashier-managesale-top-btn default-light-theme mb-7">
            <button class="mb-1" onclick="document.location='asset/list'">
                Asset List
            </button>
        </div>
        <h4 class="text-[20px] font-bold text-heading" style="underline"><?php if($data){echo $data[0]->asset;echo " - ". $data[0]->cost . " Rs";}?></h4>
        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
                <div
                    class="cashier-salereturns-table-inner-wrapperC border border-solid border-grayBorder border-b-0 mb-7">
                    <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                        <div class="cashier-salereturns-table-checkboxB default-light-theme">
                            <input type="hidden" id="b-check" name="b-check" data-checkbox-name="cbi"
                                class="selectall">
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5># </h5>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Shareholder </h5>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Share</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Amount</h5>
                        </div>
                    </div>
                    <?php 
                        if($data):
                            foreach($data as $c=> $d):

                                $amount = ($d->shares_values / 100) * $d->cost;
                    ?>
                            <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                       
                                <div class="cashier-salereturns-table-checkboxB default-light-theme">
                                    <input type="hidden" id="cbi_1" name="cbi" value="1" data-select-all="b-check"
                                        class="checkme">
                                </div>
                                <div class="cashier-salereturns-table-dateB">
                                <span><?= ++$c;?></span>
                                </div>
                                <div class="cashier-salereturns-table-dateB">
                                    <span><?= $d->Name?></span>
                                </div>
                                <div class="cashier-salereturns-table-dateB">
                                    <span><?= $d->shares_values?> %</span>
                                </div>
                                <div class="cashier-salereturns-table-dateB">
                                    <span><?= $amount?></span>
                                </div>
                            </div>
                <?php
                        endforeach;
                    endif;
                ?>
                </div>
            </div>
        </div>
    </div>
</div>