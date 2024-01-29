<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row ">
            <div class="col padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-1 card-content-title  ">
                        <div class="row ">
                            <div class="col-lg-6 text-white">Detailed View Bank</div>
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
                <div class="card card-small c-border mb-4">
                    <table class="table table-padding">
                        <tbody>
                            <tr>
                                <th>Bank Name<span class="float-right">:</span></th>
                                <td><?php echo $bankInfo->bank_name; ?></td>
                            </tr>
                            <tr>
                                <th>Account Number<span class="float-right">:</span></th>
                                <td><?php echo $bankInfo->bank_account_number; ?></td>
                            </tr>
                            <tr>
                                <th>Branch Name<span class="float-right">:</span> </th>
                                <td><?php echo $bankInfo->branch_name; ?></td>
                            </tr>
                            <tr>
                                <th>IFSC Code<span class="float-right">:</span></th>
                                <td><?php echo $bankInfo->IFSC_code; ?></td>
                            </tr>
                            <tr>
                                <th>Contact Number <span class="float-right">:</span></th>
                                <td><?php echo $bankInfo->bank_contact; ?></td>
                            </tr>
        
                        </tbody>
                    </table>
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