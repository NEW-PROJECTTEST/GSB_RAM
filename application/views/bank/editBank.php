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
                            <div class="col-md-6 col-10 text-white">Edit Bank Details</div>
                            <div class="col-md-6 col-2 "> <a href="#" onclick="GoBackWithRefresh();return false;"class="btn text-white btn-success btn-bck float-right mobile-btn "><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                    <div class="card-body contents-body ">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="updateBank" action="<?php echo base_url() ?>updateBank"
                            method="post" role="form">
                            <div class="row form-contents">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="bank_name">Bank Name</label>
                                                <input type="text" class="form-control " value="<?php echo $bankInfo->bank_name; ?>" id="bank_name" name="bank_name"
                                                    placeholder="Enter Bank Name" autocomplete="off" >
                                                    <input type="hidden" value="<?php echo $bankInfo->row_id; ?>" name="row_id" id="row_id" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="bank_account_number">Account Number</label>
                                                <input type="text" class="form-control " id="bank_account_number" value="<?php echo $bankInfo->bank_account_number; ?>"
                                                    name="bank_account_number" placeholder="Enter Branch Name"
                                                    autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="branch_name">Branch Name</label>
                                                <input type="text" class="form-control " id="branch_name" value="<?php echo $bankInfo->branch_name; ?>"
                                                    name="branch_name" placeholder="Enter Branch Name"
                                                    autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12">
                                            <div class="form-group">
                                                <label for="account_type">Account Type </label>
                                                <select class="form-control " id="account_type" name="account_type">
                                                <option value="<?php echo $bankInfo->account_type; ?>">Selected: <?php echo  $bankInfo->account_type; ?></option>
                                                <option value="Current A/C"> Current A/C</option>
                                                <option value="Savings A/C">Savings A/C</option>
                                                <option value="O/D Account">O/D Account</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="IFSC_code">IFSC Code</label>
                                                <input type="text" class="form-control " id="IFSC_code" name="IFSC_code" value="<?php echo $bankInfo->IFSC_code; ?>"
                                                    placeholder="Enter IFSC Code" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="bank_contact">Contact Number </label>
                                                <input type="text" class="form-control " id="bank_contact" value="<?php echo $bankInfo->bank_contact; ?>"
                                                    name="bank_contact" placeholder="Enter Contact Number " maxlength="10"
                                                    onkeypress="return isNumberKey(event)" autocomplete="off" >
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
        window.location = '<?php echo base_url(); ?>/bankListing';
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
});
</script>