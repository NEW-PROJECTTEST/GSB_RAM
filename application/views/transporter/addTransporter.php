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
            <div class="col-md-12 col-lg-12 padding_left_right_null">
                <div class="card ">
                    <div class="card-header text-white card-content-title p-1">
                        <div class="row ">
                            <div class="col-md-6 col-8 text-white m-auto ">Add Transporter Details</div>
                            <div class="col-md-6 col-4 m-auto"> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck float-right mobile-btn "><i
                                        class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                    <div class="card-body contents-body">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="addTransporter" action="<?php echo base_url() ?>addTransporter"
                            method="post" role="form">
                            <div class="row form-contents">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="transporter_name">Transporter Name</label>
                                        <input type="text" class="form-control required" id="transporter_name"
                                            name="transporter_name" placeholder="Enter Transporter Name"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="email">Email address (Optional) </label>
                                        <input type="text" class="form-control email " id="email" name="email"
                                            maxlength="128" placeholder="Enter Email Address" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="contact_number">Contact Number</label>
                                        <input type="text" class="form-control required" id="contact_number"
                                            name="contact_number" placeholder="Enter Contact Number"
                                            maxlength="10" onkeypress="return isNumberKey(event)" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="transporter_account_number">Account Number</label>
                                        <input type="text" class="form-control required" id="transporter_account_number"
                                            name="transporter_account_number" placeholder="Enter Account Number"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <label for="transporter_address">Address</label>
                                        <textarea class="form-control required" placeholder="Enter Address"
                                            name="transporter_address" id="transporter_address" rows="3"
                                            autocomplete="off"></textarea>
                                    </div>
                                </div>
                               
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="comments">Comments (Optional)</label>
                                        <textarea class="form-control " placeholder="Enter Address"
                                            name="comments" id="comments" rows="3"
                                            autocomplete="off"></textarea>
                                    </div>
                                </div>
                                
                            </div>
                            <input style="float:right;" type="submit" class="btn btn-primary" value="Submit" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/transporter/transporter.js" charset="utf-8">
</script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = '<?php echo base_url(); ?>/transporterListing';
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