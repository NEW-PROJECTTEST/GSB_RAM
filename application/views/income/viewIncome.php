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
                                <i class="fa fa-money"></i> Income Info
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
                                    <th>Income Type</th>
                                    <th>Income By</th>
                                    <th>Income Date</th>
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
    <div id="income" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header modal-call-report p-2">
                    <div class=" col-md-10 col-10">
                        <span class="text-white mobile-title" style="font-size : 20px">Income
                            Details</span>
                    </div>
                    <div class=" col-md-2 col-2">
                        <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body m-0">
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="updateIncome" action="<?php echo base_url() ?>updateIncome"
                        method="post" role="form">
                        <input type="hidden" name="row_id" id="row_id" value="" />
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="income_name">Name*</label>
                                    <input type="text" class="form-control " id="income_name"
                                        name="income_name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="income_type"> Income Type</label>
                                <select class="form-control " data-live-search="true" id="type_income" name="income_type">
                                    <option value=""> Selected: </option>
                                    <?php if(!empty($income_type)) {
                                        foreach($income_type as $type ){?>
                                    <option value="<?php echo $type->row_id;?>"><?php echo $type->income_type;?>
                                    </option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="income_by">Income By*</label>
                                    <select class="form-control" data-live-search="true" id="income_type_update"
                                        name="income_by" required>
                                        <option value="">Select</option>
                                        <option value="Devotee">Devotee</option>
                                        <option value="Commitee">Committee</option>
                                        <option value="Other">Other</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12" id="committe_type_update">
                                        <div class="form-group" >
                                            <label for="committee_rowid">Select Committee</label>
                                            <select name="committee_rowid" id="committee_rowid"
                                                class="form-control " data-live-search="true">
                                                <option value="">Select Committee</option>
                                                <?php if(!empty($committeInfo))
                                                        { foreach ($committeInfo as $c1)
                                                            { ?>
                                                <option value="<?php echo $c1->row_id ?>">
                                                    <?php echo $c1->committee_name ?></option>
                                                <?php   } 
                                          } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12" id="devotee_type_update">
                                        <div class="form-group" >
                                            <label for="devotee_rowid">Select Devotee</label>
                                            <select name="devotee_rowid" id="devotee_rowid"
                                                class="form-control required " data-live-search="true">
                                                <option value="">Select Devotee</option>
                                                <?php if(!empty($devoteeInfo))
                                                        { foreach ($devoteeInfo as $d1)
                                                            { ?>
                                                <option value="<?php echo $d1->row_id ?>">
                                                     <?php echo $d1->devotee_name ; ?><!--.'(Bal: '.$b1->account_balance.')' -->
                                                </option>
                                                <?php   } 
                                          } ?>
                                            </select>
                                        </div>
                                    </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="income_date">Income Date</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text material-icons date-icon">date_range</span>
                                            <input id="income_date" type="text" name="income_date"
                                                class="form-control datepicker date-col-3 required "
                                                placeholder="Income Date" autocomplete="off"  />
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="amount">Amount*</label>
                                    <input type="text" class="form-control " id="amount"
                                        name="amount" autocomplete="off" onkeypress="return isNumberKey(event)" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <input type="text" class="form-control " id="comment"
                                        name="comment"  placeholder="Comment" autocomplete="off">
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
                        <span class="text-white mobile-title" style="font-size : 20px">Income
                            Details</span>
                    </div>
                    <div class=" col-md-2 col-2">
                        <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body m-0">
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addIncome" action="<?php echo base_url() ?>addIncomeInfo"
                        method="post" role="form">
                        <input type="hidden" name="family_id" id="family_id" value="" />
                        <div class="row">
                        <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="income_name">Name*</label>
                                    <input type="text" class="form-control " id="income_name"
                                        name="income_name"  placeholder="Enter Name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="income_type"> Income Type</label>
                                <select class="form-control " data-live-search="true" id="" name="income_type" >
                                    <option value=""> Select
                                    </option>
                                    <?php if(!empty($income_type)) {
                                        foreach($income_type as $type ){?>
                                    <option value="<?php echo $type->row_id;?>"><?php echo $type->income_type;?>
                                    </option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="income_by">Income By*</label>
                                    <select class="form-control" data-live-search="true" id="income_type"
                                        name="income_by" required>
                                        <option value="">Select</option>
                                        <option value="Devotee">Devotee</option>
                                        <option value="Commitee">Committee</option>
                                        <option value="Other">Other</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12" id="committe_type">
                                        <div class="form-group" >
                                            <label for="committee_rowid">Select Committee</label>
                                            <select name="committee_rowid" id=""
                                                class="form-control selectpicker " data-live-search="true">
                                                <option value="">Select Committee</option>
                                                <?php if(!empty($committeInfo))
                                                        { foreach ($committeInfo as $c1)
                                                            { ?>
                                                <option value="<?php echo $c1->row_id ?>">
                                                    <?php echo $c1->committee_name ?></option>
                                                <?php   } 
                                          } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12" id="devotee_type">
                                        <div class="form-group" >
                                            <label for="devotee_rowid">Select Devotee</label>
                                            <select name="devotee_rowid" id=""
                                                class="form-control required selectpicker" data-live-search="true">
                                                <option value="">Select Devotee</option>
                                                <?php if(!empty($devoteeInfo))
                                                        { foreach ($devoteeInfo as $d1)
                                                            { ?>
                                                <option value="<?php echo $d1->row_id ?>">
                                                     <?php echo $d1->devotee_name ; ?><!--.'(Bal: '.$b1->account_balance.')' -->
                                                </option>
                                                <?php   } 
                                          } ?>
                                            </select>
                                        </div>
                                    </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="income_date">Income Date</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text material-icons date-icon">date_range</span>
                                            <input id="" type="text" name="income_date"
                                                class="form-control datepicker date-col-3 required "
                                                placeholder="Income Date" autocomplete="off"  />
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="amount">Amount*</label>
                                    <input type="text" class="form-control " id="amount"
                                        name="amount" onkeypress="return isNumberKey(event)"  placeholder="Amount" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="comments">Comments</label>
                                            <textarea class="form-control " name="comment" id="comments" rows="2"
                                                placeholder="Comments" autocomplete="off"></textarea>
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
    $("#committe_type").hide();
    $("#devotee_type").hide();
    $("#devotee_type_update").hide();
    $("#committe_type_update").hide();

    $('#member-list thead tr').clone(true).appendTo('#member-list thead');
    $('#member-list thead tr:eq(1) th').each(function(i) {

        var title = $(this).text();

        var newClassupdate = '';
        if (title == 'Income Date') {
            // alert('hi');
            var newClassupdate = 'datepicker_from';
            // alert(newClassupdate);
        }

        if (title != 'Actions') {
            $(this).html(
                '<div class="form-group position-relative mb-0 mt-0" style="margin-top: -5px !important; margin-bottom: -5px !important;" ><input style="border: 1px solid #75787b !important;" type="text" class="form-control input-sm ' +
                newClassupdate + '" placeholder="Search ' +
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

        lengthMenu: [
            [200, 100, 50, 20, 10],
            [200, 100, 50, 20, 10]
        ],

        processing: true,
        orderCellsTop: true,
        fixedHeader: true,
        responsive: true,
        language: {
            search: "",
            searchPlaceholder: "Search records",
            "lengthMenu": "Show _MENU_ Income",
            "infoFiltered": "(filtered from _MAX_ total income)",
            "info": "Showing _START_ to _END_ of _TOTAL_ Income",
            "infoEmpty": "Showing 0 to 0 of 0 income",


            processing: '<img src="' + baseURL + 'assets/dist/img/load.gif" width="150"  alt="loader">'

        },

        columnDefs: [{
            width: 150,
            targets: 0
        }],


        "ajax": {
            url: '<?php echo base_url(); ?>/getIncomeInfo',
            type: 'POST',

            // dataType: 'json',
        },
    });



    jQuery(document).on("click", ".deleteIncome", function() {
        $("#wizard-picture").change(function() {
            readURL(this);
        });
        var row_id = $(this).data("row_id"),
            hitURL = baseURL + "deleteIncome",
            currentRow = $(this);

        var confirmation = confirm("Are you sure to delete this Income?");

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
                    alert("Income successfully deleted");
                } else if (data.status = false) {
                    alert("Income deletion failed");
                } else {
                    alert("Access denied..!");
                }
            });
        }
    });

    jQuery('.datepicker, .datepicker_from').datepicker({
        autoclose: true,
        orientation: "bottom",
        format: "dd-mm-yyyy"
    });

    
$("#income_type").change(function() {
    if (this.value == 'Commitee') {
        $("#devotee_type").hide();
        $("#committe_type").show();
    } else if (this.value == 'Devotee') {
        $("#devotee_type").show();
        $("#committe_type").hide();
    } else if (this.value =='Other') {
        $("#committe_type").hide();
        $("#devotee_type").hide();

    }

});

$("#income_type_update").change(function() {
    if (this.value == 'Commitee') {
        $("#devotee_type_update").hide();
        $("#committe_type_update").show();
        $('#devotee_rowid').val(0);
    } else if (this.value == 'Devotee') {
        $("#devotee_type_update").show();
        $("#committe_type_update").hide();
        $('#committee_rowid').val(0);
    } else if (this.value == 'Other') {
        $("#committe_type_update").hide();
        $("#devotee_type_update").hide();
        $('#devotee_rowid').val(0);
        $('#committee_rowid').val(0);

    }


});
});

function openModel(row_id, income_name, income_type_id, income_by,income_date,amount,comment,committee_id,devoote_id) {
    $('#row_id').val(row_id);
    $('#income_name').val(income_name);
    $('#type_income').val(income_type_id);
    $('#income_type_update').val(income_by);
    $('#income_date').val(income_date);
    $('#amount').val(amount);
    $('#comment').val(comment);
    $('#committee_rowid').val(committee_id);
    $('#devotee_rowid').val(devoote_id);

    if (income_by =='Devotee')
    {
        $("#devotee_type_update").show();

    }

    if (income_by =='Commitee')
    {
        $("#committe_type_update").show();

    }

    $('#income').modal('show');
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