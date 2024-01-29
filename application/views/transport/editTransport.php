<?php
$this->load->helper('form');
$error = $this->session->flashdata('error');
if ($error) { 
    ?>
<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <i class="fa fa-check mx-2"></i>
    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
</div>
<?php } ?>
<?php
        $success = $this->session->flashdata('success');
        if ($success) {
        ?>
<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <i class="fa fa-check mx-2"></i>
    <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
</div>
<?php }?>
<div class="row">
    <div class="col-md-12">
        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
    </div>
</div>
<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12 col-lg-12  padding_left_right_null">
                <div class="card ">
                    <div class="card-header text-white card-content-title p-1">
                        <div class="row ">
                            <div class="col-md-6 col-10 text-white m-auto ">Edit Transport Details</div>
                            <div class="col-md-6 col-2 "> <a href="#" onclick="GoBackWithRefresh();return false;"class="btn text-white btn-success btn-bck float-right mobile-btn "><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                    <div class="card-body contents-body">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="updateTransport" action="<?php echo base_url() ?>updateTransport"
                            method="post" role="form">
                            <div class="row form-contents">
                                <div class="col-md-4 col-12">
                                    <label for="date"> Date </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text material-icons date-icon">date_range</span>
                                        </div>
                                        <input id="date" type="text" name="date"
                                            value="<?php echo date('d-m-Y',strtotime($transportInfo->date)); ?>"
                                            class="form-control datepicker date-col-4 required" placeholder="Enter Date"
                                            autocomplete="off" />
                                        <input type="hidden" value="<?php echo $transportInfo->row_id; ?>" name="row_id"
                                            id="row_id" />
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="invoice_number">Invoice Number</label>
                                        <input type="text" class="form-control required"
                                            value="<?php echo $transportInfo->invoice_number; ?>" id="invoice_number"
                                            name="invoice_number" placeholder="Invoice Number" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="vehicle_number">Vehicle Number</label>
                                        <select required name="vehicle_number"
                                            class="form-control required selectpicker" data-live-search="true">
                                            <option value="<?php echo $transportInfo->vehicle_number; ?>">Selected:
                                                <?php echo $transportInfo->vehicle_number; ?></option>
                                            <?php if(!empty($vehicles))
                                                        { foreach ($vehicles as $vehicle)
                                                            { ?>
                                            <option value="<?php echo $vehicle->vehicle_number ?>">
                                                <?php echo $vehicle->vehicle_number ?></option>
                                            <?php   } 
                                          } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="LR_no">LR Number </label>
                                        <input type="text" class="form-control "
                                            value="<?php echo $transportInfo->LR_no; ?>" id="LR_no" name="LR_no"
                                            placeholder="Enter LR Number" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="party_name">Party name</label>
                                        <select required name="party_rowid" id="party_rowid"
                                            class="form-control required selectpicker" data-live-search="true">
                                            <option value="<?php echo $transportInfo->party_rowid; ?>">Selected:
                                                <?php echo $transportInfo->party_name; ?></option>
                                            <?php if(!empty($party))
                                                        { foreach ($party as $p1)
                                                            { ?>
                                            <option value="<?php echo $p1->row_id ?>">
                                                <?php echo $p1->party_name ?></option>
                                            <?php   } 
                                          } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="destination">Destination </label>
                                        <input type="text" class="form-control "
                                            value="<?php echo $transportInfo->destination; ?>" id="destination"
                                            name="destination" placeholder="Enter Destination " autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="bags">Bags </label>
                                        <input type="text" class="form-control "
                                            value="<?php echo $transportInfo->bags; ?>" id="bags" name="bags"
                                            placeholder="Enter Bags" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="transporter_name">Select Transporter</label>
                                        <select required name="transporter_id" id="transporter_id"
                                            class="form-control required selectpicker" data-live-search="true">
                                            <option value=" <?php echo $transportInfo->transporter_rowid; ?>"> Selected: <?php echo $transportInfo->transporter_name; ?></option>
                                            <?php if(!empty($transporterInfo))
                                                        { foreach ($transporterInfo as $t)
                                                            { ?>
                                            <option value="<?php echo $t->row_id; ?>">
                                                <?php echo $t->transporter_name; ?>
                                            </option>
                                            <?php   } 
                                          } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4  col-12">
                                                        <div class="form-group">
                                                            <label for="vehicle_condition">Firm Name
                                                                </label>
                                                            <select class="form-control " id="firm_name"
                                                                name="firm_name">
                                                                <option
                                                                    value="<?php echo $transportInfo->firm_name; ?>">
                                                                    Selected:
                                                                    <?php echo  $transportInfo->firm_name; ?>
                                                                </option>
                                                                <option value="Karavali Transport"> Karavali Transport</option>
                                                                <option value="SK Logistics">SK Logistics</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="card">
                                        <div class="card-header card-contents-sub-title text-white">Amount Info</div>
                                        <div class="card-body card-contents-body">
                                            <div class="row">
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="mt">MT</label>
                                                        <input type="text" class="form-control required "
                                                            value="<?php echo $transportInfo->mt; ?>" id="mt" name="mt"
                                                            placeholder="Enter MT" oninput="amount_calculate('<?php echo $ponchClearedBankTotal; ?>','<?php echo $ponchClearedCashTotal; ?>');"
                                                            autocomplete="off" onkeypress="return isNumberKey(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="rate">Rate </label>
                                                        <input type="text" class="form-control required"
                                                            value="<?php echo $transportInfo->rate; ?>" id="rate"
                                                            name="rate" placeholder="Enter Rate"
                                                            oninput="amount_calculate('<?php echo $ponchClearedBankTotal; ?>','<?php echo $ponchClearedCashTotal; ?>');" autocomplete="off"
                                                            onkeypress="return isNumberKey(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="amount">Amount </label>
                                                        <input type="text" class="form-control required"
                                                            value="<?php echo $transportInfo->amount; ?>" id="amount"
                                                            name="amount" placeholder="Enter Amount" autocomplete="off"
                                                            onkeypress="return isNumberKey(event)" readOnly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="card">
                                        <div class="card-header card-contents-sub-title text-white">Diesel Info</div>
                                        <div class="card-body card-contents-body">
                                            <div class="row">
                                            <div class="col-md-4  col-12">
                                                    <div class="form-group">
                                                        <label for="diesel_pump">Diesel Pump</label>
                                                        <select class="form-control " id="diesel_pump"
                                                            name="diesel_pump">
                                                            <?php if(!empty($transportInfo->fuel_account_row_id)) { ?>
                                                            <option value="<?php echo $transportInfo->fuel_account_row_id; ?>"><?php echo $transportInfo->fuel_account_name; ?></option>
                                                            <?php } ?>
                                                            <option value="">Select Any</option>
                                                            <?php if(!empty($getAllPumpInfo))
                                                                { foreach ($getAllPumpInfo as $t)
                                                                    { ?>
                                                                    <option value="<?php echo $t->row_id; ?>">
                                                                        <?php echo $t->fuel_account_name.'(Bal:'.$t->account_balance.')'; ?>
                                                                    </option>
                                                                    <?php   } 
                                                                } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="diesel_amount">Diesel Amount </label>
                                                        <input type="text" class="form-control "
                                                            value="<?php echo $transportInfo->diesel_amount; ?>"
                                                            oninput="amount_calculate('<?php echo $ponchClearedBankTotal; ?>','<?php echo $ponchClearedCashTotal; ?>');" id="diesel_amount"
                                                            name="diesel_amount" oninput="amount_calculate('<?php echo $ponchClearedBankTotal; ?>','<?php echo $ponchClearedCashTotal; ?>');"
                                                            placeholder="Diesel Amount" autocomplete="off" onkeypress="return isNumberKey(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <label for="diesel_date">Diesel Date </label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-append">
                                                            <span
                                                                class="input-group-text material-icons date-icon">date_range</span>
                                                        </div>
                                                            <?php if($transportInfo->diesel_date != '0000-00-00') { ?>
                                                            <input id="diesel_date" type="text" name="diesel_date"
                                                                value="<?php echo date('d-m-Y',strtotime($transportInfo->diesel_date)); ?>"
                                                                class="form-control datepicker date-col-4 "
                                                                placeholder="Road tax Date" autocomplete="off" />
                                                            <?php } else { ?>
                                                            <input id="diesel_date" type="text" name="diesel_date" value=""
                                                                class="form-control datepicker date-col-4 "
                                                                placeholder="FC tax Date" autocomplete="off" />
                                                            <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="card">
                                        <div class="card-header card-contents-sub-title text-white">Party Amount Info (Optional)
                                        </div>
                                        <div class="card-body card-contents-body">
                                            <div class="row">
                                            <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="bank">Bank</label>
                                                        <select  name="bank_rowid" id="bank_rowid"
                                                            class="form-control  selectpicker"
                                                            data-live-search="true">
                                                            <option value="<?php echo $transportInfo->bank_rowid; ?>">
                                                                Selected:
                                                                <?php echo $transportInfo->bank_name; ?></option>
                                                            <?php if(!empty($bank))
                                                                { foreach ($bank as $b1)
                                                                    { ?>
                                                            <option value="<?php echo $b1->row_id ?>">
                                                                <?php echo $b1->bank_name ?></option>
                                                                <?php   } 
                                                                } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="party_amount">Bank amount to party </label>
                                                        <input type="text" class="form-control "
                                                            value="<?php echo $transportInfo->party_amount; ?>"
                                                            oninput="amount_calculate('<?php echo $ponchClearedBankTotal; ?>','<?php echo $ponchClearedCashTotal; ?>');" id="party_amount"
                                                            name="party_amount" placeholder="Party Amount"
                                                            autocomplete="off" onkeypress="return isNumberKey(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="cash_account_rowid">Cash Account</label>
                                                        <select  name="cash_account_rowid"
                                                            id="cash_account_rowid"
                                                            class="form-control  selectpicker"
                                                            data-live-search="true">
                                                            <option
                                                                value="<?php echo $transportInfo->cash_account_rowid; ?>">
                                                                Selected:
                                                                <?php echo $transportInfo->cash_account_name; ?>
                                                            </option>
                                                            <?php if(!empty($cashAccount))
                                                        { foreach ($cashAccount as $account)
                                                            { ?>
                                                               <option value="<?php echo $account->row_id ?>">
                                                               <?php echo $account->cash_account_name ?> (Balance:<?php echo $account->account_balance ?>)</option>
                                                            <?php   } 
                                                        } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="cash_amount">Cash amount to party </label>
                                                        <input type="text" class="form-control "
                                                            value="<?php echo $transportInfo->cash_amount; ?>"
                                                            oninput="amount_calculate('<?php echo $ponchClearedBankTotal; ?>','<?php echo $ponchClearedCashTotal; ?>');" id="cash_amount"
                                                            name="cash_amount" placeholder="Cash Amount"
                                                            autocomplete="off" onkeypress="return isNumberKey(event)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="card">
                                        <div class="card-header card-contents-sub-title text-white">Other Info</div>
                                        <div class="card-body card-contents-body">
                                            <div class="row">
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="loading_charge">Loading Charge </label>
                                                        <input type="text" class="form-control "
                                                            value="<?php echo $transportInfo->loading_charge; ?>"
                                                            oninput="amount_calculate('<?php echo $ponchClearedBankTotal; ?>','<?php echo $ponchClearedCashTotal; ?>');" id="loading_charge"
                                                            name="loading_charge" placeholder="Loading Charge"
                                                            autocomplete="off" onkeypress="return isNumberKey(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="unloading_charge">Unloading Charge</label>
                                                        <input type="text" class="form-control "
                                                            value="<?php echo $transportInfo->unloading_charge; ?>"
                                                            oninput="amount_calculate('<?php echo $ponchClearedBankTotal; ?>','<?php echo $ponchClearedCashTotal; ?>');" id="unloading_charge"
                                                            name="unloading_charge" placeholder="Unloading Charge"
                                                            autocomplete="off" onkeypress="return isNumberKey(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="unloading_charge">Halt Charge</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $transportInfo->halt_charge; ?>"
                                                            oninput="amount_calculate('<?php echo $ponchClearedBankTotal; ?>','<?php echo $ponchClearedCashTotal; ?>');" id="halt_charge"
                                                            name="halt_charge" placeholder="Halt Charge"
                                                            autocomplete="off" onkeypress="return isNumberKey(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="roro">RORO </label>
                                                        <input type="text" class="form-control "
                                                            value="<?php echo $transportInfo->roro; ?>" id="roro"
                                                            oninput="amount_calculate('<?php echo $ponchClearedBankTotal; ?>','<?php echo $ponchClearedCashTotal; ?>');" name="roro"
                                                            placeholder="Enter RORO" autocomplete="off" onkeypress="return isNumberKey(event)">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="discount_amount">Discount Amount </label>
                                                        <input type="text" class="form-control "
                                                            value="<?php echo $transportInfo->discount_amount; ?>"
                                                            oninput="amount_calculate('<?php echo $ponchClearedBankTotal; ?>','<?php echo $ponchClearedCashTotal; ?>');" id="discount_amount"
                                                            name="discount_amount" oninput="amount_calculate('<?php echo $ponchClearedBankTotal; ?>','<?php echo $ponchClearedCashTotal; ?>');"
                                                            placeholder="Enter Discount Amount" autocomplete="off"
                                                            onkeypress="return isNumberKey(event)" onkeypress="return isNumberKey(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="ponch_amount">Ponch Amount </label>
                                                        <input type="text" class="form-control required"
                                                            value="<?php echo $transportInfo->ponch_amount; ?>"
                                                            id="ponch_amount" name="ponch_amount"
                                                            placeholder="Enter Ponch Amount" autocomplete="off"
                                                            onkeypress="return isNumberKey(event)" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4  col-12">
                                                    <div class="form-group">
                                                        <label for="ponch_pending">Ponch Pending </label>
                                                        <select class="form-control required" id="ponch_pending"
                                                            name="ponch_pending">
                                                            <option
                                                                value="<?php echo $transportInfo->ponch_pending; ?>">
                                                                Selected:
                                                                <?php echo  $transportInfo->ponch_pending; ?></option>
                                                            <option value="Yes"> Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="narration">Narration </label>
                                                        <textarea class="form-control " placeholder="Enter Narration"
                                                            name="narration" id="narration" rows="3"
                                                            autocomplete="off"><?php echo $transportInfo->narration; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input style="float:right;" type="submit" class="btn btn-primary" value="Update" />
                     </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>assets/js/transport/transport.js" type="text/javascript"></script>
    <script type="text/javascript">
    function GoBackWithRefresh(event) {
        if ('referrer' in document) {
            window.location = document.referrer;
            //'<?php echo base_url(); ?>/transportListing';
            /* OR */
            //location.replace(document.referrer);
        } else {
            window.history.back();
        }
    }
    function amount_calculate(by_bank_cleared,by_cash_cleared) {
       
        var mt = document.getElementById('mt').value;
        var rate = document.getElementById('rate').value;
        var result = document.getElementById('amount');
        var amount_result = mt * rate;

      //ponch amount
        document.getElementById('amount').value = amount_result;
        var amount = document.getElementById('amount').value;
        var diesel_amount = document.getElementById('diesel_amount').value;
        var cash_amount = document.getElementById('cash_amount').value;
        var party_amount = document.getElementById('party_amount').value;
        var loading_charge = document.getElementById('loading_charge').value;
        var unloading_charge = document.getElementById('unloading_charge').value;
        var halt_charge = document.getElementById('halt_charge').value;
        var roro = document.getElementById('roro').value;
        var discount_amount = document.getElementById('discount_amount').value;
        var ponch_amount_result = parseFloat('0' + amount) -( parseFloat('0' + diesel_amount) + parseFloat('0' + party_amount)+ parseFloat('0' + cash_amount) + parseFloat('0' + loading_charge) + parseFloat('0' + unloading_charge)+ parseFloat('0' + halt_charge) + parseFloat('0' +roro) + parseFloat('0' + discount_amount));
        var alreadyCleared = Number(by_bank_cleared) +  Number(by_cash_cleared);
       
        document.getElementById('ponch_amount').value = ponch_amount_result-alreadyCleared;
    }
    jQuery(document).ready(function() {
        
     
        $('select').selectpicker();
        jQuery('ul.pagination li a').click(function(e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            jQuery("#searchList").attr("action", link);
            jQuery("#searchList").submit();
        });
        jQuery('.resetFilters').click(function() {
            $(this).closest('form').find("input[type=text]").val("");
        })
        // Prepare the preview for profile picture
        $("#wizard-picture").change(function() {
            readURL(this);
        });
        jQuery('.datepicker').datepicker({
            autoclose: true,
            orientation: "bottom",
            format: "dd-mm-yyyy"

        });
    });
    </script>