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
<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row p-0">
            <div class="col  padding_left_right_null">
                <div class="card card-small  p-0 m-b-1">
                    <div class="card-body p-2">
                        <div class="row c-m-b">
                            <div class="col-5">
                                <span class="page-title">
                                    <i class="fa fa-users"></i> Devotee Info
                                </span>
                            </div>
                            <div class="col-5 mobile-title">
                                <span class="page-sub-title mobile-title">Total Devotees: <?php echo $count; ?></span>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <a class="btn btn-primary mobile-btn pull-right" href="" data-toggle="modal"
                                        data-target="#Modal"><i class="fa fa-plus"></i>
                                        Add New </a>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6 col-sm-12 col-12"> -->
                            <!-- <form action="<?php echo base_url() ?>devoteeListing" method="POST" id="searchList">
                                    <div class="input-group search-box">
                                        <input type="text" name="searchText" value=""
                                            class="form-control searchText input-md pull-right"
                                            placeholder="Search By Name/Mobile/Email" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-md btn-primary searchList"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form> -->
                            <!-- </div> -->
                        </div>
                        <hr>
                        <div class="row c-m-t">


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col  padding_left_right_null">
                <div class="card card-small mb-4">
                    <div class="card-body p-1 pb-3 text-center table-responsive">
                        <table class=" table mb-0 form-table-padding bordeless ">
                            <tr class="bg-deafult">
                                <form action="<?php echo base_url() ?>devoteeListing" method="POST" id="byFilterMethod">
                                    <!-- <th width="150" style="padding: 0px;"> -->
                                    <!-- <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="devotee_id" id="devotee_id" value="<?php //echo $devotee_id ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By ID"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-id-card"></i>
                                            </div>
                                        </div> -->
                                    <!-- </th> -->
                                    <th width="40">
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width " type="text"
                                                name="devotee_name" id="devotee_name"
                                                value="<?php echo $devotee_name ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By Name"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-user"></i></div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text" name="devotee_address"
                                                id="devotee_address" value="<?php echo $devotee_address ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By devotee_address"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-user"></i></div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="contact_number" id="contact_number"
                                                value="<?php echo $contact_number ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By Phone"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-phone"></i></div>
                                        </div>
                                    </th>

                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0">
                                            <select class="form-control s-valid mobile-width input-sm pull-right" style="text-transform: uppercase" id="post_status_f" name="post_status_f">
                                        <?php if(!empty($post_status_f)){ ?>
                                            <option value="<?php echo $post_status_f ?>" selected> Selected: <?php echo $post_status_f ?></option>
                                            <?php } ?>
                                            <option value="">Select</option> 
                                            <option value="YES">YES</option> 
                                            <option value="NO">NO</option>                                                                                  
                                        </select>
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-phone"></i></div>
                                        </div>
                                    </th>

                                    <th width="180" class="text-center btn-padding"><button type="submit"
                                            class="btn btn-success btn-block mobile-width"> Search</button></th>
                                </form>
                            </tr>
                            <tr class=" text-white bg-black ">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Mobile</th>
                                <th>Post Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                    if(!empty($devoteeRecords))
                    {
                        foreach($devoteeRecords as $record)
                        {
                    ?>
                            <tr class="text-black">
                                <td><?php echo $record->devotee_id ?></td>
                                <td><?php echo $record->devotee_name ?></td>
                                <td><?php echo $record->devotee_address ?></td>
                                <td><?php echo $record->contact_number ?></td>
                                <td><?php echo $record->post_status ?></td>
                                <td class="text-center">

                                    <a class="btn  btn-sm btn-info"
                                        href="<?php echo base_url().'editDevoteePageView/'.$record->row_id; ?>"
                                        title="Edit"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger deleteDevotee" href="#"
                                        data-devotee_id="<?php echo $record->row_id; ?>" title="Delete"><i
                                            class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else { ?>
                            <tr>
                                <td class="text-center " colspan="10">
                                    Devotee Not Found!!.
                                </td>
                            </tr>
                            <?php }
                      ?>
                        </table>
                        <div>
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div id="Modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header modal-call-report p-2">
                        <div class=" col-md-10 col-10">
                            <span class="text-white mobile-title" style="font-size : 20px">Add Devotee
                                Details</span>
                        </div>
                        <div class=" col-md-2 col-2">
                            <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body m-2">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="addDevotee" action="<?php echo base_url() ?>addDevotee" method="post"
                            role="form" enctype="multipart/form-data">
                            <!-- Default Light Table -->
                            <div class="row form-contents">
                                <div class="row">
                                <div class="col-lg-12 col-12">
                                        <div class="form-group mt-0 pt-0">
                                            <label for="post_status">Search Devotee</label>
                                            <select class="form-control required selectpicker" data-live-search="true" style="width: auto;">
                                                <option value="">Search</option>
                                                <?php if(!empty($allDevoteeInfo)) {
                                                 foreach($allDevoteeInfo as $all) {?>
                                                <option value=""><?php echo $all->devotee_name ?>- <?php echo $all->contact_number ?>- <?php echo substr($all->devotee_address, 0, 50); ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                 </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="fname">Full Name*</label>
                                            <input type="text" class="form-control required"
                                                value="<?php echo set_value('fname'); ?>" id="devotee_name"
                                                name="devotee_name" 
                                                placeholder="Enter Full Name" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="devotee_id">Devotee Id*</label>
                                            <input type="text" class="form-control required"
                                                value="" id="devotee_id"
                                                 name="devotee_id" maxlength="128"
                                                placeholder="Enter Devotee Id" autocomplete="off" required>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="return_date">Date Of Birth</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-append">
                                                    <span
                                                        class="input-group-text material-icons date-icon">date_range</span>
                                                    <input id="dob" type="text" name="dob"
                                                        class="form-control datepicker date-col-3"
                                                        placeholder="Date of Birth" autocomplete="off" >
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="gender">Gender*</label>
                                            <select class="form-control required" id="gender" name="gender" required>
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="mobile">Contact Number*</label>
                                            <input type="text" class="form-control required digits" id="contact_number"
                                                value="<?php echo set_value('contact_number'); ?>" name="contact_number"
                                                maxlength="10" minlength="10" placeholder="Enter Contact Number"
                                                onkeypress="return isNumberKey(event)" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="email">Email address (Optional)</label>
                                            <input type="email" class="form-control email" id="email"
                                                value="<?php echo set_value('email'); ?>" name="email" maxlength="128"
                                                placeholder="Enter Email Address" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="mobile">Alternative Contact Number
                                                (Optional)</label>
                                            <input type="text" class="form-control digits"
                                                id="alternative_contact_number"
                                                value="<?php echo set_value('alternative_contact_number'); ?>"
                                                name="alternative_contact_number" maxlength="10"
                                                onkeypress="return isNumberKey(event)"
                                                placeholder="Enter Alternative Contact Number" autocomplete="off">
                                        </div>

                                    </div>

                                      
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="post_status">Post*</label>
                                            <select class="form-control required" id="post_status" name="post_status" required>
                                                <option value="">Select Post</option>
                                                <option value="YES">YES</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                                    
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="role">Address*</label>
                                            <textarea class="form-control required"
                                                value="<?php echo set_value('devotee_address'); ?>"
                                                name="devotee_address" id="devotee_address" rows="4"
                                                placeholder="Address" autocomplete="off" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"
                                        OnClientClick="Validate();">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> <!-- form end -->
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Modal -->
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/devotee/deleteDevotee.js" charset="utf-8">
</script>
<script type="text/javascript">
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function alphaOnly(event) {
    var key = event.keyCode;
    return ((key >= 65 && key <= 90) || key == 8 || key == 32);
};

jQuery(document).ready(function() {
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#searchList").attr("action", baseURL + "devoteeListing/" + value);
        jQuery("#searchList").submit();
    });
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#byFilterMethod").attr("action", baseURL + "devoteeListing/" + value);
        jQuery("#byFilterMethod").submit();
    });
    jQuery('.datepicker').datepicker({
        autoclose: true,
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
$("#vImg").change(function() {
    readURL(this);
});
</script>

