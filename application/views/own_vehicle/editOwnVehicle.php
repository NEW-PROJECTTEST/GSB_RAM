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
            <div class="col padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-1 card-content-title  ">
                        <div class="row ">
                            <div class="col-md-6 col-10 text-white m-auto ">Vehicle Details</div>
                            <div class="col-md-6 col-2 "> <a href="#" onclick="GoBackWithRefresh();return false;"class="btn text-white btn-success btn-bck float-right mobile-btn "><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- form start -->
        <!-- Default Light Table -->
        <div class="row form-contents">
            <div class="col-lg-12 col-12 padding_left_right_null">
                <div class="card card-small c-border p-0 mb-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item card-padding">
                            <div class="row">
                                <div class="col profile-head">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="vehicleInfo-tab" data-toggle="tab"
                                                href="#vehicleInfo" role="tab" aria-controls="vehicleInfo"
                                                aria-selected="false">Edit Vehicle Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="wheelInfo-tab" data-toggle="tab" href="#wheelInfo"
                                                role="tab" aria-controls="wheelInfo" aria-selected="true">Add Wheel
                                                Info</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content vehicleInfo-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="vehicleInfo" role="tabpanel"
                                            aria-labelledby="vehicleInfo-tab">
                                            <?php $this->load->helper("form"); ?>
                                            <form role="form" id="updateOwnVehicle"
                                                action="<?php echo base_url() ?>updateOwnVehicle" method="post"
                                                role="form">
                                                <div class="row form-contents">
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label for="vehicle_number">Vehicle Number</label>
                                                            <input type="text" class="form-control required"
                                                                id="vehicle_number" name="vehicle_number"
                                                                value="<?php echo $ownVehicleInfo->vehicle_number; ?>"
                                                                placeholder="Vehicle Number" autocomplete="off">
                                                            <input type="hidden"
                                                                value="<?php echo $ownVehicleInfo->row_id; ?>"
                                                                name="row_id" id="row_id" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <label for="fc_date">FC Date </label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-append">
                                                                <span
                                                                    class="input-group-text material-icons date-icon">date_range</span>
                                                            </div>
                                                            <?php if($ownVehicleInfo->fc_date != '0000-00-00') { ?>
                                                            <input id="fc_date" type="text" name="fc_date"
                                                                value="<?php echo date('d-m-Y',strtotime($ownVehicleInfo->fc_date)); ?>"
                                                                class="form-control datepicker date-col-4 "
                                                                placeholder="Road tax Date" autocomplete="off" />
                                                            <?php } else { ?>
                                                            <input id="fc_date" type="text" name="fc_date" value=""
                                                                class="form-control datepicker date-col-4 "
                                                                placeholder="FC tax Date" autocomplete="off" />
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <label for="road_tax_date">Road tax Date </label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-append">
                                                                <span
                                                                    class="input-group-text material-icons date-icon">date_range</span>
                                                            </div>
                                                            <?php if($ownVehicleInfo->road_tax_date != '0000-00-00') { ?>
                                                            <input id="road_tax_date" type="text" name="road_tax_date"
                                                                value="<?php echo date('d-m-Y',strtotime($ownVehicleInfo->road_tax_date)); ?>"
                                                                class="form-control datepicker date-col-4 "
                                                                placeholder="Road tax Date" autocomplete="off" />
                                                            <?php } else { ?>
                                                            <input id="road_tax_date" type="text" name="road_tax_date"
                                                                value="" class="form-control datepicker date-col-4 "
                                                                placeholder="Road tax Date" autocomplete="off" />
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <label for="return_date">Insurance Date </label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-append">
                                                                <span
                                                                    class="input-group-text material-icons date-icon">date_range</span>
                                                            </div>
                                                            <?php if($ownVehicleInfo->insurance_date != '0000-00-00') { ?>
                                                            <input id="insurance_date" type="text" name="insurance_date"
                                                                value="<?php echo date('d-m-Y',strtotime($ownVehicleInfo->insurance_date)); ?>"
                                                                class="form-control datepicker date-col-4 "
                                                                placeholder="Road tax Date" autocomplete="off" />
                                                            <?php } else { ?>
                                                            <input id="insurance_date" type="text" name="insurance_date"
                                                                value="" class="form-control datepicker date-col-4 "
                                                                placeholder="Insurance Date" autocomplete="off" />
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <label for="return_date">Karnataka Permit Date </label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-append">
                                                                <span
                                                                    class="input-group-text material-icons date-icon">date_range</span>
                                                            </div>
                                                            <?php if($ownVehicleInfo->karnataka_permit_date != '0000-00-00') { ?>
                                                            <input id="karnataka_permit_date" type="text"
                                                                name="karnataka_permit_date"
                                                                value="<?php echo date('d-m-Y',strtotime($ownVehicleInfo->karnataka_permit_date)); ?>"
                                                                class="form-control datepicker date-col-4 "
                                                                placeholder="Road tax Date" autocomplete="off" />
                                                            <?php } else { ?>
                                                            <input id="karnataka_permit_date" type="text"
                                                                name="karnataka_permit_date" value=""
                                                                class="form-control datepicker date-col-4 "
                                                                placeholder="Karnataka Permit Date"
                                                                autocomplete="off" />
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <label for="return_date">National Permit Date </label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-append">
                                                                <span
                                                                    class="input-group-text material-icons date-icon">date_range</span>
                                                            </div>

                                                            <?php if($ownVehicleInfo->national_permit_date != '0000-00-00') { ?>
                                                            <input id="national_permit_date" type="text"
                                                                name="national_permit_date"
                                                                value="<?php echo date('d-m-Y',strtotime($ownVehicleInfo->national_permit_date)); ?>"
                                                                class="form-control datepicker date-col-4 "
                                                                placeholder="Road tax Date" autocomplete="off" />
                                                            <?php } else { ?>
                                                            <input id="national_permit_date" type="text"
                                                                name="national_permit_date" value=""
                                                                class="form-control datepicker date-col-4 "
                                                                placeholder="National Permit Date" autocomplete="off" />
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <label for="return_date">Emission Date </label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-append">
                                                                <span
                                                                    class="input-group-text material-icons date-icon">date_range</span>
                                                            </div>
                                                            <?php if($ownVehicleInfo->emission_date != '0000-00-00') { ?>
                                                            <input id="emission_date" type="text" name="emission_date"
                                                                value="<?php echo date('d-m-Y',strtotime($ownVehicleInfo->emission_date)); ?>"
                                                                class="form-control datepicker date-col-4 "
                                                                placeholder="Road tax Date" autocomplete="off" />
                                                            <?php } else { ?>
                                                            <input id="emission_date" type="text" name="emission_date"
                                                                value="" class="form-control datepicker date-col-4 "
                                                                placeholder="Emission Date" autocomplete="off" />
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <label for="return_date">Last Service Date (Optional) </label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-append">
                                                                <span
                                                                    class="input-group-text material-icons date-icon">date_range</span>
                                                            </div>
                                                            <?php if($ownVehicleInfo->last_service_date != '0000-00-00') { ?>
                                                            <input id="last_service_date" type="text"
                                                                name="last_service_date"
                                                                value="<?php echo date('d-m-Y',strtotime($ownVehicleInfo->last_service_date)); ?>"
                                                                class="form-control datepicker date-col-4 "
                                                                placeholder="Road tax Date" autocomplete="off" />
                                                            <?php } else { ?>
                                                            <input id="last_service_date" type="text"
                                                                name="last_service_date" value=""
                                                                class="form-control datepicker date-col-4 "
                                                                placeholder="Last Service Date" autocomplete="off" />
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4  col-12">
                                                        <div class="form-group">
                                                            <label for="vehicle_condition">Vehicle Condition
                                                                (Optional)</label>
                                                            <select class="form-control " id="vehicle_condition"
                                                                name="vehicle_condition">
                                                                <option
                                                                    value="<?php echo $ownVehicleInfo->vehicle_condition; ?>">
                                                                    Selected:
                                                                    <?php echo  $ownVehicleInfo->vehicle_condition; ?>
                                                                </option>
                                                                <option value="Good"> Good</option>
                                                                <option value="Bad">Bad</option>
                                                                <option value="Normal">Normal</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4  col-12">
                                                        <div class="form-group">
                                                            <label for="vehicle_condition">Vehicle Type
                                                                </label>
                                                            <select class="form-control " id="vehicle_type"
                                                                name="vehicle_type">
                                                                <option
                                                                    value="<?php echo $ownVehicleInfo->vehicle_type; ?>">
                                                                    Selected:
                                                                    <?php echo  $ownVehicleInfo->vehicle_type; ?>
                                                                </option>
                                                                <option value="SELF"> SELF</option>
                                                                <option value="OTHER">OTHER</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input style="float:right;" type="submit" class="btn btn-primary"
                                                    value="Update" />
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="wheelInfo" role="tabpanel"
                                            aria-labelledby="wheelInfo-tab">
                                            <?php $this->load->helper("form"); ?>
                                            <form role="form" id="addWheelInfo"
                                                action="<?php echo base_url() ?>addWheelInfo" method="post" role="form">
                                                <div class="row">
                                                    <!-- <div class="col-lg-12 col-md-12 col-sm-12"> -->
                                                    <!-- <div class="row"> -->
                                                    <div class="col-md-4 col-12 ">
                                                        <div class="form-group">
                                                            <label for="wheel_number">Wheel Number</label>
                                                            <input type="text" class="form-control "
                                                                value="<?php echo set_value('wheel_number'); ?>"
                                                                id="wheel_number" name="wheel_number"
                                                                placeholder="Enter Wheel Number" autocomplete="off" required>

                                                            <input type="hidden"
                                                                value="<?php echo $ownVehicleInfo->row_id; ?>"
                                                                name="own_vehicle_rowid" id="own_vehicle_rowid" />
                                                            <input type="hidden"
                                                                value="<?php echo $ownVehicleInfo->vehicle_number; ?>"
                                                                name="wheel_vehicle_number" id="wheel_vehicle_number" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4  col-12">
                                                        <div class="form-group">
                                                            <label for="wheel_type">Wheel Type
                                                                </label>
                                                            <select class="form-control " id="wheel_type"
                                                                name="wheel_type" required>
                                                                <option value="">Select Wheel Type
                                                                </option>
                                                                <option value="FRONT"> FRONT</option>
                                                                <option value="LIFT">LIFT</option>
                                                                <option value="EXCEL">EXCEL</option>
                                                                <option value="DUMMY">DUMMY</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4  col-12">
                                                        <div class="form-group">
                                                            <label for="wheel_position" required>Wheel Position
                                                                </label>
                                                            <select class="form-control " id="wheel_position"
                                                                name="wheel_position">
                                                                <option value="">Select Wheel position
                                                                </option>
                                                                <option value="Right"> Right</option>
                                                                <option value="Right Right">Right Right</option>
                                                                <option value="Right Left">Right Left</option>
                                                                <option value="Left Right">Left Right</option>
                                                                <option value="Left Left">Left Left</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8  col-12">
                                                        <div class="form-group">
                                                            <label for="comments" >Comments (Optional) </label>
                                                            <textarea class="form-control required"
                                                                placeholder="Enter comments" name="comments"
                                                                id="comments" rows="3" autocomplete="off"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 col-12 ">
                                                        <input type="submit"
                                                            class="btn btn-primary wheel-button wheel-btn-mobile "
                                                            value="Add" />
                                                    </div>
                                                </div>

                                                <!-- </div> -->
                                            </form>
                                            <div class="col-lg-12 col-sm-12">
                                                <table class="table mb-0 form-table-padding bordeless">
                                                    <tr class=" text-white  bg-black">
                                                        <th width="300">Vehicle Number</th>
                                                        <th width="300">Wheel Number</th>
                                                        <th width="300">Wheel Type</th>
                                                        <th width="300">Wheel Position</th>
                                                        <th width="300">Comments</th>
                                                        <th width="300" class="text-center">Actions</th>
                                                    </tr>
                                                    <?php
                                                            if(!empty($wheelRecord)) {
                                                            foreach($wheelRecord as $record)
                                                            {
                                                                ?>
                                                    <tr class="text-black" style="font-weight: 500;">
                                                        <td><?php echo $record->vehicle_number ?></td>
                                                        <td> <?php echo $record->wheel_number ?></td>
                                                        <td><?php echo $record->wheel_type ?></td>
                                                        <td> <?php echo $record->wheel_position ?></td>
                                                        <td> <?php echo $record->comments ?></td>
                                                        <td class="text-center">
                                                            <?php if($role == ROLE_ADMIN ) { ?>
                                                            <a class="btn btn-sm btn-danger deleteWheel" href="#"
                                                                data-row_id="<?php echo $record->row_id; ?>"
                                                                title="Delete"><i class="fa fa-trash"></i></a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                                }
                                                            }  ?>
                                                </table>
                                            </div>
                                            <!-- </div> -->
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
<!-- End Default Light Table -->
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/own_vehicle/deleteWheel.js" charset="utf-8">
</script>
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

function deleteRow(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
</script>