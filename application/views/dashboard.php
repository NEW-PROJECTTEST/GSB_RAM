<div class="loader">
    <img id="loader_img" src="<?php echo base_url(); ?>assets/dist/img/loader.gif" width="150" class="img-fluid"
        alt="loader">
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="row mt-2">
        <div class="col  padding_left_right_null">
            <div class="card card-small  p-0 ">
                <div class="card-body p-1 pl-2 pr-2 ">
                    <div class="row ">
                        <div class="col-md-6 page-title "> <i class="fa fa-dashboard"></i> Dashboard / Overview</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Page Header -->
    <!-- Small Stats Blocks -->
    <?php if($role == ROLE_ADMIN || $role == ROLE_EMPLOYEE) { ?>
    <div class="row padding_left_right_null">

        <div class="col-lg-3 col-6 column_padding_card ">
            <div class="card card-small dash-card " style="background: #6bd66b;">
                <div class="card-body ">
                    <span class="stats-small__label text-uppercase text-white text-center">committee member
                        <?php echo $totalCommittee; ?></span>
                    <h6 class="stats-small__value count text-white"></h6>
                    <div class="icon float-right">
                        <i class="fas fa-users dash-icons"></i>
                    </div>
                </div>
                <div class="card-footer text-center dash-footer p-1">
                    <a class="more-info" href="<?php echo base_url(); ?>committeeListing"><span>More Info <i
                                class="fa fa-arrow-circle-right"></i></span></a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6 column_padding_card ">
            <div class="card card-small dash-card " style="background: #e6a328">
                <div class="card-body ">
                    <span class="stats-small__label text-uppercase text-white text-center">Devotee &emsp;
                        <?php echo $totalDevotees; ?></span>
                    <h6 class="stats-small__value count text-white"></h6>
                    <div class="icon float-right">
                        <i class="fas fa-users dash-icons"></i>
                    </div>
                </div>
                <div class="card-footer text-center dash-footer p-1">
                    <a class="more-info" href="<?php echo base_url(); ?>devoteeListing"><span>More Info <i
                                class="fa fa-arrow-circle-right"></i></span></a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6 column_padding_card ">
            <div class="card card-small dash-card " style="background: #119a74">
                <div class="card-body ">
                    <span class="stats-small__label text-uppercase text-white text-center">Bank(A/C) &emsp;
                        <?php echo $totalBank; ?></span>
                    <h6 class="stats-small__value count text-white"></h6>
                    <div class="icon float-right">
                        <i class="fas fa-bank dash-icons"></i>
                    </div>
                </div>
                <div class="card-footer text-center dash-footer p-1">
                    <a class="more-info" href="<?php echo base_url(); ?>bankListing"><span>More Info <i
                                class="fa fa-arrow-circle-right"></i></span></a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6  column_padding_card">
            <div class="card card-small dash-card" style="background: #7d7dcc;">
                <div class="card-body ">
                    <span class="stats-small__label text-uppercase text-white text-center">Staff &emsp;
                        <?php echo $totalEmployee; ?></span>
                    <h6 class="stats-small__value count text-white"></h6>
                    <div class="icon float-right">
                        <i class="fa fa-users  dash-icons"></i>
                    </div>
                </div>
                <div class="card-footer text-center dash-footer p-1">
                    <a class="more-info" href="<?php echo base_url(); ?>employeeListing"><span>More Info <i
                                class="fa fa-arrow-circle-right"></i></span></a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6  column_padding_card">
            <div class="card card-small dash-card" style="background: #FBBF77;">
                <div class="card-body ">
                    <span class="stats-small__label text-uppercase text-white text-center">Asset &emsp;
                        <?php echo $totalAsset; ?></span>
                    <h6 class="stats-small__value count text-white"></h6>
                    <div class="icon float-right">
                        <i class="fas fa-building dash-icons"></i>
                    </div>
                </div>
                <div class="card-footer text-center dash-footer p-1">
                    <a class="more-info" href="<?php echo base_url(); ?>assetListing"><span>More Info <i
                                class="fa fa-arrow-circle-right"></i></span></a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6  column_padding_card">
            <div class="card card-small dash-card" style="background: #00CED1;">
                <div class="card-body ">
                    <span class="stats-small__label text-uppercase text-white text-center">Party &emsp;
                        <?php echo $totalParty; ?></span>
                    <h6 class="stats-small__value count text-white"></h6>
                    <div class="icon float-right">
                        <i class="fa fa-users  dash-icons"></i>
                    </div>
                </div>
                <div class="card-footer text-center dash-footer p-1">
                    <a class="more-info" href="<?php echo base_url(); ?>partyListing"><span>More Info <i
                                class="fa fa-arrow-circle-right"></i></span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row mt-2 ">
        <div class="col-lg-6 col-md-6 col-sm-12 mb-2  padding_left_right_null">
            <div class="card card-small">
                <div class="card-header border-bottom p-2 dashboard_card_header">
                    <h6 class="m-0 dash_board_card_title">Today Overall Info</h6>
                </div>
                <div class="card-body d-flex py-0 pt-0 pl-1 pr-1">
                    <table class="table table-padding">
                        <tbody>
                            <tr>
                                <th width="40%" class="text-black">Cash Ledger<span class="float-right">:</span></th>
                                <td><?php // echo $todayCashLedger; ?></td>
                            </tr>
                            <tr>
                                <th class="text-black">Transported Vehicle<span class="float-right">:</span></th>
                                <td><?php // echo $todayTransportedVehicle; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-12 mb-2  padding_left_right_null">
            <div class="card card-small">
                <div class="card-header border-bottom p-2 dashboard_card_header">
                    <h6 class="m-0 dash_board_card_title">Overall Info</h6>
                </div>
                <div class="card-body d-flex py-0 pt-0 pl-1 pr-1">
                    <table class="table table-padding">
                        <tbody>
                            <tr>
                                <th width="40%" class="text-black">Total committee's<span class="float-right">:</span></th>
                                <td><?php //echo $totalcommittee; ?></td>
                            </tr>
                            <tr>
                                <th width="40%" class="text-black">Total Lease Vehicle<span class="float-right">:</span></th>
                                <td><?php //echo $totalLeaseVehicle; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div> -->
    <!-- <div class="row ">
        <div class="col-lg-6 col-md-6 col-sm-12 mb-2  padding_left_right_null">
            <div class="card card-small">
                <div class="card-header border-bottom p-2 dashboard_card_header">
                    <h6 class="m-0 dash_board_card_title">Own Vehicle Fuel Info</h6>
                </div>
                <div class="card-body d-flex py-0 pt-0 pl-1 pr-1">
                    <table class="table table-padding">
                        <tbody>
                        <tr>
                                <th width="40%" class="text-black">Total Own Vehicle SELF<span class="float-right">:</span></th>
                                <td><?php //echo $totalOwnVehicleSELF; ?></td>
                            </tr>
                            <tr>
                                <th width="40%" class="text-black">Total Own Vehicle OTHER<span class="float-right">:</span></th>
                                <td><?php //echo $totalOwnVehicleOTHER; ?></td>
                            </tr>
                            <?php //echo $totalFuelAmount; ?>
                            <?php //echo $totalFuel; ?></td>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="row ">
        <div class="col-lg-7 col-md-7 col-12 mb-2  padding_left_right_null">
            <div class="card card-small">
                <div class="card-header border-bottom p-2 dashboard_card_header">
                    <h6 class="m-0 dash_board_card_title"> Today's Notification</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                        <?php 
              if(!empty($insuranceNotification)){
              foreach($insuranceNotification as $notification){ 
            ?>
                        <table class="table table-padding mb-0">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-black"><?php echo $notification->vehicle_number; ?><span
                                            class="float-right">:</span></th>
                                    <td>This Vehicle Insurance will be lapse on
                                        <?php echo date('d-m-Y',strtotime($notification->insurance_date)); ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <?php }  } ?>
                        <?php 
              if(!empty($roadTaxNotification)){
              foreach($roadTaxNotification as $notification){ 
            ?>
                        <table class="table table-padding mb-0">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-black"><?php echo $notification->vehicle_number; ?><span
                                            class="float-right">:</span></th>
                                    <td>This Vehicle Road Tax will be lapse on
                                        <?php echo date('d-m-Y',strtotime($notification->road_tax_date)); ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <?php }  } ?>

                        <?php 
              if(!empty($fcNotification)){
              foreach($fcNotification as $notification){ 
               ?>
                        <table class="table table-padding mb-0">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-black"><?php echo $notification->vehicle_number; ?><span
                                            class="float-right">:</span></th>
                                    <td>This Vehicle FC will be lapse on <?php echo date('d-m-Y',strtotime($notification->fc_date)); ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <?php }  } ?>

                        <?php 
              if(!empty($karnatakaPermitNotification)){
              foreach($karnatakaPermitNotification as $notification){ 
            ?>
                        <table class="table table-padding mb-0">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-black"><?php echo $notification->vehicle_number; ?><span
                                            class="float-right">:</span></th>
                                    <td>This Vehicle Karnataka Permit will be lapse on
                                        <?php echo date('d-m-Y',strtotime($notification->karnataka_permit_date)); ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <?php }  } ?>

                        <?php 
              if(!empty($nationalPermitNotification)){
              foreach($nationalPermitNotification as $notification){ 
            ?>
                        <table class="table table-padding mb-0">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-black"><?php echo $notification->vehicle_number; ?><span
                                            class="float-right">:</span></th>
                                    <td>This Vehicle National Permit will be lapse on
                                        <?php echo date('d-m-Y',strtotime($notification->national_permit_date)); ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <?php }  } ?>

                        <?php 
              if(!empty($emissionNotification)){
              foreach($emissionNotification as $notification){ 
            ?>
                        <table class="table table-padding mb-0">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-black"><?php echo $notification->vehicle_number; ?><span
                                            class="float-right">:</span></th>
                                    <td>This Vehicle Emission Date will be lapse on
                                        <?php echo date('d-m-Y',strtotime($notification->emission_date)); ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <?php }  } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
    <?php } ?>


    <?php if($role == ROLE_DIRECTOR ) { ?>
    <!-- <div class="row padding_left_right_null">

        <div class="col-lg-3 col-6 column_padding_card ">
            <div class="card card-small dash-card " style="background: #6bd66b;">
                <div class="card-body ">
                    <span class="stats-small__label text-uppercase text-white text-center">Own Vehicles</span>
                    <h6 class="stats-small__value count text-white"><?php echo $totalOwnVehicleSELF; ?></h6>
                    <div class="icon float-right">
                        <i class="fas fa-truck dash-icons"></i>
                    </div>
                </div>
                <div class="card-footer text-center dash-footer p-2">
                    <a class="more-info" href="<?php echo base_url(); ?>LeaseVehicleListing"><span>More Info <i
                                class="fa fa-arrow-circle-right"></i></span></a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6 column_padding_card ">
            <div class="card card-small dash-card " style="background: #e6a328">
                <div class="card-body ">
                    <span class="stats-small__label text-uppercase text-white text-center">Lease Vehicles</span>
                    <h6 class="stats-small__value count text-white"><?php echo $totalLeaseVehicle; ?></h6>
                    <div class="icon float-right">
                        <i class="fas fa-truck dash-icons"></i>
                    </div>
                </div>
                <div class="card-footer text-center dash-footer p-2">
                    <a class="more-info" href="<?php echo base_url(); ?>LeaseVehicleListing"><span>More Info <i
                                class="fa fa-arrow-circle-right"></i></span></a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6 column_padding_card ">
            <div class="card card-small dash-card " style="background: #119a74">
                <div class="card-body ">
                    <span class="stats-small__label text-uppercase text-white text-center">Bank(A/C)</span>
                    <h6 class="stats-small__value count text-white"><?php echo $totalBank; ?></h6>
                    <div class="icon float-right">
                        <i class="fas fa-bank dash-icons"></i>
                    </div>
                </div>
                <div class="card-footer text-center dash-footer p-2">
                    <a class="more-info" href="<?php echo base_url(); ?>bankListing"><span>More Info <i
                                class="fa fa-arrow-circle-right"></i></span></a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6  column_padding_card">
            <div class="card card-small dash-card" style="background: #7d7dcc;">
                <div class="card-body ">
                    <span class="stats-small__label text-uppercase text-white text-center">Employees</span>
                    <h6 class="stats-small__value count text-white"><?php echo $totalEmployee; ?></h6>
                    <div class="icon float-right">
                        <i class="fa fa-users  dash-icons"></i>
                    </div>
                </div>
                <div class="card-footer text-center dash-footer p-2">
                    <a class="more-info" href="<?php echo base_url(); ?>employeeListing"><span>More Info <i
                                class="fa fa-arrow-circle-right"></i></span></a>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <div class="row mt-2 ">
        <div class="col-lg-6 col-md-6 col-sm-12 mb-2  padding_left_right_null">
            <div class="card card-small">
                <div class="card-header border-bottom p-2 dashboard_card_header">
                    <h6 class="m-0 dash_board_card_title">Today Overall Info</h6>
                </div>
                <div class="card-body d-flex py-0 pt-0 pl-1 pr-1">
                    <table class="table table-padding">
                        <tbody>
                            <tr>
                                <th width="40%" class="text-black">Cash Ledger<span class="float-right">:</span></th>
                                <td><?php echo $todayCashLedger; ?></td>
                            </tr>
                            <tr>
                                <th class="text-black">Transported Vehicle<span class="float-right">:</span></th>
                                <td><?php echo $todayTransportedVehicle; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-12 mb-2  padding_left_right_null">
            <div class="card card-small">
                <div class="card-header border-bottom p-2 dashboard_card_header">
                    <h6 class="m-0 dash_board_card_title">Overall Info</h6>
                </div>
                <div class="card-body d-flex py-0 pt-0 pl-1 pr-1">
                    <table class="table table-padding">
                        <tbody>
                            <tr>
                                <th width="40%" class="text-black">Total committee's<span class="float-right">:</span></th>
                                <td><?php echo $totalcommittee; ?></td>
                            </tr>
                            <tr>
                                <th width="40%" class="text-black">Total Lease Vehicle<span class="float-right">:</span></th>
                                <td><?php echo $totalLeaseVehicle; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="row ">
        <div class="col-lg-6 col-md-6 col-sm-12 mb-2  padding_left_right_null">
            <div class="card card-small">
                <div class="card-header border-bottom p-2 dashboard_card_header">
                    <h6 class="m-0 dash_board_card_title">Own Vehicle Fuel Info</h6>
                </div>
                <div class="card-body d-flex py-0 pt-0 pl-1 pr-1">
                    <table class="table table-padding">
                        <tbody>
                        <tr>
                                <th width="40%" class="text-black">Total Own Vehicle SELF<span class="float-right">:</span></th>
                                <td><?php echo $totalOwnVehicleSELF; ?></td>
                            </tr>
                            <tr>
                                <th width="40%" class="text-black">Total Own Vehicle OTHER<span class="float-right">:</span></th>
                                <td><?php echo $totalOwnVehicleOTHER; ?></td>
                            </tr>
                            <tr>
                                <th width="40%" class="text-black">Total Amount Of Fuel<span class="float-right">:</span></th>
                                <td><?php echo $totalFuelAmount; ?></td>
                            </tr>
                            <tr>
                                <th width="40%" class="text-black">Total Fuel(Liter)<span class="float-right">:</span></th>
                                <td><?php echo $totalFuel; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row ">
        <div class="col-lg-7 col-md-7 col-12 mb-2  padding_left_right_null">
            <div class="card card-small">
                <div class="card-header border-bottom p-2 dashboard_card_header">
                    <h6 class="m-0 dash_board_card_title"> Today's Notification</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                        <?php 
              if(!empty($insuranceNotification)){
              foreach($insuranceNotification as $notification){ 
            ?>
                        <table class="table table-padding mb-0">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-black"><?php echo $notification->vehicle_number; ?><span
                                            class="float-right">:</span></th>
                                    <td>This Vehicle Insurance will be lapse on
                                        <?php echo date('d-m-Y',strtotime($notification->insurance_date)); ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <?php }  } ?>
                        <?php 
              if(!empty($roadTaxNotification)){
              foreach($roadTaxNotification as $notification){ 
            ?>
                        <table class="table table-padding mb-0">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-black"><?php echo $notification->vehicle_number; ?><span
                                            class="float-right">:</span></th>
                                    <td>This Vehicle Road Tax will be lapse on
                                        <?php echo date('d-m-Y',strtotime($notification->road_tax_date)); ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <?php }  } ?>

                        <?php 
              if(!empty($fcNotification)){
              foreach($fcNotification as $notification){ 
               ?>
                        <table class="table table-padding mb-0">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-black"><?php echo $notification->vehicle_number; ?><span
                                            class="float-right">:</span></th>
                                    <td>This Vehicle FC will be lapse on <?php echo date('d-m-Y',strtotime($notification->fc_date)); ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <?php }  } ?>

                        <?php 
              if(!empty($karnatakaPermitNotification)){
              foreach($karnatakaPermitNotification as $notification){ 
            ?>
                        <table class="table table-padding mb-0">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-black"><?php echo $notification->vehicle_number; ?><span
                                            class="float-right">:</span></th>
                                    <td>This Vehicle Karnataka Permit will be lapse on
                                        <?php echo date('d-m-Y',strtotime($notification->karnataka_permit_date)); ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <?php }  } ?>

                        <?php 
              if(!empty($nationalPermitNotification)){
              foreach($nationalPermitNotification as $notification){ 
            ?>
                        <table class="table table-padding mb-0">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-black"><?php echo $notification->vehicle_number; ?><span
                                            class="float-right">:</span></th>
                                    <td>This Vehicle National Permit will be lapse on
                                        <?php echo date('d-m-Y',strtotime($notification->national_permit_date)); ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <?php }  } ?>

                        <?php 
              if(!empty($emissionNotification)){
              foreach($emissionNotification as $notification){ 
            ?>
                        <table class="table table-padding mb-0">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-black"><?php echo $notification->vehicle_number; ?><span
                                            class="float-right">:</span></th>
                                    <td>This Vehicle Emission Date will be lapse on
                                        <?php echo date('d-m-Y',strtotime($notification->emission_date)); ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <?php }  } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
    <?php } ?>
    <br>
    <div class="row padding_left_right_null">
        <div class="col-lg-6 col-6  column_padding_card">
            <div class="card card-small" style="background: #009999;">
                <div class="card-header border-bottom card_head_dashboard" style="background: #009999;">
                    <h6 class="mb-0 text-white text-bold">Today's Pooja</h6>
                    <!-- <div class="icon float-right">
              <i class="fa fa-calendar  dash-icons"></i>
            </div>  -->
                    <!-- <i onclick="window.location.reload();" title="Refresh" class="fa fa-refresh float-right icon_refresh text-dark" aria-hidden="true"></i> -->
                </div>
                <div class="card-body p-0 " style="background: #ffffff;">
                    <ul class="list-group list-group-small list-group-flush">
                        <?php
              if(!empty($notificationMessage)){
              foreach($notificationMessage as $notification){ 
                if($notification->event_type != 'Date'){
            ?>
                        <li class="list-group-item d-flex px-3 notification_info">
                            <span class="text-semibold text-dark" style="font-weight:500">Daily pooja by
                                <?php echo $notification->devotee_name; ?> Based on
                                <?php echo $notification->event_type; ?>
                            </span>
                            <!-- <span class="ml-auto text-right text-fiord-blue text-semibold" style="font-weight:600">Date</span> -->
                        </li>
                        <?php } }  }else{ ?>
                        <li class="list-group-item d-flex">
                            <span class="text-semibold text-dark mx-auto" style="font-weight:500">Today No
                                Announcement</span>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>



        <div class="col-lg-6 col-6  column_padding_card">
            <div class="card card-small" style="background: #009999;">
                <div class="card-header border-bottom card_head_dashboard" style="background: #009999;">

                    <h6 class="mb-0 text-white text-bold">Today's Panchanga <a
                            class="btn text-white mobile-btn pull-right" style="background: #009999;" href=""
                            data-toggle="modal" data-target="#Modal"><i class="fa fa-plus"></i> Add New </a>
                    </h6>

                    <!-- <i onclick="window.location.reload();" title="Refresh" class="fa fa-refresh float-right icon_refresh text-dark" aria-hidden="true"></i> -->
                </div>
                <div class="card-body p-0 " style="background: #ffffff;">
                    <!-- <ul class="list-group list-group-small list-group-flush">
            <?php
              if(!empty($notificationMessage)){
              foreach($notificationMessage as $notification){ 
            ?>
            <li class="list-group-item d-flex px-3 notification_info">
              <span class="text-semibold text-dark" style="font-weight:500">Daily pooja by <?php echo $notification->devotee_name; ?> Based on <?php echo $notification->event_type; ?>
              </span>
            </li>
            <?php }  }else{ ?>
              <li class="list-group-item d-flex">
                <span class="text-semibold text-dark mx-auto" style="font-weight:500">Today No Announcement</span>
              </li>
            <?php } ?>
          </ul> -->
                    <table class="container">
                        <tr>
                            <th class="container" style="width:100px">Date</th>
                            <th style="width:120px">Nakshathra</th>
                            <th style="width:100px">Paksha</th>
                            <th style="width:100px">Tithi</th>
                        </tr>
                        <?php 
            if(!empty($daypanchanga)){
                foreach($daypanchanga as $panchanga){
                    if($panchanga->date=='1970-01-01'){$date='';} else { $date =date('d-m-Y',strtotime($panchanga->date));}
                    ?>
                        <tr>
                            <td class="container" style="width:100px"><?php echo $date;?></td>
                            <td><?php echo $panchanga->nakshathra;?></td>
                            <td><?php echo $panchanga->paksha;?></td>
                            <td><?php echo $panchanga->tithi;?></td>
                        </tr>
                        <?php
                }
            }
            ?>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="row padding_left_right_null mt-4">
        <div class="col-lg-6 col-6  column_padding_card">
            <div class="card card-small" style="background: #009999;">
                <div class="card-header border-bottom card_head_dashboard" style="background: #009999;">
                    <h6 class="mb-0 text-white text-bold">Today's Yearly Pooja</h6>
                    <!-- <div class="icon float-right">
              <i class="fa fa-calendar  dash-icons"></i>
            </div>  -->
                    <!-- <i onclick="window.location.reload();" title="Refresh" class="fa fa-refresh float-right icon_refresh text-dark" aria-hidden="true"></i> -->
                </div>
                <div class="card-body p-0 " style="background: #ffffff;">
                <table class="container">
                        <tr>
                            <th class="container" style="width:40px">Date</th>
                            <th style="width:120px">Devotee Name</th>
                        </tr>                        
            <?php
              if(!empty($yearlyPoojaInfo)){
              foreach($yearlyPoojaInfo as $pooja){ 
            ?>
                      
                      <tr>
                            <td class="container" style="width:100px"><?php echo $pooja->date;?>-<?php echo date('Y') ?></td>
                            <td><?php echo $pooja->devotee_name;?></td>
                        </tr>
                        <?php  }  } ?>
                        </table>

                </div>
            </div>
        </div>



        <div id="Modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header modal-call-report p-2">
                        <div class=" col-md-10 col-10">
                            <span class="text-white mobile-title" style="font-size : 20px">Add Today's
                                Details</span>
                        </div>
                        <div class=" col-md-2 col-2">
                            <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body m-2">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="" action="<?php echo base_url() ?>addDetails" method="post" role="form"
                            enctype="multipart/form-data">
                            <!-- Default Light Table -->
                            <div class="row form-contents">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="">Date</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-append">
                                                    <span
                                                        class="input-group-text material-icons date-icon">date_range</span>
                                                    <input id="date" type="text" name="date"
                                                        value="<?php echo date('d-m-Y');?>"
                                                        class="form-control datepicker date-col-12"
                                                        placeholder="Date of Birth" autocomplete="off">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="event_id">Event</label>
                                            <select class="form-control " id="event_id" name="event_id">
                                                <option value=""> Select Event </option>
                                                <?php if(!empty($eventInfo)) {
                                        foreach($eventInfo as $event ){?>
                                                <option value="<?php echo $event->row_id;?>">
                                                    <?php echo $event->events;?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="tithi_id">Tithi</label>
                                            <select class="form-control " id="tithi_id" name="tithi_id" required>
                                                <option value=""> Select Tithi </option>
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
                                            <select class="form-control " id="nakshathra_id" name="nakshathra_id"
                                                required>
                                                <option value=""> Select Nakshathra </option>
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
                                            <select class="form-control " id="masa_id" name="masa_id">
                                                <option value=""> Select Masa </option>
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
                                            <select class="form-control" id="gothra_id" name="gothra_id">
                                                <option value=""> Select Gothra </option>
                                                <?php if(!empty($gothraInfo)) {
                                        foreach($gothraInfo as $gothra ){?>
                                                <option value="<?php echo $gothra->row_id;?>">
                                                    <?php echo $gothra->gothra;?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12 event_panchanga">
                                        <div class="form-group">
                                            <label for="paksha_id">Paksha</label>
                                            <select class="form-control " id="paksha_id" name="paksha_id">
                                                <option value=""> Select Paksha </option>
                                                <?php if(!empty($pakshaInfo)) {
                                        foreach($pakshaInfo as $paksha ){?>
                                                <option value="<?php echo $paksha->row_id;?>">
                                                    <?php echo $paksha->paksha;?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="form-group">
                                <input style="float:right;" type="submit" class="btn btn-primary" value="Add" />
                            </div>
                    </div>
                </div>
                </form> <!-- form end -->
            </div>
        </div>
    </div>
</div>

</div>

<script>
$(window).on("load", function() {
    setTimeout(function() {
        $(".loader").hide();
    }, 500);
});
jQuery(document).ready(function() {
    jQuery('.datepicker').datepicker({
        autoclose: true,
        orientation: "bottom",
        format: "dd-mm-yyyy"
    });
    // jQuery('.datepicker').datepicker({
    //         autoclose: true,
    //         format: "yyyy-mm-dd"
    //     });
});
</script>