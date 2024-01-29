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
        <div class="row p-0">
            <div class="col  padding_left_right_null">
                <div class="card card-small  p-0 m-b-1">
                    <div class="card-body p-2">

                        <div class="row ">
                            <div class="col-lg-6  col-12">
                                <span class="page-title">
                                    <i class="fa fa-money"></i> Cash Ledger Management
                                </span>
                            </div>
                            <div class="col-lg-6   col-12">
                                <div class="form-group">
                                    <a class="btn btn-primary mobile-btn ml-2 pull-right" href="" data-toggle="modal"
                                        data-target="#Modal"><i class="fa fa-plus"></i> Add New </a>
                                        <a class="btn btn-success mobile-btn pull-right mobile-bck " href="" data-toggle="modal"
                                    data-target="#Modal2"><i class="fa fa-file"></i>
                                    Report</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col  padding_left_right_null">
                <div class="card card-small mb-4">
                    <div class="card-body p-1 pb-3 text-center table-responsive">
                        <table id="cash-ledger-list" style="width:100%"
                            class="display table  table-striped table-hover">
                            <thead>
                                <tr>
                                <th>Date</th>
                                <th>Party Name</th>
                                <th>Reason</th>
                                <th>Cash Amount</th>
                                <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal Bigin -->
        <div class="row">
            <div class="col">
                <div id="Modal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg ">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header modal-call-report p-2">
                                <div class=" col-lg-10 col-10">
                                    <span class="text-white mobile-title" style="font-size : 20px">Add Cash Ledger
                                        Details</span>
                                </div>
                                <div class=" col-lg-2 col-2  ">
                                    <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                                </div>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <?php $this->load->helper("form"); ?>
                                <form role="form" id="addCashLedger" action="<?php echo base_url() ?>addCashLedger"
                                    method="post" role="form">
                                    <div class="row form-contents">
                                        <div class="col-md-6 col-12">
                                            <label for="cash_ledger_date"> Date </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-append">
                                                    <span
                                                        class="input-group-text material-icons date-icon">date_range</span>
                                                </div>
                                                <input id="cash_ledger_date" type="text" name="cash_ledger_date"
                                                    value="<?php echo date('d-m-Y'); ?>"
                                                    class="form-control datepicker date-col-4 required"
                                                    placeholder="Enter Date" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="transporter_name">Party name</label>
                                                <select required name="party_rowid"  id="party_rowid"
                                                    class="form-control required selectpicker" data-live-search="true">
                                                    <option value="">Select Party</option>
                                                    <?php if(!empty($party))
                                                        { foreach ($party as $p1)
                                                            { ?>
                                                    <option value="<?php echo $p1->row_id ?>">
                                                        <?php echo $p1->party_name ?></option>
                                                    <?php   } 
                                          } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 ">
                                        <div class="form-group">
                                                        <label for="cash_account_rowid">Cash Account</label>
                                                        <select name="cash_account_rowid" id="cash_account_rowid"
                                                            class="form-control  selectpicker" data-live-search="true">
                                                            <option value="">Select Cash Account</option>
                                                            <?php if(!empty($cashAccount))
                                                        { foreach ($cashAccount as $account)
                                                            { ?>
                                                            <option value="<?php echo $account->row_id ?> " >
                                                                <?php echo $account->cash_account_name ?> (Balance:<?php echo $account->account_balance ?>)</option>
                                                            <?php   } 
                                                          } ?>
                                                        </select>
                                                    </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="cash_amount">Amount </label>
                                                <input type="text" class="form-control " id="cash_amount"
                                                    name="cash_amount" placeholder="Enter Amount" maxlength="10"
                                                    onkeypress="return isNumberKey(event)" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label for="reason">Reason(Optional)</label>
                                                <textarea class="form-control " placeholder="Enter Reason" name="reason"
                                                    id="reason" rows="3" autocomplete="off" ></textarea>
                                            </div>
                                        </div>

                                    </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" style="flaot : left" value="Submit" />
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
           <!-- modal Bigin -->
           <div class="row">
            <div class="col">
                <div id="Modal2" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg ">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header modal-call-report p-2">
                                <div class=" col-lg-10 col-10">
                                    <span class="text-white mobile-title" style="font-size : 20px">Cash Ledger
                                        Report</span>
                                </div>
                                <div class=" col-lg-2 col-2  ">
                                    <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                                </div>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <?php $this->load->helper("form"); ?>
                                <div class="row">
                                <div class="col-md-6 col-sm-12">
                                        <label for="fromDate">Date From </label>
                                        <div class="input-group ">
                                            <span class="input-group-append">
                                                <span
                                                    class="input-group-text material-icons date-icon">date_range</span>
                                            </span>
                                            <input id="fromDate" type="text" name="fromDate"
                                                class="form-control datepicker  " placeholder=" Date From"
                                                autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="toDate">Date To </label>
                                        <div class="input-group ">
                                            <span class="input-group-append">
                                                <span
                                                    class="input-group-text material-icons date-icon">date_range</span>
                                            </span>
                                            <input id="toDate" type="text" name="toDate"
                                                class="form-control datepicker" placeholder="Date To"
                                                autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <a class="btn  btn-success text-white" onclick="downloadCashLedgerReport()"><i
                                        class="fa fa-download"> &nbsp;Cash Ledger Report</i></a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/cash_ledger/cash_ledger.js" charset="utf-8">
