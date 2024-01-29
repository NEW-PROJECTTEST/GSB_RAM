<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row ">
            <div class="col padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-1 card-content-title  ">
                        <div class="row ">
                            <div class="col-lg-6 text-white">Detailed View Party</div>
                            <div class="col-lg-6"> <a href="#" onclick="GoBackWithRefresh();return false;"
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
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal" role="tab"
                            aria-controls="personal" aria-selected="false">Party Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="bill-tab" data-toggle="tab" href="#bill" role="tab"
                            aria-controls="bill" aria-selected="true">Bill Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab"
                            aria-controls="pending" aria-selected="true">Bill Payment</a>
                    </li>
                </ul>

                <div class="tab-content personal-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="personal" role="tabpanel"
                                            aria-labelledby="personal-tab">
                        <div class="card card-small c-border mb-4">
                            <table class="table table-padding">
                                <tbody>
                                    <tr>
                                        <th width="230">Party Name<span class="float-right">:</span></th>
                                        <td><?php echo $partyInfo->party_name; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email<span class="float-right">:</span> </th>
                                        <td><?php echo $partyInfo->email; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Contact Number One<span class="float-right">:</span></th>
                                        <td><?php echo $partyInfo->contact_number_one; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Contact Number Two<span class="float-right">:</span></th>
                                        <td><?php echo $partyInfo->contact_number_two; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Address<span class="float-right">:</span></th>
                                        <td><?php echo $partyInfo->party_address; ?></td>
                                    </tr>
                                    <tr>
                                        <th>GST No.<span class="float-right">:</span></th>
                                        <td><?php echo $partyInfo->party_gst; ?></td>
                                    </tr>
                                    <tr>
                                        <th>State Code<span class="float-right">:</span></th>
                                        <td><?php echo $partyInfo->party_state_code; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="bill" role="tabpanel" aria-labelledby="bill-tab">
                        <div class="card-body p-1  text-center table-responsive">
                            <table id="bill-list" style="width:100%"
                                class="display table table-striped table-hover nowrap ">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Bill No.</th>
                                        <th>Product</th>
                                        <th>Total Amount</th>
                                        <th>Action</th>
                                        <!-- <th class="text-center">Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($partyBillInfo as $bill){  ?>
                                    <tr>
                                        <td><?php echo date('d-m-Y',strtotime($bill->date)); ?></td>
                                        <td><?php echo $bill->bill_no; ?></td>
                                        <td><?php echo $bill->product; ?></td>
                                        <td><?php echo $bill->total_amount; ?></td>
                                        <td><a class="btn  btn-sm btn-primary" href="<?php echo base_url().'printBill/'.$bill->row_id; ?>" title="View"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="card-body p-1  text-center table-responsive">
                            <table style="width:100%"
                                class="display table table-striped table-hover nowrap ">
                                <thead>
                                    <tr>
                                        <th>Paid Date</th>
                                        <th>Payment Type</th>
                                        <th>Paid Amount</th>
                                        <th>Bill No.</th>
                                        <!-- <th>Balance</th> -->
                                        <!-- <th class="text-center">Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($billPaidInfo as $paid){  ?>
                                    <tr>
                                        <td><?php echo date('d-m-Y',strtotime($paid->trans_date)); ?></td>
                                        <td><?php echo $paid->payment_type; ?></td>
                                        <td><?php echo $paid->paid_amount; ?></td>
                                        <td><?php echo $paid->bill_no; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Default Light Table -->
    </div>
</div>
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