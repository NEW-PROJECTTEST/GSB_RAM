<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row ">
            <div class="col padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-1 card-content-title  ">
                        <div class="row ">
                            <div class="col-md-6 text-white ">Detailed View Of Cash Ledger</div>
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
                                            <a class="nav-link active" id="cashLedger-tab" data-toggle="tab"
                                                href="#cashLedger" role="tab" aria-controls="cashLedger"
                                                aria-selected="false">Cash Ledger Info</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" id="family-tab" data-toggle="tab" href="#family"
                                                role="tab" aria-controls="family" aria-selected="true">Other</a>
                                        </li> -->
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Academic</a>
                                        </li> -->
                                    </ul>
                                    <div class="tab-content cashLedger-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="cashLedger" role="tabpanel"
                                            aria-labelledby="cashLedger-tab">
                                            <table class="table table-padding">
                                                <tbody>
                                                <tr>
                                                        <th>Date<span class="float-right">:</span> </th>
                                                        <td><?php echo date('d-m-Y',strtotime($cashLedgerInfo->cash_ledger_date)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Party Name<span class="float-right">:</span> </th>
                                                        <td><?php echo $cashLedgerInfo->party_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Reason<span class="float-right">:</span></th>
                                                        <td><?php echo $cashLedgerInfo->reason; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Amount<span class="float-right">:</span></th>
                                                        <td><?php echo $cashLedgerInfo->cash_amount; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="family" role="tabpanel"
                                            aria-labelledby="family-tab">

                                        </div>
                                        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">

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