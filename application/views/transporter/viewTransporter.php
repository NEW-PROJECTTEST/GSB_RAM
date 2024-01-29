<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row ">
            <div class="col padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-1 card-content-title  ">
                        <div class="row ">
                            <div class="col-md-6 text-white ">Detailed View Of Transporter</div>
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
                                            <a class="nav-link active" id="transporter-tab" data-toggle="tab"
                                                href="#transporter" role="tab" aria-controls="transporter"
                                                aria-selected="false">Transporter Info</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" id="family-tab" data-toggle="tab" href="#family"
                                                role="tab" aria-controls="family" aria-selected="true">Other</a>
                                        </li> -->
                                    </ul>
                                    <div class="tab-content transporter-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="transporter" role="tabpanel"
                                            aria-labelledby="transporter-tab">
                                            <table class="table table-padding">
                                                <tbody>
                                                    <tr>
                                                        <th>Transporter Name<span class="float-right">:</span></th>
                                                        <td><?php echo $transporterInfo->transporter_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email<span class="float-right">:</span></th>
                                                        <td><?php echo $transporterInfo->email; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Contact Number<span class="float-right">:</span> </th>
                                                        <td><?php echo $transporterInfo->contact_number; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Account Number<span class="float-right">:</span></th>
                                                        <td><?php echo $transporterInfo->transporter_account_number; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Transporter Address<span class="float-right">:</span></th>
                                                        <td><?php echo $transporterInfo->transporter_address; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Comments<span class="float-right">:</span></th>
                                                        <td><?php echo $transporterInfo->comments; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="family" role="tabpanel"
                                            aria-labelledby="family-tab">

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