<form action="update-load-for-sell" method="post">
    <div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
        <input type="hidden" name="sid" value="<?php echo $data['sell'][0]['sid'];?>">
        <h4 class="text-[20px] font-bold text-heading mb-9">Update sale </h4>
        <div class="grid grid-cols-12 gap-x-5">
            <div class="lg:col-span-2 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Customer</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" style="display: none;" name="customer">
                            <option selected="" disabled="" value="default">Select Customer</option>
                            <?php
                            if($data['customers']):foreach($data['customers'] as $customer):
                            ?>
                            <option <?php if($data['sell'][0]['customer']== $customer->Name){echo "selected";}?> value="<?php echo $customer->id?>"><?php echo $customer->Name?> </option>
                            <?php endforeach; endif;?>
                        </select>
                        <?php validator('customer');?>
                    </div>
                </div>
            </div>


            <div class="lg:col-span-2 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Select Date</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="date"  value="<?php echo $data['sell'][0]['selldate']; ?>"  name="rdate">
                            <?php validator('rdate')?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-2 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Driver Name </h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text"  value="<?php echo  $data['sell'][0]['driver'];  ?>"  name="driver">
                            <?php validator('driver')?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-2 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Driver Number</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" value="<?php echo $data['sell'][0]['dno']; ?>"  name="dnumber">
                            <?php validator('dnumber');?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-2 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Vehicle No</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number"  value="<?php echo $data['sell'][0]['vno'];  ?>"  name="vno">
                            <?php validator('vno')?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
<hr>
<br/>
        <div class="grid grid-cols-12 gap-x-5" style="align-items: center;">
            <?php foreach($data['sell'] as $sell) :?>
            <div class="lg:col-span-3 md:col-span-6 col-span-12" id="tunnelDiv">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Tunnel</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" name="tunnels[]" required style="display: none;" title="0" id="tunnelSelect-0" onchange="readySell(this)">
                            <option selected disabled>Select Tunnel </option>
                            <?php
                            if($data['tunnels']):foreach($data['tunnels'] as $tunnel):
                            ?>
                            <option <?php if($sell['tid']==$tunnel->id){echo "selected";}?> value="<?php echo $tunnel->id?>"><?php echo $tunnel->TName?> </option>
                            <?php endforeach; endif;?>
                        </select>
                        <?php validator('tunnels[]')?>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-3 md:col-span-6 col-span-12" id="productDiv">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Product</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="text" value="<?php echo $sell['pid']?>" name="" placeholder="bags"  title="0" id="productSelect-0" style="padding: 3px;">
                            <?php validator('bags[]')?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3 md:col-span-6 col-span-12" id="gradeDiv" >
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Grade</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" name="grades[]" onchange="sellGrade(this)" style="display: none;" title="0" id="gradeSelect-0">
                            <option selected="" disabled="" value="0">Select Grade </option>
                            <option <?php if($sell['grade']=="A"){echo "selected";}?> value="1">A</option>
                            <option  <?php if($sell['grade']=="B"){echo "selected";}?>value="2">B</option>
                        </select>
                        <?php validator('grades[]')?>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 md:col-span-6 col-span-12" id="bagDiv" >
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Bags</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" value="<?php echo $sell['Quantity'];?>" min="0"  name="bags[]" placeholder="bags" title="0" oninput="checkValue(this)" id="bagsInput-0" style=" padding: 3px;">
                            <span id="bagsInputres-0"> <?php validator('bags[]')?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
            <div id="clickableDiv" style="margin-top: 8px;cursor:pointer;" class=" h-10 w-10 leading-[38px] border border-grayBorder border-solid text-center inline-block rounded-[3px] text-bodyText short">
                <i class="fal fa-plus"></i>
            </div>

            <div class="col-span-12">
                <div class="cashier-managesale-top-btn default-light-theme pt-2.5">
                    <button class="btn-primary" type="submit">Update Now</button>
                </div>
            </div>
        </div>
    </div>
</form>
 <script>
    document.addEventListener("DOMContentLoaded", function () {
        var counter = 1;

        var clickableDiv = document.getElementById("clickableDiv");

        clickableDiv.addEventListener("click", function () {
            var tunnelDiv = document.getElementById("tunnelDiv").cloneNode(true);
            var productDiv = document.getElementById("productDiv").cloneNode(true);
            var gradeDiv = document.getElementById("gradeDiv").cloneNode(true);
            var bagsDiv = document.getElementById("bagDiv").cloneNode(true);

            // Update IDs for cloned elements
            tunnelDiv.querySelector("select").id = "tunnelSelect-" + counter;
            productDiv.querySelector("input").id = "productSelect-" + counter;
            gradeDiv.querySelector("select").id = "gradeSelect-" + counter;
            bagsDiv.querySelector("input").id = "bagsInput-" + counter;
            bagsDiv.querySelector("span").id="bagsInputres-"+counter;

            tunnelDiv.querySelector("select").title = counter;
            productDiv.querySelector("input").title = counter;
            gradeDiv.querySelector("select").title = counter;
            bagsDiv.querySelector("input").title = counter;

                // tunnelDiv.querySelector("select").selectedIndex=0;
                // tunnelDiv.querySelector("select").innerHTML="";
                // tunnelDiv.getElementsByClassName("list").selectedIndex=0;
                // productDiv.querySelector("input").value = "";
                // gradeDiv.querySelector("select").value = "default";
                // bagsDiv.querySelector("input").value = "";

            var deleteButton = document.createElement("div");
            deleteButton.className = "h-10 w-10 leading-[38px] border border-grayBorder border-solid text-center inline-block rounded-[3px] text-bodyText short";
            deleteButton.style = "margin-top: 8px;cursor:pointer;";
            deleteButton.innerHTML = `<i class="fa-light fa-xmark"></i>`;

            deleteButton.addEventListener("click", function () {
                tunnelDiv.remove();
                productDiv.remove();
                gradeDiv.remove();
                bagsDiv.remove();
                deleteButton.remove();
            });

            clickableDiv.parentNode.insertBefore(tunnelDiv, clickableDiv.nextSibling);
            clickableDiv.parentNode.insertBefore(productDiv, tunnelDiv.nextSibling);
            clickableDiv.parentNode.insertBefore(gradeDiv, productDiv.nextSibling);
            clickableDiv.parentNode.insertBefore(bagsDiv, gradeDiv.nextSibling);
            clickableDiv.parentNode.insertBefore(deleteButton, bagsDiv.nextSibling);

            counter++; // Increment the counter for next iteration
        });
    });
</script>