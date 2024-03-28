<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
        <h4 class="text-[20px] font-bold text-heading mb-9"> Create Purchase</h4>
    <form action="create-purchase" method="POST">
    <div class="grid grid-cols-12 gap-x-5">
        <div class="lg:col-span-2 md:col-span-6 col-span-12 ">
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
        <div class="lg:col-span-2 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Bill Number </h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" placeholder="bill number" name='bno'>
                        <?php validator('bno')?>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-2 md:col-span-6 col-span-12">
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
    </div>


        <div class="grid grid-cols-12 gap-x-5"  style="align-items: center;">
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



            <div class="lg:col-span-4 md:col-span-6 col-span-12" id="addQty">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Quantity</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" min="0" oninput="calculateTotal()" placeholder="Quantity" name="qty[]">
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
                        <input type="number" oninput="calculateTotal()" min="0" placeholder="Rate" name="rate[]">
                        <?php validator('rate[]')?>
                    </div>
                </div>
            </div>
        </div>

                <div id="clickableDiv" style="margin-top: 8px;cursor:pointer;" class=" h-10 w-10 leading-[38px] border border-grayBorder border-solid text-center inline-block rounded-[3px] text-bodyText short">
                    <i class="fal fa-plus"></i>
                </div>



                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var clickableDiv = document.getElementById("clickableDiv");

                            clickableDiv.addEventListener("click", function() {
                                addproduct=$("#addproduct").html();
                                var productdiv = document.createElement("div");
                                productdiv.className = "lg:col-span-4 md:col-span-6 col-span-12";
                                productdiv.innerHTML = addproduct;




                                var quantitydiv = document.createElement("div");
                                addQty=$("#addQty").html();
                                quantitydiv.className = "lg:col-span-4 md:col-span-6 col-span-12";

                                quantitydiv.innerHTML = addQty;
                                var ratediv = document.createElement("div");
                                addRate=$("#addRate").html();
                                ratediv.className = "lg:col-span-3 md:col-span-6 col-span-12";

                                ratediv.innerHTML = addRate;

                                var deleteButton = document.createElement("div");
                                deleteButton.className = "h-10 w-10 leading-[38px] border border-grayBorder border-solid text-center inline-block rounded-[3px] text-bodyText short";
                                deleteButton.style = "margin-top: 8px;cursor:pointer;";
                                deleteButton.innerHTML = `<i class="fa-light fa-xmark"></i>`;

                                deleteButton.addEventListener("click", function() {
                                    productdiv.remove();
                                    quantitydiv.remove();
                                    ratediv.remove();
                                    deleteButton.remove();

                                });

                                clickableDiv.parentNode.insertBefore(productdiv, clickableDiv.nextSibling);
                                clickableDiv.parentNode.insertBefore(quantitydiv, productdiv.nextSibling);
                                clickableDiv.parentNode.insertBefore(ratediv, quantitydiv.nextSibling);
                                clickableDiv.parentNode.insertBefore(deleteButton, ratediv.nextSibling);
                            });
                        });
                    //     document.addEventListener("DOMContentLoaded", function() {
                    //     var clickableDiv = document.getElementById("clickableDiv");

                    //     clickableDiv.addEventListener("click", function() {
                    //         // Get quantity and rate values
                    //         var qtyValue = document.querySelector("input[name='qty[]']").value;
                    //         var rateValue = document.querySelector("input[name='rate[]']").value;

                    //         // Calculate total amount
                    //         var totalAmount = parseInt(qtyValue) * parseInt(rateValue);

                    //         // Display total amount in console
                    //         alert(totalAmount);
                    //         console.log("Total Amount:", totalAmount);
                    //     });
                    // });
                    function calculateTotal(){
                        var qtyInputs = document.querySelectorAll("input[name='qty[]']");
                        var rateInputs = document.querySelectorAll("input[name='rate[]']");
                        
                        var totalAmount = 0;
                        
                        for (var i = 0; i < qtyInputs.length; i++) {
                            var qtyValue = parseInt(qtyInputs[i].value);
                            var rateValue = parseInt(rateInputs[i].value);
                            
                            if (!isNaN(qtyValue) && !isNaN(rateValue)) {
                                totalAmount += qtyValue * rateValue;
                            }
                        }
                        var transport=parseFloat($("#transportation").val());
                        var total_=totalAmount+transport
                        $("#grand-total").val(total_);
                    }

                    </script>


                    <div class="lg:col-span-4 md:col-span-6 col-span-12">
                        <div class="cashier-select-field mb-5">
                            <h5 class="text-[15px] text-heading font-semibold mb-3">Transport Charges</h5>
                            <div class="cashier-input-field-style">
                                <div class="single-input-field w-full">
                                    <input oninput="calculateTotal()" id="transportation" type="number" min="0" placeholder="Charges" value="0"  name='charges'>
                                    <?php validator('rate[]')?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-4 md:col-span-6 col-span-12">
                        <div class="cashier-select-field mb-5">
                            <h5 class="text-[15px] text-heading font-semibold mb-3">Grand Total </h5>
                            <div class="cashier-input-field-style">
                                <div class="single-input-field w-full">
                                    <input id="grand-total" type="number" min="0" placeholder="Grand Total"  name='gt'>
                                    <?php validator('gt')?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-4 md:col-span-6 col-span-12">
                        <div class="cashier-select-field mb-5">
                            <h5 class="text-[15px] text-heading font-semibold mb-3">Paid  Amount </h5>
                            <div class="cashier-input-field-style">
                                <div class="single-input-field w-full">
                                    <input type="number" min="0" placeholder="Paid Amount"  name='pa'>
                                    <?php validator('pa')?>
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
