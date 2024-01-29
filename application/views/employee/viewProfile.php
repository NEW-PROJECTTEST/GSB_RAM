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
<?php  
                $noMatch = $this->session->flashdata('nomatch');
                if($noMatch)
                {
            ?>
<div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php echo $this->session->flashdata('nomatch'); ?>
</div>
<?php } ?>
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
                            <div class="col-md-6 col-8 text-white ">My Profile</div>
                            <div class="col-md-6 col-4"> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck pull-right  "><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Blocks -->
        <div class="row form-contents">
            <div class="col-lg-3 col-md-4 col-12  padding_left_right_null">
                <div class="card card-small c-border mb-4 p-1">
                    <div class="card-header text-center profile-img">
                        <?php if(!empty($employeeInfo->profile_image)){ ?>
                        <img src="<?php echo $employeeInfo->profile_image; ?>"
                            class="avatar rounded-circle img-thumbnail" width="150" height="180" id="uploadedImage"
                            name="userfile" width="130" height="130" alt="Profile Image Not Uploaded" />
                        <?php } else { ?>
                        <img class="avatar rounded-circle img-thumbnail"
                            src="<?php echo base_url(); ?>assets/dist/img/usr.png" width="100" height="100"
                            alt="User Avatar">
                        <?php } ?>
                    </div>
                    <div class="card-body text-center profile_sidebar pt-0 pl-0 pr-0 mt-1">
                        <div class="p-1">
                            <span style="font-weight: 700"> <i class="fa fa-id-card"></i> Employee ID: <span
                                    style="color: #093973;"> <?php echo $employeeInfo->employee_id; ?></span></span>
                        </div>
                        <hr class="mt-1 mb-1">
                        <div class="p-1">
                            <span style="font-weight: 700"> <i class="fas fa-user"></i> Role: <span
                                    style="color: #093973;"> <?php echo $employeeInfo->role; ?></span></span>
                        </div>
                        <hr class="mt-1 mb-1">
                        <div class="p-1">
                            <span style="font-weight: 700"> <i class="far fa-calendar-alt"></i> DOB: <span
                                    style="color: #093973;"><?php echo date('d-m-Y', strtotime($employeeInfo->dob)); ?></span></span>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-12  padding_left_right_null ">
                <div class="card card-small c-border mb-4 ">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-1">
                            <div class="row">
                                <div class="col profile-head">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                                role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="password-tab" data-toggle="tab"
                                                href="#changePassword" role="tab" aria-controls="password"
                                                aria-selected="false">Change Password</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content profile-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <table class="table table-padding">
                                                <tbody>
                                                    <tr>
                                                        <th width="40%">Gender<span class="float-right">:</span></th>
                                                        <td><?php echo $employeeInfo->gender; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Contact Number<span class="float-right">:</span></th>
                                                        <td><?php echo $employeeInfo->contact_number; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Alternative Contact Number<span class="float-right">:</span>
                                                        </th>
                                                        <td><?php echo $employeeInfo->alternative_contact_number; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email<span class="float-right">:</span></th>
                                                        <td><?php echo $employeeInfo->email; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address<span class="float-right">:</span></th>
                                                        <td><?php echo $employeeInfo->employee_address; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="<?= ($active == "changepass")? "active" : "" ?> tab-pane fade mx-auto"
                                            id="changePassword" role="tabpanel" aria-labelledby="password-tab">
                                            <form role="form" method="post"
                                                action="<?php echo base_url() ?>changePassword">
                                                <div class="input-group mb-3 profile_changePassword">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text material-icons">lock</span>
                                                    </div>
                                                    <input type="password" class="form-control"
                                                        placeholder="Old password" id="oldPassword" name="oldPassword"
                                                        autocomplete="off" required />
                                                </div>
                                                <div class="input-group mb-3 profile_changePassword">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text material-icons">lock</span>
                                                    </div>
                                                    <input type="password" class="form-control"
                                                        placeholder="New Password" id="password" name="password"
                                                        autocomplete="off" required />
                                                </div>
                                                <div class="input-group mb-3 profile_changePassword">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text material-icons">lock</span>
                                                    </div>
                                                    <input type="password" class="form-control equalTo"
                                                        placeholder="Re-Type Password" id="cpassword" name="cpassword"
                                                        autocomplete="off" required />
                                                </div>
                                                <div>
                                                    <button type="submit"
                                                        class="btn btn-primary float-right ">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                   </div>
               </li>
            </ul>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/employee/profile.js" type="text/javascript"></script>
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
        format: "yyyy-mm-dd"

    });
});
</script>