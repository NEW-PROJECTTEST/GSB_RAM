<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row ">
            <div class="col padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-1 card-content-title  ">
                        <div class="row ">
                            <div class="col-md-6 text-white ">Detailed View Of Cash Account</div>
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
                                            <a class="nav-link active" id="cashAccount-tab" data-toggle="tab"
                                                href="#cashAccount" role="tab" aria-controls="cashAccount"
                                                aria-selected="false">Cash Account Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="cashDetails-tab" data-toggle="tab" href="#cashDetails"
                                                role="tab" aria-controls="cashDetails" aria-selected="true">Cash Details</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content cashAccount-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="cashAccount" role="tabpanel"
                                            aria-labelledby="cashAccount-tab">
                                            <table class="table table-padding">
                                                <tbody>
                                                    <tr>
                                                        <th>Cash Account Name<span class="float-right">:</span></th>
                                                        <td><?php echo $cashAccountInfo->cash_account_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Cash Account Type<span class="float-right">:</span></th>
                                                        <td><?php echo $cashAccountInfo->cash_account_type; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="cashDetails" role="tabpanel"
                                            aria-labelledby="cashDetails-tab">
                                            <table class="table mb-0 form-table-padding bordeless">
                                                <tr class=" text-white  bg-black">
                                                    <th width="200">Date</th>
                                                    <th width="300">Amount</th>
                                                    <th width="300">Bank</th>
                                                    <th width="300" class="text-center">Actions</th>
                                                </tr>
                                                <?php
                                                if(!empty($cashRecords)) {
                                                foreach($cashRecords as $record)
                                                 {
                                                    ?>
                                                <tr class="text-black" style="font-weight: 500;">
                                                    <td><?php echo date('d-m-Y',strtotime($record->cash_date)); ?>
                                                    </td>
                                                    <td> <?php echo $record->cash_amount ?></td>
                                                    <td> <?php echo $record->bank_name ?></td>
                                                    <td class="text-center">
                                                        <?php if($role == ROLE_ADMIN || $role == ROLE_EMPLOYEE) { ?>
                                                        <a class="btn btn-sm btn-danger deleteCashDetails" href="#"
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
        window.location = document.referrer;
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
});
</script>