<style>
.select2-container .select2-selection--single {
    height: 38px !important;
    width: 360px !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow b {
    margin-top: 3px !important;
    color: black !important;

}

@media screen and (max-width: 480px) {
    .select2-container--default .select2-selection--single .select2-selection__arrow {

        margin-right: 20px !important;
    }

    .select2-container .select2-selection--single {
        width: 270px !important;
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
        <div class="row p-0">
            <div class="col">
                <div class="card card-small  p-0 m-b-1">
                    <div class="card-body p-1">
                        <div class="row c-m-b">
                            <div class="col-lg-6 col-sm-12 col-12">
                                <span class="page-title">
                                    <i class="fa fa-user"></i> Customer Management
                                </span>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12 box-tools">
                                <form action="<?php echo base_url() ?>customerListing" method="POST" id="searchList">
                                    <div class="input-group search-box">
                                        <input type="text" name="searchText" value=""
                                            class="form-control input-lg pull-right searchText"
                                            placeholder="Search By Name/Mobile/Code" />
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
                            <div class="col-lg-6 col-sm-12 col-12">
                                <span class="page-sub-title mobile-title">Total Customers: <?php echo $count; ?></span>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <a class="btn btn-primary pull-right"
                                        href="<?php echo base_url(); ?>addCustomerPageView"><i class="fa fa-plus"></i>
                                        New Customer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card card-small mb-4">
                    <div class="card-body p-1 pb-3 text-center table-responsive">
                        <table class="display table  table-striped table-hover">
                            <tr class="bg-deafult">
                                <form action="<?php echo base_url() ?>customerListing" method="POST"
                                    id="byFilterMethod">

                                    <th width="150" style="padding: 1px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="customer_name" id="customer_name"
                                                value="<?php echo $customer_name ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By Name"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-user"></i></div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <input class="form-control is-valid mobile-width" type="text" name="code"
                                            id="code" value="<?php echo $code ?>"
                                            class="form-control input-sm pull-right " style="text-transform: uppercase"
                                            placeholder="By Code" autocomplete="off">
                                        <div class="valid-feedback feedback-icon">
                                    </th>
                                    <th width="150" style="padding: 1px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="contact_number" id="contact_number"
                                                value="<?php echo $contact_number ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By Phone"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-phone"></i></div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 1px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="customer_address" id="customer_address"
                                                value="<?php echo $customer_address ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By Address"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th width="180" class="text-center btn-padding"><button type="submit"
                                            class="btn btn-primary btn-block mobile-width"> Search</button></th>
                                </form>
                            </tr>
                            <tr class="text-white bg-primary ">

                                <th>Name</th>
                                <th>Code</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                    if(!empty($customerRecords))
                    {
                        foreach($customerRecords as $record)
                        {
                    ?>
                            <tr class="text-black">

                                <td><?php echo $record->customer_name ?></td>
                                <td><?php echo $record->customer_code ?></td>
                                <td><?php echo $record->contact_number ?></td>
                                <td><?php echo substr($record->customer_address, 0, 20);?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-success text-white" href="" data-toggle="modal"
                                        data-target="#Modal"
                                        onclick="openModal('<?php echo $record->customer_name; ?>','<?php echo $record->customer_id; ?>')"><i
                                            class="fa fa-send"></i>&nbsp;&nbsp;Indent</a>
                                    <a class="btn  btn-sm btn-primary"
                                        href="<?php echo base_url().'editCustomerPageView/'.$record->customer_id; ?>"
                                        title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-sm btn-danger deleteCustomer" href="#"
                                        data-customer_id="<?php echo $record->customer_id; ?>" title="Delete"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else { ?>
                            <tr class="bg-info">
                                <td class="text-center text-white" colspan="10">
                                    Customer Not Found!!.
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
    </div>
    <!-- modal Bigin -->
    <div class="row">
        <div class="col">
            <div id="Modal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header ">
                            <span class="text-white" style="font-size : 20px">Indent Customer Name :</span> &nbsp;&nbsp;
                            <span class="modal-title text-white " style="font-size : 20px"></span>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addCallAssign" action="<?php echo base_url() ?>generateIndent"
                                method="post" role="form">
                                <input type="hidden" value="" id="identCustId" name="customer_id">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="assigned_date_from">Indent Date </label>
                                        <div class="input-group ">
                                            <span class="input-group-append">
                                                <span
                                                    class="input-group-text material-icons date-icon">date_range</span>
                                            </span>
                                            <input value="<?php echo date('d-m-Y'); ?>" id="assigned_date_from" type="text" name="date"
                                                class="form-control datepicker" placeholder="Assigned Date From"
                                                autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="assigned_type">Contract Number</label>
                                            <input type="text" class="form-control" id="contract_number"
                                                name="contract_number" placeholder="Enter Contract Number"
                                                autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="assigned_type">Product Code</label>
                                            <input type="text" class="form-control" id="product_code"
                                                name="product_code" placeholder="Enter Product Code" autocomplete="off"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="assigned_type">Quantity with Unit</label>
                                            <input type="text" class="form-control" id="qty_unit" name="qty_unit"
                                                placeholder="Enter Quantity" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="assigned_type">Destination & Distance in KM</label>
                                            <input type="text" class="form-control" id="dest_km" name="dest_km"
                                                placeholder="Enter Destination & Distance" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="assigned_type">LR Number</label>
                                            <input type="text" class="form-control" id="lr_num" name="lr_num"
                                                placeholder="Enter LR Number" autocomplete="off" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="assigned_type">Tank Truck Number</label>
                                            <input type="text" class="form-control" id="tank_truck" name="tank_truck"
                                                placeholder="Enter Tank Truck Number" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="assigned_type">Shipping Bill No.</label>
                                            <input type="text" class="form-control" id="" name="shipping_bill_no"
                                                placeholder="Enter Shipping Bill Number" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="assigned_type">Container No.</label>
                                            <input type="text" class="form-control" id="" name="container_no"
                                                placeholder="Enter Container Number" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="assigned_type">Driver Name</label>
                                            <input type="text" class="form-control" id="driver_name" name="driver_name"
                                                placeholder="Enter Driver Name" autocomplete="off" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="assigned_type">DL Number Validity</label>
                                            <input type="text" class="form-control" id="dl_validity" name="dl_validity"
                                                placeholder="Enter DL Number Validity" autocomplete="off" >
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="assigned_type">Cleaner Name</label>
                                            <input type="text" class="form-control" id="cleaner_name" name="cleaner_name"
                                                placeholder="Enter Cleaner Name" autocomplete="off" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="assigned_type">Fitness Certificate Valid</label>
                                            <input type="text" class="form-control validDate" id="dl_validity" name="fitness_certificate"
                                                placeholder="Fitness Certificate" autocomplete="off" >
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
<script type="text/javascript">
function openModal(customer_name, customer_id) {
    $("#Modal").modal('show');
    $("#Modal .modal-title").html(customer_name);
    document.getElementById("identCustId").value = customer_id;
}
jQuery(document).ready(function() {
    $('.js-example-basic-single').select2();
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#searchList").attr("action", baseURL + "customerListing/" + value);
        jQuery("#searchList").submit();
    });
    jQuery('.datepicker,.validDate').datepicker({
        autoclose: true,
        orientation: "bottom",
        format: "dd-mm-yyyy"

    });
    $('#selectAll').click(function() {
        if ($('#selectAll').is(':checked')) {
            $('.singleSelect').prop('checked', true);
        } else {
            $('.singleSelect').prop('checked', false);
        }
    });

    jQuery(document).on("click", ".deleteCustomer", function() {
        var customer_id = $(this).data("customer_id"),
            hitURL = baseURL + "deleteCustomer",
            currentRow = $(this);

        var confirmation = confirm("Are you sure to delete this Customer ?");

        if (confirmation) {
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: hitURL,
                data: {
                    customer_id: customer_id
                }
            }).done(function(data) {
                console.log(data);
                currentRow.parents('tr').remove();
                if (data.status = true) {
                    alert("Customer successfully deleted");
                } else if (data.status = false) {
                    alert("Customer deletion failed");
                } else {
                    alert("Access denied..!");
                }
            });
        }
    });
});
</script>