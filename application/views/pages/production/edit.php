<!-- <div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Add Fasal</h4>
    <div class="grid grid-cols-12 gap-x-5">


        <div class="lg:col-span-3 md:col-span-5 col-span-12 flex items-center">

            <div class="cashier-select-field  flex items-center flex-1">
                <label class="text-[15px] text-heading font-semibold  mr-2" for="fasalInput">Fasal :</label>
                <div class="cashier-input-field-style flex-1 mr-2">
                    <div class="single-input-field w-full">
                        <input id="fasalInput" type="text" placeholder="Fasal">
                    </div>
                </div>
            </div>
        </div>


        <div class="lg:col-span-6 md:col-span-6 col-span-12 flex items-center">

            <div class="cashier-select-field  flex items-center flex-1">
                <label class="text-[15px] text-heading font-semibold  mr-2" for="fasalInput">Packaging Unit :</label>
                <div class="cashier-input-field-style flex-1 mr-2">
                    <div class="single-input-field w-full">
                        <input id="fasalInput" type="text" placeholder="Packaging Unit">
                    </div>
                </div>
            </div>


            <div class="col-span-12">
                <div class="cashier-managesale-top-btn default-light-theme ">
                    <button class="btn-primary ml-auto" type="submit" style="margin-bottom: 0;">Add Now</button>
                </div>
            </div>
        </div>


    </div>
</div> -->


