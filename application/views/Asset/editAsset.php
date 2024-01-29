<?php 

  $purchase_date = '';

if( $assetInfo->purchase_date=='1970-01-01') {

    $purchase_date = '';

}
else {
$purchase_date = date("d-m-Y", strtotime($assetInfo->purchase_date));
}
?>

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
<?php } ?>
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
                <div class="card-header text-white card-content-title p-1">
                    <div class="row ">
                        <div class="col-md-5 col-8 text-white m-auto ">Edit Asset Details</div>
                        <div class=" col-md-5 col-4 m-auto "> <span class="mobile-right ">ID :<?php echo  $assetInfo->row_id; ?></span></div>
                        <div class="col-md-2 col-12 m-auto"> <a href="#" onclick="GoBackWithRefresh();return false;" class="btn text-white btn-success btn-bck float-right mobile-btn mobile-bck"><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                    </div>
                </div>
                <div class="row form-contents">
                    <div class="col-lg-12 col-12 padding_left_right_null">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#asset" role="tab" aria-controls="personal" aria-selected="false">Asset Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="bill-tab" data-toggle="tab" href="#subscription" role="tab" aria-controls="bill" aria-selected="true">Depreciation Details</a>
                            </li>
                            <!--
                       <li class="nav-item">
                           <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab"
                            aria-controls="pending" aria-selected="true">Bill Payment</a>
                        </li> -->
                        </ul>

                        <div class="tab-content personal-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="asset" role="tabpanel" aria-labelledby="personal-tab">
                                <div class="card card-small c-border mb-4 p-2">
                                    <?php $this->load->helper("form"); ?>
                                    <form role="form" id="updateAsset" action="<?php echo base_url() ?>updateAsset" method="post" role="form" enctype="multipart/form-data">

                                        <div class="row form-contents">
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="asset_name">Asset Name*</label>
                                                    <input type="text" class="form-control " id="asset_name" name="asset_name" value="<?php echo $assetInfo->asset_name; ?>" placeholder="Enter asset Name" autocomplete="off" required>
                                                    <input type="hidden" value="<?php echo $assetInfo->row_id; ?>" name="row_id" id="row_id" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="invoice">Invoice No </label>
                                                    <input type="text" class="form-control invoice " id="invoice_no" name="invoice_no" value="<?php echo $assetInfo->invoice_no; ?>" maxlength="128" placeholder="Enter Invoice No" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="purchase_date">Purchase Date</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text material-icons date-icon">date_range</span>
                                                            <input id="purchase_date" type="text" value="<?php echo  $purchase_date; ?>" name="purchase_date" class="form-control datepicker date-col-lg-6 required " placeholder="Purchase Date" autocomplete="off"  />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="purchase_amount">Purchase Amount*</label>
                                                    <input type="text" class="form-control " id="purchase_amount" value="<?php echo $assetInfo->purchase_amount; ?>" name="purchase_amount" placeholder="Enter Purchase Amount" maxlength="10" onkeypress="return isNumberKey(event)" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="asset_type">Asset Type</label>
                                                    <select class="form-control " id="asset_type" name="asset_type">
                                                        <option value="<?php echo $assetInfo->asset_id ?>"> Selected :<?php echo $assetInfo->asset_type ?>
                                                        </option>
                                                        <?php if (!empty($assetTypeInfo)) {
                                                            foreach ($assetTypeInfo as $asset) { ?>
                                                                <option value="<?php echo $asset->row_id; ?>"><?php echo $asset->asset_type; ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="contact_number_two">State Code</label>
                                                <input type="text" class="form-control " id="state_code" value=""
                                                    name="state_code" placeholder="Enter committee State Code"
                                                    maxlength="6" onkeypress="return isNumberKey(event)"
                                                    autocomplete="off">
                                            </div>
                                        </div> -->


                                        <div class="form-group">

                                            <input style="float:right;" type="submit" class="btn btn-primary" value="Update" />
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="subscription" role="tabpanel" aria-labelledby="bill-tab">
                                <div class="card-body p-2  table-responsive">
                                    <div class="row">
                                        <div class="col  padding_left_right_null">
                                            <div class="card card-small mb-4">
                                                <div class="card-body p-1 pb-3 text-center table-responsive">
                                                    <table class=" table mb-0 form-table-padding bordeless ">
                                                        <!-- <tr class="bg-deafult">
                                <form action="<?php echo base_url() ?>assetListing" method="POST" id="byFilterMethod"> -->
                                                        <!-- <th width="150" style="padding: 0px;"> -->
                                                        <!-- <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="devotee_id" id="devotee_id" value="<?php //echo $devotee_id 
                                                                                            ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By ID"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-id-card"></i>
                                            </div>
                                        </div> -->
                                                        <!-- </th> -->

                                                        <!-- <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width " type="text"
                                                name="asset_name" id="asset_name"
                                                value=""
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="Asset Name"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-user"></i></div>
                                        </div>
                                    </th>
                                       <th width="100"></th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text" name="purchase_date"
                                                id="purchase_date" value=""
                                                class="form-control datepicker date-col-lg-6 required "
                                                style="text-transform: uppercase" placeholder="Purchase Date"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-user"></i></div>
                                        </div>
                                    </th>
                                    <th width="150"></th>
                                    <th width="150"></th>

                                    <th width="180" class="text-center btn-padding"><button type="submit"
                                            class="btn float-right btn-success btn-block mobile-width pull-right"> Search</button></th>
                                </form>
                            </tr> -->
                                                        <tr class=" text-white bg-black ">
                                                            <th width="2000">Depreciated Amount</th>
                                                            <th width="2000">Depreciated Year</th>
                                                            <th class="text-center" width="2000">Actions</th>
                                                        </tr>
                                                        <?php
                                                        if (!empty($depreciationInfo)) {
                                                            foreach ($depreciationInfo as $dep) { ?>
                                                                <tr class="text-black">
                                                                    <td><?php echo $dep->depriciation_amount ?></td>
                                                                    <td><?php echo $dep->year ?></td>


                                                                    <td class="text-center">


                                                                        <a class="btn btn-sm btn-danger deleteDepreciationInfo" href="#" data-row_id="<?php echo $dep->row_id ?>" title="Delete"><i class="fas fa-trash"></i></a>


                                                                    </td>
                                                                </tr>
                                                            <?php }
                                                        } else { ?>
                                                            <tr>
                                                                <td class="text-center " colspan="10">
                                                                    Depreciation Not Found!!.
                                                                </td>
                                                            </tr>
                                                        <?php } ?>

                                                    </table>
                                                    <div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>









<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8">
</script>
<script type="text/javascript">
    function GoBackWithRefresh(event) {
        if ('referrer' in document) {
            window.location = '<?php echo base_url(); ?>/assetListing';
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