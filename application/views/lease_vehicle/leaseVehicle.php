<style>
.select2-container--default .select2-selection--single .select2-selection__rendered {
    font-weight: 600;
}

.select2-container--default .select2-selection--single {
    margin-left: -30px;
    margin-right: -29px;
    height: 20px;
    border-radius: 0px;
    text-align: left;
}

.select2-container--default .select2-selection--single .select2-selection__arrow b {
    margin-top: 3px !important;
    color: black !important;
    margin-left: 10px !important;
}

.select2-container--open .select2-dropdown--below {
    width: 250px !important;
    margin-left: -25px !important;
}
@media screen and (max-width: 480px) {
    .select2-container--default .select2-selection--single {
        margin-left: 0px !important;
        margin-right: 0px !important;
        border-radius: 0px !important;
        text-align: left !important;
        height: 31px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        margin-right: 20px !important;
    }

    .select2-container--open .select2-dropdown--below {
        width: 130px !important;
        margin-left: -5px !important;
    }
}
</style>
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
                                    <i class="fa fa-truck mobile-title"></i> Lease Vehicle Management
                                </span>
                            </div>
                            <div class="col-lg-6 col-12 box-tools">
                                <form action="<?php echo base_url() ?>LeaseVehicleListing" method="POST"
                                    id="searchList">
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

                            <div class="col-md-6 col-7 ">
                                <a class="btn btn-primary mobile-btn ml-2 pull-right"
                                    href="<?php echo base_url(); ?>addLeaseVehiclePageView"><i class="fa fa-plus"></i>
                                    Add New</a>

                                <a class="btn btn-success mobile-btn pull-right " href="" data-toggle="modal"
                                    data-target="#Modal"><i class="fa fa-file"></i>
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
                        <table class="table mb-0 form-table-padding bordeless">
                            <tr class="bg-deafult">
                                <form action="<?php echo base_url() ?>LeaseVehicleListing" method="POST"
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
                                        <select
                                            class="form-control is-valid input-sm js-example-basic-single mobile-width"
                                            id="transporter_name" name="transporter_name">
                                            <?php if($transporter_name != "") { ?>
                                            <option value="<?php echo $transporter_name; ?>" selected><b>Sorted:
                                                    <?php echo $transporter_name; ?></b></option>
                                            <option value="">ALL</option>
                                            <?php if(!empty($transporters))
                                                        { foreach ($transporters as $trans)
                                                            { ?>
                                                <option value="<?php echo $trans->transporter_name ?>">
                                                    <?php echo $trans->transporter_name ?></option>
                                                <?php   } 
                                          } ?>
                                            <?php } else { ?>
                                            <option value="">Select Transporter</option>
                                            <?php if(!empty($transporters))
                                                        { foreach ($transporters as $trans)
                                                            { ?>
                                                <option value="<?php echo $trans->transporter_name ?>">
                                                    <?php echo $trans->transporter_name ?></option>
                                                <?php   } 
                                          } ?>
                                            <?php } ?>
                                        </select></th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="contact_number_one" id="contact_number_one"
                                                value="<?php echo $contact_number_one ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By Contact"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fas fa-phone"></i></div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="rc_number" id="rc_number"
                                                value="<?php echo $rc_number ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By RC"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fas fa-phone"></i></div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="pan_number" id="contact_number_one"
                                                value="<?php echo $pan_number ?>"
                                                class="form-control input-sm pull-right "
                                                placeholder="By PAN"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fas fa-phone"></i></div>
                                        </div>
                                    </th>
                                    <th width="180" class="text-center btn-padding"><button type="submit"
                                            class="btn btn-success btn-block mobile-width"> Search</button></th>
                                </form>
                            </tr>
                            <tr class=" text-white  bg-black">
                                <th>Vehicle Number</th>
                                <th>Transporter Name</th>
                                <th>Contact Number</th>
                                <th>RC Number</th>
                                <th>PAN Number</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                        if(!empty($LeaseVehicleRecords))
                        {
                            foreach($LeaseVehicleRecords as $record)
                            {
                        ?>
                                <tr class="text-black">
                                <td><?php echo $record->vehicle_number ?></td>
                                <td><?php echo $record->transporter_name ?></td>
                                <td><?php echo $record->contact_number_one ?></td>
                                <td><?php echo $record->rc_number ?></td>
                                <td><?php echo $record->pan_number ?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary"
                                        href="<?= base_url().'viewLeaseVehicle/'.$record->row_id; ?>"
                                        title="View More"><i class="fa fa-eye"></i></a>
                                    <?php if($role == ROLE_ADMIN || $role == ROLE_EMPLOYEE) { ?>
                                    <a class="btn  btn-sm btn-info"
                                        href="<?php echo base_url().'editLeaseVehiclePageView/'.$record->row_id; ?>"
                                        title="Edit"><i class="fas fa-edit"></i></i></a>
                                    <a class="btn btn-sm btn-danger deleteLeaseVehicle" href="#"
                                        data-row_id="<?php echo $record->row_id; ?>" title="Delete"><i
                                            class="fas fa-trash"></i></a>
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
                <div id="Modal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg ">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header modal-call-report p-2">
                                <div class=" col-lg-10 col-10">
                                    <span class="text-white mobile-title" style="font-size : 20px">Lease Vehicle
                                        Report</span>
                                </div>
                                <div class=" col-lg-2 col-2  ">
                                    <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                                </div>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <?php $this->load->helper("form"); ?>

                                <div class="row">

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="vehicle_number">Vehicle Number</label>
                                            <select required name="vehicle_number" id="report_vehicle_number"
                                                class="form-control required selectpicker" data-live-search="true">
                                                <!-- <option value="">Select Vehicle</option> -->
                                                <option value="ALL">ALL</option>
                                                <?php if(!empty($vehicles))
                                                        { foreach ($vehicles as $vehicle)
                                                            { ?>
                                                <option value="<?php echo $vehicle->vehicle_number ?>">
                                                    <?php echo $vehicle->vehicle_number ?></option>
                                                <?php   } 
                                          } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="transporter_name">Transporter name</label>
                                            <select required name="transporter_name" id="report_transporter_name"
                                                class="form-control required selectpicker" data-live-search="true">
                                                <!-- <option value="">Select Transporter</option> -->
                                                <option value="ALL">ALL</option>
                                                <?php if(!empty($transporters))
                                                        { foreach ($transporters as $trans)
                                                            { ?>
                                                <option value="<?php echo $trans->transporter_name ?>">
                                                    <?php echo $trans->transporter_name ?></option>
                                                <?php   } 
                                          } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <a class="btn  btn-success text-white" onclick="downloadLeaseVehicleReport()"><i
                                        class="fa fa-download"> &nbsp;Vehicle Report</i></a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lease_vehicle/lease_vehicle.js" charset="utf-8">
</script>
<script type="text/javascript">
function downloadLeaseVehicleReport() {
    var vehicle_number = $('#report_vehicle_number :selected').val();
    var transporter_name = $('#report_transporter_name :selected').val();
    $.ajax({
        url: '<?php echo base_url(); ?>/downloadLeaseVehicleReport ',
        type: 'POST',
        dataType: 'json',
        data: {
            transporter_name: transporter_name,
            vehicle_number: vehicle_number,
        },

        success: function(data) {
            // $("#loader").html("<span style='color:green'><b>Downloded</b></span>");
            // var studentObj = JSON.parse(data)
            var $a = $("<a>");
            $a.attr("href", data.file);
            $("body").append($a);
            $a.attr("download", "Lease_Vehicle_Result_" + vehicle_number + "_Report_file.xls");
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
jQuery(document).ready(function() {
    $('.js-example-basic-single').select2();
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#searchList").attr("action", baseURL + "LeaseVehicleListing/" + value);
        jQuery("#searchList").submit();
    });
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#byFilterMethod").attr("action", baseURL + "LeaseVehicleListing/" + value);
        jQuery("#byFilterMethod").submit();
    });
    jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});
</script>