</script>
<script type="text/javascript">
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    return true;
}
function downloadCashLedgerReport() {
    var from_date = $('#fromDate').val();
    var to_date = $('#toDate').val();
    if($('#fromDate').val() == "") {
     alert("Please enter From Date!");
     } else  if($('#toDate').val() == ""){
     alert("Please enter To Date!");
     } else {
    $.ajax({
        url: '<?php echo base_url(); ?>/downloadCashLedgerReport ',
        type: 'POST',
        dataType: 'json',
        data: {
            from_date: from_date,
            to_date: to_date,
        },

        success: function(data) {
            // $("#loader").html("<span style='color:green'><b>Downloded</b></span>");
            // var studentObj = JSON.parse(data)
            var $a = $("<a>");
            $a.attr("href", data.file);
            $("body").append($a);
            $a.attr("download", "Cash_Ledger_Result_" + from_date + "_to_" + to_date + "_Report_file.xls");
            $a[0].click();
            $a.remove();
        },
        error: function(result) {
            //   $("#loader").html("<span style='color:red'>Server Error!!</span>");
        },
        fail: (function(status) {
            alert("Server Error!!  Failed");
        }),
        beforeSend: function(d) {
            // $("#loader").html(loader);
        }
    });
     }
}
jQuery(document).ready(function() {
    $('#cash-ledger-list thead tr').clone(true).appendTo( '#cash-ledger-list thead' );
   $('#cash-ledger-list thead tr:eq(1) th').each( function (i) {
       
       var title = $(this).text();
       if(title != 'Actions'){
       $(this).html( '<div class="form-group position-relative mb-0 mt-0 search-padding"><input type="text" class="form-control input-sm " placeholder="Search" '+title+'" /> </div>' );

       $( 'input', this ).on( 'keyup change', function () {
           if ( table.column(i).search() !== this.value ) {
               table
                   .column(i)
                   .search( this.value )
                   .draw();
           }
       } );
    }else{
        $(this).html( '' );
    }
   } );
    var table =  $('#cash-ledger-list').DataTable({
       
       processing : true,
       orderCellsTop: true,
       fixedHeader: true,
       language: {
        search: "",
            searchPlaceholder: "Search records",
            "lengthMenu":     "Show _MENU_ Cash Ledgers",
            "infoFiltered":   "(filtered from _MAX_ total Cash Ledgers)",
            "info":           "Showing _START_ to _END_ of _TOTAL_ Cash Ledgers",
            "infoEmpty":      "Showing 0 to 0 of 0 Cash Ledgers",
            processing: '<img src="'+baseURL+'assets/dist/img/load.gif" width="100"  width="100" alt="loader">'
   },
  
       "ajax": {
           url: '<?php echo base_url(); ?>/getCashLedgerDetails ',
           type: 'POST',
           // dataType: 'json',
       },
   });
   jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
 
   jQuery(document).on("click", ".deleteCashLedger", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteCashLedger",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Cash Ledger ?");
		
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
				if(data.status = true) { alert("Cash Ledger successfully deleted"); }
				else if(data.status = false) { alert("Cash Ledger deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
});
</script>