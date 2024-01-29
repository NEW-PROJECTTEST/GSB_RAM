<style>
    body{
    color: #484b51;
}
.text-secondary-d1 {
    color: #728299!important;
}
.page-header {
    margin: 0 0 1rem;
    padding-bottom: 1rem;
    padding-top: .5rem;
    border-bottom: 1px dotted #e2e2e2;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}
.page-title {
    padding: 0;
    margin: 0;
    font-size: 1.75rem;
    font-weight: 300;
}
.brc-default-l1 {
    border-color: #dce9f0!important;
}

.ml-n1, .mx-n1 {
    margin-left: -.25rem!important;
}
.mr-n1, .mx-n1 {
    margin-right: -.25rem!important;
}
.mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
}

hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
}

.text-grey-m2 {
    color: #888a8d!important;
}

.text-success-m2 {
    color: #86bd68!important;
}

.font-bolder, .text-600 {
    font-weight: 600!important;
}

.text-110 {
    font-size: 110%!important;
}
.text-blue {
    color: #478fcc!important;
}
.pb-25, .py-25 {
    padding-bottom: .75rem!important;
}

.pt-25, .py-25 {
    padding-top: .75rem!important;
}
.bgc-default-tp1 {
    background-color: rgba(121,169,197,.92)!important;
}
.bgc-default-l4, .bgc-h-default-l4:hover {
    background-color: #f3f8fa!important;
}
.page-header .page-tools {
    -ms-flex-item-align: end;
    align-self: flex-end;
}

.btn-light {
    color: #757984;
    background-color: #f5f6f9;
    border-color: #dddfe4;
}
.w-2 {
    width: 1rem;
}

.text-120 {
    font-size: 120%!important;
}
.text-primary-m1 {
    color: #4087d4!important;
}

