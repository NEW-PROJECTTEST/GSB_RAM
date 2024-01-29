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
                            <div class="col-md-5 col-8 text-white m-auto ">Edit Committee Details</div>
                            <div class=" col-md-5 col-4 m-auto "> <span class="mobile-right ">Name
                                    :<?php echo  $committeeInfo->committee_name; ?></span></div>
                            <div class="col-md-2 col-12 m-auto"> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck float-right mobile-btn mobile-bck"><i
                                        class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                    <div class="card-body contents-body ">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="addCommittee" action="<?php echo base_url() ?>updateCommittee"
                            method="post" role="form" enctype="multipart/form-data">
                            <div class="row form-contents">
                                <div class="col-lg-4  padding_left_right_null">
                                    <div class="card card-small c-border mb-4 p-2">
                                        <div class="card-header  text-center">
                                            <label for="fname">Profile Image (Optional)</label>
                                            <div class="form-group">
                                                <?php if(!empty($committeeInfo->profile_image)) { ?>
                                                <img src="<?php echo $committeeInfo->profile_image; ?>"
                                                    class="avatar rounded-circle img-thumbnail" width="130" height="130"
                                                    id="uploadedImage" name="userfile" alt="Profile Image Not Uploaded">
                                                <?php } else {?>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/usr.png"
                                                    class="avatar rounded-circle img-thumbnail" width="130" height="130"
                                                    id="uploadedImage" name="userfile">
                                                <?php }?>
                                                <input type="file" class="form-control-sm" id="sImg" name="userfile">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-8  padding_left_right_null">
                                    <div class="card card-small c-border p-4 ">
                                        <div class="row">
                                            <div class="col-lg-12 col-12">
                                                <div class="form-group">
                                                    <label for="committee_name">Name*</label>
                                                    <input type="text" class="form-control " id="committee_name"
                                                        value="<?php echo $committeeInfo->committee_name;?>"
                                                        name="committee_name" placeholder="Enter Name"
                                                        onkeydown="return alphaOnly(event)" autocomplete="off" required>
                                                    <input type="hidden" value="<?php echo $committeeInfo->row_id; ?>"
                                                        name="row_id" id="row_id" />

                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="contact_number_one">Contact Number*</label>
                                                    <input type="text" class="form-control "
                                                        value="<?php echo $committeeInfo->contact_number_one;?>"
                                                        id="contact_number_one" name="contact_number_one"
                                                        placeholder="Enter Contact Number One" maxlength="10"
                                                        minlength="10" onkeypress="return isNumberKey(event)"
                                                        autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="contact_number_two">Contact Number Two</label>
                                                    <input type="text" class="form-control "
                                                        value="<?php echo $committeeInfo->contact_number_two;?>"
                                                        id="contact_number_two" name="contact_number_two"
                                                        placeholder="Enter Contact Number Two" maxlength="10"
                                                        minlength="10" onkeypress="return isNumberKey(event)"
                                                        autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="email">Email address</label>
                                                    <input type="email" class="form-control email "
                                                        value="<?php echo $committeeInfo->email;?>" id="email"
                                                        name="email" maxlength="128" placeholder="Enter Email Address"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="asset_type">Role*</label>
                                                    <select class="form-control required" id="role" name="role"
                                                        required>
                                                        <option value="<?php echo $committeeInfo->role_id?>">
                                                            Selected :<?php echo $committeeInfo->role?>
                                                        </option>
                                                        <?php if(!empty($committeeRoleInfo)) {
                                                                foreach($committeeRoleInfo as $role ){?>
                                                        <option value="<?php echo $role->row_id;?>">
                                                            <?php echo $role->role;?></option>
                                                        <?php }}?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="">Committee Type*</label>
                                                    <select class="form-control" id="type" name="type" required>
                                                        <option value="<?php echo $committeeInfo->type_id?>">
                                                            Selected :<?php echo $committeeInfo->type?>
                                                        </option>
                                                        <?php if(!empty($committeeTypeInfo)) {
                                                                            foreach($committeeTypeInfo as $type )
                                                                            { ?>
                                                        <option value="<?php echo $type->row_id;?>">
                                                            <?php echo $type->type.' - '.$type->year;?>
                                                        </option>
                                                        <?php }
                                                            }?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="year">Year*</label>
                                                    <select class="form-control required" id="year" name="year"
                                                        required>
                                                        <option value="<?php echo $committeeInfo->year?>">
                                                            Selected :<?php echo $committeeInfo->year?>
                                                        </option>
                                                        <option value="2018">2018</option>
                                                        <option value="2019">2019</option>
                                                        <option value="2020">2020</option>
                                                        <option value="2021">2021</option>
                                                        <option value="2022">2022</option>
                                                        <option value="2023">2023</option>
                                                        <option value="2024">2024</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="committee_address">Address</label>
                                                    <textarea class="form-control " placeholder="Enter Address"
                                                        name="committee_address" id="committee_address" rows="3"
                                                        autocomplete="off"><?php echo $committeeInfo->committee_address;?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="form-group">
                                        <button type="submit" style="float:right;"
                                            class="btn btn-primary mr-1">Update</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/committee/committee.js" charset="utf-8">
</script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = '<?php echo base_url(); ?>/committeeListing';
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