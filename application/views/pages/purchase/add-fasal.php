<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
        <h4 class="text-[20px] font-bold text-heading mb-9"> Create Purchase</h4>
    <form action="create-purchase" method="POST">
    <div class="grid grid-cols-12 gap-x-5">
    <div class="lg:col-span-4 md:col-span-6 col-span-12" id="addproduct">
            <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Product</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" style="display: none;" name="product[]">
                        <option selected="selected" disabled="disabled">Select Product</option>
                            <?php if(!empty($data['products'])):foreach($data['products'] as $product):?>
                            <option value="<?php ShowVal($product->id);?>"><?php ShowVal($product->Name);?></option>
                            <?php endforeach; endif;?>
                        </select>
                        <?php validator('product[]')?>
                    </div>
                </div>
            </div>
        <div class="lg:col-span-4 md:col-span-6 col-span-12 ">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Quality</h5>
                <div class="cashier-select-field-style">
                    <select class="block" style="display: none;" name="supplier">
                        <option selected="selected" disabled="disabled">Select Supplier</option>
                        <?php if(!empty($data['suppliers'])):foreach($data['suppliers'] as $supplier):?>
                        <option value="<?php ShowVal($supplier->id);?>"><?php ShowVal($supplier->Name);?></option>
                        <?php endforeach; endif;?>
                    </select>
                    <?php validator('supplier')?>
                </div>
            </div>
        </div>
        <div class="lg:col-span-4 md:col-span-6 col-span-12 ">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Supplier</h5>
                <div class="cashier-select-field-style">
                    <select class="block" style="display: none;" name="supplier">
                        <option selected="selected" disabled="disabled">Select Supplier</option>
                        <?php if(!empty($data['suppliers'])):foreach($data['suppliers'] as $supplier):?>
                        <option value="<?php ShowVal($supplier->id);?>"><?php ShowVal($supplier->Name);?></option>
                        <?php endforeach; endif;?>
                    </select>
                    <?php validator('supplier')?>
                </div>
            </div>
        </div>
    </div>


        <div class="grid grid-cols-12 gap-x-5"  style="align-items: center;">
            <div class="lg:col-span-3 md:col-span-6 col-span-12" id="addQty">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Quantity</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" min="0" placeholder="Quantity" name="qty[]">
                            <?php validator('qty[]')?>
                        </div>
                    </div>
                </div>
            </div>


        <div class="lg:col-span-3 md:col-span-6 col-span-12" id="addRate">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Rate</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="number" min="0" placeholder="Rate" name="rate[]">
                        <?php validator('rate[]')?>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-3 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Select Date</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="date" placeholder="date" name='pdate'>
                        <?php validator('pdate')?>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Transport Charges</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="number" min="0" placeholder="Charges"  name='charges'>
                        <?php validator('rate[]')?>
                    </div>
                </div>
            </div>
        </div>

            <div class="col-span-12">
                <div class="cashier-managesale-top-btn default-light-theme pt-2.5">
                    <button class="btn-primary" type="submit">Create Purchase</button>
                </div>
            </div>
        </div>
    <form>
</div>
