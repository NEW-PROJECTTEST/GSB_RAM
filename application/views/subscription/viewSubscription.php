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
<?php } ?>
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
                            <div class="col-lg-10 col-sm-8 col-8">
                                <span class="page-title">
                                    <i class="fa fa-user"></i> Subscription Info
                                </span>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group text-right">
                                    <a class="btn btn-primary mobile-btn pull-right" href="" data-toggle="modal"
                                        data-target="#Modal"><i class="fa fa-plus"></i>
                                        Add New </a>
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
                    <div class="card-body p-1  text-center table-responsive">
                        <table id="member-list" style="width:100%"
                            class="display table table-striped table-hover nowrap ">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Amount</th>
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
    </div>
    <!--Edit Subscription Model--->
    <div id="subscription" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header modal-call-report p-2">
                    <div class=" col-md-10 col-10">
                        <span class="text-white mobile-title" style="font-size : 20px">Subscription
                            Details</span>
                    </div>
                    <div class=" col-md-2 col-2">
                        <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body m-0">
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="updateSubscription" action="<?php echo base_url() ?>updateSubscription"
                        method="post" role="form">
                        <input type="hidden" name="row_id" id="row_id" value="" />
                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <div class="form-group">
                                    <label for="committee_name">Subscription Amount</label>
                                    <input type="text" class="form-control " id="subscription_amount"
                                        name="subscription_amount" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="form-group">
                                    <label for="contact_number_two">Month</label>
                                    <select class="form-control" data-live-search="true" id="month"
                                        name="subscription_month" required>
                                        <option value="">Select</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label for="subscription_year"> Year</label>
                                <select class="form-control " data-live-search="true" id="year" name="subscription_year" required>
                                    <option value=""> Select
                                    </option>
                                    <?php if(!empty($subscription_year)) {
                                        foreach($subscription_year as $year ){?>
                                    <option value="<?php echo $year->row_id;?>"><?php echo $year->year;?>
                                    </option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>

                        </div>
                        <div class="form-group">
                            <input style="float:right;" type="submit" class="btn btn-primary" value="Update" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----End Edit Subscription Model-->

    <!--Add Subscription Model--->
    <div id="Modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header modal-call-report p-2">
                    <div class=" col-md-10 col-10">
                        <span class="text-white mobile-title" style="font-size : 20px">Subscription
                            Details</span>
                    </div>
                    <div class=" col-md-2 col-2">
                        <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body m-0">
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addSubscription" action="<?php echo base_url() ?>addSubscriptionByFamilyID"
                        method="post" role="form">
                        <input type="hidden" name="family_id" id="family_id" value="" />
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                <label for="committee_name">Select Family Head*</label>
                                    <select name="family_id" id="ddlFamilyHead" class="form-control selectpicker"
                                        data-live-search="true" required>
                                        <option value="">Select Member</option>
                                        <?php if(!empty($familyInfo)){ 
                                            foreach ($familyInfo as $fam) { ?>
                                        <option value="<?php echo $fam->row_id?>">
                                            <?php echo $fam->devotee_name ?>
                                        </option>
                                        <?php } 
                                                                                } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="committee_name">Subscription Amount*</label>
                                    <input type="text" class="form-control " id="subscription_amt"
                                        name="subscription_amount" value="" autocomplete="off" readonly required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="contact_number_two">Month*</label>
                                    <select class="form-control selectpicker" data-live-search="true" id=""
                                        name="subscription_month" required>
                                        <option value="">Select</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="subscription_year"> Year*</label>
                                <select class="form-control " id="year" name="subscription_year" required>
                                    <option value=""> Select
                                    </option>
                                    <?php if(!empty($subscription_year)) {
                                        foreach($subscription_year as $year ){?>
                                    <option value="<?php echo $year->row_id;?>"><?php echo $year->year;?>
                                    </option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>

                        </div>
                        <div class="form-group">
                            <input style="float:right;" type="submit" class="btn btn-primary" value="Add" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----End Add Subscription Model-->
</div>
</div>
<script type="text/javascript">
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function alphaOnly(event) {
    var key = event.keyCode;
    return ((key >= 65 && key <= 90) || key == 8 || key == 32);
};

jQuery(document).ready(function() {
    $('#member-list thead tr').clone(true).appendTo('#member-list thead');
    $('#member-list thead tr:eq(1) th').each(function(i) {

        var title = $(this).text();
        if (title != 'Actions') {
            $(this).html(
                '<div class="form-group position-relative mb-0 mt-0 search-padding "><input type="text" class="form-control input-sm" placeholder="Search" ' +
                title + '" /> </div>');
            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        } else {
            $(this).html('');
        }
    });
    var table = $('#member-list').DataTable({

        processing: true,
        orderCellsTop: true,
        fixedHeader: true,
        responsive: true,
        language: {
            search: "",
            searchPlaceholder: "Search records",
            "lengthMenu": "Show _MENU_ Subscriptions",
            "infoFiltered": "(filtered from _MAX_ total members)",
            "info": "Showing _START_ to _END_ of _TOTAL_ Subscriptions",
            "infoEmpty": "Showing 0 to 0 of 0 members",


            processing: '<img src="' + baseURL + 'assets/dist/img/load.gif" width="150"  alt="loader">'

        },

        columnDefs: [{
            width: 150,
            targets: 0
        }],


        "ajax": {
            url: '<?php echo base_url(); ?>/getSubscriptionInfo',
            type: 'POST',

            // dataType: 'json',
        },
    });



    jQuery(document).on("click", ".deleteSubscription", function() {
        $("#wizard-picture").change(function() {
            readURL(this);
        });
        var row_id = $(this).data("row_id"),
            hitURL = baseURL + "deleteSubscription",
            currentRow = $(this);

        var confirmation = confirm("Are you sure to delete this Subscription?");

        if (confirmation) {
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: hitURL,
                data: {
                    row_id: row_id
                }
            }).done(function(data) {
                console.log(data);
                currentRow.parents('tr').remove();
                if (data.status = true) {
                    alert("Subscription successfully deleted");
                } else if (data.status = false) {
                    alert("Subscription deletion failed");
                } else {
                    alert("Access denied..!");
                }
            });
        }
    });
});

function openModel(row_id, subscription_amount, year, month) {
    $('#row_id').val(row_id);
    $('#subscription_amount').val(subscription_amount);
    $('#year').val(year);
    $('#month').val(month);
    $('#subscription').modal('show');
}

$('#ddlFamilyHead').change(function() {
    var selValue = $(this).val();
    // alert(selValue);
    $.ajax({
            url: '<?php echo base_url(); ?>/getSubscriptionAmtByFamId',
            type: 'POST',
            data: { family_id : selValue},
            success: function(data) {
                
                $('#subscription_amt').val(data.sub_amt);
                // alert(data.sub_amt);
            },
            error: function(result){
                alert("Retry Again! Something Went Wrong");
            },
            fail:(function(status) {
                alert("Retry Again! Something Went Wrong");  
            }),
            beforeSend:function(d){
                $("#coverScreen").show();
            }
        });

});
</script>