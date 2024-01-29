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
                        <div class="row">
                            <div class="col-md-8 col-12">
                                <span class="page-title ">
                                    <i class="fa fa-money mobile-title"></i> Fuel Book Management
                                </span>
                            </div>
                            <div class="col-md-4 col-12">
                                <span class="page-sub-title mobile-title pull-right m-auto mobile-bck">Total Cash Book:
                                    <?php echo $count; ?></span>
                            </div>
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
                            <form action="<?php echo base_url() ?>fuelBookListing" method="POST" id="byFilterMethod">
                                <th width="150" style="padding: 0px;">
                                    <div class="form-group position-relative mb-0"><input
                                            class="form-control is-valid datepicker mobile-width" type="text"
                                            name="created_date" id="created_date" value="<?php echo $created_date ?>"
                                            style="text-transform: uppercase" placeholder="By Date" autocomplete="off">
                                        <div class="valid-feedback feedback-icon"><i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </th>
                                <th  style="padding: 0px;">
                                    <div class="form-group position-relative mb-0"><input
                                            class="form-control is-valid mobile-width" type="text" name="fuel_name"
                                            id="fuel_name" value="<?php echo $fuel_name ?>"
                                            class="form-control input-sm pull-right " style="text-transform: uppercase"
                                            placeholder="By Name" autocomplete="off">
                                        <div class="valid-feedback feedback-icon"><i class="fa fa-money"></i>
                                        </div>
                                    </div>
                                </th>
                                <th width="150" style="padding: 0px;">
                                    <div class="form-group position-relative mb-0"><input
                                            class="form-control is-valid mobile-width" type="text" name="debit"
                                            id="debit" value="<?php echo $debit ?>"
                                            class="form-control input-sm pull-right " style="text-transform: uppercase"
                                            placeholder="By Amount" autocomplete="off">
                                        <div class="valid-feedback feedback-icon"><i class="fa fa-money"></i>
                                        </div>
                                    </div>
                                </th>
                                <th width="150" style="padding: 0px;">
                                    <div class="form-group position-relative mb-0"><input
                                            class="form-control is-valid mobile-width" type="text" name="credit"
                                            id="credit" value="<?php echo $credit ?>"
                                            class="form-control input-sm pull-right " style="text-transform: uppercase"
                                            placeholder="By Amount" autocomplete="off">
                                        <div class="valid-feedback feedback-icon"><i class="fa fa-money"></i>
                                        </div>
                                    </div>
                                </th>
                                <th width="150" style="padding: 0px;">
                                    <select class="form-control is-valid input-sm mobile-width" id="transaction_type"
                                        name="transaction_type">
                                        <?php if($transaction_type != "") { ?>
                                        <option value="<?php echo $transaction_type; ?>" selected><b>Sorted:
                                                <?php echo $transaction_type; ?></b></option>
                                        <option value="">ALL</option>
                                        <option value="Bank">Bank</option>
                                        <option value="Cash">Cash</option>
                                        <?php } else { ?>
                                        <option value="">Select Type</option>
                                        <option value="Bank">Bank</option>
                                        <option value="Cash">Cash</option>
                                        <?php } ?>
                                    </select>
                                </th>
                                <th width="180" class="text-center btn-padding"><button type="submit"
                                        class="btn btn-success btn-block mobile-width"> Search</button></th>
                            </form>
                        </tr>
                        <tr class=" text-white  bg-black">
                            <th>Transaction Date</th>
                            <th>Name</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Transaction Type</th>
                            <th></th>
                        </tr>
                        <?php
                        if(!empty($fuelBookRecords))
                        {
                            foreach($fuelBookRecords as $record)
                            {
                          if($record->credit != '0.00') {?>
                        <tr class="text-black">
                            <td><?php  echo date('d-m-Y',strtotime($record->cash_date));?></td>
                            <td><?php echo $record->fuel_account_name ?></td>
                            <td><?php echo $record->debit ?></td>
                            <td><?php echo $record->credit ?></td>
                            <td><?php echo $record->transaction_type ?></td>
                            <td></td>
                        </tr>

                        <?php
                          }
                        }
                    } else { ?>
                        <tr>
                            <td class="text-center " colspan="10">
                                Fuel Info Not Found!!.
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
</div>
<script src="<?php echo base_url(); ?>assets/js/cash_account/cash_account.js" type="text/javascript"></script>
<script type="text/javascript">
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    return true;
}


jQuery(document).ready(function() {
    $('.js-example-basic-single').select2();
    // jQuery('ul.pagination li a').click(function(e) {
    //     e.preventDefault();
    //     var link = jQuery(this).get(0).href;
    //     var value = link.substring(link.lastIndexOf('/') + 1);
    //     jQuery("#searchList").attr("action", baseURL + "cashBookListing/" + value);
    //     jQuery("#searchList").submit();
    // });
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#byFilterMethod").attr("action", baseURL + "cashBookListing/" + value);
        jQuery("#byFilterMethod").submit();
    });
    jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});
</script>