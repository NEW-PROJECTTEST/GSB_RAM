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
                            <div class="col-lg-6 text-white ">Edit Family Info</div>
                            <div class="col-lg-6 "> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck pull-right mobile-bck "><i
                                        class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- form start -->
        <form role="form" id="editDevotee" action="<?php echo base_url() ?>updateFamily" method="post" role="form"
            enctype="multipart/form-data">
            <!-- Default Light Table -->
            <div class="row form-contents">
                <div class="col-lg-12  padding_left_right_null">
                    <div class="row">
                        <div class="col">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="hidden" name="row_id" value="<?php echo $familyInfo->row_id; ?>">
                                    <label for="fname">Select Family Head</label>
                                    <select class="form-control required selectpicker" data-live-search="true"
                                        id="family" name="family_head_id">
                                        <option value="<?php echo $familyInfo->devotee_id; ?>">
                                            Selected:<?php echo $familyInfo->devotee_name; ?></option>
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
                                <option value="<?php echo $familyInfo->subscription_amt_id; ?>"> Selected:<?php echo $familyInfo->amount; ?>
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
                                    <label for="mobile">Previous Temple(Name & Address)
                                    </label>
                                    <textarea class="form-control" id="previous_mosque" value=""
                                        name="previous_mosque"
                                        autocomplete="off"><?php echo $familyInfo->previous_mosque; ?></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fname">Select Reference Committee Person</label>
                                    <select class="form-control selectpicker" data-live-search="true"
                                        id="family" name="committee_referer">
                                        <?php if(!empty($familyInfo->committee_name)){ ?>
                                        <option value="<?php echo $familyInfo->committee_id;?>">
                                            Selected:<?php echo $familyInfo->committee_name;?></option>
                                            <?php }?>
                                        <option value="">Select</option>
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
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Relation</th>
                                                        <th>Action</th>
                                                    </tr>
                                                   
                                                    <?php  $i=0; if(!empty($familyMemberInfo)){
                                                    foreach($familyMemberInfo as $member){ ?>
                                                        <!-- <tr> -->
                                                        <tr id="row<?php echo $i?>">
                                                            <td><input type="hidden" name="familyMember[]" value="<?php echo $member->row_id ?>"/><?php echo $member->devotee_name ?></td>
                                                            <td><input type="hidden" name="relation[]" value="<?php echo $member->relation_id?>"/><?php echo $member->relation_name?></td>
                                                            <td><button type="button" name="remove" id="<?php echo $i ?>" class="btn-sm btn-danger btn_remove">X</button></td>
                                                        </tr>
                                                    <?php $i++; } } ?>
                                                </table>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary mt-2"
                                                OnClientClick="Validate();">Submit</button>
                                            </div>
                            <!-- <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="role">Add Family Member</label>
                                    <input type="button" class="btn btn-primary" id="btnClone" value="Add" />
                                </div>
                            </div>
                            <?php if(!empty($familyMemberInfo)){
                                foreach($familyMemberInfo as $member){ ?>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <select name="familyMember[]" class="form-control select1" id="ddlMember"
                                        data-live-search="true">
                                        <option value="<?php echo $member->row_id ?>">
                                            Selected:<?php echo $member->devotee_name ?></option>
                                            <option value="">SELECT</option>
                                        <?php if(!empty($devoteeInfo)){ 
                                                                                foreach ($devoteeInfo as $devt) { ?>
                                        <option value="<?php echo $devt->row_id ?>">
                                            <?php echo $devt->devotee_name ?>
                                        </option>
                                        <?php } 
                                                                                } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <select class="form-control select1" data-live-search="true" id="ddlRelation"
                                        name="relation[]">
                                        <option value="<?php echo $member->relation_id?>">
                                            Selected:<?php echo $member->relation_name?>
                                        </option>
                                        <option value="">SELECT</option>
                                        <?php if(!empty($relationInfo)){ 
                                                                                foreach ($relationInfo as $rel) { ?>
                                        <option value="<?php echo $rel->row_id ?>">
                                            <?php echo $rel->relation_name ?>
                                        </option>
                                        <?php } 
                                                                                } ?>
                                    </select>
                                </div>
                            </div>
                            <?php } }
                            ?> -->
                            <!-- <button type="submit" class="btn btn-primary" OnClientClick="Validate();">Update</button> -->
                        </div>
                    </div>

                </div>
            </div>
        </form> <!-- form end -->
        <!-- End Default Light Table -->
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/devotee/editDevotee.js" type="text/javascript"></script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = '<?php echo base_url(); ?>/familyListing';
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
var i=<?= $i ?>;
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

</script>