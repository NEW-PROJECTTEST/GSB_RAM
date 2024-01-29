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
                        <div class="row">
                            <div class="col-lg-5 col-sm-12 col-12">
                                <span class="page-title">
                                    <i class="fa fa-users"></i> Family Info
                                </span>
                            </div>
                            <div class="col-lg-5 col-8 mobile-title">
                                <span class="page-sub-title mobile-title">Total Family: <?php echo $count; ?></span>
                            </div>
                            <div class="col-lg-2 col-4 ">
                                <div class="form-group">
                                    <a class="btn btn-primary mobile-btn pull-right" href="" data-toggle="modal"
                                        data-target="#Modal"><i class="fa fa-plus"></i>
                                        Add New </a>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6 col-sm-12 col-12">
                                <form action="<?php echo base_url() ?>familyListing" method="POST" id="searchList">
                                    <div class="input-group search-box">
                                        <input type="text" name="searchText" value=""
                                            class="form-control searchText input-md pull-right"
                                            placeholder="Search By Name/Mobile" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-md btn-primary searchList"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div> -->
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
                                <form action="<?php echo base_url() ?>familyListing" method="POST" id="byFilterMethod">
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

                                    </th>
                                    <th width="180" class="text-center btn-padding"><button type="submit"
                                            class="btn btn-success btn-block mobile-width"> Search</button></th>
                                </form>
                            </tr>
                            <tr class=" text-white bg-black ">
                                <th>ID</th>
                                <th>Family Head</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                    if(!empty($familyRecords))
                    {
                        foreach($familyRecords as $record)
                        {
                    ?>
                            <tr class="text-black">
                                <td><?php echo $record->row_id ?></td>
                                <td><?php echo $record->devotee_name ?></td>
                                <td><?php echo $record->contact_number ?></td>
                                <td><?php echo $record->devotee_address ?></td>
                                <td class="text-center">

                                    <a class="btn  btn-sm btn-info"
                                        href="<?php echo base_url().'editFamilyPageView/'.$record->row_id; ?>"
                                        title="Edit"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger deleteFamily" href="#"
                                        data-family_id="<?php echo $record->row_id; ?>" title="Delete"><i
                                            class="fas fa-trash"></i></a>
                                    <!-- <a class="btn  btn-sm btn-success" href="" data-toggle="modal"
                                        onclick="openModel('<?php echo $record->row_id; ?>','<?php echo $record->amount; ?>')"
                                        title="Subscription">Subscription</a> -->
                                </td>
                            </tr>
                            <?php
                        }
                    } else { ?>
                            <tr>
                                <td class="text-center " colspan="10">
                                    Family Not Found!!.
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
                            <span class="text-white mobile-title" style="font-size : 20px">Add Family
                                Details</span>
                        </div>
                        <div class=" col-md-2 col-2">
                            <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="addFamily" action="<?php echo base_url() ?>addFamily" method="post"
                            role="form">
                            <!-- Default Light Table -->
                            <div class="row form-contents">
                                <div class="col-lg-12  padding_left_right_null">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="fname">Select Family Head*</label>
                                                    <select class="form-control required selectpicker"
                                                        data-live-search="true" id="family" name="family_head_id"
                                                        required>
                                                        <option value="">Select Name</option>
                                                        <?php if(!empty($devoteeInfo)){ 
                                                                        foreach ($devoteeInfo as $devt) { ?>
                                                        <option value="<?php echo $devt->row_id ?>">
                                                            <?php echo $devt->devotee_name ?></option>
                                                        <?php } 
                                                                    } ?>
                                                    </select>
                                                </div>
                                                <!-- <div class="col-lg-6 col-12">
                        <div class="form-group required">
                            <label for="subscription_amount">Subscription Amount</label>
                            <select class="form-control " id="subscription_amount" name="subscription_amount" required>
                                <option value=""> Select Subscription Amount 
                                    </option>
                                    <?php if(!empty($subscriptionInfo)) {
                                        foreach($subscriptionInfo as $sub ){?>
                                <option value="<?php echo $sub->row_id;?>"><?php echo $sub->amount;?></option>
                                <?php }}?>
                            </select>
                        </div>
                    </div> -->
                                            </div>
                                            <!-- <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="mobile">Previous Place of Worship(Name & Address)
                                                    </label>
                                                    <textarea class="form-control required" id="previous_mosque"
                                                        value="<?php echo set_value('previous_mosque'); ?>"
                                                        name="previous_mosque"
                                                        placeholder="Enter Details"
                                                        autocomplete="off"></textarea>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="fname">Select Reference Committee Person</label>
                                                    <select class="form-control required selectpicker"
                                                        data-live-search="true" id="family" name="committee_referer">
                                                        <option value="">Select Referer</option>
                                                        <?php if(!empty($committeeInfo)){ 
                                                                        foreach ($committeeInfo as $cmt) { ?>
                                                        <option value="<?php echo $cmt->row_id ?>">
                                                            <?php echo $cmt->committee_name ?></option>
                                                        <?php } 
                                                                    } ?>
                                                    </select>
                                                </div>
                                            </div> -->

                                            <div class="form-row">
                                                <div class="col-10">
                                                    <label for="role">Add Family Member</label>
                                                </div>
                                                <div class="col-2 text-right mb-1">
                                                    <input type="button" class="btn btn-primary" id="btnClone"
                                                        value="+Add member" />
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <select name="" id="ddlMember"
                                                        class="form-control selectpicker" data-live-search="true">
                                                        <option value="">Select Member</option>
                                                        <?php if(!empty($devoteeInfo)){ 
                                                                                foreach ($devoteeInfo as $devt) { ?>
                                                        <option value="<?php echo $devt->row_id.'/'.$devt->devotee_name ?>">
                                                            <?php echo $devt->devotee_name ?>
                                                        </option>
                                                        <?php } 
                                                                                } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <select class="form-control selectpicker" data-live-search="true"
                                                        id="ddlRelation" name="">
                                                        <option value="">Select Relation
                                                        </option>
                                                        <?php if(!empty($relationInfo)){ 
                                                                                foreach ($relationInfo as $rel) { ?>
                                                        <option value="<?php echo $rel->row_id.'/'.$rel->relation_name ?>">
                                                            <?php echo $rel->relation_name ?>
                                                        </option>
                                                        <?php } 
                                                                                } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <table class="col-12 ml-2 mr-4 table-bordered text-center" id="addMember">
                                                    <tr><th>Name</th>
                                                    <th>Relation</th>
                                                <th>Action</th></tr>
                                                </table>
                                            </div>
                                           
                                            
                                            <!-- <div class="text-right m-2">
                                                <input type="button" class="btn btn-primary" id="btnClone"
                                                    value="+Add Member" />
                                            </div> -->
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary mt-2"
                                                OnClientClick="Validate();">Submit</button>
                                            </div>
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

    <!--Subscription Model--->
    <div id="subscription" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header modal-call-report p-2">
                    <div class=" col-md-10 col-10">
                        <span class="text-white mobile-title" style="font-size : 20px">Subscription
                            Details</span>
                    </div>
                    <div class=" col-md-2 col-2">
                        <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body m-0">
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addSubscription" action="<?php echo base_url() ?>addSubscription"
                        method="post" role="form">
                        <input type="hidden" name="family_id" id="family_id" value="" />
                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <div class="form-group">
                                    <label for="committee_name">Subscription Amount</label>
                                    <input type="text" class="form-control " id="subscription_amt"
                                        name="subscription_amount" value="" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="form-group">
                                    <label for="contact_number_two">Month</label>
                                    <select class="form-control selectpicker" data-live-search="true" id=""
                                        name="subscription_month" required>
                                        <option value="">Select</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label for="subscription_year"> Year</label>
                                <select class="form-control " id="year" name="subscription_year" required>
                                    <option value=""> Select
                                    </option>
                                    <?php if(!empty($subscription_year)) {
                                        foreach($subscription_year as $year ){?>
                                    <option value="<?php echo $year->row_id;?>"><?php echo $year->year;?>
                                    </option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>

                        </div>
                        <div class="form-group">
                            <input style="float:right;" type="submit" class="btn btn-primary" value="Add" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----End Subscription Model-->
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/family/deleteFamily.js" charset="utf-8">
</script>
<script type="text/javascript">
$(document).ready(function() {
    //change selectboxes to selectize mode to be searchable
    $(".select").select2();
});
var i=0;
$(function() {
    $("#btnClone").bind("click", function() {
        var ddl1 = $("#ddlMember option:selected").val();
        var ddl2 = $("#ddlRelation option:selected").val();

        var arr = ddl1.split('/');
        var arr1 = ddl2.split('/');
        i++;
        $('#addMember').append('<tr id="row'+i+'"><td><input type="hidden" name="familyMember[]" value="'+arr[0]+'"/>'+arr[1]+'</td><td><input type="hidden" name="relation[]" value="'+arr1[0]+'"/>'+arr1[1]+'</td><td><button type="button" name="remove" id="'+i+'" class="btn-sm btn-danger btn_remove">X</button></td></tr>');

    });
});
$(document).on('click','.btn_remove',function(){
    var btn_id = $(this).attr('id');
    $('#row'+btn_id).remove();
});

$(document).on("click", ".add", function() {
    // var n = $('.inv_row').length + 1;
    var temp = $('.inv_row:last').clone()
    // temp.find('select').val('');
    // $('input:first', temp).attr('value', '');
    $('.inv_row:last').after(temp);

});

$(document).on("click", ".sub", function() {
    var n = $('.inv_row').length;
    if (n > 1) {
        $('.inv_row:last').remove();
    }
});

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
        jQuery("#searchList").attr("action", baseURL + "familyListing/" + value);
        jQuery("#searchList").submit();
    });
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#byFilterMethod").attr("action", baseURL + "familyListing/" + value);
        jQuery("#byFilterMethod").submit();
    });
    jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
    });
});

function openModel(family_id, subscription_amt) {

    $('#family_id').val(family_id);
    $('#subscription_amt').val(subscription_amt);
    $('#subscription').modal('show');
}
</script>