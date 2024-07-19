<div class="cashier-content-area mt-[30px] px-7">
    <div class="cashier-managesale-area bg-white p-7 pt-5 custom-shadow rounded-lg mb-5">
       <div style="display:flex;margin-bottom:5px;">
            <div class="cashier-managesale-top-btn default-light-theme">
                <button class="" onclick="document.location='payroll'">
                    <i class="fa-light fa-plus"></i>  Pays List
                </button>
            </div>
            <h4 class="text-[20px] font-bold text-heading" style="width:60%; text-align:center;">Generate Pays List</h4>
        </div>
        <style>
            .cashier-salereturns-table-dateB {
                width: 10%;
                min-width: 13px;
            }
            input{
                width: 80%;
            }
        </style>
        <div class="cashier-salereturns-table-area">
            <div class="cashier-salereturns-table-innerC">
            <form action="generate-pays" method="post">
                <label>Select Date</label>
            <input type="month" id="myMonth" required name="date_"style="width:100px; height:20px; border:1px solid">

                <div
                    class="cashier-salereturns-table-inner-wrapperC border border-solid border-grayBorder border-b-0 mb-7">
                    <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                        
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Name</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Designation</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Basic Salary</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Medical </h5>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Allowance</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Loan</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Installment</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Addition</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Deduction</h5>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                            <h5>Net Sallary</h5>
                        </div>
                    </div>
                        
                    <?php if(!empty($data)): foreach($data['records'] as $c=> $d):?>

                    <div class="cashier-salereturns-table-list flex border-b border-solid border-grayBorder h-12">
                       
                        <div class="cashier-salereturns-table-dateB">
                            <input type="hidden" name="employee_id[]" value="<?php echo $d->eid?>">
                        <span><?php ShowVal($d->Name);?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                        <span><?php ShowVal($d->designation);?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                        <span><?php ShowVal($d->BasicSalary);?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                        <span><?php ShowVal($d->Medical);?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                        <span><?php ShowVal($d->Allowances);?></span>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                        <span><?php ShowVal($d->loan);?></span>
                        <input type="hidden" name="total[]" id="total-<?php echo $c; ?>" value="<?php  $total= $d->BasicSalary+$d->Medical+$d->Allowances; echo $total;?>">
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                        <span><input type="number" id="installment-<?php echo $c; ?>" min="0" class="net-sallary-by-installment" title="<?php echo $c;?>" name="installment[]" value="<?php $insta= $d->loan>0?$d->installment:0; echo $insta;?>"></span>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                        <span><input type="number" class="net-sallary-by-installment" min="0" id="additon-<?php echo $c; ?>" title="<?php echo $c;?>"  value="0" name="additon[]"></span>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                        <span><input type="number" class="net-sallary-by-installment" min="0" id="deduction-<?php echo $c; ?>" title="<?php echo $c;?>"  value="0" name="deduction[]"></span>
                        </div>
                        <div class="cashier-salereturns-table-dateB">
                        <span><input type="number" min="0" id="net-<?php echo $c?>" readonly  name="net[]" value="<?php ShowVal($total-$insta);?>"></span>
                        </div>
                       
                    </div>
                    <?php endforeach;endif;?>
                    <div class="col-span-12">
                        <div class="cashier-managesale-top-btn default-light-theme pt-2.5" style="float:right;">
                            <button class="btn-primary" type="submit" style="margin-bottom:20px;">Add Now</button>
                        </div>
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>