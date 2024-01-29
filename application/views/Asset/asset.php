

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

<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row p-0">
            <div class="col  padding_left_right_null">
                <div class="card card-small  p-0 m-b-1">
                    <div class="card-body p-2">
                        <div class="row c-m-b">
                            <div class="col-lg-4 col-sm-12 col-12">
                                <span class="page-title">
                                    <i class="fa fa-building"></i> Asset Management
                                </span>
                            </div>
                            
                            <div class="col-lg-4 col-8 mobile-title">
                                <span class="page-sub-title mobile-title">Total Assets: <?php echo $count; ?></span>
                            </div>
                            <div class="col-lg-4 col-4 ">
                                <div class="form-group">
                                    <a class="btn btn-primary mobile-btn pull-right" href="" data-toggle="modal"
                                        data-target="#Modal"><i class="fa fa-plus"></i>
                                        Add New </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col  padding_left_right_null">
                <div class="card card-small mb-4">
                    <div class="card-body p-1 pb-3 text-center table-responsive">
                        <table class=" table mb-0 form-table-padding bordeless ">
                            <tr class="bg-deafult">
                                <form action="<?php echo base_url() ?>assetListing" method="POST" id="byFilterMethod">
                                    <!-- <th width="150" style="padding: 0px;"> -->
                                    <!-- <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="devotee_id" id="devotee_id" value="<?php //echo $devotee_id ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By ID"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-id-card"></i>
                                            </div>
                                        </div> -->
                                    <!-- </th> -->

                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width " type="text"
                                                name="asset_name" id="asset_name" value="<?php echo $asset_name ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="Asset Name"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"> <i class="fas fa-building"></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th width="100"></th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control datepicker is-valid mobile-width" type="text"
                                                name="purchase_date" id="" value="<?php echo $purchase_date ?>"
                                                placeholder="Purchase Date" autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </th>
                                    <th width="150"></th>
                                    <th width="150"></th>

                                    <th width="180" class="text-center btn-padding"><button type="submit"
                                            class="btn float-right btn-success btn-block mobile-width pull-right">
                                            Search</button></th>
                                </form>
                            </tr>
                            <tr class=" text-white bg-black ">
                                <th width="200">Name</th>
                                <th width="200">Invoice No</th>
                                <th width="200">Purchase Date</th>
                                <th>Purchase Amount</th>
                                <th>Depreciated Amount</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                    if(!empty($assetRecords))
                    {
                        foreach($assetRecords as $asset)
                        {
                    ?>
                            <tr class="text-black">
                                <td><?php echo $asset->asset_name ?></td>
                                <td><?php echo $asset->invoice_no ?></td>
                                <?php if($asset->purchase_date=='1970-01-01') { ?>
                                    <td></td>
                                    <?php } else { ?>
                                <td><?php echo date('d-m-Y',strtotime($asset->purchase_date)); ?></td>
                                <?php }?>
                                <td><?php echo $asset->purchase_amount ?></td>
                                <td><?php echo $model->getDepreciationAmountByAsset($asset->row_id); ?></td>


                                <td class="text-center">

                                    <a class="btn  btn-sm btn-info"
                                        href="<?php echo base_url().'editAssetView/'.$asset->row_id; ?>" title="Edit"><i
                                            class="fas fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger deleteAssetInfo" href="#"
                                        data-row_id="<?php echo $asset->row_id; ?>" title="Delete"><i
                                            class="fas fa-trash"></i></a>
                                    <a class="btn  btn-sm btn-success" href="" data-toggle="modal"
                                        onclick="openModel('<?php echo $asset->row_id; ?>')" title="Edit">Depreciate</a>

                                </td>
                            </tr>
                            <?php
                        }
                    } else { ?>
                            <tr>
                                <td class="text-center " colspan="10">
                                    Asset Not Found!!.
                                </td>
                            </tr>
                            <?php }
                      ?>
                        </table>
                        <div>
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="Modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header modal-call-report p-2">
                <div class=" col-md-10 col-10">
                    <span class="text-white mobile-title" style="font-size : 20px">Add Asset
                        Details</span>
                </div>
                <div class=" col-md-2 col-2">
                    <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <!-- Modal body -->
            <div class="modal-body m-2">
                <?php $this->load->helper("form"); ?>
                <form role="form" id="addAsset" action="<?php echo base_url() ?>addAsset" method="post" role="form"
                    enctype="multipart/form-data">
                    <div class="row">

                        <div class="row form-contents">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="committee_name">Asset Name*</label>
                                    <input type="text" class="form-control " id="asset_name" name="asset_name" value=""
                                        placeholder="Enter Asset Name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="return_date">Purchase Date</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text material-icons date-icon">date_range</span>
                                            <input id="purchase_date" type="text" name="purchase_date"
                                                class="form-control datepicker date-col-3 required "
                                                placeholder="Purchase Date" autocomplete="off"  />
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="contact_number_one">Purchase Amount*</label>
                                    <input type="text" class="form-control " id="purchase_amount" value=""
                                        name="purchase_amount" placeholder="Enter Purchase Amount" maxlength="10"
                                        onkeypress="return isNumberKey(event)" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="contact_number_two">Invoice No</label>
                                    <input type="text" class="form-control " id="invoice_no" value="" name="invoice_no"
                                        placeholder="Enter Invoice No" maxlength="10" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group required">
                                    <label for="asset_type">Asset Type</label>
                                    <select class="form-control " id="asset_type" name="asset_type" >
                                        <option value=""> Select Asset Type
                                        </option>
                                        <?php if(!empty($assetTypeInfo)) {
                                                foreach($assetTypeInfo as $asset ){?>
                                        <option value="<?php echo $asset->row_id;?>">
                                            <?php echo $asset->asset_type;?></option>
                                        <?php }}?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input style="float:right;" type="submit" class="btn btn-primary" value="Update" />
                    </div>    
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<div id="depriciation_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header modal-call-report p-2">
                <div class=" col-md-10 col-10">
                    <span class="text-white mobile-title" style="font-size : 20px">Depreciation
                        Details</span>
                </div>
                <div class=" col-md-2 col-2">
                    <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <!-- Modal body -->
            <div class="modal-body m-2">
                <?php $this->load->helper("form"); ?>
                <form role="form" id="addAsset" action="<?php echo base_url() ?>addDepriciation" method="post"
                    role="form" enctype="multipart/form-data">
                    <input type="hidden" name="asset_id" id="asset_id" value="" />

                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="committee_name">Depreciation Amount*</label>
                                <input type="text" class="form-control " id="depriciation_amount"
                                    name="depriciation_amount" value=""  onkeypress="return isNumberKey(event)" placeholder="Enter Depriciation Amount"
                                    autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="asset_type">Depreciation Year*</label>
                                <select class="form-control " id="depriciation_year" name="depriciation_year" required>
                                    <option value=""> Select Depreciation Year
                                    </option>
                                    <?php if(!empty($depriciationYearInfo)) {
                                        foreach($depriciationYearInfo as $year ){?>
                                    <option value="<?php echo $year->row_id;?>"><?php echo $year->year;?>
                                    </option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                            <input style="float:right;" type="submit" class="btn btn-primary" value="Update" />
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- </div>
</div> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8">
</script>
<script type="text/javascript">
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function openModel(asset_id) {
    $('#asset_id').val(asset_id);
    $('#depriciation_modal').modal('show');
}


function alphaOnly(event) {
    var key = event.keyCode;
    return ((key >= 65 && key <= 90) || key == 8 || key == 32);
};

jQuery(document).ready(function() {
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#searchList").attr("action", baseURL + "assetListing/" + value);
        jQuery("#searchList").submit();
    });
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#byFilterMethod").attr("action", baseURL + "assetListing/" + value);
        jQuery("#byFilterMethod").submit();
    });
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
$("#vImg").change(function() {
    readURL(this);
});
</script>