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
                            <div class="col-md-6 text-white ">Cash Transfer</div>
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
                <div class="card card-small c-border p-0 mb-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item card-padding">
                            <div class="row">
                                <div class="col profile-head">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="cashTarnsfer-tab" data-toggle="tab"
                                                href="#cashTarnsfer" role="tab" aria-controls="cashTarnsfer"
                                                aria-selected="false">Cash Transfer </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="transferDetails-tab" data-toggle="tab"
                                                href="#transferDetails" role="tab" aria-controls="transferDetails"
                                                aria-selected="true">Transfer Details</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content cashTarnsfer-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="cashTarnsfer" role="tabpanel"
                                            aria-labelledby="cashTarnsfer-tab">
                                            <?php $this->load->helper("form"); ?>
                                            <form role="form" id="transferCashDetails"
                                                action="<?php echo base_url() ?>transferCashDetails" method="post"
                                                role="form">
                                                <div class="row form-contents">
                                                    <div class="col-md-6 col-12">
                                                        <label for="transfer_cash_date">Date</label>
                                                        <div class="input-group ">
                                                            <span class="input-group-append">
                                                                <span
                                                                    class="input-group-text material-icons date-icon">date_range</span>
                                                            </span>
                                                            <input id="transfer_cash_date" type="text"
                                                                name="transfer_cash_date"
                                                                value="<?php echo date('d-m-Y'); ?>"
                                                                class="form-control datepicker  "
                                                                placeholder="Enter Date" autocomplete="off" >
                                                            <input type="hidden" name="cash_account_rowid"
                                                                id="cash_account_rowid" />
                                                            <input type="hidden" name="account_balance"
                                                                id="account_balance" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="transfer_cash_amount">Amount</label>
                                                            <input type="text" class="form-control required "
                                                                id="transfer_cash_amount"
                                                                onkeypress="return isNumberKey(event)"
                                                                name="transfer_cash_amount" placeholder="Enter Amount"
                                                                autocomplete="off" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="from_cash_account_rowid">From Cash
                                                                Account</label>
                                                            <select name="from_cash_account_rowid"
                                                                id="from_cash_account_rowid"
                                                                class="form-control required selectpicker"
                                                                data-live-search="true" >
                                                                <option value="">Select From Cash Account</option>
                                                                <?php if(!empty($cashAccount))
                                                        { foreach ($cashAccount as $account)
                                                            { ?>
                                                                <option value="<?php echo $account->row_id ?> ">
                                                                <?php echo $account->cash_account_name ?> (Balance:<?php echo $account->account_balance ?>)</option>
                                                                <?php   } 
                                                          } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="to_cash_account_rowid">To Cash Account</label>
                                                            <select name="to_cash_account_rowid"
                                                                id="to_cash_account_rowid"
                                                                class="form-control required selectpicker"
                                                                data-live-search="true" >
                                                                <option value="">Select To Cash Account</option>
                                                                <?php if(!empty($cashAccount))
                                                        { foreach ($cashAccount as $account)
                                                            { ?>
                                                                <option value="<?php echo $account->row_id ?> ">
                                                                <?php echo $account->cash_account_name ?> (Balance:<?php echo $account->account_balance ?>)</option>
                                                                <?php   } 
                                                          } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="comments">Comments</label>
                                                            <textarea class="form-control " placeholder="Enter Address"
                                                                name="comments" id="comments" rows="3"
                                                                autocomplete="off"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input style="float:right;" type="submit" class="btn btn-primary"
                                                    value="Submit" />

                                        </div>
                                        <div class="tab-pane fade" id="transferDetails" role="tabpanel"
                                            aria-labelledby="transferDetails-tab">
                                            <table class="table mb-0 form-table-padding bordeless">
                                                <tr class=" text-white  bg-black">
                                                    <th width="200">Date</th>
                                                    <th width="300">Amount</th>
                                                    <th width="300">From Cash Account</th>
                                                    <th width="300">To Cash Account</th>
                                                    <th width="300">Comments</th>
                                                    <th width="300" class="text-center">Actions</th>
                                                </tr>
                                                <?php
                                                if(!empty($cashRecords)) {
                                                foreach($cashRecords as $record)
                                                 {
                                                    ?>
                                                <tr class="text-black" style="font-weight: 500;">
                                                    <td><?php echo date('d-m-Y',strtotime($record->transfer_cash_date)); ?>
                                                    </td>
                                                    <td> <?php echo $record->transfer_cash_amount ?></td>
                                                    <td> <?php echo $record->cash_account_name ?></td>
                                                    <td> <?php echo $record->to_cash_account ?></td>
                                                    <td> <?php echo $record->comments ?></td>
                                                    <td class="text-center">
                                                        <?php if($role == ROLE_ADMIN || $role == ROLE_EMPLOYEE) { ?>
                                                        <a class="btn btn-sm btn-danger deleteTransferDetails" href="#"
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
<script src="<?php echo base_url(); ?>assets/js/cash_account/cash_account.js" type="text/javascript"></script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = '<?php echo base_url(); ?>/cashAccountListing';
        /* OR */
        //location.replace(document.referrer);
    } else {
        window.history.back();
    }
}
jQuery(document).ready(function() {

    jQuery('.resetFilters').click(function() {
        $(this).closest('form').find("input[type=text]").val("");
    })

    jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});
</script>