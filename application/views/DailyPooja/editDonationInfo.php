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
                            <div class="col-md-5 col-8 text-white m-auto ">Edit Donation Details</div>
                            <div class=" col-md-5 col-4 m-auto "> <span class="mobile-right ">
                                </span></div>
                            <div class="col-md-2 col-12 m-auto"> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck float-right mobile-btn mobile-bck"><i
                                        class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                    <div class="card-body contents-body ">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="addCommittee" action="<?php echo base_url() ?>updateDonationDetails"
                            method="post" role="form" enctype="multipart/form-data">
                            <input type="hidden" id="donation_id" name="row_id" value="<?php echo $donationInfo->row_id ?>">
                            <!-- <div class="row form-contents"> -->
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="purpose">Collected By*</label>
                                        <select class="form-control selectpicker" id="committee_name"
                                            name="committee_name" data-live-search="true" required>
                                            <?php if(!empty($donationInfo->name)){ ?>
                                            <option value="<?php echo $donationInfo->committee_id ?>" selected>
                                                Selected: <?php echo $donationInfo->name ?></option>
                                            <?php } else { ?>
                                            <option value=""> Select</option>
                                            <?php } ?>
                                            <?php if(!empty($committeeInfo)) {
                                                             foreach($committeeInfo as $role ){?>
                                            <option value="<?php echo $role->row_id;?>">
                                                <?php echo $role->type;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="fname">Devotee Name*</label>
                                        <input class="form-control is-valid mobile-width " type="text"
                                            name="devotee_name" id="devotee_name"
                                            value="<?php echo $donationInfo->devotee_name ?>"
                                            onkeydown="return alphaOnly(event)"
                                            class="form-control input-sm pull-right " style="text-transform: uppercase"
                                            placeholder="Devotee Name" autocomplete="off" required>
                                    </div>
                                </div>
                            
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="fname">Date</label>

                                        <input id="dob" type="text" name="in_date"
                                            class="form-control datepicker date-col-3" placeholder="Date"
                                            value="<?php echo date('d-m-Y',strtotime($donationInfo->date)) ?>"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="purpose">Select Donation/ Seva*</label>
                                        <select class="form-control" id="donation_type" name="donation_type" required>
                                            <?php if(!empty($donationInfo->donation_type)){ ?>
                                            <option value="<?php echo $donationInfo->donation_type ?>" selected>
                                                Selected:
                                                <?php echo $donationInfo->donation_type ?></option>
                                            <?php } else { ?>
                                            <option value=""> Select Seva </option>
                                            <?php } ?>
                                            <option value="DONATION">DONATION</option>
                                            <option value="SEVA">SEVA</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 donation_display">
                                    <div class="form-group">
                                        <label for="purpose">Donation Type*</label>
                                        <select class="form-control selectpicker" id="type_of_donation"
                                            name="type_of_donation" data-live-search="true">
                                            <?php if(!empty($donationInfo->type_of_donation)){ ?>
                                            <option value="<?php echo $donationInfo->type_of_donation ?>" selected>
                                                Selected: <?php echo $donationInfo->type_of_donation ?></option>
                                            <?php } else { ?>
                                            <option value=""> Select</option>
                                            <?php } ?>
                                            <?php if(!empty($donationTypeInfo)) {
                                                             foreach($donationTypeInfo as $type){?>
                                            <option value="<?php echo $type->donation_type;?>">
                                                <?php echo $type->donation_type;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 seva_display">
                                    <div class="form-group">
                                        <label for="purpose">Seva*</label>
                                        <select class="form-control selectpicker" id="seva_name" name="seva_name[]"
                                            required data-live-search="true" multiple>
                                            <?php if(!empty($donationInfo->seva_name)){ ?>
                                            <option value="" selected> <?php echo $donationInfo->seva_name ?> - <?php echo $donationInfo->amount ?>Rs</option>
                                            <?php } else { ?>
                                            <option value=""> Select Seva </option>
                                            <?php } ?>
                                            <?php if(!empty($sevaInfo)) {
                                                             foreach($sevaInfo as $role ){?>
                                            <option value="<?php echo $role->row_id;?>">
                                                <?php echo $role->seva_name;?> - <?php echo $role->amount;?>Rs</option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group col-md-6 donation_display">
                                    <label for="fname">Donation Amount*</label>
                                    <input class="form-control is-valid mobile-width " type="text"
                                        onkeypress="return isNumberKey(event)" name="donation_amount"
                                        id="donation_amount" value="<?php echo $donationInfo->amount;?>" class="form-control input-sm pull-right "
                                        style="text-transform: uppercase" placeholder="Donation Amount"
                                        autocomplete="off">
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="purpose">Purpose*</label>
                                        <select class="form-control selectpicker" id="purpose" name="purpose" required
                                            data-live-search="true">
                                            <?php if(!empty($donationInfo->purpose)){ ?>
                                            <option value="<?php echo $donationInfo->purpose ?>"> Selected:
                                                <?php echo $donationInfo->purpose_name ?></option>
                                            <?php } else { ?>
                                            <option value=""> Select Purpose </option>
                                            <?php } ?>
                                            <?php if(!empty($purposeInfo)) {
                                                             foreach($purposeInfo as $role ){?>
                                            <option value="<?php echo $role->row_id;?>">
                                                <?php echo $role->purpose_name;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="fname">Mobile Number</label>
                                        <input class="form-control is-valid mobile-width " type="text"
                                            onkeypress="return isNumberKey(event)" name="mobile_number"
                                            id="mobile_number" value="<?php echo $donationInfo->mobile_number;?>"
                                            class="form-control input-sm pull-right" minlength="10" maxlength="10"
                                            style="text-transform: uppercase" placeholder="Mobile Number"
                                            autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="purpose">Payment Type*</label>
                                        <select class="form-control " id="payment_type" name="payment_type" required>
                                            <?php if(!empty($donationInfo->payment_type)){ ?>
                                            <option value="<?php echo $donationInfo->payment_type ?>" selected>
                                                Selected: <?php echo $donationInfo->payment_type ?></option>
                                            <?php } else { ?>
                                            <option value="">Select payment Type</option>
                                            <?php } ?>
                                            <option value="CASH">CASH</option>
                                            <option value="BANK">BANK</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 reference_number">
                                    <div class="form-group">
                                        <label for="fname">Reference Number</label>
                                        <input class="form-control is-valid mobile-width " type="text"
                                            name="reference_number" id="reference_number"
                                            value="<?php echo $donationInfo->reference_number;?>"
                                            class="form-control input-sm pull-right" style="text-transform: uppercase"
                                            placeholder="Reference Number" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="fname">Email</label>
                                    <input class="form-control is-valid mobile-width " type="email" name="email"
                                        id="email" value="<?php echo $donationInfo->email;?>"
                                        class="form-control input-sm pull-right" style="text-transform: uppercase"
                                        placeholder="Email" autocomplete="off">
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="role">Address</label>
                                        <textarea class="form-control" value="<?php echo $donationInfo->address;?>"
                                            name="devotee_address" id="devotee_address" rows="4" placeholder="Address"
                                            autocomplete="off"><?php echo $donationInfo->address;?></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="role">Note</label>
                                        <textarea class="form-control" value="<?php echo $donationInfo->note;?>"
                                            name="note" id="note" rows="4" placeholder="Note"
                                            autocomplete="off"><?php echo $donationInfo->note;?></textarea>
                                    </div>
                                </div>


                            </div>


                            <!-- Modal footer -->
                            <div class="form-group">
                                <button type="submit" style="float:right;" class="btn btn-primary mr-1">Update</button>
                            </div>
                            <!-- </div> -->
                            <!-- </div> -->
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
        window.location = '<?php echo base_url(); ?>/donationListing';
        /* OR */
        //location.replace(document.referrer);
    } else {
        window.history.back();
    }
}

$("#payment_type").change(function() {
    payment_type = $('#payment_type').val();
    if (payment_type == 'BANK') {
        $('.reference_number').show();
    } else {
        $('.reference_number').hide();
    }
});

$("#donation_type").change(function() {
        donation_type = $('#donation_type').val();
        if (donation_type == 'DONATION') {
            $('.donation_display').show();
            $('.seva_display').hide();
            $('#donation_amount').prop('required',true);
            $('#seva_name').prop('required',false);
            $('#type_of_donation').prop('required',true);
        } else {
            $('.donation_display').hide();
            $('.seva_display').show();  
            $('#seva_name').prop('required',true); 
            $('#donation_amount').prop('required',false);  
            $('#type_of_donation').prop('required',false);  
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

function blockSpecialChar(e) {
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
}
jQuery(document).ready(function() {
    donation_id = $('#donation_id').val();

    $.ajax({
        url: '<?php echo base_url(); ?>/getSevaInfoByDonationId',
        type: 'POST',
        data: {
            donation_id: donation_id
        },
        success: function(data) {
            var sevaInfo = JSON.parse(data);
            for (let i = 0; i < sevaInfo.sevaIdArray.length; i++) {
                $("#seva_name option[value= '" + sevaInfo.sevaIdArray[i] + "']").prop("selected",true);
            }
            
        },
        error: function(result) {
            alert("Retry Again! Something Went Wrong");
        },
        fail: (function(status) {
            alert("Retry Again! Something Went Wrong");
        }),
        beforeSend: function(d) {
        }
    });



        $('.selectpicker').selectpicker('refresh');

        donation_type = $('#donation_type').val();
        if (donation_type == 'DONATION') {
            $('.donation_display').show();
            $('.seva_display').hide();
            $('#donation_amount').prop('required',true);
            $('#seva_name').prop('required',false);
            $('#type_of_donation').prop('required',true);
        } else {
            $('.donation_display').hide();
            $('.seva_display').show();  
            $('#seva_name').prop('required',true); 
            $('#donation_amount').prop('required',false);    
            $('#type_of_donation').prop('required',false);
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
    jQuery('.datepicker').datepicker({
        autoclose: true,
        orientation: "bottom",
        format: "dd-mm-yyyy"
    });
});


payment_types = $('#payment_type').val();
if (payment_types == 'BANK') {
    $('.reference_number').show();
} else {
    $('.reference_number').hide();
}


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