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
        <div class="row ">
            <div class="col-md-12 col-lg-12  padding_left_right_null">
                <div class="card ">
                    <div class="card-header text-white card-content-title p-1">
                        <div class="row ">
                            <div class="col-lg-6 text-white ">Expense Management</div>
                            <div class="col-lg-6 "> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck pull-right mobile-bck "><i
                                        class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>

                    <!-- form start -->
                    <div class="card-body contents-body ">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="editDevotee" action="<?php echo base_url() ?>updateExpense" method="post"
                            role="form" enctype="multipart/form-data">
                            <!-- Default Light Table -->
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="account_type">Expense Name*</label>
                                            <select class="form-control selectpicker" id="expense_type" name="expense_type" data-live-search="true" required>
                                            <option value="<?php echo  $expenseInfo->expense_type; ?>">Selected:
                                                <?php echo $expenseInfo->expense_type; ?></option>
                                                <?php if(!empty($expenseNameInfo)) {
                                                    foreach($expenseNameInfo as $expense){ ?>
                                                <option value="<?php echo $expense->expense_name ?>"><?php echo $expense->expense_name ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="account_type">Expense Type*</label>
                                            <select class="form-control " id="type_of_expense" name="type_of_expense"
                                                required>
                                                <option value="<?php echo $expenseInfo->type_of_expense; ?>">Selected:
                                                <?php echo $expenseInfo->type_of_expense; ?></option>
                                                <option value="Event">Event</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12 committee_name">
                                        <div class="form-group">
                                            <label for="purpose">Committee*</label>
                                            <select class="form-control selectpicker" id="committee_name" name="committee_name" data-live-search="true">
                                            <option value="<?php echo  $expenseInfo->committee_id; ?>">Selected:
                                                <?php echo $expenseInfo->committee_name; ?></option>
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
                                            <select class="form-control selectpicker" id="event_type" name="event_type" data-live-search="true">
                                            <option value="<?php echo  $expenseInfo->event_type; ?>">Selected:
                                                <?php echo $expenseInfo->event_type; ?></option>
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
                                        <label for="amount">Amount*</label>
                                        <input type="text" class="form-control "
                                            value="<?php echo $expenseInfo->amount; ?>" id="amount"
                                            name="expense_amount" onkeypress="return isNumberKey(event)" maxlength="128"
                                            placeholder="Enter Amount" autocomplete="off" required>
                                        <input type="hidden" value="<?php echo $expenseInfo->row_id; ?>" name="row_id"
                                            id="row_id" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="account_type">Payment Type*</label>
                                        <select class="form-control " id="account_type" name="account_type" required>
                                            <option value="<?php echo  $expenseInfo->account_type; ?>">Selected:
                                                <?php echo $expenseInfo->account_type; ?></option>
                                            <option value="Cash">Cash</option>
                                            <option value="Bank">Bank</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="invoice_no">Invoice No</label>
                                        <input type="text" class="form-control " id="invoice_no"
                                            value="<?php echo $expenseInfo->invoice_no; ?>" name="invoice_no"
                                            maxlength="128" placeholder="Enter Invoice No" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                        <div class="form-group" id="bank_type_select">
                                            <label for="bank_rowid">Select Bank</label>
                                            <select name="bank_row_id" id="bank_row_id"
                                                class="form-control selectpicker " data-live-search="true">
                                                <?php if($expenseInfo->bank_id>0){ ?>
                                                    <option value="<?php echo $expenseInfo->bank_id ?>">Selected:<?php echo $expenseInfo->bank_name ?></option>
                                                <?php } ?>
                                                <option value="0">Select Bank Account</option>
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
                                                <?php if($expenseInfo->cash_id>0){ ?>
                                                    <option value="<?php echo $expenseInfo->cash_id ?>">Selected:<?php echo $expenseInfo->cash_account_name ?></option>
                                                <?php } ?>
                                                <option value="0">Select Cash Account</option>
                                                <?php if(!empty($cashAccount))
                                                        { foreach ($cashAccount as $b1)
                                                            { ?>
                                                <option value="<?php echo $b1->row_id ?>">
                                                     <?php echo $b1->cash_account_name; ?><!-- .'(Bal: '.$b1->account_balance.')' -->
                                                </option>
                                                <?php   } 
                                          } ?>
                                            </select>
                                        </div>
                                    </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group required">
                                        <label for="party">Party</label>
                                        <select class="form-control selectpicker" id="party" name="party" data-live-search="true">
                                            <option value="<?php echo $expenseInfo->party_id; ?>">
                                                Selected:<?php echo $expenseInfo->party_name; ?>
                                            </option>
                                            <?php if(!empty($partyInfo)) {
                                                foreach($partyInfo as $party ){?>
                                            <option value="<?php echo $party->row_id;?>">
                                                <?php echo $party->party_name;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                   
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="contact_number_two">Date*</label>
                                            <input type="text" class="form-control datepicker" id="" value="<?php echo date('d-m-Y',strtotime($expenseInfo->expense_date)); ?>"
                                                name="year" placeholder="Enter Date"
                                                autocomplete="off" required>
                                        </div>
                                    </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="comments">Notes</label>
                                        <textarea class="form-control " name="comments" id="comments" rows="2"
                                            placeholder="Notes"
                                            autocomplete="off"> <?php echo $expenseInfo->comments; ?></textarea>
                                    </div>
                                </div>

                                <?php foreach ($atachmentInfo as $key => $attachment): ?>
    <div class="col-lg-6 col-12">
        <div class="form-group">
            <label for="attachment<?php echo $key + 1; ?>">Attachment <?php echo $key + 1; ?></label>
            <img src="<?php echo base_url($attachment->doc_path); ?>" alt="Attachment <?php echo $key + 1; ?>" style="max-width: 200px; max-height: 200px;">
            <input type="file" accept="image/png, image/jpeg, image/jpg, application/pdf" class="form-control-sm" id="attachment<?php echo $key + 1; ?>" name="userfile[]">
            <input type="hidden" value="<?php echo $attachment->doc_name; ?>" name="documentName[]">
        </div>
    </div>
<?php endforeach; ?>

<?php for ($i = count($atachmentInfo) + 1; $i <= 3; $i++): ?>
    <div class="col-lg-6 col-12">
        <div class="form-group">
            <label for="attachment<?php echo $i; ?>">Attachment <?php echo $i; ?></label>
            <input type="file" accept="image/png, image/jpeg, image/jpg, application/pdf" class="form-control-sm" id="attachment<?php echo $i; ?>" name="userfile[]">
            <input type="hidden" value="attachment_<?php echo $i; ?>" name="documentName[]">
        </div>
    </div>
<?php endfor; ?>









                                

                            </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" style="float:right;" class="btn btn-primary mr-1">Update</button>
                    </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- form end -->
<!-- End Default Light Table -->


<script src="<?php echo base_url(); ?>assets/js/devotee/editDevotee.js" type="text/javascript"></script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = '<?php echo base_url(); ?>/expenseListing';
        /* OR */
        //location.replace(document.referrer);
    } else {
        window.history.back();
    }
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    return true;
}

jQuery(document).ready(function() {

    // $('.committee_name').hide();
    //     $("#committee_name").prop('required', false);
    //     $('.event_type').hide();
    //     $("#event_type").prop('required', false);


    type_of_expenses = $('#type_of_expense').val();

if (type_of_expenses == 'Event') {
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


        
    var trans_type = $("#account_type").val();
    if(trans_type=='Cash'){
        $("#bank_type_select").hide();
    }else if(trans_type=='Bank'){
        $("#cash_type_select").hide();
    }
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        jQuery("#searchList").attr("action", link);
        jQuery("#searchList").submit();
    });
    jQuery('.resetFilters').click(function() {
        $(this).closest('form').find("input[type=text]").val("");
    })
    // Prepare the preview for profile picture
    $("#wizard-picture").change(function() {
        readURL(this);
    });
    jQuery('.datepicker').datepicker({
        autoclose: true,
        orientation: "bottom",
        format: "dd-mm-yyyy"

    });
});

$("#account_type").change(function() {
    if (this.value == 'Cash') {
        $("#bank_type_select").hide();
        $("#bank_type_select select").val(0);
        $("#cash_type_select").show();
    } else if (this.value == 'Bank') {
        $("#bank_type_select").show();
        $("#cash_type_select").hide();
        $("#cash_type_select select").val(0);
    }

});

$("#type_of_expense").change(function() {
    type_of_expense = $('#type_of_expense').val();
    if (type_of_expense == 'Event') {
        $('.committee_name').hide();
        $("#committee_name").prop('required', false);
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
$("#sImg").change(function() {
    readURL(this);
});
</script>