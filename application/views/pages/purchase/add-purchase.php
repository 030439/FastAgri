<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
        <h4 class="text-[20px] font-bold text-heading mb-9">select Supplier</h4>
    <div class="grid grid-cols-12 gap-x-5">
        <div class="lg:col-span-2 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Supplier</h5>
                <div class="cashier-select-field-style">
                    <select class="block" style="display: none;">
                        <option selected="" disabled="" value="default">Select Supplier</option>
                        <option value="language-1">Jonathan Deo</option>
                        <option value="language-2">Andrew Tye</option>
                        <option value="language-3">Peter Parkar</option>
                    </select>
                    <div class="nice-select block" tabindex="0"><span class="current">Select Supplier</span>
                        <ul class="list">
                            <li data-value="default" class="option selected disabled focus">Select Supplier</li>
                            <li data-value="language-1" class="option">Jonathan Deo</li>
                            <li data-value="language-2" class="option">Andrew Tye</li>
                            <li data-value="language-3" class="option">Peter Parkar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="lg:col-span-2 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Select Date</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="date" placeholder="date">
                    </div>
                </div>
            </div>
        </div>


    </div>


             <h4 class="text-[20px] font-bold text-heading mb-9">Add Purchase</h4>
        <div class="grid grid-cols-12 gap-x-5"  style="align-items: center;">
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Product</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" style="display: none;">
                            <option selected="" disabled="" value="default">Product</option>
                            <option value="language-1">Jonathan Deo</option>
                            <option value="language-2">Andrew Tye</option>
                            <option value="language-3">Peter Parkar</option>
                        </select>
                        <div class="nice-select block" tabindex="0"><span class="current">Product</span>
                            <ul class="list">
                                <li data-value="default" class="option selected disabled focus">Product</li>
                                <li data-value="language-1" class="option">Jonathan Deo</li>
                                <li data-value="language-2" class="option">Andrew Tye</li>
                                <li data-value="language-3" class="option">Peter Parkar</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>



            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Quantity</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder="Quantity">
                        </div>
                    </div>
                </div>
            </div>


            <div class="lg:col-span-3 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Rate</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" placeholder="Rate">
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
                                var productdiv = document.createElement("div");
                                productdiv.className = "lg:col-span-4 md:col-span-6 col-span-12";
                                productdiv.innerHTML = `<div class="cashier-select-field mb-5">
                            <h5 class="text-[15px] text-heading font-semibold mb-3">product</h5>
                            <div class="cashier-select-field-style">
                                <select class="block" style="display: none;">
                                    <option selected="" disabled="" value="default">Select product</option>
                                    <option value="language-1">Jonathan Deo</option>
                                    <option value="language-2">Andrew Tye</option>
                                    <option value="language-3">Peter Parkar</option>
                                </select>
                                <div class="nice-select block" tabindex="0"><span class="current">Select product</span>
                                    <ul class="list">
                                        <li data-value="default" class="option selected disabled focus">Select product</li>
                                        <li data-value="language-1" class="option">Jonathan Deo</li>
                                        <li data-value="language-2" class="option">Andrew Tye</li>
                                        <li data-value="language-3" class="option">Peter Parkar</li>
                                    </ul>
                                </div>
                            </div>
                        </div>`;




                                var quantitydiv = document.createElement("div");
                                quantitydiv.className = "lg:col-span-4 md:col-span-6 col-span-12";

                                quantitydiv.innerHTML = `<div class="cashier-select-field mb-5">
                            <h5 class="text-[15px] text-heading font-semibold mb-3">Quantity</h5>
                            <div class="cashier-input-field-style">
                                <div class="single-input-field w-full">
                                    <input type="text" placeholder="quantity" style=" padding: 3px;">
                                </div>
                            </div>
                        </div>`;
                                var ratediv = document.createElement("div");
                                ratediv.className = "lg:col-span-3 md:col-span-6 col-span-12";

                                ratediv.innerHTML = `<div class="cashier-select-field mb-5">
                            <h5 class="text-[15px] text-heading font-semibold mb-3">Rate</h5>
                            <div class="cashier-input-field-style">
                                <div class="single-input-field w-full">
                                    <input type="text" placeholder="Rate" style=" padding: 3px;">
                                </div>
                            </div>
                        </div>`;




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
                    </script>


            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                        <div class="cashier-select-field mb-5">
                            <h5 class="text-[15px] text-heading font-semibold mb-3">Transport Charges</h5>
                            <div class="cashier-input-field-style">
                                <div class="single-input-field w-full">
                                    <input type="text" placeholder="Charges">
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
</div>
