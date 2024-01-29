<?php
$y = date('Y');
?>
<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row ">
            <div class="col padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-1 card-content-title  ">
                        <div class="row ">
                            <div class="col-lg-6 text-white">Detailed Date Pooja View</div>
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
                            aria-controls="personal" aria-selected="false">Pooja Info</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="bill-tab" data-toggle="tab" href="#bill" role="tab"
                            aria-controls="bill" aria-selected="true">Bill Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab"
                            aria-controls="pending" aria-selected="true">Bill Payment</a>
                    </li> -->
                </ul>

                <div class="tab-content personal-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="personal" role="tabpanel"
                                            aria-labelledby="personal-tab">
                        <div class="card card-small c-border mb-4">
                            <table class="table table-padding">
                                <tbody>
                                   
                                    
                                    <tr>
                                        <th width="230">Devotee Name<span class="float-right">:</span></th>
                                        <td><?php echo $dpInfo->devotee_name; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Pooja Type<span class="float-right">:</span> </th>
                                        <td><?php echo strtoupper($dpInfo->event_type); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Date<span class="float-right">:</span></th>
                                        <td><?php  if($dpInfo->date=='1970-01-01'){echo $dpInfo->date='';} else { echo $dpInfo->date.'-'.$y;} ?></td>
                                    </tr>
                                    <!-- <tr>
                                        <th>Tithi<span class="float-right">:</span></th>
                                        <td><?php echo $dpInfo->tithi; ?></td>
                                    </tr> -->
                                    <tr>
                                        <th>Nakshathra<span class="float-right">:</span></th>
                                        <td><?php echo $dpInfo->nakshathra; ?></td>
                                    </tr>
                                    <!-- <tr>
                                        <th>Masa<span class="float-right">:</span></th>
                                        <td><?php echo $dpInfo->masa; ?></td>
                                    </tr> -->
                                    <tr>
                                        <th>Rashi<span class="float-right">:</span></th>
                                        <td><?php echo $dpInfo->rashi; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Gothra<span class="float-right">:</span></th>
                                        <td><?php echo $dpInfo->gothra; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Occation<span class="float-right">:</span></th>
                                        <td><?php echo strtoupper($dpInfo->occation); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Amount<span class="float-right">:</span></th>
                                        <td><?php echo strtoupper($dpInfo->amount); ?></td>
                                    </tr>
                                    <!-- <tr>
                                        <th>State Code<span class="float-right">:</span></th>
                                        <td><?php //echo $committeeInfo->committee_state_code; ?></td>
                                    </tr> -->
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