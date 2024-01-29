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
        <div class="row p-0 ">
            <div class="col padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-2 ">
                        <div class="row c-m-b">
                            <div class="col-lg-6 col-12">
                                <span class="page-title ">
                                    <i class="fa fa-bus mobile-title"></i> Own Vehicle Management (<?php echo $vehicle_type ?>)
                                </span>
                            </div>
                            <div class="col-lg-6 col-12 box-tools">
                            <?php if($vehicle_type=="SELF"){
                                    $transurl = "OwnSelfVehicleListing";
                                }else{
                                    $transurl = "OwnOtherVehicleListing";
                                }?>
                                <form action="<?php echo base_url().$transurl ?>" method="POST" id="searchList">
                                    <div class="input-group search-box">
                                        <input type="text" name="searchText" value=""
                                            class="form-control searchText input-md pull-right" autocomplete="off"
                                            placeholder="Search By Vehicle Number" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-md btn-primary searchList"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="row c-m-t">
                            <div class="col-md-6 col-5">
                                <span class="page-sub-title mobile-title">Total Vehicles: <?php echo $count; ?></span>
                            </div>
                            <div class="col-md-6 col-7 text-right">
                                <a class="btn btn-primary mobile-btn ml-2 pull-right "
                                    href="<?php echo base_url(); ?>addOwnVehiclePageView"><i class="fa fa-plus"></i>
                                    Add New</a>

                                <a class="btn btn-success mobile-btn pull-right " href="" data-toggle="modal"
                                    data-target="#Modal3"><i class="fa fa-file"></i>
                                    Report</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col padding_left_right_null">
                <div class="card card-small mb-4">
                    <div class="card-body p-1 pb-3 text-center table-responsive">
                        <table class="table mb-0 form-table-padding ">
                            <tr class="bg-deafult">
                                <?php if($vehicle_type=="SELF"){
                                    $transurl = "OwnSelfVehicleListing";
                                }else{
                                    $transurl = "OwnOtherVehicleListing";
                                }?>
                                <form action="<?php echo base_url().$transurl ?>" method="POST"
                                    id="byFilterMethod">
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="vehicle_number" id="vehicle_number"
                                                value="<?php echo $vehicle_number ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By Vehicle"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-id-card"></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid datepicker mobile-width" type="text"
                                                name="insurance_date" id="insurance_date"
                                                value="<?php echo $insurance_date ?>" style="text-transform: uppercase"
                                                placeholder="By Date" autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid datepicker mobile-width" type="text"
                                                name="karnataka_permit_date" id="karnataka_permit_date"
                                                value="<?php echo $karnataka_permit_date ?>"
                                                style="text-transform: uppercase" placeholder="By Date"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid datepicker mobile-width" type="text"
                                                name="last_service_date" id="last_service_date"
                                                value="<?php echo $last_service_date ?>"
                                                style="text-transform: uppercase" placeholder="By Date"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </th>
                                    <!-- <th width="150" style="padding: 0px;">
                                        <select class="form-control is-valid input-sm mobile-width"
                                            id="vehicle_type" name="vehicle_type">
                                            <?php if($vehicle_type != "") { ?>
                                            <option value="<?php echo $vehicle_type; ?>" selected><b>Sorted:
                                                    <?php echo $vehicle_type; ?></b></option>
                                            <option value="">ALL</option>
                                            <option value="SELF">SELF</option>
                                            <option value="OTHER">OTHER</option>
                                           
                                            <?php } else { ?>
                                            <option value="">ALL</option>
                                            <option value="SELF">SELF</option>
                                            <option value="OTHER">OTHER</option>
                                           
                                            <?php } ?>
                                        </select>
                                    </th> -->
                                    <th width="180" class="text-center btn-padding"><button type="submit"
                                            class="btn btn-success btn-block mobile-width"> Search</button></th>
                                </form>
                            </tr>
                            <tr class=" text-white  bg-black">
                                <th>Vehicle Number</th>
                                <th>Insurance Date</th>
                                <th>KA Permit date</th>
                                <th>Last Service Date</th>
                                <!-- <th>Vehicle Type</th> -->
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                        if(!empty($OwnVehicleRecords))
                        {
                            foreach($OwnVehicleRecords as $record)
                            {
                        ?>
                            <tr class="text-black">
                                <td><?php echo $record->vehicle_number ?></td>
                                <?php if($record->insurance_date != '0000-00-00') { ?>
                                <td><?php echo date('d-m-Y',strtotime($record->insurance_date)); ?></td>
                                <?php } else { ?>
                                <td></td>
                                <?php } ?>
                                <?php if($record->karnataka_permit_date != '0000-00-00') { ?>
                                <td><?php echo date('d-m-Y',strtotime($record->karnataka_permit_date)); ?></td>
                                <?php } else { ?>
                                <td></td>
                                <?php } ?>
                                <?php if($record->last_service_date != '0000-00-00') { ?>
                                <td><?php echo date('d-m-Y',strtotime($record->last_service_date)); ?></td>
                                <?php } else { ?>
                                <td></td>
                                <?php } ?>
                                <!-- <td><?php echo $record->vehicle_type ?></td> -->
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary"
                                        href="<?= base_url().'viewOwnVehicle/'.$record->row_id; ?>" title="View More"><i
                                            class="fa fa-eye"></i></a>
                                    <?php if($role == ROLE_ADMIN || $role == ROLE_EMPLOYEE) { ?>
                                    <a class="btn  btn-sm btn-info"
                                        href="<?php echo base_url().'editOwnVehiclePageView/'.$record->row_id; ?>"
                                        title="Edit"><i class="fas fa-edit"></i></i></a>
                                    <a class="btn btn-sm btn-danger deleteOwnVehicle" href="#"
                                        data-row_id="<?php echo $record->row_id; ?>" title="Delete"><i
                                            class="fas fa-trash"></i></a>
                                    <a class="btn btn-sm btn-success text-white" href="" data-toggle="modal"
                                        data-target="#Modal"
                                        onclick="openModal('<?php echo $record->vehicle_number; ?>','<?php echo $record->row_id; ?>')">
                                        <i class="material-icons text-white">local_gas_station</i>&nbsp;&nbsp;Fuel</a>
                                    <a class="btn btn-sm btn-success text-white" href="" data-toggle="modal"
                                        data-target="#Modal2"
                                        onclick="openModal2('<?php echo $record->vehicle_number; ?>','<?php echo $record->row_id; ?>')"><i
                                            class="	fa fa-truck"></i>&nbsp;&nbsp;Trip</a>
                                    <?php } ?>


                                </td>
                            </tr>
                            <?php
                        }
                    } else { ?>
                            <tr>
                                <td class="text-center " colspan="10">
                                    Vehicle Not Found!!.
                                </td>
                            </tr>
                            <?php }
                      ?>
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal Bigin -->
        <div class="row">
            <div class="col">
                <div id="Modal3" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg ">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header modal-call-report p-2">

                                <div class=" col-lg-10 col-10">
                                    <span class="text-white mobile-title" style="font-size : 20px">Own Vehicle
                                        Report</span>
                                    &nbsp;&nbsp; <span class="modal-title text-white mobile-title"
                                        style="font-size : 20px"></span>
                                </div>
                                <div class=" col-lg-2 col-2  ">
                                    <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                                </div>

                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <?php $this->load->helper("form"); ?>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="fromDate">Date From (Only for Fuel/Trip Report)</label>
                                        <div class="input-group ">
                                            <span class="input-group-append">
                                                <span
                                                    class="input-group-text material-icons date-icon">date_range</span>
                                            </span>
                                            <input id="fromDate" type="text" name="fromDate"
                                                class="form-control datepicker  " placeholder=" Date From"
                                                autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="toDate">Date To (Only for Fuel/Trip Report)</label>
                                        <div class="input-group ">
                                            <span class="input-group-append">
                                                <span
                                                    class="input-group-text material-icons date-icon">date_range</span>
                                            </span>
                                            <input id="toDate" type="text" name="toDate"
                                                class="form-control datepicker  " placeholder="Date To"
                                                autocomplete="off" required>
                                        </div>
                                    </div>
                                    <br /><br /><br /><br />
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="vehicle_number">Vehicle Number</label>
                                            <select required name="vehicle_number" id="report_vehicle_number"
                                                class="form-control required selectpicker" data-live-search="true">
                                                <option value="ALL">ALL</option>
                                                <?php if(!empty($ownVehicles))
                                                        { foreach ($ownVehicles as $vehicle)
                                                            { ?>
                                                <option value="<?php echo $vehicle->vehicle_number ?>">
                                                    <?php echo $vehicle->vehicle_number ?></option>
                                                <?php   } 
                                          } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer ownVehicle-modal-footer p-2 ">
                                <div class="row ">
                                    <div class="col-md-3 col-6 ownVehicle-report-col pull-right ">
                                        <a class="btn  btn-success text-white" onclick="downloadOwnVehicleReport()"><i
                                                class="fa fa-download"> &nbsp;Vehicle Report</i></a>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <a class="btn  btn-success text-white" onclick="downloadFuelReport()"><i
                                                class="fa fa-download"> &nbsp;Fuel Report</i></a>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <a class="btn  btn-success text-white" onclick="downloadTripReport()"><i
                                                class="fa fa-download"> &nbsp;Trip Report</i></a>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <a class="btn  btn-success text-white" onclick="downloadWheelReport()"><i
                                                class="fa fa-download"> &nbsp;Wheel Report </i></a>
                                    </div>
                                    <!-- <div class="col-md-2 col-4">     
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
        <!-- modal Bigin -->
        <div class="row">
            <div class="col">
                <div id="Modal2" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg ">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header p-1">
                                <div class="col-md-10 col-10">
                                    <span class="text-white mobile-title" style="font-size : 20px">Add Trip
                                        Details To Vehicle : </span>
                                    &nbsp;&nbsp; <span class="modal-title text-white mobile-title"
                                        style="font-size : 20px"></span>
                                </div>
                                <div class=" col-md-2 col-2  ">
                                    <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                                </div>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <?php $this->load->helper("form"); ?>
                                <form role="form" id="addTrip" action="<?php echo base_url() ?>addTrip" method="post"
                                    role="form">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <label for="service_date">Date</label>
                                            <div class="input-group ">
                                                <span class="input-group-append">
                                                    <span
                                                        class="input-group-text material-icons date-icon">date_range</span>
                                                </span>
                                                <input id="service_date" type="text" name="service_date"
                                                    class="form-control datepicker" placeholder="Enter Date"
                                                    autocomplete="off" required>
                                                <input type="hidden" name="vehicle_number" id="modal2_vehicle_number" />
                                                <input type="hidden" name="own_vehicle_rowid" id="own_vehicle_rowid" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="fuel_rowid">Select Fuel Date</label>
                                                <select name="fuel_rowid" id="fuel_rowid"
                                                    class="form-control required selectpicker" data-live-search="true"
                                                    required>
                                                    <option value="">Select Fuel Date</option>
                                                    <?php if(!empty($fuelDetails))
                                                        { foreach ($fuelDetails as $fuel)
                                                         
                                                            { ?>
                                                    <option value="<?php echo $fuel->row_id ?>">
                                                        <?php echo date('d-m-Y',strtotime($fuel->fuel_date)) .' - '.$fuel->vehicle_number ?></option>
                                                    <?php   } 
                                          } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="place">Place</label>
                                                <input type="text" class="form-control " id="place" name="place"
                                                    placeholder="Enter Place" autocomplete="off" required>

                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="total_trip">Total Trip</label>
                                                <input type="text" class="form-control " id="total_trip"
                                                    onkeypress="return isNumberKey(event)" name="total_trip"
                                                    placeholder="Enter Trip" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="trip_amount">Amount</label>
                                                <input type="text" class="form-control " id="trip_amount"
                                                    onkeypress="return isNumberKey(event)" name="trip_amount"
                                                    placeholder="Enter Amount" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="comments">Comments(Optional) </label>
                                                <textarea class="form-control required" placeholder="Enter comments"
                                                    name="comments" id="narration" rows="3"
                                                    autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" style="flaot : left" value="Submit" />
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
        <!-- modal Bigin -->
        <div class="row">
            <div class="col">
                <div id="Modal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg ">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header p-1">
                                <div class="col-md-10 col-10">
                                    <span class="text-white mobile-title" style="font-size : 20px">Add Fuel Details To
                                        Vehicle :
                                    </span>
                                    &nbsp;&nbsp; <span class="modal-title text-white mobile-title"
                                        style="font-size : 20px"></span>
                                </div>
                                <div class=" col-md-2 col-2  ">
                                    <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                                </div>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <?php $this->load->helper("form"); ?>
                                <form role="form" id="addFuel" action="<?php echo base_url() ?>addFuel" method="post"
                                    role="form">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <label for="fuel_date">Date</label>
                                            <div class="input-group ">
                                                <span class="input-group-append">
                                                    <span
                                                        class="input-group-text material-icons date-icon">date_range</span>
                                                </span>
                                                <input id="fuel_date" type="text" name="fuel_date"
                                                    class="form-control datepicker_fuel_date" placeholder="Enter Date"
                                                    autocomplete="off" required>

                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12">
                                            <div class="form-group">
                                                <label for="diesel_pump">Diesel Pump</label>
                                                <select class="form-control " id="diesel_pump" name="diesel_pump">
                                                    <option value="">Select Any</option>
                                                    <?php if(!empty($getAllPumpInfo))
                                                                { foreach ($getAllPumpInfo as $t)
                                                                    { ?>
                                                    <option value="<?php echo $t->row_id; ?>">
                                                        <?php echo $t->fuel_account_name.'(Bal:'.$t->account_balance.')'; ?>
                                                    </option>
                                                    <?php   } 
                                                                } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="liter">Liter</label>
                                                <input type="text" class="form-control " id="liter"
                                                    onkeypress="return isNumberKey(event)" name="liter"
                                                    placeholder="Enter Liter" autocomplete="off" required>
                                                <input type="hidden" name="vehicle_number" id="modal_vehicle_number" />
                                                <input type="hidden" name="ownVehicleRow_Id" id="ownVehicleRow_Id" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="fuel_amount">Amount</label>
                                                <input type="text" class="form-control " id="fuel_amount"
                                                    onkeypress="return isNumberKey(event)" name="fuel_amount"
                                                    placeholder="Enter Amount" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="fuel_rowid">Select Type</label>
                                                <select name="fuel_type" id="fuel_type"
                                                    class="form-control required" data-live-search="true"
                                                    required>
                                                    <option value="">Select Type</option>
                                                    <option value="Diesel">Diesel</option>
                                                    <option value="Petrol">Petrol</option>
                                                    <option value="Oil">Oil</option>
                                                    <option value="Waste">Waste</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" style="flaot : left" value="Submit" />
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/own_vehicle/own_vehicle.js" charset="utf-8">
</script>
<script type="text/javascript">
function openModal(vehicle_number, row_id) {
    $("#Modal").modal('show');
    $("#Modal .modal-title").html(vehicle_number);
    document.getElementById("modal_vehicle_number").value = vehicle_number;
    document.getElementById("ownVehicleRow_Id").value = row_id;
}

