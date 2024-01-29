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
                                    <i class="fa fa-user"></i> Billing Management
                                </span>
                            </div>
                            <div class="col-lg-6 col-sm-8 col-4 ">
                                <a class="btn btn-primary mobile-btn pull-right"
                                    href="<?php echo base_url() ?>addNewBill"><i class="fa fa-plus"></i> Add New </a>
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
                        <table id="bill-list" style="width:100%"
                            class="display table table-striped table-hover nowrap ">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Party</th>
                                    <th>Bill No.</th>
                                    <th>Product</th>
                                    <th>Total Amount</th>
                                    <th>Balance</th>
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
</div>

<!-- Modal Bigin -->

<div id="Modal2" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header modal-call-report p-2">
                <div class=" col-lg-10 col-10">
                    <span class="text-white mobile-title" style="font-size : 20px">Pay Bill</span>
                </div>
                <div class=" col-lg-2 col-2  ">
                    <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <?php $this->load->helper("form"); ?>
                <form role="form" id="addBillPayment" action="<?php echo base_url() ?>addBillPayment" method="post"
                    role="form">
                    <div class="row form-contents">
                        <div class="col-md-6 col-12">
                            <label for="cash_date">Date</label>
                            <div class="input-group ">
                                <span class="input-group-append">
                                    <span class="input-group-text material-icons date-icon">date_range</span>
                                </span>
                                <input id="pay_date" type="text" name="pay_date" value="<?php echo date('d-m-Y'); ?>"
                                    class="form-control datepicker  " placeholder="Enter Date" autocomplete="off"
                                    required>
                                <input type="hidden" name="billrowId" id="billrowId" />
                                <!-- <input type="hidden" name="account_balance" id="modal_account_balance" /> -->
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="cash_amount">Amount</label>
                                <input type="text" class="form-control " id="pay_amount"
                                    onkeypress="return isNumberKey(event)" name="pay_amount" placeholder="Enter Amount"
                                    autocomplete="off" required>
                                <!-- <input type="hidden" name="vehicle_number" id="modal2_vehicle_number" /> -->
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="bank_rowid">Transaction Type</label>
                                <select required name="tran_type" id="tran_type" class="form-control required" required>
                                    <option value="">Select Transaction Type</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bank">Bank</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group" id="bank_type_select">
                                <label for="bank_rowid">Select Bank</label>
                                <select name="bank_row_id" id="bank_row_id" class="form-control selectpicker "
                                    data-live-search="true">
                                    <option value="">Select Bank</option>
                                    <?php if(!empty($bank)){ 
                                        foreach ($bank as $b1) { ?>
                                    <option value="<?php echo $b1->row_id ?>">
                                        <?php echo $b1->bank_name ?></option>
                                    <?php   } 
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-md-6 col-12">
                            <div class="form-group" id="cash_type_select">
                                <label for="bank_rowid">Select Cash Account</label>
                                <select name="cash_row_id" id="cash_row_id" class="form-control required selectpicker"
                                    data-live-search="true">
                                    <option value="">Select Cash Account</option>
                                    <?php if(!empty($cashAccount))
                                                        { foreach ($cashAccount as $b1)
                                                            { ?>
                                    <option value="<?php echo $b1->row_id ?>">
                                        <?php echo $b1->cash_account_name .'(Bal: '.$b1->account_balance.')'; ?>
                                    </option>
                                    <?php   } 
                                          } ?>
                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="comments">Comments (Optional)</label>
                                <textarea class="form-control " placeholder="Enter Comments" name="comments"
                                    id="comments" rows="3" autocomplete="off"></textarea>
                            </div>
                        </div> -->
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
<!-- End Modal -->

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
    $('#bill-list thead tr').clone(true).appendTo('#bill-list thead');
    $('#bill-list thead tr:eq(1) th').each(function(i) {

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
    var table = $('#bill-list').DataTable({

        processing: true,
        orderCellsTop: true,
        fixedHeader: true,
        responsive: true,
        language: {
            search: "",
            searchPlaceholder: "Search records",
            "lengthMenu": "Show _MENU_ Parties",
            "infoFiltered": "(filtered from _MAX_ total parties)",
            "info": "Showing _START_ to _END_ of _TOTAL_ parties",
            "infoEmpty": "Showing 0 to 0 of 0 parties",


            processing: '<img src="' + baseURL + 'assets/dist/img/load.gif" width="150"  alt="loader">'

        },

        columnDefs: [{
            width: 150,
            targets: 0
        }],


        "ajax": {
            url: '<?php echo base_url(); ?>/get_bill_list',
            type: 'POST',

            // dataType: 'json',
        },
    });

    jQuery(document).on("click", ".deleteBill", function() {
        var row_id = $(this).data("row_id"),
            hitURL = baseURL + "deleteBill",
            currentRow = $(this);

        var confirmation = confirm("Are you sure to delete this bill ?");

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
                    alert("Bill successfully deleted");
                } else if (data.status = false) {
                    alert("Bill deletion failed");
                } else {
                    alert("Access denied..!");
                }
            });
        }
    });
});

jQuery(document).ready(function() {
    $("#bank_type_select").hide();
    //$("#cash_type_select").hide();

    jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });

    $('.js-example-basic-single').select2();

    $("#tran_type").change(function() {

        if (this.value == 'Cash') {
             $("#bank_type_select").hide();
        //     $("#cash_type_select").show();
         } 
         //else
         if (this.value == 'Bank') {
            $("#bank_type_select").show();
            //$("#cash_type_select").hide();
        }

    });
});
function openPayModal(row_id) {
    $("#Modal2").modal('show');
    document.getElementById("billrowId").value = row_id;
    //alert(row_id);
    // document.getElementById("modal_account_balance").value = account_balance;
}
</script>