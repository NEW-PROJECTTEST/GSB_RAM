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
        <div class="row ">
            <div class="col padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-1 card-content-title  ">
                        <div class="row ">
                            <div class="col-lg-6 text-white">Edit Customer</div>
                            <div class="col-lg-6"> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck pull-right mobile-bck "><i
                                        class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- form start -->
        <div class="col-lg-12">
            <div class="card card-small c-border mb-4 ">
                <form role="form" id="updateCustomer" action="<?php echo base_url() ?>updateCustomer" method="post"
                    role="form">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-4">
                            <div class="row">
                            <input type="hidden" value="<?php echo $customerInfo->customer_id; ?>" name="customer_id"/>
                                <div class="col">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="customer_name">Customer Name</label>
                                            <input type="text" class="form-control required"
                                                value="<?php echo $customerInfo->customer_name; ?>" id="customer_name"
                                                name="customer_name" maxlength="128" placeholder="Enter Full Name"
                                                autocomplete="off" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="mobile">Code</label>
                                            <input type="text" class="form-control required " id="code"
                                                value="<?php echo $customerInfo->customer_code; ?>" name="code"
                                                maxlength="80" placeholder="Enter Customer code"
                                                 autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="mobile">Contact Number</label>
                                            <input type="text" class="form-control digits" id="contact_number"
                                                value="<?php echo $customerInfo->contact_number; ?>"
                                                name="contact_number" maxlength="10"
                                                onkeypress="return isNumberKey(event)"
                                                placeholder="Enter Contact Number" autocomplete="off" required>
                                        </div>

                                    </div>



                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="customer_address">Address</label>
                                            <textarea class="form-control required" name="customer_address"
                                                id="customer_address" rows="4" placeholder="Enter Address"
                                                autocomplete="off"><?php echo $customerInfo->customer_address; ?></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success float-right"
                                       >Update</button>
                                </div>


                            </div>
                        </li>
                    </ul>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- End Default Light Table -->

<script src="<?php echo base_url(); ?>assets/js/customer/editCustomer.js" type="text/javascript"></script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = document.referrer;
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