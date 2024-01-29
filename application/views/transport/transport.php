<style>
.select2-container--default .select2-selection--single .select2-selection__rendered {
    font-weight: 600;
}

.select2-container--default .select2-selection--single {
    margin-left: -9px;
    margin-right: -9px;
    height: 20px;
    border-radius: 0px;
    text-align: left;
}

.select2-container--default .select2-selection--single .select2-selection__arrow b {
    margin-top: 3px !important;
    color: black !important;
    margin-left: 5px !important;
}

.select2-container--open .select2-dropdown--below {
    width: 180px !important;
    margin-left: -10px !important;
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
        margin-right: 30px !important;
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
                                    <i class="fa fa-road mobile-title"></i> Transport Management (Ponch <?php echo $ponch; ?>)
                                </span>
                            </div>
                            <div class="col-lg-6 col-12 box-tools">
                                <?php if($ponch=="Uncleared"){
                                    $transurl = "pendingPonch";
                                }else{
                                    $transurl = "clearPonch";
                                }?>

                                <form action="<?php echo base_url().$transurl ?>TransportListing" method="POST" id="searchList">
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
                                <span class="page-sub-title mobile-title">Total Transport: <?php echo $count; ?></span>
                            </div>
                            <div class="col-md-6 col-7 text-right">
                                <a class="btn btn-primary mobile-btn ml-2 pull-right"
                                    href="<?php echo base_url(); ?>addTransportPageView"><i class="fa fa-plus"></i>
                                    Add New</a>
                                <a class="btn btn-success mobile-btn pull-right" href="" data-toggle="modal"
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
                                <?php if($ponch=="Uncleared"){
                                    $transurl = "pendingPonch";
                                }else{
                                    $transurl = "clearPonch";
                                }?>
                                <form action="<?php echo base_url().$transurl ?>TransportListing" method="POST"
                                    id="byFilterMethod">
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid datepicker mobile-width" type="text"
                                                name="date" id="date" value="<?php echo $date ?>"
                                                style="text-transform: uppercase" placeholder="By Date"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </th>
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
                                            <?php if(!empty($transporters)){
                                           foreach ($transporters as $trans) {?>
                                            <option value="<?php echo $trans->transporter_name ?>">
                                                <?php echo $trans->transporter_name ?></option>
                                            <?php } } ?>
                                            <?php } else { ?>
                                            <option value="">Select Any</option>
                                            <?php if(!empty($transporters)){
                                          foreach ($transporters as $trans) {?>
                                            <option value="<?php echo $trans->transporter_name ?>">
                                                <?php echo $trans->transporter_name ?></option>
                                            <?php } } ?>
                                            <?php } ?>
                                        </select></th>
                                    <th width="150" style="padding: 0px;">
                                        <select
                                            class="form-control is-valid input-sm js-example-basic-single mobile-width"
                                            id="party_name" name="party_name">
                                            <?php if($party_name != "") { ?>
                                            <option value="<?php echo $party_name; ?>" selected><b>Sorted:
                                                    <?php echo $party_name; ?></b></option>
                                            <option value="">ALL</option>
                                            <?php if(!empty($party)){
                                           foreach ($party as $p1) {?>
                                            <option value="<?php echo $p1->party_name ?>">
                                                <?php echo $p1->party_name ?></option>
                                            <?php } } ?>
                                            <?php } else { ?>
                                            <option value="">Select Any</option>
                                            <?php if(!empty($party)){
                                          foreach ($party as $p1) {?>
                                            <option value="<?php echo $p1->party_name ?>">
                                                <?php echo $p1->party_name ?></option>
                                            <?php } } ?>
                                            <?php } ?>
                                        </select></th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="ponch_amount" id="ponch_amount"
                                                value="<?php echo $ponch_amount ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By Amount"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-money"></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th width="180" class="text-center btn-padding"><button type="submit"
                                            class="btn btn-success btn-block mobile-width"> Search</button></th>
                                </form>
                            </tr>
                            <tr class=" text-white  bg-black">
                                <th>Date</th>
                                <th>Vehicle Number</th>
                                <th>Transporter Name</th>
                                <th>Party Name</th>
                                <th>Ponch Amount</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                        if(!empty($transportRecords))
                        {
                            foreach($transportRecords as $record)
                            {
                        ?>
                            <tr class="text-black">
                                <td><?php  echo date('d-m-Y',strtotime($record->date));?></td>
                                <td><?php echo $record->vehicle_number ?></td>
                                <td><?php echo $record->transporter_name ?></td>
                                <td><?php echo $record->party_name ?></td>
                                <td><?php echo $record->ponch_amount ?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary"
                                        href="<?= base_url().'viewTransport/'.$record->row_id; ?>" title="View More"><i
                                            class="fa fa-eye"></i></a>
                                    <?php if($role == ROLE_ADMIN || $role == ROLE_EMPLOYEE) { ?>
                                    <a class="btn  btn-sm btn-info"
                                        href="<?php echo base_url().'editTransportPageView/'.$record->row_id; ?>"
                                        title="Edit"><i class="fas fa-edit"></i></i></a>
                                    <a class="btn btn-sm btn-danger deleteTransport" href="#"
                                        data-row_id="<?php echo $record->row_id; ?>" title="Delete"><i
                                            class="fas fa-trash"></i></a>
                                            <a <?php if($record->ponch_pending == 'Yes') { ?>
                                        class="btn btn-sm btn-success text-white " <?php } else {?>
                                        class="btn btn-sm btn-danger text-white disabled " <?php } ?>href=""
                                        data-toggle="modal" data-target="#Modal2"
                                        onclick="openModal2('<?php echo $record->row_id; ?>','<?php echo $record->ponch_amount; ?>')"><i
                                            class="fa fa-money"></i>&nbsp;&nbsp;Ponch Clear</a>
                                    <?php } ?>
                                   
                                </td>
                            </tr>
                            <?php
                        }
                    } else { ?>
                            <tr>
                                <td class="text-center " colspan="10">
                                    Transport Not Found!!.
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
                                    <span class="text-white mobile-title" style="font-size : 20px">Transport
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
                                    <div class="col-md-6 col-sm-12">
                                        <label for="fromDate">Date From</label>
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
                                        <label for="toDate">Date To</label>
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
                                    <br><br><br><br>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="transporter_name">By Party name</label>
                                            <select required name="party_name" id="report_party_name"
                                                class="form-control required selectpicker" data-live-search="true"
                                                required>
                                                <!-- <option value="">Select Party</option> -->
                                                <option value="ALL">ALL</option>
                                                <?php if(!empty($party))
                                                        { foreach ($party as $p1)
                                                            { ?>
                                                <option value="<?php echo $p1->party_name ?>">
                                                    <?php echo $p1->party_name ?></option>
                                                <?php   } 
                                          } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="vehicle_number">By Vehicle Number</label>
                                            <select name="vehicle_number" id="report_vehicle_number"
                                                class="form-control required selectpicker" data-live-search="true"
                                                required>
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
                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group">
                                            <label for="modal_transporter_name">By Transporter name</label>
                                            <select required name="modal_transporter_name" id="modal_transporter_name"
                                                class="form-control required selectpicker" data-live-search="true" required>
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
                                    <div class="col-md-6  col-12">
                                        <div class="form-group">
                                            <label for="ponch_pending">Ponch Pending </label>
                                            <select class="form-control " id="report_ponch_pending" name="ponch_pending"
                                                required>
                                                <!-- <option value="">Select Any</option> -->
                                                <option value="All">All</option>
                                                <option value="Yes"> Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <a class="btn  btn-success text-white" onclick="downloadTransportReport()"><i
                                        class="fa fa-download"> &nbsp;Download Report</i></a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                                    <span class="text-white mobile-title" style="font-size : 20px">Enter Ponch Clear
                                        Details
                                    </span>
                                </div>
                                <div class=" col-md-2 col-2  ">
                                    <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                                </div>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <?php $this->load->helper("form"); ?>
                                <form role="form" id="updatePonchClear"
                                    action="<?php echo base_url() ?>updatePonchClear" method="post" role="form">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <label for="ponch_date">Date</label>
                                            <div class="input-group ">
                                                <span class="input-group-append">
                                                    <span
                                                        class="input-group-text material-icons date-icon">date_range</span>
                                                </span>
                                                <input id="ponch_date" type="text" name="ponch_date"
                                                    value="<?php echo date('d-m-Y'); ?>"
                                                    class="form-control datepicker  " placeholder="Enter Date"
                                                    autocomplete="off" required>
                                                <input type="hidden" name="row_id" id="row_id" />
                                                <input type="hidden" name="ponch_amount" id="ponch_amount" />

                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12">
                                            <div class="form-group">
                                                <label for="ponch_pending">Ponch Pending </label>
                                                <select class="form-control" id="ponch_pending" name="ponch_pending"
                                                    required>
                                                    <option value="">Select Any</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12  col-12">
                                            <span class="text-black mobile-title" style="font-size : 17px">Ponch Pending
                                                Amount:</span>
                                            &nbsp;&nbsp; <span class="ponch_amount text-black mobile-title"
                                                style="font-size : 17px"></span>
                                        </div>
                                        <br> <br>
                                        <div class="col-md-6 col-12c">
                                            <div class="form-group">
                                                <label for="ponch_clear_bank_account">Bank</label>
                                                <select  name="ponch_clear_bank_account"
                                                    id="ponch_clear_bank_account"
                                                    class="form-control  selectpicker" data-live-search="true">
                                                    <option value="">Select Bank</option>
                                                    <?php if(!empty($bank))
                                                        { foreach ($bank as $b1)
                                                            { ?>
                                                    <option value="<?php echo $b1->row_id ?>">
                                                        <?php echo $b1->bank_name ?></option>
                                                    <?php   } 
                                          } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="ponch_clear_amount_by_bank">Amount By Bank</label>
                                                <input type="text" class="form-control " id="ponch_clear_amount_by_bank"
                                                    onkeypress="return isNumberKey(event)"
                                                    name="ponch_clear_amount_by_bank" placeholder="Enter Amount"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 ">
                                            <div class="form-group">
                                                <label for="ponch_clear_cash_account">Cash Account</label>
                                                <select name="ponch_clear_cash_account" id="ponch_clear_cash_account"
                                                    class="form-control  selectpicker" data-live-search="true">
                                                    <option value="">Select Cash Account</option>
                                                            <?php if(!empty($cashAccount))
                                                        { foreach ($cashAccount as $account)
                                                            { ?>
                                                            <option value="<?php echo $account->row_id ?> " >
                                                                <?php echo $account->cash_account_name ?> (Balance:<?php echo $account->account_balance ?>)</option>
                                                            <?php   } 
                                                          } ?>
                                                        </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="ponch_clear_amount_by_cash">Amount By Cash</label>
                                                <input type="text" class="form-control " id="ponch_clear_amount_by_cash"
                                                    onkeypress="return isNumberKey(event)"
                                                    name="ponch_clear_amount_by_cash" placeholder="Enter Amount"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 ">
                                            <div class="form-group">
                                                <label for="ponch_clear_cash_account">Fuel Account</label>
                                                <select name="ponch_clear_fuel_account" id="ponch_clear_fuel_account"
                                                    class="form-control  selectpicker" data-live-search="true">
                                                    <option value="">Select Fuel Account</option>
                                                            <?php if(!empty($fuelAccount))
                                                        { foreach ($fuelAccount as $fuel)
                                                            { ?>
                                                            <option value="<?php echo $fuel->row_id ?> " >
                                                                <?php echo $fuel->fuel_account_name ?> (Balance:<?php echo $fuel->account_balance ?>)</option>
                                                            <?php   } 
                                                          } ?>
                                                        </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="ponch_clear_amount_by_fuel">Amount By Fuel</label>
                                                <input type="text" class="form-control " id="ponch_clear_amount_by_fuel"
                                                    onkeypress="return isNumberKey(event)"
                                                    name="ponch_clear_amount_by_fuel" placeholder="Enter Amount"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="comments">Comments</label>
                                                <textarea class="form-control " placeholder="Enter Comments"
                                                    name="comments" id="comments" rows="3"
                                                    autocomplete="off" required></textarea>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/transport/transport.js" charset="utf-8">
</script>
<script type="text/javascript">
function openModal2(row_id, ponch_amount) {
    $("#Modal2").modal('show');
    $("#Modal2 .ponch_amount").html(ponch_amount);
    document.getElementById("row_id").value = row_id;
    document.getElementById("ponch_amount").value = ponch_amount;


}

function downloadTransportReport() {
    var from_date = $('#fromDate').val();
    var to_date = $('#toDate').val();
    var vehicle_number = $('#report_vehicle_number :selected').val();
    var party_name = $('#report_party_name :selected').val();
    var transporter_name = $('#modal_transporter_name :selected').val();
    var ponch_pending = $('#report_ponch_pending').val();
    if ($('#fromDate').val() == "") {
        alert("Please enter From Date!");
    } else if ($('#toDate').val() == "") {
        alert("Please enter To Date!");
    } else {
        $.ajax({
            url: '<?php echo base_url(); ?>/downloadTransportReport ',
            type: 'POST',
            dataType: 'json',
            data: {
                from_date: from_date,
                to_date: to_date,
                vehicle_number: vehicle_number,
                party_name: party_name,
                transporter_name : transporter_name,
                ponch_pending: ponch_pending,
            },

            success: function(data) {
                // $("#loader").html("<span style='color:green'><b>Downloded</b></span>");
                // var studentObj = JSON.parse(data)
                var $a = $("<a>");
                $a.attr("href", data.file);
                $("body").append($a);
                $a.attr("download", "Transport_Result_" + from_date + "_to_" + to_date +
                "_Report_file.xls");
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

jQuery(document).ready(function() {
    <?php if($ponch=="Uncleared"){
        $transurl = "pendingPonch";
    }else{
        $transurl = "clearPonch";
    }?>
    $(".bank").hide();
    $(".cash").hide();
    $('.js-example-basic-single').select2();
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#searchList").attr("action", "<?php echo base_url().$transurl ?>TransportListing/" + value);
        jQuery("#searchList").submit();
    });
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#byFilterMethod").attr("action", "<?php echo base_url().$transurl ?>TransportListing/" + value);
        jQuery("#byFilterMethod").submit();
    });
    jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });



    // $("#payment_type").change(function(e) {
    // alert("ghd");
    //     var select = e.target;
    //     var value = $("#payment_type").val();
    //     if(value != 0){
    //     var option = select.options[select.selectedIndex];
    //     if(value == "Bank"){
    //         $(".cash").hide();
    //         $(".bank").show();

    //     }else if((value == "Cash")){
    //         $(".cash").show();
    //         $(".bank").hide();  
    //     }        
    // }else{
    //     $(".cash").hide();
    //     $(".bank").hide();

    // } 
    // });
});
</script>