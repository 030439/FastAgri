<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Add Tunnels</h4>
    <div class="grid grid-cols-12 gap-x-5" style="align-items: center;">
        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3"> Name</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" placeholder="Name">
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Covered Area</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" placeholder="1 acre">
                    </div>
                </div>
            </div>
        </div>




        <div class="lg:col-span-4 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Fasal</h5>
                <div class="cashier-select-field-style">
                    <select class="block" style="display: none;">
                        <option selected="" disabled="" value="default">Fasal</option>
                        <option value="language-1">Jonathan Deo</option>
                        <option value="language-2">Andrew Tye</option>
                        <option value="language-3">Peter Parkar</option>
                    </select>
                    <div class="nice-select block" tabindex="0"><span class="current">Fasal</span>
                        <ul class="list">
                            <li data-value="default" class="option selected disabled focus">Fasal</li>
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
                <h5 class="text-[15px] text-heading font-semibold mb-3">ShareHolders</h5>
                <div class="cashier-select-field-style">
                    <select class="block" style="display: none;">
                        <option selected="" disabled="" value="default">ShareHolders</option>
                        <option value="language-1">Jonathan Deo</option>
                        <option value="language-2">Andrew Tye</option>
                        <option value="language-3">Peter Parkar</option>
                    </select>
                    <div class="nice-select block" tabindex="0"><span class="current">ShareHolders</span>
                        <ul class="list">
                            <li data-value="default" class="option selected disabled focus">SeShareHolders</li>
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
                <h5 class="text-[15px] text-heading font-semibold mb-3">Shares</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" placeholder="shares">
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="cashier-header-shortmenu pr-5 maxSm:pr-4 items-center flex flex-col justify-center custom-height-70"
            style="padding: 13px 0 0 0; cursor:pointer;">
            <div
                class=" h-10 w-10 leading-[38px] border border-grayBorder border-solid text-center inline-block rounded-[3px] text-bodyText short">
                <i class="fal fa-plus"></i>
            </div>
        </div> -->

        <!-- HTML -->
        <div class="cashier-header-shortmenu pr-5 maxSm:pr-4 items-center flex flex-col justify-center custom-height-70"
            style="padding: 13px 0 0 0; cursor:pointer;" id="clickableDiv">
            <div
                class=" h-10 w-10 leading-[38px] border border-grayBorder border-solid text-center inline-block rounded-[3px] text-bodyText short">
                <i class="fal fa-plus"></i>
            </div>
        </div>

        <script>
        document.addEventListener("DOMContentLoaded", function() {
            var clickableDiv = document.getElementById("clickableDiv");

            clickableDiv.addEventListener("click", function() {

                var shareholdersDiv = document.createElement("div");
                shareholdersDiv.className = "lg:col-span-4 md:col-span-6 col-span-12";
                shareholdersDiv.innerHTML = `
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">ShareHolders</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" style="display: none;">
                            <option selected="" disabled="" value="default">ShareHolders</option>
                            <option value="language-1">Jonathan Deo</option>
                            <option value="language-2">Andrew Tye</option>
                            <option value="language-3">Peter Parkar</option>
                        </select>
                        <div class="nice-select block" tabindex="0">
                            <span class="current">ShareHolders</span>
                            <ul class="list">
                                <li data-value="default" class="option selected disabled focus">ShareHolders</li>
                                <li data-value="language-1" class="option">Jonathan Deo</li>
                                <li data-value="language-2" class="option">Andrew Tye</li>
                                <li data-value="language-3" class="option">Peter Parkar</li>
                            </ul>
                        </div>
                    </div>
                </div>
            `;

                var sharesDiv = document.createElement("div");
                sharesDiv.className = "lg:col-span-4 md:col-span-6 col-span-12";
                sharesDiv.innerHTML = `
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Shares</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" placeholder="shares">
                        </div>
                    </div>
                </div>
            `;

                var deleteButton = document.createElement("div");
                deleteButton.className =
                    "cashier-header-shortmenu pr-5 maxSm:pr-4 items-center flex flex-col justify-center custom-height-70";
                deleteButton.style = "padding: 13px 0 0 0; cursor:pointer;";
                deleteButton.innerHTML = `<div
                class=" h-10 w-10 leading-[38px] border border-grayBorder border-solid text-center inline-block rounded-[3px] text-bodyText short">
                <i class="fa-light fa-xmark"></i>
            </div>`;

                deleteButton.addEventListener("click", function() {
                    shareholdersDiv.remove();
                    sharesDiv.remove();
                    deleteButton.remove();
                });

                clickableDiv.parentNode.insertBefore(sharesDiv, clickableDiv
                    .nextSibling);
                clickableDiv.parentNode.insertBefore(shareholdersDiv, clickableDiv.nextSibling);
                clickableDiv.parentNode.insertBefore(deleteButton, sharesDiv.nextSibling);
            });
        });
        </script>









        <div class="col-span-12">
            <div class="cashier-managesale-top-btn default-light-theme pt-2.5">
                <button class="btn-primary" type="submit">Add Now</button>
            </div>
        </div>
    </div>
</div>