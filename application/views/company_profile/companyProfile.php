<?php
$company_name = "";
$company_logo = "";
$cgst = "";
$sgst = "";
$igst = "";
$cgst = "";
$utgst = "";
$company_gst_number = "";
$company_website_url = "";
$company_pan_number = "";
$founder_name = "";
$company_address = "";
$company_contact_number_one = "";
$company_contact_number_two = "";
$company_email = "";
$total_employee = "";
$row_id = "";
 if(!empty($companyInfo)){
    $row_id = $companyInfo->row_id;
    $company_name = $companyInfo->company_name;
    $company_logo =$companyInfo->company_logo;
    $cgst = $companyInfo->cgst;
    $sgst = $companyInfo->sgst;
    $igst =$companyInfo->igst;
    $cgst = $companyInfo->cgst;
    $utgst = $companyInfo->utgst;
    $company_gst_number =$companyInfo->company_gst_number;
    $company_website_url = $companyInfo->company_website_url;
    $company_pan_number = $companyInfo->company_pan_number;
    $founder_name = $companyInfo->founder_name;
    $company_address =$companyInfo->company_address;
    $company_contact_number_one = $companyInfo->company_contact_number_one;
    $company_contact_number_two = $companyInfo->company_contact_number_two;
    $company_email =$companyInfo->company_email;
    $total_employee = $companyInfo->total_employee;
 }
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
            <div class="col  padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-1 card-content-title">
                        <div class="row ">
                            <div class="col-md-6 col-8 text-white ">Place Profile</div>
                            <div class="col-md-6 col-4"> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck pull-right  "><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <!-- left column -->
            <div class="col-md-12 col-lg-12 padding_left_right_null">
                <div class="card ">
                    <div class="card-header text-white card-contents-sub-title">Add Place Profile</div>
                    <div class="card-body card-contents-body ">
                        <?php $this->load->helper("form"); ?>
                        <!--form start -->
                        <form role="form" id="addCompanyProfile" action="<?php echo base_url() ?>addCompanyProfileToDb"
                            method="post" role="form" enctype="multipart/form-data">
                            <div class="row">
                                <?php if($row_id == "") {?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Place Logo(Optional)</label>
                                        <input type="file" class="form-control" id="vImg" name="userfile">
                                        <img height="100" alt="" width="150" src="#" id="uploadedImage" name="userfile">
                                    </div>
                                </div>
                                <?php } else { ?>
                                <div class="col-md-4">
                                    <label for="fname">Change Place Logo</label>
                                    <div class="form-group">
                                        <input type="file" class="form-control" id="vImg" name="userfile">
                                        <img height="100" width="150" src="<?php echo  $companyInfo->company_logo; ?>"
                                            id="uploadedImage" name="userfile" autocomplete="off"/>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="company_name">Place Name</label>
                                        <input type="text" class="form-control required"
                                            value="<?php echo $company_name; ?>" id="company_name" name="company_name"
                                            placeholder="Enter Company Name" autocomplete="off">
                                        <input type="hidden" value="<?php echo $row_id; ?>" name="row_id" id="row_id" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="founder_name">Place Head Name</label>
                                        <input type="text" class="form-control required"
                                            value="<?php echo $founder_name; ?>" id="founder_name" name="founder_name"
                                            placeholder="Enter Director Name" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="company_website_url">Website Url</label>
                                        <input type="text" class="form-control required"
                                            value="<?php echo $company_website_url; ?>" id="company_website_url"
                                            name="company_website_url" placeholder="Company Website Url" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="company_pan_number">PAN Number</label>
                                        <input type="text" class="form-control" id="company_pan_number"
                                            value="<?php echo $company_pan_number; ?>" name="company_pan_number"
                                            placeholder="Enter Pan Number" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="company_contact_number_one">Contact Number One</label>
                                        <input type="text" class="form-control digits required"
                                            id="company_contact_number_one"
                                            value="<?php echo $company_contact_number_one; ?>"
                                            name="company_contact_number_one" placeholder="Company Contact Number One"
                                            onkeypress="return isNumberKey(event)" maxlength="10" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="company_contact_number_two">Contact Number
                                            Two(Optional)</label>
                                        <input type="text" class="form-control digits " id="company_contact_number_two"
                                            value="<?php echo $company_contact_number_two; ?>"
                                            name="company_contact_number_two" placeholder="Company Contact Number Two"
                                            onkeypress="return isNumberKey(event)" maxlength="10" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="company_email">Email Address</label>
                                        <input type="text" class="form-control required" id="company_email"
                                            value="<?php echo $company_email ?>" name="company_email" maxlength="128"
                                            placeholder="Email address" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="total_employee">Total Employees</label>
                                        <input type="text" class="form-control required"
                                            value="<?php echo $total_employee; ?>" id="total_employee"
                                            name="total_employee" placeholder="Enter Total employees" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="company_address">Address</label>
                                        <textarea class="form-control required" placeholder="Enter Address"
                                            name="company_address" id="company_address"
                                            rows="3"><?php echo $company_address; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header card-contents-sub-title text-white">Tax Info(Optional)</div>
                                        <div class="card-body card-contents-body">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <label for="sgst">SGST</label>
                                                        <input type="text" class="form-control " id="sgst"
                                                            value="<?php echo $sgst; ?>" name="sgst"
                                                            onkeypress="return Validate(event);"
                                                            placeholder="Enter SGST" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <label for="igst">IGST</label>
                                                        <input type="text" class="form-control " id="igst"
                                                            value="<?php echo $igst; ?>" name="igst"
                                                            onkeypress="return Validate(event);"
                                                            placeholder="Enter IGST" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <label for="utgst">UTGST</label>
                                                        <input type="text" class="form-control " id="utgst"
                                                            value="<?php echo $utgst; ?>" name="utgst"
                                                            onkeypress="return Validate(event);"
                                                            placeholder="Enter UTGST" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <label for="cgst">CGST</label>
                                                        <input type="text" class="form-control " id="cgst"
                                                            value="<?php echo $cgst; ?>" name="cgst"
                                                            onkeypress="return Validate(event);"
                                                            placeholder="Enter CGST" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <label for="cgst">Company GSTIN/UIN</label>
                                                        <input type="text" class="form-control " id="company_gst_number"
                                                            value="<?php echo $company_gst_number; ?>"
                                                            name="company_gst_number"
                                                            placeholder="Enter Company GST Number" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <br>
                            <input style="float:right;" type="submit" class="btn btn-primary"
                                <?php if($row_id == "") {?> value="Submit" <?php } else { ?> value="Update"
                                <?php } ?> />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/company_profile/addCompanyProfile.js" type="text/javascript"></script>
<script type="text/javascript">
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function Validate(event) {
    var regex = new RegExp("^[0-9.]");
    var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
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

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#uploadedImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#vImg").change(function() {
    readURL(this);
});
</script>