function openModal2(vehicle_number, row_id) {
    $("#Modal2").modal('show');
    $("#Modal2 .modal-title").html(vehicle_number);
    document.getElementById("modal2_vehicle_number").value = vehicle_number;
    document.getElementById("own_vehicle_rowid").value = row_id;

}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function downloadOwnVehicleReport() {

    var vehicle_number = $('#report_vehicle_number :selected').val();

    $.ajax({
        url: '<?php echo base_url(); ?>/downloadOwnVehicleReport ',
        type: 'POST',
        dataType: 'json',
        data: {
            vehicle_number: vehicle_number,
        },

        success: function(data) {
            // $("#loader").html("<span style='color:green'><b>Downloded</b></span>");
            // var studentObj = JSON.parse(data)
            var $a = $("<a>");
            $a.attr("href", data.file);
            $("body").append($a);
            $a.attr("download", "OwnVehicle_Result_" + vehicle_number + "_Report_file.xls");
            $a[0].click();
            $a.remove();
        },
        error: function(result) {
            //   $("#loader").html("<span style='color:red'>Server Error!!</span>");
        },
        fail: (function(status) {
            alert("Server Error!!  Failed");
        }),
        beforeSend: function(d) {
            // $("#loader").html(loader);
        }
    });
}


function downloadWheelReport() {

    var vehicle_number = $('#report_vehicle_number :selected').val();

    $.ajax({
        url: '<?php echo base_url(); ?>/downloadWheelReport ',
        type: 'POST',
        dataType: 'json',
        data: {
            vehicle_number: vehicle_number,
        },

        success: function(data) {
            // $("#loader").html("<span style='color:green'><b>Downloded</b></span>");
            // var studentObj = JSON.parse(data)
            var $a = $("<a>");
            $a.attr("href", data.file);
            $("body").append($a);
            $a.attr("download", "Wheel_Result_" + vehicle_number + "_Report_file.xls");
            $a[0].click();
            $a.remove();
        },
        error: function(result) {
            //   $("#loader").html("<span style='color:red'>Server Error!!</span>");
        },
        fail: (function(status) {
            alert("Server Error!!  Failed");
        }),
        beforeSend: function(d) {
            // $("#loader").html(loader);
        }
    });
}

