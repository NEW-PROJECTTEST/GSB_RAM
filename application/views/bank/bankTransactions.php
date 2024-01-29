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
                            <div class="col-lg-6 col-sm-8 col-8">
                                <span class="page-title">
                                    <i class="fa fa-bank"></i> Bank Transaction
                                </span>
                            </div>
                            <div class="col-lg-6 col-sm-8 col-4 ">
                            <a class="btn btn-primary mobile-btn pull-right" href="" data-toggle="modal"
                                        data-target="#Modal"><i class="fa fa-plus"></i> Add New </a>
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
                        <table id="bank-list" style="width:100%"
                            class="display table  table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Bank Name</th>
                                    <th>Particulars</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
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
                                <div class=" col-md-10 col-10">
                                    <span class="text-white mobile-title" style="font-size : 20px">Add Bank
                                        Transaction</span>
                                </div>
                                <div class=" col-md-2 col-2  ">
                                    <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                                </div>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <?php $this->load->helper("form"); ?>
                                <form role="form" id="addBankTransaction" action="<?php echo base_url() ?>addBankTransaction" method="post"
                                    role="form">
                                    <div class="row form-contents">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="bank_name">Date</label>
                                                <input type="text" class="form-control datepicker" id="date" name="trans_date"
                                                    placeholder="Enter Date" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="bank_name">Bank</label>
                                                <select class="form-control " id="bank" name="bank_name" required>
                                                    <option value="">Select Bank</option>
                                                    <?php if(!empty($bankInfo)){
                                                        foreach($bankInfo as $bank){
                                                            ?>
                                                            <option value="<?php echo $bank->bank_name ?>"><?php echo $bank->bank_name ?></option>
                                                            <?php
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="bank_account_number">Particular</label>
                                                <textarea class="form-control " id="particular" 
                                                    name="particular" placeholder="Enter Particular"
                                                    autocomplete="off" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12">
                                            <div class="form-group">
                                                <label for="account_type">Transaction Type </label>
                                                <select class="form-control " id="transaction_type" name="transaction_type" required>
                                                    <option value="">Select Any</option>
                                                    <option value="DEBIT">DEBIT</option>
                                                    <option value="CREDIT">CREDIT</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="amount"
                                                    name="amount" placeholder="Enter Amount"
                                                    autocomplete="off" required>
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
    </div>
</div>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bank/bank.js" charset="utf-8"> -->
</script>
<script type="text/javascript">
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    return true;
}
jQuery(document).ready(function() {
    $('#bank-list thead tr').clone(true).appendTo( '#bank-list thead' );
    $('#bank-list thead tr:eq(1) th').each( function (i) {
        
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
    var table =  $('#bank-list').DataTable({
        columnDefs: [
            // { className: "my_class", targets: "_all" },
            {
                className: "text-left",
                targets: 2,

            }
        ],
        processing : true,
        orderCellsTop: true,
        fixedHeader: true,
        language: {
            search: "",
            searchPlaceholder: "Search records",
            "lengthMenu":     "Show _MENU_ Banks",
            "infoFiltered":   "(filtered from _MAX_ total Banks)",
            "info":           "Showing _START_ to _END_ of _TOTAL_ Banks",
            "infoEmpty":      "Showing 0 to 0 of 0 Banks",
        processing: '<img src="'+baseURL+'assets/dist/img/load.gif" width="100"  width="100" alt="loader">'
    },
   
        "ajax": {
            url: '<?php echo base_url(); ?>/getBankTransactionDetails ',
            type: 'POST',
            // dataType: 'json',
        },
    });



    jQuery(document).on("click", ".deleteTransaction", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteTransaction",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Transaction ?");
		
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
				if(data.status = true) { alert("Transaction successfully deleted"); }
				else if(data.status = false) { alert("Transaction deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
   
    jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
    });
});
</script>