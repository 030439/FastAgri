<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Issue Stock</h4>
    <div class="grid grid-cols-12 gap-x-5">








        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Tunnel Name</h5>
                <div class="cashier-select-field-style">
                    <select class="block" style="display: none;">
                        <option selected="" disabled="" value="default">Tunnel Name</option>
                        <?php 
                            if(!empty($data['tunnels'])):
                            foreach($data['tunnels'] as $t):    
                        ?> 
                        <option value="<?php echo $t->id?>"><?=$t->TName;?></option>
                        <?php endforeach; endif;?>
                    </select>
                </div>
            </div>
        </div>
        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Product</h5>
                <div class="cashier-select-field-style">
                    <select class="block" style="display: none;" id="issue-stock-product">
                        <option selected="" disabled="" value="default">Product</option>
                        <?php 
                            if(!empty($data['products'])):
                            foreach($data['products'] as $p):    
                        ?> 
                        <option value="<?php echo $p->id?>"><?=$p->Name;?></option>
                        <?php endforeach; endif;?>
                    </select>
                    <p id="issue-stock-product-qty"></p>
                </div>
            </div>
        </div>


        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Quantity</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" placeholder="Quantity" id="issue-quantity-val">
                        <p id="issue-stock-qty"></p>
                    </div>
                </div>
            </div>
        </div>



        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">issued person name</h5>
                <div class="cashier-select-field-style">
                    <select class="block" style="display: none;">
                        <option selected="" disabled="" value="default">issued person name</option>
                        <?php 
                            if(!empty($data['employees'])):
                            foreach($data['employees'] as $e):    
                        ?> 
                        <option value="<?php echo $e->id?>"><?=$e->Name;?></option>
                        <?php endforeach; endif;?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-span-12">
            <div class="cashier-managesale-top-btn default-light-theme pt-2.5">
                <button class="btn-primary" type="submit">Add Now</button>
            </div>
        </div>
    </div>
</div>