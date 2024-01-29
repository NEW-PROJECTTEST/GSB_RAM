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
                            <div class="col-md-6 col-10 text-white m-auto ">Edit Cash Account Details</div>
                            <div class="col-md-6 col-2 "> <a href="#" onclick="GoBackWithRefresh();return false;"class="btn text-white btn-success btn-bck float-right mobile-btn "><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                    <div class="card-body contents-body">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="updateCashAccount" action="<?php echo base_url() ?>updateCashAccount"
                            method="post" role="form">
                            <div class="row form-contents">
                            <div class="col-md-6  col-12">
                                            <div class="form-group">
                                                <label for="cash_account_name">Cash Account Name </label>
                                                <input type="text" class="form-control "
                                                    value="<?php echo $cashAccountInfo->cash_account_name; ?>" id="cash_account_name"
                                                    name="cash_account_name" maxlength="128" placeholder="Enter Cash Account Name"
                                                    autocomplete="off" required>
                                                    <input type="hidden" value="<?php echo $cashAccountInfo->row_id; ?>" name="row_id" id="row_id" />
                                            </div>
                                        </div>
                                <div class="col-md-6  col-12">
                                    <div class="form-group">
                                        <label for="cash_account_type"> Cash Account Type </label>
                                        <select class="form-control " id="cash_account_type" name="cash_account_type"
                                            required>
                                            <option value="<?php echo $cashAccountInfo->cash_account_type; ?>">Selected:
                                                <?php echo  $cashAccountInfo->cash_account_type; ?></option>
                                            <option value="Company">Company</option>
                                            <option value="Other">Other</option>
                                        </select>
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
</div>
</div>
<script src="<?php echo base_url(); ?>assets/js/cash_account/cash_account.js" type="text/javascript"></script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = '<?php echo base_url(); ?>/cashAccountListing';
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