<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Production Ready items</h4>
    <form action="ready-product-update" method="post">
        <div class="grid grid-cols-12 gap-x-5">
            <!-- auto fill -->
             <input type="hidden" name="id" value="<?php echo $data['production']->id?>">
            <div class="lg:col-span-2 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Tunnel</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" style="display: none;" name="tunnel"onchange="productionTunnel(this)" id="production-tunnel">
                            <option selected="selected" disabled="disabled">Select Supplier</option>
                            <?php if(!empty($data['tunnels'])):foreach($data['tunnels'] as $tunnel):?>
                            <option <?php if($data['production']->TunnelId==$tunnel->id){echo "selected";}?> value="<?php ShowVal($tunnel->id);?>"><?php echo ($tunnel->TName);?></option>
                            <?php endforeach; endif;?>
                        </select>
                        <?php validator('tunnel')?>
                    </div>
                </div>
            </div> 
            <!-- auto fill -->
            <div class="lg:col-span-2 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Product</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" readonly value="<?= productName_(productIdByCrop($data['production']->CropId));?>" placeholder=" Product" name="product" id="production-product">
                        </div>
                    </div>
                </div>
            </div>
            <!-- auto fill -->
            <div class="lg:col-span-2 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Unit</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" style="display: none;" name="units">
                            <option selected="selected" disabled="disabled">Select Unit</option>
                            <?php if(!empty($data['units'])):foreach($data['units'] as $unit):?>
                            <option <?php if($data['production']->UnitId==$unit->id){echo "selected";}?> value="<?php ShowVal($unit->id);?>"><?php echo ($unit->Name);?></option>
                            <?php endforeach; endif;?>
                        </select>
                        <?php validator('units')?>
                    </div>
                </div>
            </div>
            <!-- auto fill -->
            <div class="lg:col-span-2 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Quantity</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" min="0" placeholder="Quantity" name="quantity" value="<?php echo $data['production']->Quantity?>">
                            <?php validator('quantity')?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- auto fill -->
            <div class="lg:col-span-2 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Quality</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" style="display: none;" name="quality">
                            <option selected="selected" disabled="disabled">Select Quality</option>
                            <?php if(!empty($data['quality'])):foreach($data['quality'] as $quality):?>
                            <option <?php if($data['production']->GradeId==$quality->id){echo "selected";}?> value="<?php ShowVal($quality->id);?>"><?php echo ($quality->Name);?></option>
                            <?php endforeach; endif;?>
                        </select>
                        <?php validator('quality')?>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-2 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3"></h5>
                    <div class="cashier-select-field-style" style="margin-top:25px !important">
                        <div class="cashier-managesale-top-btn default-light-theme pt-2.5">
                            <button class="btn-primary" type="submit">Add Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg">
    <h4 class="text-[20px] font-bold text-heading">Daily Production List</h4>
    <div class="cashier-table-header-search-area">
        <div class="grid grid-cols-12 gap-x-5 pb-0.5">
            <div class="md:col-span-6 col-span-12">
            </div>
            <div class="md:col-span-6 col-span-12">
                <div class="cashier-table-header-search-action-btn text-right maxSm:text-left">
                    <button type="button" onClick="reports('dailyProductionReports');"><svg id="pdf-file" xmlns="http://www.w3.org/2000/svg"
                            width="19.027" height="19.72" viewBox="0 0 19.027 19.72">
                            <path id="Path_188" data-name="Path 188"
                                d="M82.8,209H81.578a.578.578,0,0,0-.578.58l.009,4.389a.578.578,0,1,0,1.155,0v-1.333l.636,0a1.817,1.817,0,1,0,0-3.634Zm0,2.478-.639,0c0-.246,0-.511,0-.664,0-.131,0-.4,0-.661H82.8a.662.662,0,1,1,0,1.323Z"
                                transform="translate(-78.227 -200.95)" fill="#ff9720"></path>
                            <path id="Path_189" data-name="Path 189"
                                d="M210.784,209h-1.207a.578.578,0,0,0-.578.579s.009,4.246.009,4.262a.578.578,0,0,0,.578.576h0c.036,0,.9,0,1.241-.009a2.449,2.449,0,0,0,2.253-2.7C213.083,210.088,212.159,209,210.784,209Zm.025,4.251c-.15,0-.407,0-.647.006,0-.5,0-2.581-.006-3.1h.628c1.06,0,1.143,1.188,1.143,1.553C211.927,212.467,211.582,213.238,210.81,213.251Z"
                                transform="translate(-201.297 -200.95)" fill="#ff9720"></path>
                            <path id="Path_190" data-name="Path 190"
                                d="M355.344,209a.578.578,0,1,0,0-1.155h-1.766a.578.578,0,0,0-.578.578v4.358a.578.578,0,0,0,1.155,0v-1.643H355.2a.578.578,0,1,0,0-1.155h-1.048V209Z"
                                transform="translate(-339.75 -199.837)" fill="#ff9720"></path>
                            <path id="Path_191" data-name="Path 191"
                                d="M26.294,5.585H25.87V5.42a2.877,2.877,0,0,0-.792-1.987L22.678.9a2.9,2.9,0,0,0-2.1-.9H12.89a1.735,1.735,0,0,0-1.733,1.733V5.585h-.424A1.735,1.735,0,0,0,9,7.318v6.933a1.735,1.735,0,0,0,1.733,1.733h.424v2A1.735,1.735,0,0,0,12.89,19.72H24.137a1.735,1.735,0,0,0,1.733-1.733v-2h.424a1.735,1.735,0,0,0,1.733-1.733V7.318A1.735,1.735,0,0,0,26.294,5.585ZM12.312,1.733a.578.578,0,0,1,.578-.578h7.691a1.74,1.74,0,0,1,1.258.541l2.4,2.531a1.726,1.726,0,0,1,.475,1.192v.165h-12.4Zm12.4,16.254a.578.578,0,0,1-.578.578H12.89a.578.578,0,0,1-.578-.578v-2h12.4Zm2.157-3.736a.578.578,0,0,1-.578.578H10.733a.578.578,0,0,1-.578-.578V7.318a.578.578,0,0,1,.578-.578h15.56a.578.578,0,0,1,.578.578Z"
                                transform="translate(-9 0)" fill="#ff9720"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
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
                <table id="user-list" class="table display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Tunnel</th>
                            <th>Crop/Fasal</th>
                            <th>Grade</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Production Date</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="3"></th>
                            <th >Total Qty</th>
                            <th id="total-net"></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
        </div>
    </div>
</div>

<?php $file="production.php";?>