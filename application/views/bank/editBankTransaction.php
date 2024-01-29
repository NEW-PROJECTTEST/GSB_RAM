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
        <div class="row">
            <!-- left column -->
            <div class="col-md-12 col-lg-12  padding_left_right_null">
                <div class="card ">
                    <div class="card-header text-white card-content-title p-1">
                        <div class="row ">
                            <div class="col-md-6 col-10 text-white">Edit Bank Transaction</div>
                            <div class="col-md-6 col-2 "> <a href="#" onclick="GoBackWithRefresh();return false;"class="btn text-white btn-success btn-bck float-right mobile-btn "><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                    <div class="card-body contents-body ">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="updateBankTransaction" action="<?php echo base_url() ?>updateBankTransaction"
                            method="post" role="form">
                            <input type="hidden" value="<?php echo $transInfo->row_id ?>" name="row_id">
                            <div class="row form-contents">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="bank_name">Date</label>
                                                <input type="text" class="form-control datepicker" id="date" name="trans_date" value="<?php echo date('d-m-Y',strtotime($transInfo->trans_date)); ?>"
                                                    placeholder="Enter Date" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="bank_name">Bank</label>
                                                <select class="form-control " id="bank" name="bank_name" required>
                                                    <option value="<?php echo $transInfo->bank_name;?>">Selected:<?php echo $transInfo->bank_name;?></option>
                                                    <?php if(!empty($bankInfo)){
                                                        foreach($bankInfo as $bank){
                                                            ?>
                                                            <option value="<?php echo $bank->bank_name ?>"><?php echo $bank->bank_name ?></option>
                                                            <?php
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="bank_account_number">Particular</label>
                                                <textarea class="form-control " id="particular" 
                                                    name="particular" placeholder="Enter Particular"
                                                    autocomplete="off" required><?php echo $transInfo->particular;?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12">
                                            <div class="form-group">
                                                <label for="account_type">Transaction Type </label>
                                                <select class="form-control " id="transaction_type" name="transaction_type" required>
                                                    <option value="<?php echo $transInfo->trans_type;?>">Selected:<?php echo $transInfo->trans_type;?></option>
                                                    <option value="DEBIT">DEBIT</option>
                                                    <option value="CREDIT">CREDIT</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="amount"
                                                    name="amount" placeholder="Enter Amount" value="<?php echo $transInfo->amount;?>"
                                                    autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                            <input style="float:right;" type="submit" class="btn btn-primary" value="Update" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bank/bank.js" charset="utf-8"> -->
</script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = '<?php echo base_url(); ?>/bankTransactionListing';
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
    jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});
</script>