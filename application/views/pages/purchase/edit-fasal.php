
<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <style>
        button:hover{
            background-color:#ffc403 !important;
            color:green;
        }
    </style>
    <div style="display:flex">
        <div style="width:40%;margin-top:-5px;margin-left:-20px;padding:1px !important;height:10px" class="cashier-managesale-top-btn default-light-theme mb-7">
            <button style="background:none"  class="" onclick="document.location='purchased/seed-list'">
            <i style="background:none"class="far fa-arrow-left inline-block"></i> 
            </button>
           
        </div>
        <h4 style="border-bottom:5px solid #ffc403" class="text-[20px] font-bold text-heading mb-9" style="">Update Seed Purchase</h4>
    </div>
    <form action="update-seed-purchase" method="POST">
        <input type="hidden" name="id" value="<?php echo $data['purchase']['id']?>">
    <div class="grid grid-cols-12 gap-x-5">
    <div class="lg:col-span-4 md:col-span-6 col-span-12" id="addproduct">
            <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Seed</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" style="display: none;" name="product[]">
                        <option selected="selected" disabled="disabled">Select Product</option>
                            <?php if(!empty($data['products'])):foreach($data['products'] as $product):?>
                            <option <?php if($data['purchase']['product_id']==$product->pid){echo "selected";}?> value="<?php ShowVal($product->pid);?>"><?php ShowVal($product->FasalName);?></option>
                            <?php endforeach; endif;?>
                        </select>
                        <?php validator('product[]')?>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12" id="addQty">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Quality</h5>
                    
                    <div class="cashier-select-field-style">
                        <select class="block"  name="quality">
                        <option selected="selected" disabled="disabled">Select Quality</option>
                            <option <?php if($data['purchase']['quality']==1){echo "selected";}?> value="1">A</option>
                            <option <?php if($data['purchase']['quality']==2){echo "selected";}?> value="2">B</option>
                        </select>
                        <?php validator('quality')?>
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
                        <option <?php if($data['purchase']['Supplier_id']==$supplier->id){echo "selected";}?> value="<?php ShowVal($supplier->id);?>"><?php ShowVal($supplier->Name);?></option>
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
                            <input type="number" min="0" required value="<?php echo $data['purchase']['quantity']; ?>"  name="qty[]">
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
                        <input type="number" required min="0"  value="<?php echo $data['purchase']['rate']; ?>"  name="rate[]">
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
                        <input type="date" required value="<?php echo $data['purchase']['Date']; ?>"  name='pdate'>
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
                        <input required type="number" min="0"  value="<?php echo $data['purchase']['expenses']; ?>"   name='charges'>
                        <?php validator('charges')?>
                    </div>
                </div>
            </div>
        </div>

            <div class="col-span-12">
                <div class="cashier-managesale-top-btn default-light-theme pt-2.5">
                    <button class="btn-primary" type="submit">Update Purchase</button>
                </div>
            </div>
        </div>
    <form>
</div>
