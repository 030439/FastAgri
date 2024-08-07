
<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <style>
        button:hover{
            background-color:#ffc403 !important;
            color:green;
        }
    </style>
    <div style="display:flex">
        <div style="width:40%;margin-top:-5px;margin-left:-20px;padding:1px !important;height:10px" class="cashier-managesale-top-btn default-light-theme mb-7">
            <button style="background:none"  class="" onclick="document.location='asset/list'">
            <i style="background:none"class="far fa-arrow-left inline-block"></i> 
            </button>
           
        </div>
        <h4 style="border-bottom:5px solid #ffc403" class="text-[20px] font-bold text-heading mb-9" style="">Add Asset</h4>
    </div>
    <form action="asset/save" method="post">
    <div class="grid grid-cols-12 gap-x-5" style="align-items: center;">
        <div class="lg:col-span-6 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3"> Asset Name</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="text" placeholder="" name="name">
                        <?php validator('name')?>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-6 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Asset Cost</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="number" min='0' placeholder="" name="area">
                        <?php validator('area')?>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 md:col-span-6 col-span-12" id="shareh">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">ShareHolders</h5>
                <div class="cashier-select-field-style">
                    <select class="block" style="display: none;" name="shareholder[]">
                        <option selected="selected" disabled="disabled">Select shareholders</option>
                        <?php if(!empty($data['shareholders'])):foreach($data['shareholders'] as $supplier):?>
                        <option value="<?php ShowVal($supplier->id);?>"><?php ShowVal($supplier->Name);?></option>
                        <?php endforeach; endif;?>
                    </select>
                    <?php validator('shareholder[]')?>
                </div>
            </div>
        </div>




        <div class="lg:col-span-4 md:col-span-6 col-span-12" id="shareD">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Shares</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                        <input type="number" min="0" placeholder="" name="shares[]">
                        <?php validator('shares[]')?>
                    </div>
                </div>
            </div>
        </div>

       

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
                var shareh=$("#shareh").html();
                var shareholdersDiv = document.createElement("div");
                shareholdersDiv.className = "lg:col-span-4 md:col-span-6 col-span-12";
                shareholdersDiv.innerHTML = shareh;
               var shareD=$('#shareD').html();
                var sharesDiv = document.createElement("div");
                sharesDiv.className = "lg:col-span-4 md:col-span-6 col-span-12";
                sharesDiv.innerHTML = shareD;

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
    </form>
</div>