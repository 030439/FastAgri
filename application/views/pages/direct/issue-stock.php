<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9" style="text-align:center">Direct Issue Stock</h4>
    <form action="direct-issue-product" method="post">
        <div class="grid grid-cols-12 gap-x-5">
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3"> Party name</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" name="person">
                            <option selected="" disabled="" value="default">Party  name</option>
                            <?php 
                                if(!empty($data['employees'])):
                                foreach($data['employees'] as $e):    
                            ?> 
                            <option value="<?php echo $e->id?>"><?=$e->Name;?></option>
                            <?php endforeach; endif;?>
                        </select>
                        <?php validator('person')?>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Date</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="date" name="issueDate"  value="<?php echo set_value('issueDate'); ?>"  id="issue--val">
                            <?php validator('issueDate')?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Product</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" name="product"  id="issue-stock-product-with-price">
                            <option selected="" disabled="" value="default">Product</option>
                            <?php 
                            
                                if(!empty($data['products'])):
                                    
                                foreach($data['products'] as $p):    
                            ?> 
                            <option value="<?php echo $p->id?>"><?=$p->Name;?></option>
                            <?php endforeach; endif;?>
                        </select>
                        <?php validator('product')?>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Avaiable Stock Rate</h5>
                    <div class="cashier-select-field-style">
                        <select   id="avaiable-stock-rates" name="pqid">
                        </select>
                        <p id="issue-stock-product-qty" title=""></p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Quantity</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" name="qty" onkeyup="checkQty(this)"  value="<?php echo set_value('qty'); ?>" >
                            <p id="issue-stock-qty-" class="text-danger"></p>
                            <?php validator('qty')?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12">
                <div class="cashier-managesale-top-btn default-light-theme pt-2.5">
                    <button class="btn-primary" id="issue-stock-btn" type="submit">Add Now</button>
                </div>
            </div>
        </div>
    </form>
</div>