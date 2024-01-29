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
                                    <i class="fa fa-user"></i> Party Management
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
                    <div class="card-body p-1  text-center table-responsive">
                        <table id="party-list" style="width:100%"
                            class="display table table-striped table-hover nowrap ">
                            <thead>
                                <tr>
                                <th>Party Name</th>
                                <!-- <th>Email</th> -->
                                <th>Contact Number</th>
                                <!-- <th>Pending Balance</th> -->
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
                                    <span class="text-white mobile-title" style="font-size : 20px">Add Party
                                        Details</span>
                                </div>
                                <div class=" col-md-2 col-2">
                                    <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                                </div>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <?php $this->load->helper("form"); ?>
                                <form role="form" id="addParty" action="<?php echo base_url() ?>addParty" method="post"
                                    role="form">
                                    <div class="row form-contents">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="party_name">Party Name</label>
                                                <input type="text" class="form-control " id="party_name" name="party_name"
                                                    placeholder="Enter party Name" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                            <label for="email">Email address (Optional) </label>
                                                <input type="text" class="form-control email " id="email" name="email"
                                                    maxlength="128" placeholder="Enter Email Address"
                                                    autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="contact_number_one">Contact Number One</label>
                                                <input type="text" class="form-control " id="contact_number_one"
                                                    name="contact_number_one" placeholder="Enter Contact Number One"
                                                    maxlength="10" onkeypress="return isNumberKey(event)"
                                                    autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="contact_number_two">Contact Number Two  (Optional)</label>
                                                <input type="text" class="form-control " id="contact_number_two"
                                                    name="contact_number_two" placeholder="Enter Contact Number Two"
                                                    maxlength="10" onkeypress="return isNumberKey(event)"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="gst">GST No.</label>
                                                <input type="text" class="form-control " id="gst"
                                                    name="gst" placeholder="Enter Party GST"
                                                    maxlength="15"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="contact_number_two">State Code</label>
                                                <input type="text" class="form-control " id="state_code" 
                                                    name="state_code" placeholder="Enter Party State Code"
                                                    maxlength="6" onkeypress="return isNumberKey(event)"
                                                    autocomplete="off">
                                            </div>
                                        </div> -->
                                        
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label for="party_address">Address</label>
                                                <textarea class="form-control " placeholder="Enter Address"
                                                    name="party_address" id="party_address" rows="3" autocomplete="off"
                                                    required></textarea>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/party/party.js" charset="utf-8">
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
    $('#party-list thead tr').clone(true).appendTo( '#party-list thead' );
    $('#party-list thead tr:eq(1) th').each( function (i) {
        
        var title = $(this).text();
        if(title != 'Actions'){
        $(this).html( '<div class="form-group position-relative mb-0 mt-0 search-padding "><input type="text" class="form-control input-sm" placeholder="Search" '+title+'" /> </div>' );
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
    var table =  $('#party-list').DataTable({
       
        processing : true,
        orderCellsTop: true,
        fixedHeader: true,
         responsive: true,
        language: {
            search: "",
            searchPlaceholder: "Search records",
            "lengthMenu":     "Show _MENU_ Parties",
            "infoFiltered":   "(filtered from _MAX_ total parties)",
            "info":           "Showing _START_ to _END_ of _TOTAL_ parties",
            "infoEmpty":      "Showing 0 to 0 of 0 parties",
    

        processing: '<img src="'+baseURL+'assets/dist/img/load.gif" width="150"  alt="loader">'

    },

    columnDefs: [
            { width: 150, targets: 0 }
        ],
       
   
        "ajax": {
            url: '<?php echo base_url(); ?>/getPartyDetails ',
            type: 'POST',
           
            // dataType: 'json',
        },
    });


   
    jQuery(document).on("click", ".deleteParty", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteParty",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this party ?");
		
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
				if(data.status = true) { alert("Party successfully deleted"); }
				else if(data.status = false) { alert("Party deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
});
</script>