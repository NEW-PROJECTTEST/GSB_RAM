<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row ">
            <div class="col padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-1 card-content-title  ">
                        <div class="row ">
                            <div class="col-md-6 text-white ">Detailed View Of Own Vehicle</div>
                            <div class="col-md-6"> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck pull-right mobile-bck "><i
                                        class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- form start -->
        <!-- Default Light Table -->
        <div class="row form-contents">
            <div class="col-lg-12 col-12 padding_left_right_null">
                <div class="card card-small c-border  mb-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item card-padding">
                            <div class="row">
                                <div class="col profile-head">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="ownVehicle-tab" data-toggle="tab"
                                                href="#ownVehicle" role="tab" aria-controls="ownVehicle"
                                                aria-selected="false">Own Vehicle Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="fuel-tab" data-toggle="tab" href="#fuel" role="tab"
                                                aria-controls="fuel" aria-selected="true">Fuel Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="service-tab" data-toggle="tab" href="#service"
                                                role="tab" aria-controls="service" aria-selected="true">Trip Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="wheel-tab" data-toggle="tab" href="#wheel"
                                                role="tab" aria-controls="wheel" aria-selected="true">Wheel Info</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content ownVehicle-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="ownVehicle" role="tabpanel"
                                            aria-labelledby="ownVehicle-tab">
                                            <table class="table table-padding">
                                                <tbody>
                                                    <tr>
                                                        <th>Vehicle Number<span class="float-right">:</span> </th>
                                                        <td><?php echo $ownVehicleInfo->vehicle_number; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>FC Date<span class="float-right">:</span></th>
                                                        <?php if($ownVehicleInfo->fc_date != '0000-00-00') { ?>
                                                        <td><?php echo date('d-m-Y',strtotime($ownVehicleInfo->fc_date)); ?>
                                                        </td>
                                                        <?php } else { ?>
                                                        <td></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <th>Road Tax Date<span class="float-right">:</span></th>
                                                        <?php if($ownVehicleInfo->road_tax_date != '0000-00-00') { ?>
                                                        <td><?php echo  date('d-m-Y',strtotime($ownVehicleInfo->road_tax_date)) ?>
                                                        </td>
                                                        <?php } else { ?>
                                                        <td></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <th>Insurance Date<span class="float-right">:</span> </th>
                                                        <?php if($ownVehicleInfo->insurance_date != '0000-00-00') { ?>
                                                        <td><?php echo  date('d-m-Y',strtotime($ownVehicleInfo->insurance_date)) ?>
                                                        </td>
                                                        <?php } else { ?>
                                                        <td></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <th>Karnataka Permit Date<span class="float-right">:</span></th>
                                                        <?php if($ownVehicleInfo->karnataka_permit_date != '0000-00-00') { ?>
                                                        <td><?php echo  date('d-m-Y',strtotime($ownVehicleInfo->karnataka_permit_date)) ?>
                                                        </td>
                                                        <?php } else { ?>
                                                        <td></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <th>National Permit Date<span class="float-right">:</span></th>
                                                        <?php if($ownVehicleInfo->national_permit_date != '0000-00-00') { ?>
                                                        <td><?php echo  date('d-m-Y',strtotime($ownVehicleInfo->national_permit_date)) ?>
                                                        </td>
                                                        <?php } else { ?>
                                                        <td></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <th>Emission Date<span class="float-right">:</span></th>
                                                        <?php if($ownVehicleInfo->emission_date != '0000-00-00') { ?>
                                                        <td><?php echo  date('d-m-Y',strtotime($ownVehicleInfo->emission_date)) ?>
                                                        </td>
                                                        <?php } else { ?>
                                                        <td></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <th>Last Service Date<span class="float-right">:</span></th>
                                                        <?php if($ownVehicleInfo->last_service_date != '0000-00-00') { ?>
                                                        <td><?php echo  date('d-m-Y',strtotime($ownVehicleInfo->last_service_date)) ?>
                                                        </td>
                                                        <?php } else { ?>
                                                        <td></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <th>Vehicle Condition<span class="float-right">:</span></th>
                                                        <td><?php echo $ownVehicleInfo->vehicle_condition; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="fuel" role="tabpanel" aria-labelledby="fuel-tab">
                                            <table class="table mb-0 form-table-padding bordeless">
                                                <tr class=" text-white  bg-black">
                                                    <th width="200">Date</th>
                                                    <th width="300">Vehicle Number</th>
                                                    <th width="300">Liter</th>
                                                    <th width="300">Type</th>
                                                    <th width="300">Amount</th>
                                                    <th width="300" class="text-center">Actions</th>
                                                </tr>
                                                <?php
                                                if(!empty($fuelRecord)) {
                                                foreach($fuelRecord as $record)
                                                 {
                                                    ?>
                                                <tr class="text-black" style="font-weight: 500;">
                                                    <td><?php echo date('d-m-Y',strtotime($record->fuel_date)); ?></td>
                                                    <td><?php echo $record->vehicle_number ?></td>
                                                    <td><?php echo $record->liter ?></td>
                                                    <td> <?php echo $record->fuel_type ?></td>
                                                    <td> <?php echo $record->fuel_amount ?></td>
                                                    <td class="text-center">
                                                        <?php if($role == ROLE_ADMIN || $role == ROLE_EMPLOYEE) { ?>
                                                        <a class="btn btn-sm btn-danger deleteFuel" href="#"
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

                                        <div class="tab-pane fade" id="service" role="tabpanel"
                                            aria-labelledby="service-tab">
                                            <table class="table mb-0 form-table-padding bordeless">
                                                <tr class=" text-white  bg-black">
                                                    <th width="200">Date</th>
                                                    <th width="300">Vehicle Number</th>
                                                    <th width="300">Place/Distance</th>
                                                    <th width="300">Total Trip</th>
                                                    <th width="300" class="text-center">Actions</th>
                                                </tr>
                                                <?php
                                                if(!empty($tripRecord)) {
                                                foreach($tripRecord as $record)
                                                 {
                                                    ?>
                                                <tr class="text-black" style="font-weight: 500;">
                                                    <td><?php echo date('d-m-Y',strtotime($record->service_date)); ?>
                                                    </td>
                                                    <td><?php echo $record->vehicle_number ?></td>
                                                    <td> <?php echo $record->place ?></td>
                                                    <td> <?php echo $record->total_trip ?></td>
                                                    <td class="text-center">
                                                        <?php if($role == ROLE_ADMIN || $role == ROLE_EMPLOYEE) { ?>
                                                        <a class="btn btn-sm btn-danger deleteTrip" href="#"
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
                                        <div class="tab-pane fade" id="wheel" role="tabpanel"
                                            aria-labelledby="wheel-tab">
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
                                                        <?php if($role == ROLE_ADMIN || $role == ROLE_EMPLOYEE) { ?>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/own_vehicle/own_vehicle.js" charset="utf-8">
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/own_vehicle/deleteWheel.js" charset="utf-8">
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/own_vehicle/deleteTrip.js" charset="utf-8">
</script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = document.referrer;    
        //'<?php echo base_url(); ?>/OwnVehicleListing';
        /* OR */
        //location.replace();
    } else {
        window.history.back();
    }
}
jQuery(document).ready(function() {

    jQuery('.resetFilters').click(function() {
        $(this).closest('form').find("input[type=text]").val("");
    })
});
</script>