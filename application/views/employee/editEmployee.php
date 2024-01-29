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
            <div class="col  padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-1 card-content-title  ">
                        <div class="row ">
                            <div class="col-lg-6 text-white ">Staff Management</div>
                            <div class="col-lg-6 "> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck pull-right mobile-bck "><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- form start -->
        <form role="form" id="editEmployee" action="<?php echo base_url() ?>updateEmployee" method="post" role="form"
            enctype="multipart/form-data">
            <!-- Default Light Table -->
            <div class="row form-contents">
                <div class="col-lg-4  padding_left_right_null">
                    <div class="card card-small c-border mb-4 p-2">
                        <div class="card-header  text-center">
                            <div>
                                <label for="fname">Profile Image (Optional)</label></div>
                            <?php if(!empty($employeeInfo->profile_image)) { ?>
                            <img src="<?php echo $employeeInfo->profile_image; ?>"
                                class="avatar rounded-circle img-thumbnail" width="130" height="130" id="uploadedImage"
                                name="userfile" alt="Profile Image Not Uploaded">
                            <input type="file" class="form-control-sm" id="sImg" name="userfile">
                            <?php } else { ?>
                            <img src="<?php echo base_url(); ?>assets/dist/img/usr.png"
                                class="avatar rounded-circle img-thumbnail" width="130" height="130" id="uploadedImage"
                                name="userfile">
                            <input type="file" class="form-control-sm" id="sImg" name="userfile">
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="employee_id">Staff ID</label>
                            <input type="text" class="form-control " value="<?php echo $employeeInfo->employee_id; ?>"
                                id="employee_id" name="employee_id" maxlength="128" placeholder="Enter Employee ID"
                                autocomplete="off">
                            <input type="hidden" value="<?php echo $employeeInfo->row_id; ?>" name="row_id"
                                id="row_id" />
                        </div>
                        <div class="form-group">
                            <label for="fname">Full Name</label>
                            <input type="text" class="form-control " value="<?php echo $employeeInfo->employee_name; ?>"
                                id="employee_name" name="employee_name" maxlength="128" placeholder="Enter Full Name"
                                autocomplete="off">
                        </div>
                        <label for="return_date">Date Of Birth</label>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text material-icons date-icon">date_range</span>
                            </div>
                            <input id="dob" type="text" name="dob"
                                value="<?php echo date('d-m-Y',strtotime($employeeInfo->dob)); ?>"
                                class="form-control datepicker  forgotPassword-input" placeholder="Date of Birth"
                                autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control " id="gender" name="gender">
                                <option value="<?php echo  $employeeInfo->gender; ?>">Selected:
                                    <?php echo $employeeInfo->gender; ?></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select></div>
                    </div>
                </div>
                <div class="col-lg-8  padding_left_right_null">
                    <div class="card card-small c-border mb-4 ">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-1">
                                <div class="row">
                                    <div class="col-12">
                                        <b> <span class="float-right">Employee ID :
                                                <?php echo $employeeInfo->employee_id; ?></b>
                                    </div>
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="email">Email address</label>
                                                <input type="text" class="form-control " id="email"
                                                    value="<?php echo $employeeInfo->email; ?>" name="email"
                                                    maxlength="128" placeholder="Enter Email Address"
                                                    autocomplete="off">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="mobile">Contact Number</label>
                                                <input type="text" class="form-control  digits" id="contact_number"
                                                    value="<?php echo $employeeInfo->contact_number; ?>"
                                                    name="contact_number" maxlength="10"
                                                    onkeypress="return isNumberKey(event)"
                                                    placeholder="Enter Contact Number" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="mobile">Alternative Contact Number (Optional)</label>
                                                <input type="text" class="form-control digits"
                                                    id="alternative_contact_number"
                                                    value="<?php echo $employeeInfo->alternative_contact_number; ?>"
                                                    onkeypress="return isNumberKey(event)"
                                                    name="alternative_contact_number" maxlength="10"
                                                    placeholder="Enter Alternative Contact Number" autocomplete="off">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="role">Role</label>
                                                <select class="form-control " id="role_id" name="role_id">
                                                    <option value="<?php echo $employeeInfo->role_id; ?>">Selected:
                                                        <?php echo  $employeeInfo->role; ?></option>
                                                    <?php if(!empty($roles)){
                                                              foreach ($roles as $rl) {?>
                                                    <option value="<?php echo $rl->role_id ?>"
                                                        <?php if($rl->role_id == set_value('role')) {echo "selected=selected";} ?>>
                                                        <?php echo $rl->role ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control minlength" id="password"
                                                    name="password" maxlength="20" placeholder="Password">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="cpassword">Confirm Password</label>
                                                <input type="password" class="form-control  equalTo" id="cpassword"
                                                    name="cpassword" maxlength="20" placeholder="Confirm Password">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="role">Address</label>
                                                <textarea class="form-control " name="employee_address"
                                                    id="employee_address" rows="4" placeholder="Address"
                                                    autocomplete="off"> <?php echo $employeeInfo->employee_address; ?></textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form> <!-- form end -->
        <!-- End Default Light Table -->
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/employee/editEmployee.js" type="text/javascript"></script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location ='<?php echo base_url(); ?>/employeeListing';
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