<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row ">
            <div class="col padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-1 card-content-title  ">
                        <div class="row ">
                            <div class="col-md-6 text-white ">Detailed View Of Transport</div>
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
                                            <a class="nav-link active" id="transport-tab" data-toggle="tab"
                                                href="#transport" role="tab" aria-controls="transport"
                                                aria-selected="false">Transport Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="ponch-tab" data-toggle="tab" href="#ponch"
                                                role="tab" aria-controls="ponch" aria-selected="true">Ponch Clear
                                                Info</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Academic</a>
                                        </li> -->
                                    </ul>
                                    <div class="tab-content transport-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="transport" role="tabpanel"
                                            aria-labelledby="transport-tab">
                                            <table class="table table-padding">
                                                <tbody>
                                                    <tr>
                                                        <th width="250">Date<span class="float-right">:</span></th>
                                                        <td><?php echo date('d-m-Y',strtotime($transportInfo->date)); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Invoice Number<span class="float-right">:</span> </th>
                                                        <td><?php echo $transportInfo->invoice_number; ?></td>
                                                    </tr>

                                                    <th>Vehicle Number<span class="float-right">:</span></th>
                                                    <td><?php echo $transportInfo->vehicle_number; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Party Name<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->party_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Transporter Name<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->transporter_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>LR No<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->LR_no; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Bags<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->bags; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Destination<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->destination; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>MT<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->mt; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Rate<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->rate; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Amount(MT*Rate)<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->amount; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Diesel Pump<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->fuel_account_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Diesel Amount<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->diesel_amount; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Cash Account<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->cash_account_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Cash Amount<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->cash_amount; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Bank<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->bank_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Party Amount<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->party_amount; ?></td>
                                                    </tr>
                                                    <tr>
                                                    <tr>
                                                        <th>Loading Charge<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->loading_charge; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Unloading Charge<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->unloading_charge; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Halt Charge<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->halt_charge; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>RORO<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->roro; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount Amount<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->discount_amount; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Ponch Amount<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->ponch_amount; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Ponch Pending<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->ponch_pending; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Narration<span class="float-right">:</span></th>
                                                        <td><?php echo $transportInfo->narration; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="ponch" role="tabpanel"
                                            aria-labelledby="ponch-tab">

                                            <table class="table table-padding">
                                                <tbody>
                                                    <tr class="bg-primary">
                                                        <th width="250">Date</th>
                                                        <th>Amount</th>
                                                        <th>Type</th>
                                                        <th>Bank</th>
                                                        <th>Comment</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    <?php if(!empty($ponchInfo)){
                                                        foreach($ponchInfo as $p){ ?>
                                                    <tr>
                                                        <th><?php echo date('d-m-Y',strtotime($p->date)); ?></th>
                                                        <th><?php echo $p->amount; ?></th>
                                                        <th><?php echo $p->type; ?></th>
                                                        <th><?php echo $p->bank_name; ?></th>
                                                        <th><?php echo $p->comments; ?></th>
                                                        
                                                        <th> 
                                                        <?php if($p->date >= '2020-01-14'){ ?>
                                                        <a class="btn btn-sm btn-danger deletePochInfo" href="#"
                                                                data-row_id="<?php echo $p->row_id; ?>"
                                                                title="Delete"><i class="fas fa-trash"></i></a>
                                                        <?php } ?>
                                                                </th>
                                                    </tr>
                                                    <?php  } }else{ ?>
                                                    <th colspan="4">Info Not Found!</th>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <?php if($transportInfo->ponch_pending == 'No'){?>
                                            <b style="color:green;"> Ponch Cleared </b>
                                            <?php } else { ?>
                                            <b style="color:red;"> Ponch Uncleared </b>
                                            <?php } ?>
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
    jQuery('.datepicker').datepicker({
        autoclose: true,
        orientation: "bottom",
        format: "dd-mm-yyyy"

    });



    jQuery(document).on("click", ".deletePochInfo", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deletePochInfo",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Ponch Details ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Ponch Details successfully deleted"); }
				else if(data.status = false) { alert("Ponch Details deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
});
</script>