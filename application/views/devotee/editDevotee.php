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
            <div class="col-md-12 col-lg-12  padding_left_right_null">
                <div class="card ">
                    <div class="card-header text-white card-content-title p-1">
                        <div class="row ">
                            <div class="col-lg-6 text-white ">Devotee Management</div>
                            <div class="col-lg-6 "> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck pull-right mobile-bck "><i
                                        class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>

                    <!-- form start -->
                    <div class="card-body contents-body ">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="editDevotee" action="<?php echo base_url() ?>updateDevotee" method="post"
                            role="form" enctype="multipart/form-data">
                            <!-- Default Light Table -->
                            <!-- <div class="card-header  text-center">
                            <div>
                                <label for="fname">Profile Image (Optional)</label>
                            </div>
                            <?php if(!empty($devoteeInfo->profile_image)) { ?>
                            <img src="<?php echo $devoteeInfo->profile_image; ?>"
                                class="avatar rounded-circle img-thumbnail" width="130" height="130" id="uploadedImage"
                                name="userfile" alt="Profile Image Not Uploaded">
                            <input type="file" class="form-control-sm" id="sImg" name="userfile">
                            <?php } else { ?>
                            <img src="<?php echo base_url(); ?>assets/dist/img/usr.png"
                                class="avatar rounded-circle img-thumbnail" width="130" height="130" id="uploadedImage"
                                name="userfile">
                            <input type="file" class="form-control-sm" id="sImg" name="userfile">
                            <?php } ?>
                        </div> -->
                            <!-- <div class="form-group">
                            <label for="devotee_id">devotee ID</label>
                            <input type="text" class="form-control " value="<?php echo $devoteeInfo->devotee_id; ?>"
                                id="devotee_id" name="devotee_id" maxlength="128" placeholder="Enter Devotee ID"
                                autocomplete="off">
                        </div> -->
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="fname">Full Name*</label>
                                        <input type="text" class="form-control "
                                            value="<?php echo $devoteeInfo->devotee_name; ?>" id="devotee_name"
                                            name="devotee_name" maxlength="128" placeholder="Enter Full Name"
                                            autocomplete="off">
                                        <input type="hidden" value="<?php echo $devoteeInfo->row_id; ?>" name="row_id"
                                            id="row_id" />
                                    </div>
                                </div>
                                <!-- <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="">Devotee Id*</label>
                                        <input type="text" class="form-control "
                                            value="<?php echo $devoteeInfo->devotee_id; ?>" 
                                            name="devote_id" maxlength="128" placeholder="Enter Devotee Id"
                                            autocomplete="off" required/>                
                                    </div>
                                </div> -->
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="return_date">Date Of Birth*</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span
                                                    class="input-group-text material-icons date-icon">date_range</span>
                                            </div>
                                            <input id="dob" type="text" name="dob"
                                                value="<?php echo date('d-m-Y',strtotime($devoteeInfo->dob)); ?>"
                                                class="form-control datepicker  forgotPassword-input"
                                                placeholder="Date of Birth" autocomplete="off" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="gender">Gender*</label>
                                        <select class="form-control " id="gender" name="gender">
                                            <option value="<?php echo  $devoteeInfo->gender; ?>">Selected:
                                                <?php echo $devoteeInfo->gender; ?></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mobile">Contact Number*</label>
                                        <input type="text" class="form-control  digits" id="contact_number"
                                            value="<?php echo $devoteeInfo->contact_number; ?>" name="contact_number"
                                            maxlength="10" onkeypress="return isNumberKey(event)"
                                            placeholder="Enter Contact Number" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="email">Email address (Optional)</label>
                                        <input type="text" class="form-control " id="email"
                                            value="<?php echo $devoteeInfo->email; ?>" name="email" maxlength="128"
                                            placeholder="Enter Email Address" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mobile">Alternative Contact Number (Optional)</label>
                                        <input type="text" class="form-control digits" id="alternative_contact_number"
                                            value="<?php echo $devoteeInfo->alternative_contact_number; ?>"
                                            onkeypress="return isNumberKey(event)" name="alternative_contact_number"
                                            maxlength="10" placeholder="Enter Alternative Contact Number"
                                            autocomplete="off">
                                    </div>

                                </div>

                                <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="post_status">Post*</label>
                                            <select class="form-control required" id="post_status" name="post_status" required>
                                              <option value="<?php echo  $devoteeInfo->post_status; ?>">Selected:
                                                <?php echo $devoteeInfo->post_status; ?></option>  
                                                <option value="YES">YES</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label for="role">Address</label>
                                        <textarea class="form-control " name="devotee_address" id="devotee_address"
                                            rows="4" placeholder="Address"
                                            autocomplete="off"> <?php echo $devoteeInfo->devotee_address; ?></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" style="float:right;" class="btn btn-primary mr-1">Update</button>
                    </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- form end -->
<!-- End Default Light Table -->


<script src="<?php echo base_url(); ?>assets/js/devotee/editDevotee.js" type="text/javascript"></script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = '<?php echo base_url(); ?>/devoteeListing';
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

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#uploadedImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#sImg").change(function() {
    readURL(this);
});
</script>