.text-danger-m1 {
    color: #dd4949!important;
}
.text-blue-m2 {
    color: #68a3d5!important;
}
.text-150 {
    font-size: 150%!important;
}
.text-60 {
    font-size: 60%!important;
}
.text-grey-m1 {
    color: #7b7d81!important;
}
.align-bottom {
    vertical-align: bottom!important;
}
</style>
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
        <div class="row p-0">
            <div class="col padding_left_right_null">
                <div class="card card-small  p-0 m-b-1">
                    <div class="card-body p-2">
                    <div class="row ">
                            <div class="col-lg-6 col-sm-8 col-8">
                                <span class="page-title">
                                    <i class="fa fa-file-alt"></i> Invoice
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <form role="form" id="add" action="<?php echo base_url() ?>addBillToDB"  method="post">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-4">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">To:</span>
                            <select required name="party_row_id" id="party_row_id"
                                class="form-control required selectpicker" data-live-search="true" required>
                                    <option value="">Select Party</option>
                                    <?php if(!empty($partyInfo)){ 
                                    foreach ($partyInfo as $party){ ?>
                                    <option value="<?php echo $party->row_id ?>"><?php echo $party->party_name ?></option>
                                <?php } 
                                } ?>
                            </select>
                        </div>
                        <!-- <div class="text-grey-m2">
                            <div class="my-1">
                                <input type="text" name="party_gst" class="form-control" placeholder="Party GST" 
                                    autocomplete="off" required>
                            </div>
                            <div class="my-1">
                                <input type="text" name="party_state_code" class="form-control" placeholder="Party State Code" onkeypress="return isNumberKey(event)"
                                    autocomplete="off" required>
                            </div>
                        </div> -->
                    </div>
                    <!-- /.col -->
                    <div class="col-4"></div>
                    <div class=" col-sm-4 justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <!-- <div class="mt-1 mb-1 text-secondary-m1 text-600 text-125">
                                INVOICE
                            </div> -->
                            <div class="my-2">
                                <input id="date" type="text" name="date" class="form-control datepicker" placeholder="Date"
                                    autocomplete="off" required>
                            </div>
                            <div class="my-2">
                                <input type="text" name="bill_no" class="form-control" placeholder="Bill No." onkeypress="return isNumberKey(event)"
                                    autocomplete="off" required>
                            </div>
                            <div class="my-2">
                                <input type="text" name="ref_no" class="form-control" placeholder="Ref No." onkeypress="return isNumberKey(event)"
                                    autocomplete="off" required>
                            </div>
                            <div class="my-2">
                                <input type="text" name="product" class="form-control" placeholder="Product"
                                    autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                    <div class="m-0">
                        <div class="table-responsive row1">
                            <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                                <thead class="bg-none bgc-default-tp1">
                                    <tr class="text-white">
                                        <th width="70">#</th>
                                        <th>Date</th>
                                        <th>Vehicle</th>
                                        <th>LR</th>
                                        <th>Invoice</th>
                                        <th>Destination</th>
                                        <th>Rate(M/Tons)</th>
                                        <th>Qty</th>
                                        <th width="140">Amount</th>
                                    </tr>
                                </thead>

                                <tbody class="text-95 text-secondary-d3">
                                    
                                    <tr class="inv_row">
                                        <td><input id="slno" type="text" name="slno[]" class="form-control" placeholder="1"
                                        autocomplete="off" disabled></td>
                                        <td><input type="date" name="trans_date[]" class="form-control" placeholder="Date"
                                        autocomplete="off" required></td>
                                        <td><input type="text" name="vehicle[]" class="form-control" placeholder="Vehicle"
                                        autocomplete="off" required></td>
                                        <td><input type="text" name="lr[]" class="form-control" placeholder="LR" onkeypress="return isNumberKey(event)"
                                        autocomplete="off" required></td>
                                        <td class="text-95"><input type="text" name="invoice[]" class="form-control" placeholder="Invoice" onkeypress="return isNumberKey(event)"
                                        autocomplete="off" required></td>
                                        <td><input type="text" name="destination[]" class="form-control" placeholder="Destination"
                                        autocomplete="off" required></td>
                                        <td class="text-secondary-d2"><input type="text" name="rate[]" id="itemrate" class="form-control itemrate" placeholder="Rate" onkeypress="return isNumberKey(event)"
                                        autocomplete="off" required></td>
                                        <td class="text-secondary-d2"><input type="text" name="qty[]" id="itemquantity" class="form-control itemquantity" placeholder="Qty" value="1" onkeypress="return isNumberKey(event)"
                                        autocomplete="off" required></td>
                                        <td class="text-secondary-d2"><input type="text" name="amount[]" id="amount" class="form-control amount" placeholder="Amount"
                                        autocomplete="off" readonly required></td>
                                    </tr> 
                                    <p id='newrow'></p>
                                </tbody>
                            </table>
                        </div>
                        <div class="row ">
                            <div class="col-12 text-right">
                            <input type='button' class = "add align-right btn" id='add' value='+' />
                            <input type='button' class = "sub align-right btn" id='sub' value='-' />
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12 text-right">
                            Total Amount:&nbsp;<i class="fa fa-rupee-sign"></i>&nbsp;<input type="text" name="totalAmount" class="text-150 border-0 w-25 totalAmt" placeholder="0"
                                        autocomplete="off" required readonly>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-12">
                            <input type="submit" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0" value="ADD">
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <script>
    $(document).on("click",".add",function(){
        var n= $('.inv_row').length+1;
        var temp = $('.inv_row:first').clone()
        temp.find('input').val('');
        $('input:first',temp).attr('value',n)
        $('.inv_row:last').after(temp);
    });

    $(document).on("click",".sub",function(){
        var n= $('.inv_row').length;
        if(n>1){
            $('.inv_row:last').remove();
        }
    });

    $('form').delegate('.itemquantity,.itemrate','keyup',function()  {  
        calculateAmount();
        totalAmount();
    });

    function calculateAmount(){
        $(".amount").each(function() {
            var tr=$(this).parent().parent();

            var quantity = tr.find('.itemquantity').val();
            var rate = tr.find('.itemrate').val();
            if(quantity != "" && rate != ""){
                var total = quantity * rate;
            }
            tr.find('.amount').val(total);
        });
    }

    function totalAmount(){
        var t=0;
        $('.amount').each(function(i,e){
            var amt = $(this).val()-0;
            t+=amt;
        });
        $('.totalAmt').val(t);
    }

    function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    return true;
    }

    jQuery(document).ready(function() {
        jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        setDate: new Date()
        });
    });

    
    </script>