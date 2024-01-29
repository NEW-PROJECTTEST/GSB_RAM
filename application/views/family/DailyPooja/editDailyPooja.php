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
                            <div class="col-md-5 col-8 text-white m-auto ">Edit DailyPooja Details</div>
                            <div class=" col-md-5 col-4 m-auto "> <span class="mobile-right ">ID
                                    :<?php echo $dpInfo->row_id;?></span></div>
                            <div class="col-md-2 col-12 m-auto"> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck float-right mobile-btn mobile-bck"><i
                                        class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                    <div class="card-body contents-body ">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="addCommittee" action="<?php echo base_url() ?>updateDailyPooja"
                            method="post" role="form" enctype="multipart/form-data">
                            <!-- <div class="row form-contents"> -->
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="devotee_id">Seva By*</label>
                                        <select class="form-control " id="devotee_id" name="devotee_id" required>
                                            <!-- <option value=""> Select Devotee </option> -->
                                            <option value="<?php echo $dpInfo->devotee_id?>">
                                                Selected :<?php echo $dpInfo->devotee_name?>
                                                <?php if(!empty($poojaInfo)) {
                                        foreach($poojaInfo as $role ){?>
                                            <option value="<?php echo $role->row_id;?>">
                                                <?php echo $role->devotee_name;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" value="<?php echo $dpInfo->row_id;?>" name="row_id" id="row_id" />
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="event_type">Event Type*</label>
                                        <select class="form-control " onchange="changeStatus()" id="event_type"
                                            name="event_type" required>
                                            <!-- <option value="">Select Event Type</option> -->
                                            <option value="<?php echo $dpInfo->event_type?>">
                                                Selected :<?php echo $dpInfo->event_type?>
                                            <option value="Date">Date</option>
                                            <!-- <option value="Event">Event</option>
                                                <option value="Tithi">Tithi</option>
                                                <option value="Nakshathra">Nakshathra</option>
                                                <option value="Masa">Masa</option>
                                                <option value="Rashi">Rashi</option> -->
                                            <option value="Panchanga">Panchanga</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 col-12 event_date_only">
                                    <div class="form-group">
                                        <label for="date">Date*</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span
                                                    class="input-group-text material-icons date-icon">date_range</span>
                                                <input id="date" type="text" name="date"
                                                    value="<?php  if($dpInfo->date=='1970-01-01'){echo $dpInfo->date='';} else { echo date('d-m-Y',strtotime($dpInfo->date));}?>"
                                                    class="form-control datepicker date-col-3 required"
                                                    placeholder="Select Date" autocomplete="off" />


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="Event ss col-12" id="dpevent">
                            <div class="form-group">
                                <label for="event_id">Event*</label>
                                <select class="form-control " id="event_id" name="event_id" >
                                     <option value=""> Select Event </option> 
                                    <option value="<?php echo $dpInfo->event_id?>">
                                                            Selected :<?php echo $dpInfo->events?>
                                    <?php if(!empty($eventInfo)) {
                                        foreach($eventInfo as $event ){?>
                                        <option value="<?php echo $event->row_id;?>">
                                        <?php echo $event->events;?></option>
                                        <?php }}?>
                                    </select>
                                </div>
                            </div> -->

                                <div class="col-lg-6 col-12 event_panchanga">
                                    <div class="form-group">
                                        <label for="tithi_id">Tithi*</label>
                                        <select class="form-control " id="tithi_id" name="tithi_id">
                                            <!-- <option value=""> Select Tithi </option> -->
                                            <option value="<?php echo $dpInfo->tithi_id?>">
                                                Selected :<?php echo $dpInfo->tithi?>
                                                <?php if(!empty($tithiInfo)) {
                                        foreach($tithiInfo as $tithi ){?>
                                            <option value="<?php echo $tithi->row_id;?>">
                                                <?php echo $tithi->tithi;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 event_date">
                                    <div class="form-group">
                                        <label for="nakshathra_id">Nakshathra*</label>
                                        <select class="form-control " id="nakshathra_id" name="nakshathra_id">
                                            <!-- <option value=""> Select Nakshathra </option> -->
                                            <option value="<?php echo $dpInfo->nakshathra_id?>">
                                                Selected :<?php echo $dpInfo->nakshathra?>
                                                <?php if(!empty($nakshathraInfo)) {
                                        foreach($nakshathraInfo as $nakshathra ){?>
                                            <option value="<?php echo $nakshathra->row_id;?>">
                                                <?php echo $nakshathra->nakshathra;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 event_panchanga" id="dpmasa">
                                    <div class="form-group">
                                        <label for="masa_id">Masa*</label>
                                        <select class="form-control " id="masa_id" name="masa_id">
                                            <!-- <option value=""> Select Masa </option> -->
                                            <option value="<?php echo $dpInfo->masa_id?>">
                                                Selected :<?php echo $dpInfo->masa?>
                                                <?php if(!empty($masaInfo)) {
                                        foreach($masaInfo as $masa ){?>
                                            <option value="<?php echo $masa->row_id;?>">
                                                <?php echo $masa->masa;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 event_date" id="dprashi">
                                    <div class="form-group">
                                        <label for="rashi_id">Rashi*</label>
                                        <select class="form-control " id="rashi_id" name="rashi_id">
                                            <!-- <option value=""> Select Rashi </option> -->
                                            <option value="<?php echo $dpInfo->rashi_id?>">
                                                Selected :<?php echo $dpInfo->rashi?>
                                                <?php if(!empty($rashiInfo)) {
                                        foreach($rashiInfo as $rashi){?>
                                            <option value="<?php echo $rashi->row_id;?>">
                                                <?php echo $rashi->rashi;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 event_date" id="dpgothra">
                                    <div class="form-group">
                                        <label for="gothra_id">Gothra*</label>
                                        <select class="form-control " id="gothra_id" name="gothra_id">
                                            <!-- <option value=""> Select Gothra </option> -->
                                            <option value="<?php echo $dpInfo->gothra_id?>">
                                                Selected :<?php echo $dpInfo->gothra?>
                                                <?php if(!empty($gothraInfo)) {
                                        foreach($gothraInfo as $gothra ){?>
                                            <option value="<?php echo $gothra->row_id;?>">
                                                <?php echo $gothra->gothra;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 event_date">
                                    <div class="form-group">
                                        <label for="occation_id">Occasion*</label>
                                        <select class="form-control " id="occation_id" name="occation_id" required>
                                            <option value="<?php echo $dpInfo->occation_id?>">
                                                Selected :<?php echo $dpInfo->occation?>
                                                <?php if(!empty($occationInfo)) {
                                        foreach($occationInfo as $occation ){?>
                                            <option value="<?php echo $occation->row_id;?>">
                                                <?php echo $occation->occation;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-6 col-12 event_panchanga">
                                    <div class="form-group">
                                        <label for="paksha_id">Paksha*</label>
                                        <select class="form-control " id="paksha_id" name="paksha_id">
                                            <option value="<?php echo $dpInfo->paksha_id?>">
                                                Selected :<?php echo $dpInfo->paksha?>
                                                <?php if(!empty($pakshaInfo)) {
                                        foreach($pakshaInfo as $paksha ){?>
                                            <option value="<?php echo $paksha->row_id;?>">
                                                <?php echo $paksha->paksha;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="amount">Amount*</label>
                                        <select class="form-control " id="amount" name="amount" required>
                                            <!-- <option value=""> Select Devotee </option> -->
                                            <option value="<?php echo $dpInfo->amount?>">
                                                Selected :<?php echo $dpInfo->amount?>
                                                <?php if(!empty($subscriptionInfo)) {
                                        foreach($subscriptionInfo as $sub ){?>
                                            <option value="<?php echo $sub->amount;?>">
                                                <?php echo $sub->amount;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label for="role">Remarks</label>
                                        <textarea class="form-control required" value="<?php echo $dpInfo->remarks?>" name="remarks" id="remarks"
                                            rows="4" placeholder="Remarks" autocomplete="off"><?php echo $dpInfo->remarks?></textarea>
                                    </div>
                                </div>

                            </div>

                            <!-- <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="amount">Amount*</label>
                                    <input type="text" class="form-control " id="amount" value = "<?php echo $dpInfo->amount ?>"
                                     name="amount" placeholder="Enter Amount"
                                     onkeypress="return isNumberKey(event)" autocomplete="off"
                                     required>
                                   </div>
                                </div> -->

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
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/committee/committee.js" charset="utf-8"> -->
</script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = '<?php echo base_url(); ?>/DailyPoojaListing';
        /* OR */
        //location.replace(document.referrer);
    } else {
        window.history.back();
    }
}

// function changeStatus(){
//     //document.getElementById("booktype").style.visibility="hidden";
//     var status = document.getElementById("event_type");

//     if(status.value=="Date"){
//         document.getElementById("dpdate").style.visibility="visible";

//     }else{
//         document.getElementById("dpdate").style.visibility="hidden";
//     }
//     if(status.value=="Event"){
//         document.getElementById("dpevent").style.visibility="visible";

//     }else{
//         document.getElementById("dpevent").style.visibility="hidden";
//     }
//     if(status.value=="Tithi"){
//         document.getElementById("dptithi").style.visibility="visible";

//     }else{
//         document.getElementById("dptithi").style.visibility="hidden";
//     }
//     if(status.value=="Nakshathra"){
//         document.getElementById("dpnakshathra").style.visibility="visible";

//     }else{
//         document.getElementById("dpnakshathra").style.visibility="hidden";
//     }
//     if(status.value=="Masa"){
//         document.getElementById("dpmasa").style.visibility="visible";

//     }else{
//         document.getElementById("dpmasa").style.visibility="hidden";
//     }
//     if(status.value=="Rashi"){
//         document.getElementById("dprashi").style.visibility="visible";

//     }else{
//         document.getElementById("dprashi").style.visibility="hidden";
//     }
//     if(status.value=="Gothra"){
//         document.getElementById("dpgothra").style.visibility="visible";

//     }else{
//         document.getElementById("dpgothra").style.visibility="hidden";
//     }
// }

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

$(document).ready(function() {
    // $('.event_date').hide();
    // $('.event_panchanga').hide();

    event_type = $('#event_type').val();
    if (event_type == 'Date') {
        $('.event_date').show();
        $('.event_date_only').show();
        $('.event_panchanga').hide();
        $("#date").prop('required', true);
        $("#paksha_id").prop('required', false);
        $("#masa_id").prop('required', false);
        $("#tithi_id").prop('required', false);
    } else {
        $('.event_date').show();
        $('.event_date_only').hide();
        $("#date").prop('required', false);
        $('.event_panchanga').show();
        $("#paksha_id").prop('required', true);
        $("#masa_id").prop('required', true);
        $("#tithi_id").prop('required', true);
    }

    $("#event_type").change(function() {
        event_type = $('#event_type').val();
        if (event_type == 'Date') {
            $('.event_date').show();
            $('.event_panchanga').hide();
            $('.event_date_only').show();
            $("#date").prop('required', true);
            $("#paksha_id").prop('required', false);
            $("#masa_id").prop('required', false);
            $("#tithi_id").prop('required', false);
        } else {
            $('.event_date').show();
            $('.event_date_only').hide();
            $('.event_panchanga').show();
            $("#date").prop('required', false);
            $("#paksha_id").prop('required', true);
            $("#masa_id").prop('required', true);
            $("#tithi_id").prop('required', true);
        }
    });

});
</script>