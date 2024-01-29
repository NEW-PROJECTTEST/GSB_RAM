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
                            <div class="col-md-5 col-8 text-white m-auto ">Edit Today's Details</div>
                            <div class=" col-md-5 col-4 m-auto "> <span class="mobile-right ">ID
                                    :<?php echo $Details->row_id;?></span></div>
                            <div class="col-md-2 col-12 m-auto"> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck float-right mobile-btn mobile-bck"><i
                                        class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                    <div class="card-body contents-body ">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="" action="<?php echo base_url() ?>updateDailyDetails"
                            method="post" role="form" enctype="multipart/form-data">
                            <!-- <div class="row form-contents"> -->
                            <div class="row">
                            <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="">Date</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-append">
                                                    <span
                                                        class="input-group-text material-icons date-icon">date_range</span>
                                                    <input id="date" type="text" name="date" value="<?php  if($Details->date=='1970-01-01'){echo $Details->date='';} else { echo date('d-m-Y',strtotime($Details->date));}?>"
                                                        class="form-control datepicker date-col-12"
                                                        placeholder="Date of Birth" autocomplete="off" >
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                <label for="event_id">Event</label>
                                <select class="form-control selectpicker" id="event_id" name="event_id" data-live-search="true">
                                    <!-- <option value=""> Select Event </option> -->
                                    <option value="<?php echo $Details->event_id?>">
                                                            Selected :<?php echo $Details->events?>
                                    <?php if(!empty($eventInfo)) {
                                        foreach($eventInfo as $event ){?>
                                        <option value="<?php echo $event->row_id;?>">
                                        <?php echo $event->events;?></option>
                                        <?php }}?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" value="<?php echo $Details->row_id;?>"
                                                        name="row_id" id="row_id" />
                            <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="tithi_id">Tithi</label>
                                <select class="form-control selectpicker" id="tithi_id" name="tithi_id" required data-live-search="true">
                                    <!-- <option value=""> Select Tithi </option> -->
                                    <option value="<?php echo $Details->tithi_id?>">
                                                            Selected :<?php echo $Details->tithi?>
                                    <?php if(!empty($tithiInfo)) {
                                        foreach($tithiInfo as $tithi ){?>
                                        <option value="<?php echo $tithi->row_id;?>">
                                        <?php echo $tithi->tithi;?></option>
                                        <?php }}?>
                                    </select>
                                </div>
                            </div>
                                <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="nakshathra_id">Nakshathra</label>
                                <select class="form-control selectpicker" id="nakshathra_id" name="nakshathra_id" required data-live-search="true">
                                    <!-- <option value=""> Select Nakshathra </option> -->
                                    <option value="<?php echo $Details->nakshathra_id?>">
                                                            Selected :<?php echo $Details->nakshathra?>
                                    <?php if(!empty($nakshathraInfo)) {
                                        foreach($nakshathraInfo as $nakshathra ){?>
                                        <option value="<?php echo $nakshathra->row_id;?>">
                                        <?php echo $nakshathra->nakshathra;?></option>
                                        <?php }}?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="masa_id">Masa</label>
                                <select class="form-control selectpicker" id="masa_id" name="masa_id" data-live-search="true">
                                    <!-- <option value=""> Select Masa </option> -->
                                    <option value="<?php echo $Details->masa_id?>">
                                                            Selected :<?php echo $Details->masa?>
                                    <?php if(!empty($masaInfo)) {
                                        foreach($masaInfo as $masa ){?>
                                        <option value="<?php echo $masa->row_id;?>">
                                        <?php echo $masa->masa;?></option>
                                        <?php }}?>
                                    </select>
                                </div>
                            </div>
                                <!-- <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="rashi_id">Rashi</label>
                                <select class="form-control " id="rashi_id" name="rashi_id" required >
                                     <option value=""> Select Rashi </option> 
                                    <option value="<?php echo $Details->rashi_id?>">
                                                            Selected :<?php echo $Details->rashi?>
                                   
                                    <?php if(!empty($rashiInfo)) {
                                        foreach($rashiInfo as $rashi){?>
                                        <option value="<?php echo $rashi->row_id;?>">
                                        <?php echo $rashi->rashi;?></option>
                                        <?php }}?>
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="gothra_id">Gothra</label>
                                <select class="form-control selectpicker" id="gothra_id" name="gothra_id" data-live-search="true">
                                    <!-- <option value=""> Select Gothra </option> -->
                                    
                                    <option value="<?php echo $Details->gothra_id?>">
                                                            Selected :<?php echo $Details->gothra?>
                                    <?php if(!empty($gothraInfo)) {
                                        foreach($gothraInfo as $gothra ){?>
                                        <option value="<?php echo $gothra->row_id;?>">
                                        <?php echo $gothra->gothra;?></option>
                                        <?php }}?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="paksha_id">Paksha</label>
                                <select class="form-control selectpicker" id="paksha_id" name="paksha_id" data-live-search="true">
                                    <!-- <option value=""> Select Gothra </option> -->
                                    
                                    <option value="<?php echo $Details->paksha_id?>">
                                                            Selected :<?php echo $Details->paksha?>
                                    <?php if(!empty($pakshaInfo)) {
                                        foreach($pakshaInfo as $paksha ){?>
                                        <option value="<?php echo $paksha->row_id;?>">
                                        <?php echo $paksha->paksha;?></option>
                                        <?php }}?>
                                    </select>
                                </div>
                            </div>
                                
                        </div>
                        
                                    

                                    <!-- Modal footer -->
                                    <div class="form-group">
                                        <button type="submit" style="float:right;"
                                            class="btn btn-primary mr-1">Update</button>
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
        window.location = '<?php echo base_url(); ?>/dailyDetailsListing';
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