function downloadFuelReport() {
    var from_date = $('#fromDate').val();
    var to_date = $('#toDate').val();
    var vehicle_number = $('#report_vehicle_number :selected').val();
    if ($('#fromDate').val() == "") {
        alert("Please enter From Date!");
    } else if ($('#toDate').val() == "") {
        alert("Please enter To Date!");
    } else {
        $.ajax({
            url: '<?php echo base_url(); ?>/downloadFuelReport ',
            type: 'POST',
            dataType: 'json',
            data: {
                from_date: from_date,
                to_date: to_date,
                vehicle_number: vehicle_number,
            },

            success: function(data) {
                // $("#loader").html("<span style='color:green'><b>Downloded</b></span>");
                // var studentObj = JSON.parse(data)
                var $a = $("<a>");
                $a.attr("href", data.file);
                $("body").append($a);
                $a.attr("download", "Fuel_Result_" + vehicle_number + "_Report_file.xls");
                $a[0].click();
                $a.remove();
            },
            error: function(result) {
                //   $("#loader").html("<span style='color:red'>Server Error!!</span>");
            },
            fail: (function(status) {
                alert("Server Error!!  Failed");
            }),
            beforeSend: function(d) {
                // $("#loader").html(loader);
            }
        });
    }
}

function downloadTripReport() {
    var from_date = $('#fromDate').val();
    var to_date = $('#toDate').val();
    var vehicle_number = $('#report_vehicle_number :selected').val();
    if ($('#fromDate').val() == "") {
        alert("Please enter From Date!");
    } else if ($('#toDate').val() == "") {
        alert("Please enter To Date!");
    } else {
        $.ajax({
            url: '<?php echo base_url(); ?>/downloadTripReport ',
            type: 'POST',
            dataType: 'json',
            data: {
                from_date: from_date,
                to_date: to_date,
                vehicle_number: vehicle_number,
            },

            success: function(data) {
                // $("#loader").html("<span style='color:green'><b>Downloded</b></span>");
                // var studentObj = JSON.parse(data)
                var $a = $("<a>");
                $a.attr("href", data.file);
                $("body").append($a);
                $a.attr("download", "Trip_Result_" + vehicle_number + "_Report_file.xls");
                $a[0].click();
                $a.remove();
            },
            error: function(result) {
                //   $("#loader").html("<span style='color:red'>Server Error!!</span>");
            },
            fail: (function(status) {
                alert("Server Error!!  Failed");
            }),
            beforeSend: function(d) {
                // $("#loader").html(loader);
            }
        });
    }
}

<?php if($vehicle_type=="SELF"){
                                    $transurl = "OwnSelfVehicleListing";
                                }else{
                                    $transurl = "OwnOtherVehicleListing";
                                }?>
jQuery(document).ready(function() {
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#searchList").attr("action", "<?php echo base_url().$transurl ?>" + value);
        jQuery("#searchList").submit();
    });
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#byFilterMethod").attr("action", baseURL + "OwnVehicleListing/" + value);
        jQuery("#byFilterMethod").submit();
    });
    jQuery('.datepicker,.datepicker_fuel_date').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});
</script>