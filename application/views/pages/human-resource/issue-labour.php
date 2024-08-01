<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9">Issue Labour</h4>
    <form action="labour-issue" method="post">
        <div class="grid grid-cols-12 gap-x-5">
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3"> Date</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="date" name="ldate">
                            <?php validator('ldate')?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Select Jamadar</h5>
                    <div class="cashier-select-field-style">
                        <select class="block" style="display: none;" name='jamandar'>
                            <option selected="" disabled="" value="default">Select Jamadar</option>
                            <?php if($data['jamandars']): foreach($data['jamandars'] as $jaamandar):?>
                                <option value="<?= $jaamandar->id;?>"><?php echo $jaamandar->name;?></option>
                            <?php endforeach; endif;?>
                        </select>
                        <?php validator('jamandar')?>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3">Select Tunnel </h5>
                    <div class="cashier-select-field-style">
                        <select class="block" style="display: none;" name="tunnel">
                            <option selected="" disabled="" value="default">Select Tunnel</option>
                            <?php if($data['tunnels']): foreach($data['tunnels'] as $tunnel):?>
                                <option value="<?= $tunnel->id;?>"><?php echo $tunnel->TName;?></option>
                            <?php endforeach; endif;?>
                        </select>
                        <?php validator('tunnel')?>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3"> Enter no of labour</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" name="labour" min="1" onkeyup="getTotalAmountForLabour(this)" placeholder="  Enter no of labour">
                            <?php validator('labour')?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3"> Total Amount</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" id="issue-labour-total-amount" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="cashier-select-field mb-5">
                    <h5 class="text-[15px] text-heading font-semibold mb-3"> Deduction</h5>
                    <div class="cashier-input-field-style">
                        <div class="single-input-field w-full">
                            <input type="number" name="deduction" min="1" placeholder="  Enter deduction">
                            <?php validator('deduction')?>
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