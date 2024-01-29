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
                            <div class="col-lg-6 text-white">Edit Indent</div>
                            <div class="col-lg-6"> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck pull-right mobile-bck "><i
                                        class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- form start -->
        <div class="col-lg-12">
            <div class="card card-small c-border mb-4 ">
                <div class="card-body contents-body ">
                    <form role="form" id="addCallAssign" action="<?php echo base_url() ?>updateIndent" method="post"
                        role="form">
                        <input type="hidden" value="<?php echo $identInfo->row_id; ?>" id="identCustId" name="row_id">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="assigned_date_from">Indent Date </label>
                                <div class="input-group ">
                                    <span class="input-group-append">
                                        <span class="input-group-text material-icons date-icon">date_range</span>
                                    </span>
                                    <input value="<?php echo date('d-m-Y',strtotime($identInfo->date)); ?>"
                                        id="assigned_date_from" type="text" name="date" class="form-control datepicker"
                                        placeholder="Assigned Date From" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="assigned_type">Contract Number</label>
                                    <input type="text" class="form-control" id="contract_number" name="contract_number"
                                        value="<?php echo $identInfo->contract_number; ?>"
                                        placeholder="Enter Contract Number" autocomplete="off" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="assigned_type">Product Code</label>
                                    <input type="text" class="form-control" id="product_code" name="product_code"
                                        value="<?php echo $identInfo->product_code; ?>" placeholder="Enter Product Code"
                                        autocomplete="off" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="assigned_type">Quantity with Unit</label>
                                    <input type="text" class="form-control" id="qty_unit" name="qty_unit"
                                        value="<?php echo $identInfo->qty_unit; ?>" placeholder="Enter Quantity"
                                        autocomplete="off" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="assigned_type">Destination & Distance in KM</label>
                                    <input type="text" class="form-control" id="dest_km" name="dest_km"
                                        value="<?php echo $identInfo->destination_km; ?>"
                                        placeholder="Enter Destination & Distance" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="assigned_type">LR Number</label>
                                    <input type="text" class="form-control" id="lr_num" name="lr_num"
                                        value="<?php echo $identInfo->lr_number; ?>" placeholder="Enter LR Number"
                                        autocomplete="off" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="assigned_type">Tank Truck Number</label>
                                    <input type="text" class="form-control" id="tank_truck" name="tank_truck"
                                        value="<?php echo $identInfo->tank_truck_number; ?>"
                                        placeholder="Enter Tank Truck Number" autocomplete="off" >
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="assigned_type">Shipping Bill No.</label>
                                    <input type="text" class="form-control" id="" name="shipping_bill_no"  value="<?php echo $identInfo->shipping_bill_no; ?>"
                                        placeholder="Enter Shipping Bill Number" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="assigned_type">Container No.</label>
                                            <input type="text" class="form-control" id="" name="container_no" value="<?php echo $identInfo->container_no; ?>"
                                                placeholder="Enter Container Number" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="assigned_type">Driver Name</label>
                                    <input type="text" class="form-control" id="driver_name" name="driver_name"
                                        value="<?php echo $identInfo->driver_name; ?>" placeholder="Enter Driver Name"
                                        autocomplete="off" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="assigned_type">DL Number Validity</label>
                                    <input type="text" class="form-control" id="dl_validity" name="dl_validity"
                                        value="<?php echo $identInfo->dl_num_validity; ?>"
                                        placeholder="Enter DL Number Validity" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="assigned_type">Cleaner Name</label>
                                    <input type="text" class="form-control" id="cleaner_name" name="cleaner_name"
                                        value="<?php echo $identInfo->cleaner_name; ?>" placeholder="Enter Cleaner Name"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="assigned_type">Fitness Certificate Valid</label>
                                    <input type="text" class="form-control validDate" id="dl_validity"
                                        value="<?php 
                                        if($identInfo->fitness_cert_valid_date != NULL){
                                            echo date('d-m-Y',strtotime($identInfo->fitness_cert_valid_date)); 
                                        }
                                        
                                        ?>"
                                        name="fitness_certificate" placeholder="Fitness Certificate" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="transporter_name">Change Customer</label>
                                    <select required name="customer_id" id="transporter_rowid"
                                        class="form-control required selectpicker" data-live-search="true">
                                        <option value="<?php echo $identInfo->customer_id; ?>">Selected: <?php echo $identInfo->customer_name; ?></option>
                                        <option value="">Select Customer</option>
                                        <?php if(!empty($custInfo))
                                                        { foreach ($custInfo as $c)
                                                            { ?>
                                        <option value="<?php echo $c->customer_id ?>">
                                            <?php echo $c->customer_name; ?></option>
                                        <?php   } 
                                          } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" style="flaot : left" value="Update" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>

            </div>
        </div>
    </div>

</div>
</div>

<!-- End Default Light Table -->

<script src="<?php echo base_url(); ?>assets/js/customer/editCustomer.js" type="text/javascript"></script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = document.referrer;
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
    jQuery('.datepicker, .validDate').datepicker({
        autoclose: true,
        orientation: "bottom",
        format: "dd-mm-yyyy"
    });
});
</script>