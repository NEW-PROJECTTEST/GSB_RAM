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
                            <div class="col-lg-6 text-white ">Income Management</div>
                            <div class="col-lg-6 "> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck pull-right mobile-bck "><i
                                        class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>

                    <!-- form start -->
                    <div class="card-body contents-body ">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="updateIncome" action="<?php echo base_url() ?>updateIncome"
                        method="post" role="form">
                        <input type="hidden" name="row_id" id="row_id" value="<?php echo $incomeInfo->row_id?>" />
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="income_name">Name*</label>
                                    <input type="text" class="form-control " id="income_name" value="<?php echo $incomeInfo->income_name?>"
                                        name="income_name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="income_type"> Income Type</label>
                                <select class="form-control " data-live-search="true" id="type_income" name="income_type">
                                    <option value="<?php echo $incomeInfo->income_type_id?>"> Selected:<?php echo $incomeInfo->income_type?> </option>
                                    <?php if(!empty($income_type)) {
                                        foreach($income_type as $type ){?>
                                    <option value="<?php echo $type->row_id;?>"><?php echo $type->income_type;?>
                                    </option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="income_by">Income By*</label>
                                    <select class="form-control" data-live-search="true" id="income_type_update"
                                        name="income_by" required>
                                        <option value="<?php echo $incomeInfo->income_by?>">Selected : <?php echo $incomeInfo->income_by?> </option>
                                        <option value="Devotee">Devotee</option>
                                        <option value="Commitee">Committee</option>
                                        <option value="Other">Other</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12" id="committe_type_update">
                                        <div class="form-group" >
                                            <label for="committee_rowid">Select Committee</label>
                                            <select name="committee_rowid" id="committee_rowid"
                                                class="form-control selectpicker " data-live-search="true">
                                                <option value="<?php echo $incomeInfo->committee_id?>">Selected: <?php echo $incomeInfo->committee_name?></option>
                                                <?php if(!empty($committeInfo))
                                                        { foreach ($committeInfo as $c1)
                                                            { ?>
                                                <option value="<?php echo $c1->row_id ?>">
                                                    <?php echo $c1->committee_name ?></option>
                                                <?php   } 
                                          } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12" id="devotee_type_update">
                                        <div class="form-group" >
                                            <label for="devotee_rowid">Select Devotee</label>
                                            <select name="devotee_rowid" id="devotee_rowid"
                                                class="form-control selectpicker required " data-live-search="true">
                                                <option value="<?php echo $incomeInfo->devoote_id?>">Selected:<?php echo $incomeInfo->devotee_name?></option>
                                                <?php if(!empty($devoteeInfo))
                                                        { foreach ($devoteeInfo as $d1)
                                                            { ?>
                                                <option value="<?php echo $d1->row_id ?>">
                                                     <?php echo $d1->devotee_name ; ?><!--.'(Bal: '.$b1->account_balance.')' -->
                                                </option>
                                                <?php   } 
                                          } ?>
                                            </select>
                                        </div>
                                    </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="income_date">Income Date</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text material-icons date-icon">date_range</span>
                                            <input id="income_date" type="text" name="income_date" value="<?php  if($incomeInfo->income_date=='1970-01-01'){echo $incomeInfo->income_date='';} else { echo date('d-m-Y',strtotime($incomeInfo->income_date));}?>"
                                                class="form-control datepicker date-col-3 required "
                                                placeholder="Income Date" autocomplete="off"  />
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="amount">Amount*</label>
                                    <input type="text" class="form-control " id="amount" value="<?php echo $incomeInfo->amount?>"
                                        name="amount" autocomplete="off" onkeypress="return isNumberKey(event)" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="comments">Comments</label>
                                            <textarea class="form-control " name="comment" id="comments" rows="2"
                                                placeholder="Comments" autocomplete="off"><?php echo $incomeInfo->comment?></textarea>
                                        </div>
                                    </div>


                        </div>
                        <div class="form-group">
                            <input style="float:right;" type="submit" class="btn btn-primary" value="Update" />
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
        window.location = '<?php echo base_url(); ?>/incomeListing';
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
    $("#devotee_type_update").hide();
    $("#committe_type_update").hide();

    var income_by = $("#income_type_update").val();
    if(income_by=='Devotee'){
        $("#devotee_type_update").show();
    }else if(income_by=='Commitee'){
        $("#committe_type_update").show();
    }
    
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


$("#income_type_update").change(function() {
    if (this.value == 'Commitee') {
        $("#devotee_type_update").hide();
        $("#committe_type_update").show();
        $('#devotee_rowid').val(0);
    } else if (this.value == 'Devotee') {
        $("#devotee_type_update").show();
        $("#committe_type_update").hide();
        $('#committee_rowid').val(0);
    } else if (this.value == 'Other') {
        $("#committe_type_update").hide();
        $("#devotee_type_update").hide();
        $('#devotee_rowid').val(0);
        $('#committee_rowid').val(0);

    }


});
</script>