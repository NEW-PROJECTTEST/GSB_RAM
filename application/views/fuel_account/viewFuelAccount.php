<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row ">
            <div class="col padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-1 card-content-title  ">
                        <div class="row ">
                            <div class="col-md-6 text-white ">Detailed View Of Fuel Account</div>
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
                                                aria-selected="false">Fuel Account Details</a>
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
                                                        <th>Fuel Account Name<span class="float-right">:</span></th>
                                                        <td><?php echo $fuelAccountInfo->fuel_account_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Cash Account Type<span class="float-right">:</span></th>
                                                        <td><?php echo $fuelAccountInfo->fuel_account_type; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <input type="hidden" value="<?php echo $row_id; ?>" id="fuel_account_id"/>
                                        <div class="tab-pane fade" id="cashDetails" role="tabpanel"
                                            aria-labelledby="cashDetails-tab">
                                            <table class="table mb-0 form-table-padding bordeless">
                                                <tr class=" text-white  bg-black">
                                                    <th width="200">Date</th>
                                                    <th width="300">Amount</th>
                                                    <th width="300">Type</th>
                                                    <th width="300" class="text-center">Actions</th>
                                                </tr>
                                                <?php
                                                if(!empty($fuelCashRecords)) {
                                                foreach($fuelCashRecords as $record)
                                                 {
                                                    ?>
                                                <tr class="text-black" style="font-weight: 500;">
                                                
                                                    <td><?php echo date('d-m-Y',strtotime($record->cash_date)); ?>
                                                    </td>
                                                    <td> <?php echo $record->cash_amount ?></td>
                                                    <td> <?php echo $record->cash_type ?></td>
                                                    <td class="text-center">
                                                        <?php if($role == ROLE_ADMIN || $role == ROLE_EMPLOYEE) { 
                                                            if($openingRowId->row_id != $record->row_id) {?>
                                                        <a class="btn btn-sm btn-danger deleteFuelAccountCashInfo" href="#"
                                                            data-row_id="<?php echo $record->row_id; ?>"
                                                            title="Delete"><i class="fa fa-trash"></i></a>
                                                        <?php } else{
                                                            echo "OB";
                                                        } } ?>
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
<script src="<?php echo base_url(); ?>assets/js/fuel_account/fuel_account.js" type="text/javascript"></script>
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