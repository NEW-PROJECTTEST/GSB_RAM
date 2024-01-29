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
            <div class="col-md-12 col-lg-12 padding_left_right_null">
                <div class="card ">
                    <div class="card-header text-white card-content-title p-1">
                        <div class="row ">
                            <div class="col-md-6 col-8 text-white m-auto ">Add Vehicle Details</div>
                            <div class="col-md-6 col-4 m-auto"> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck float-right mobile-btn "><i
                                        class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                    <div class="card-body contents-body">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="addOwnVehicle" action="<?php echo base_url() ?>addOwnVehicle"
                            method="post" role="form">
                            <div class="row form-contents">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="vehicle_number">Vehicle Number</label>
                                        <input type="text" class="form-control required"
                                            value="<?php echo set_value('vehicle_number'); ?>" id="vehicle_number"
                                            name="vehicle_number" placeholder="Vehicle Number" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="fc_date">FC Date </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text material-icons date-icon">date_range</span>
                                        </div>
                                        <input id="fc_date" type="text" name="fc_date"
                                            value="<?php echo set_value('fc_date'); ?>"
                                            class="form-control datepicker date-col-4 " placeholder="FC Date"
                                            autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="road_tax_date">Road tax Date (Optional) </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text material-icons date-icon">date_range</span>
                                        </div>
                                        <input id="road_tax_date" type="text" name="road_tax_date"
                                            class="form-control datepicker date-col-4 " placeholder="Road tax Date"
                                            autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="return_date">Insurance Date (Optional) </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text material-icons date-icon">date_range</span>
                                        </div>
                                        <input id="insurance_date" type="text" name="insurance_date"
                                            class="form-control datepicker  date-col-4 " placeholder="Insurance Date"
                                            autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="return_date">Karnataka Permit Date (Optional)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text material-icons date-icon">date_range</span>
                                        </div>
                                        <input id="karnataka_permit_date" type="text" name="karnataka_permit_date"
                                            class="form-control datepicker date-col-4  "
                                            placeholder="Karnataka Permit Date" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="return_date">National Permit Date (Optional)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text material-icons date-icon">date_range</span>
                                        </div>
                                        <input id="national_permit_date" type="text" name="national_permit_date"
                                            class="form-control datepicker date-col-4 "
                                            placeholder="National Permit Date" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="return_date">Emission Date (Optional)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text material-icons date-icon">date_range</span>
                                        </div>
                                        <input id="emission_date" type="text" name="emission_date"
                                            class="form-control datepicker date-col-4 " placeholder="Emission Date"
                                            autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="return_date">Last Service Date (Optional) </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text material-icons date-icon">date_range</span>
                                        </div>
                                        <input id="last_service_date" type="text" name="last_service_date"
                                            class="form-control datepicker date-col-4 " placeholder="Last Service Date"
                                            autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-md-4  col-12">
                                    <div class="form-group">
                                        <label for="vehicle_condition">Vehicle Condition (Optional)</label>
                                        <select class="form-control " id="vehicle_condition" name="vehicle_condition">
                                            <option value="">Select Vehicle Condition</option>
                                            <option value="Good"> Good</option>
                                            <option value="Bad">Bad</option>
                                            <option value="Normal">Normal</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4  col-12">
                                    <div class="form-group">
                                        <label for="vehicle_condition">Vehicle Type</label>
                                        <select class="form-control " id="vehicle_type" name="vehicle_type">
                                            <option value="">Select Vehicle Type</option>
                                            <option value="SELF"> SELF</option>
                                            <option value="OTHER">OTHER</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input style="float:right;" type="submit" class="btn btn-primary" value="Submit" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="<?php echo base_url(); ?>assets/js/own_vehicle/own_vehicle.js" type="text/javascript"></script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = document.referrer;
        //'<?php echo base_url(); ?>/OwnVehicleListing';
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
        format: "dd-mm-yyyy"

    });
});
</script>