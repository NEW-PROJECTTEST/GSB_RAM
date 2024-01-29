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
                            <div class="col-md-6 col-10 text-white m-auto ">Edit Cash Ledger Details</div>
                            <div class="col-md-6 col-2 "> <a href="#" onclick="GoBackWithRefresh();return false;"class="btn text-white btn-success btn-bck float-right mobile-btn "><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                    <div class="card-body contents-body ">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="updateCashLedger" action="<?php echo base_url() ?>updateCashLedger"
                            method="post" role="form">
                            <div class="row form-contents">
                                <div class="col-md-6 col-12">
                                    <label for="cash_ledger_date"> Date </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text material-icons date-icon">date_range</span>
                                        </div>
                                        <input id="cash_ledger_date" type="text" name="cash_ledger_date"
                                            value="<?php echo date('d-m-Y',strtotime($cashLedgerInfo->cash_ledger_date)); ?>"
                                            class="form-control datepicker date-col-4 required" placeholder="Enter Date"
                                            autocomplete="off" />
                                        <input type="hidden" value="<?php echo $cashLedgerInfo->row_id; ?>"
                                            name="row_id" id="row_id" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="party_rowid">Party name</label>
                                        <select required name="party_rowid" id="party_rowid"
                                            class="form-control required selectpicker" data-live-search="true">
                                            <option value="<?php echo $cashLedgerInfo->party_rowid; ?>">Selected:
                                                <?php echo $cashLedgerInfo->party_name; ?></option>
                                            <?php if(!empty($party))
                                                        { foreach ($party as $p1)
                                                            { ?>
                                            <option value="<?php echo $p1->row_id ?>">
                                                <?php echo $p1->party_name ?></option>
                                            <?php   } 
                                          } ?>
                                        </select>
                                        <input type="hidden" value="<?php echo $cashLedgerInfo->row_id; ?>"
                                            name="row_id" id="row_id" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="cash_amount">Amount </label>
                                        <input type="text" class="form-control " id="cash_amount" name="cash_amount"
                                            value="<?php echo $cashLedgerInfo->cash_amount; ?>"
                                            placeholder="Enter Amount" maxlength="10"
                                            onkeypress="return isNumberKey(event)" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="cash_account_rowid">Cash Account</label>
                                        <select name="cash_account_rowid" id="cash_account_rowid"
                                            class="form-control  selectpicker" data-live-search="true">
                                            <option value="<?php echo $cashLedgerInfo->cash_account_rowid; ?>">
                                                Selected:
                                                <?php echo $cashLedgerInfo->cash_account_name; ?>
                                            </option>
                                            <?php if(!empty($cashAccount))
                                                        { foreach ($cashAccount as $account)
                                                            { ?>
                                                            <option value="<?php echo $account->row_id ?> " >
                                                                <?php echo $account->cash_account_name ?> (Balance:<?php echo $account->account_balance ?>)</option>
                                                            <?php   } 
                                                          } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="reason">Reason</label>
                                        <textarea class="form-control " placeholder="Enter Reason" name="reason"
                                            id="reason" rows="3" autocomplete="off"
                                            required><?php echo $cashLedgerInfo->reason; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <input style="float:right;" type="submit" class="btn btn-primary" value="Update" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bank/bank.js" charset="utf-8">
</script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = '<?php echo base_url(); ?>/cashLedgerListing';
        /* OR */
        //location.replace(document.referrer);
    } else {
        window.history.back();
    }
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function blockSpecialChar(e) {
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
}
jQuery(document).ready(function() {
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        jQuery("#searchList").attr("action", link);
        jQuery("#searchList").submit();
    });
    jQuery('.resetFilters').click(function() {
        $(this).closest('form').find("input[type=text]").val("");
    })
    jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});
</script>