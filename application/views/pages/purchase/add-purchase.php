<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Add Purchase</h4>
    <form action="purchase/save" method="post">
    <div class="grid grid-cols-12 gap-x-5">



        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Supplier Name</h5>
                <div class="cashier-select-field-style">
                    <select class="block" style="display: none;">
                        <option selected="" disabled="" value="default">Supplier Name</option>
                        <option value="language-1">Jonathan Deo</option>
                        <option value="language-2">Andrew Tye</option>
                        <option value="language-3">Peter Parkar</option>
                    </select>
                    <div class="nice-select block" tabindex="0"><span class="current">Supplier Name</span>
                        <ul class="list">
                            <li data-value="default" class="option selected disabled focus">Supplier Name</li>
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



        <!-- editable rate  -->
        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Rate</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" placeholder="Rate">
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Transport Charges</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" placeholder="Transport Charges">
                    </div>
                </div>
            </div>
        </div>







        <div class="col-span-12">
            <div class="cashier-managesale-top-btn default-light-theme pt-2.5">
                <button class="btn-primary" type="submit">Add Now</button>
            </div>
        </div>
    </div>
    </form>
</div>