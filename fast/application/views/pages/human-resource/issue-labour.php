<div class="cashier-addsupplier-area bg-white p-7 custom-shadow rounded-lg pt-5 mb-5">
    <h4 class="text-[20px] font-bold text-heading mb-9" style="text-align:center">Issue Labour</h4>
    <form action="labour-issue" method="post">
        <div class="grid grid-cols-12 gap-x-5">
            <div class="lg:col-span-6 md:col-span-6 col-span-12">
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
            <div class="lg:col-span-6 md:col-span-6 col-span-12">
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
            <div id="form-wrapper">
    <div class="grid grid-cols-12 gap-4 form-section" style="width:1150px">
        <div class="lg:col-span-3 md:col-span-6 col-span-12">
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Select Tunnel</h5>
                <div class="cashier-select-field-style">
                    <select class="block w-full" name="tunnel[]">
                        <option selected="" disabled="" value="default">Select Tunnel</option>
                        <?php if($data['tunnels']): foreach($data['tunnels'] as $tunnel):?>
                            <option value="<?= $tunnel->id;?>"><?php echo $tunnel->TName;?></option>
                        <?php endforeach; endif;?>
                    </select>
                    <?php validator('tunnel')?>
                </div>
            </div>
        </div>
        <div class="lg:col-span-3 md:col-span-6 col-span-12" style="margin: 0px 5px" >
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Enter no of labour</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                    <input type="number" name="labour[]" id="labour-1" min="1" onkeyup="getTotalAmountForLabours(this)">
                        <?php validator('labour')?>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-3 md:col-span-6 col-span-12" style="margin: 0px 5px" >
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Total Amount</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                    <input type="number" id="issue-1" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-3 md:col-span-6 col-span-12" style="margin: 0px 5px" >
            <div class="cashier-select-field mb-5">
                <h5 class="text-[15px] text-heading font-semibold mb-3">Deduction</h5>
                <div class="cashier-input-field-style">
                    <div class="single-input-field w-full">
                    <input type="number" name="deduction[]" id="deduction-1" min="0" value="0" placeholder="Enter deduction">
                        <?php validator('deduction')?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Plus button -->
       
    </div>
</div>


<!-- Add JavaScript to handle cloning of form sections -->
<script>
let formCount = 1;

function addNewRecord() {
    // Increment the form count
    formCount++;

    // Clone the form section
    const formSection = document.querySelector('.form-section');
    const newSection = formSection.cloneNode(true);

    // Clear the input fields and select options in the cloned section
    const inputs = newSection.querySelectorAll('input');
    inputs.forEach(input => {
        if (input.type !== 'hidden') {
            input.value = ''; // Clear input values
        }
    });

    const selects = newSection.querySelectorAll('select');
    selects.forEach(select => {
        select.selectedIndex = 0; // Reset select options to default
    });

    // Update IDs in the cloned section
    newSection.querySelectorAll('input').forEach(input => {
        const oldId = input.id;
        input.id = oldId.split('-')[0] + '-' + formCount;
    });

    newSection.querySelectorAll('select').forEach(select => {
        const oldId = select.id;
        select.id = oldId.split('-')[0] + '-' + formCount;
    });

    // Attach the onkeyup event listener to the newly cloned input fields
    const newLabourInputs = newSection.querySelectorAll('input[name="labour[]"]');
    newLabourInputs.forEach(input => {
        input.addEventListener('keyup', function() {
            getTotalAmountForLabours(this);
        });
    });

    // Append the new section after the last form section
    document.getElementById('form-wrapper').appendChild(newSection);
}


</script>

            <div class="col-span-12">
            <div class="lg:col-span-1 md:col-span-6 col-span-12  flex items-center" >
            <button type="button" class="btn btn-primary" style="height:30px;background-color: rgb(119 221 85); width:100px" onclick="addNewRecord()">+</button>
        </div>
                <div class="cashier-managesale-top-btn default-light-theme pt-2.5">
                    <button class="btn-primary" type="submit">Add Now</button>
                </div>
            </div>
        </div>
    </form>
</div>