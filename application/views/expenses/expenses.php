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
<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row p-0">
            <div class="col  padding_left_right_null">
                <div class="card card-small  p-0 m-b-1">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-lg-5 col-sm-12 col-12">
                                <span class="page-title">
                                    <i class="fa fa-money"></i> Expense Management
                                </span>
                            </div>
                            <div class="col-lg-5 col-8 mobile-title">
                                <span class="page-sub-title mobile-title">Total Expenses: <?php echo $count; ?></span>
                            </div>
                            <div class="col-lg-2 col-4 ">
                                <div class="form-group">
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
                    <div class="card-body p-1 pb-3 text-center table-responsive">
                        <table class=" table mb-0 form-table-padding bordeless ">
                            <tr class="bg-deafult">
                                <form action="<?php echo base_url() ?>expenseListing" method="POST" id="byFilterMethod">
                                    <!-- <th width="150" style="padding: 0px;"> -->
                                    <!-- <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="devotee_id" id="devotee_id" value="<?php //echo $devotee_id ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By ID"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-id-card"></i>
                                            </div>
                                        </div> -->
                                    <!-- </th> -->
                                    <!-- <th width="40">
                                    </th> -->

                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="expense_type" id="expense_type"
                                                value="<?php echo $expense_type ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By Expense Name"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-list"></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width " type="text"
                                                name="account_type" id="account_type"
                                                value="<?php echo $account_type ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By Payment Type"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-money"></i></div>
                                        </div>
                                    </th>
                                    
                                    <th width="150" style="padding: 0px;">

                                    </th>
                                    <th width="180" class="text-center btn-padding"><button type="submit"
                                            class="btn btn-success btn-block mobile-width"> Search</button></th>
                                </form>
                            </tr>
                            <tr class=" text-white bg-black ">
                            <th width="10000">Date</th>
                                <th width="10000">Expense Name</th>
                                <th width="10000">Payment Type</th>
                                <th width="10000">Event Type</th>
                                <th width="10000">Committee</th>
                                <th width="10000">Amount</th>
                                <th class="text-center" width="10000">Actions</th>
                            </tr>
                            <?php
                    if(!empty($expensesRecords))
                    {
                        foreach($expensesRecords as $expense)
                        {
                    ?>
                            <tr class="text-black">
                            <td><?php echo $expense->expense_date ?></td>
                                <td><?php echo $expense->expense_type ?></td>
                                <td><?php echo $expense->account_type ?></td>
                                <td><?php echo $expense->event_type ?></td>
                                <td><?php echo $expense->committee_name ?></td>
                                <td><?php echo $expense->amount ?></td>
                                <td class="text-center">

                                    <a class="btn  btn-sm btn-info"
                                        href="<?php echo base_url().'editExpensePageView/'.$expense->row_id; ?>"
                                        title="Edit"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger deleteExpense" href="#"
                                        data-expense_id="<?php echo $expense->row_id; ?>" title="Delete"><i
                                            class="fas fa-trash"></i></a>
                                     <?php $attachmentInfo = $expenses_model->getAttachmentDocumentInfo($expense->row_id); 
                                            foreach($attachmentInfo as $doc){ ?>
                                            <a href="<?php echo base_url(); ?><?php echo $doc->doc_path; ?>"
                                            download target="_blank" class="btn btn_download p-2"><i
                                            class="fa fa-download" style="font-size: 15px;"></i></a>
                                            <?php } ?>        

                                </td>
                            </tr>
                            <?php
                        }
                    } else { ?>
                            <tr>
                                <td class="text-center " colspan="10">
                                    Expenses Not Found!!.
                                </td>
                            </tr>
                            <?php }
                      ?>
                        </table>
                        <div>
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div id="Modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header modal-call-report p-2">
                        <div class=" col-md-10 col-10">
                            <span class="text-white mobile-title" style="font-size : 20px">Add Expense
                                Details</span>
                        </div>
                        <div class=" col-md-2 col-2">
                            <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body m-2">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="addExpenses" action="<?php echo base_url() ?>addExpenses" method="post"
                            role="form" enctype="multipart/form-data">
                            <!-- Default Light Table -->
                            <div class="row form-contents">
                                <div class="row">

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="account_type">Expense Name*</label>
                                            <select class="form-control selectpicker" data-live-search="true"
                                                id="expense_type" name="expense_type" required>
                                                <option value=""> Select Expense Name
                                                </option>
                                                <?php if(!empty($expenseNameInfo)) {
                                                    foreach($expenseNameInfo as $expense){ ?>
                                                <option value="<?php echo $expense->expense_name ?>">
                                                    <?php echo $expense->expense_name ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="account_type">Expense Type*</label>
                                            <select class="form-control " id="type_of_expense" name="type_of_expense"
                                                required>
                                                <option value=""> Select Expense Type
                                                </option>
                                                <option value="Event">Event</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12 committee_name">
                                        <div class="form-group">
                                            <label for="purpose">Committee*</label>
                                            <select class="form-control selectpicker" id="committee_name"
                                                name="committee_name" data-live-search="true">
                                                <option value=""> Select Committee </option>
                                                <?php if(!empty($committeeInfo)) {
                                                             foreach($committeeInfo as $role ){?>
                                                <option value="<?php echo $role->row_id;?>">
                                                    <?php echo $role->type;?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12 event_type">
                                        <div class="form-group">
                                            <label for="purpose">Event Type*</label>
                                            <select class="form-control selectpicker" id="event_type" name="event_type"
                                                data-live-search="true">
                                                <option value=""> Select Event </option>
                                                <?php if(!empty($eventInfo)) {
                                                             foreach($eventInfo as $role ){?>
                                                <option value="<?php echo $role->events;?>">
                                                    <?php echo $role->events;?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="expense_amount"> Amount*</label>
                                            <input type="text" class="form-control " id="expense_amount" value=""
                                                name="expense_amount" placeholder="Enter Expense Amount" maxlength="10"
                                                onkeypress="return isNumberKey(event)" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="account_type">Payment Type*</label>
                                            <select class="form-control " id="tran_type" name="account_type" required>
                                                <option value=""> Select Payment Type
                                                </option>
                                                <option value="Cash">Cash</option>
                                                <option value="Bank">Bank</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="contact_number_two">Invoice No</label>
                                            <input type="text" class="form-control " id="invoice_no" value=""
                                                name="invoice_no" placeholder="Enter Invoice No" maxlength="10"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group" id="bank_type_select">
                                            <label for="bank_rowid">Select Bank</label>
                                            <select name="bank_row_id" id="bank_row_id"
                                                class="form-control selectpicker " data-live-search="true">
                                                <option value="">Select Bank</option>
                                                <?php if(!empty($bank))
                                                        { foreach ($bank as $b1)
                                                            { ?>
                                                <option value="<?php echo $b1->row_id ?>">
                                                    <?php echo $b1->bank_name ?></option>
                                                <?php   } 
                                          } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group" id="cash_type_select">
                                            <label for="bank_rowid">Select Cash Account</label>
                                            <select name="cash_row_id" id="cash_row_id"
                                                class="form-control required selectpicker" data-live-search="true">
                                                <option value="">Select Cash Account</option>
                                                <?php if(!empty($cashAccount))
                                                        { foreach ($cashAccount as $b1)
                                                            { ?>
                                                <option value="<?php echo $b1->row_id ?>">
                                                    <?php echo $b1->cash_account_name ; ?>
                                                    <!--.'(Bal: '.$b1->account_balance.')' -->
                                                </option>
                                                <?php   } 
                                          } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group required">
                                            <label for="party">Party</label>
                                            <select class="form-control selectpicker" id="party" name="party"
                                                data-live-search="true">
                                                <option value=""> Select Party
                                                </option>
                                                <?php if(!empty($partyInfo)) {
                                                foreach($partyInfo as $party ){?>
                                                <option value="<?php echo $party->row_id;?>">
                                                    <?php echo $party->party_name;?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="account_type">Year*</label>
                                            <select class="form-control " id="year" name="year" required>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="contact_number_two">Date*</label>
                                            <input type="text" class="form-control datepicker" id="" value=""
                                                name="year" placeholder="Enter Date" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="comments">Notes</label>
                                            <textarea class="form-control " name="comments" id="comments" rows="2"
                                                placeholder="Notes" autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="contact_number_two">Attachment 1</label>
                                            <input type="hidden" value="attachment_1" name="documentName[]" id=""/>
                                            <input type="file" accept="image/png, image/jpeg, image/jpg, application/pdf" class="form-control-sm" id="" name="userfile[]">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="contact_number_two">Attachment 2</label>
                                            <input type="hidden" value="attachment_2" name="documentName[]" id=""/>
                                            <input type="file" accept="image/png, image/jpeg, image/jpg, application/pdf" class="form-control-sm" id="" name="userfile[]">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="contact_number_two">Attachment 3</label>
                                            <input type="hidden" value="attachment_3" name="documentName[]" id=""/>
                                            <input type="file" accept="image/png, image/jpeg, image/jpg, application/pdf" class="form-control-sm" id="" name="userfile[]">
                                        </div>
                                    </div>


                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"
                                        OnClientClick="Validate();">Submit</button>
                                </div>

                            </div>
                    </div>
                </div>
                </form> <!-- form end -->
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Modal -->
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/expenses/deleteExpense.js" charset="utf-8">
</script>
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

    $('.committee_name').hide();
    $("#committee_name").prop('required', false);
    $('.event_type').hide();
    $("#event_type").prop('required', false);

    $("#bank_type_select").hide();
    $("#cash_type_select").hide();
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#searchList").attr("action", baseURL + "expenseListing/" + value);
        jQuery("#searchList").submit();
    });
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#byFilterMethod").attr("action", baseURL + "expenseListing/" + value);
        jQuery("#byFilterMethod").submit();
    });
    jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});

$("#tran_type").change(function() {
    if (this.value == 'Cash') {
        $("#bank_type_select").hide();
        $("#cash_type_select").show();
    } else if (this.value == 'Bank') {
        $("#bank_type_select").show();
        $("#cash_type_select").hide();
    }

});



$("#type_of_expense").change(function() {
    type_of_expense = $('#type_of_expense').val();
    if (type_of_expense == 'Event') {
        $('.committee_name').show();
        $("#committee_name").prop('required', true);
        $('.event_type').show();
        $("#event_type").prop('required', true);
    } else {
        $('.committee_name').show();
        $("#committee_name").prop('required', true);
        $('.event_type').hide();
        $("#event_type").prop('required', false);
    }
});





function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#uploadedImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#vImg").change(function() {
    readURL(this);
});
</script>