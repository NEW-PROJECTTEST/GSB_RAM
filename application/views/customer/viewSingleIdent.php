<style>
@media print {
    .page-break {
        display: block;
        page-break-before: always;
    }

    .main-footer {
        display: none !important;
    }
}

@media print {
    .noprint {
        display: none;
    }

    ::-webkit-scrollbar {
        display: none;
    }

    .enable-print {
        display: block !important;

    }
}

.A4 {
    /* overflow-x: scroll; */
    background: white;
    width: 26cm;
    height: 34.7cm;
    display: block;
    margin: 0 auto;
    padding: 25px;
    margin-bottom: 0.5cm;
    box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
}

#border {
    border-radius: 1px;
    border: 2px solid black;
    width: 18.5cm;
    height: 26.7cm;

}

.stm_work {
    font-size: 25px;
    font-weight: bold;
}

.title {
    font-size: 30px;
    margin-left: -25px;
}

table,
th,
td {
    border: 1px solid black;
    border-collapse: collapse;
    padding: 3px;
}

/* ------------------ */
/* new added changes */
/* ----------------- */

.photo1 {
    margin-top: 0px !important;
}

.picture-box {
    margin-top: 15px;
}

.footer-sign {
    margin-top: 60px;
    text-transform: uppercase;
    font-size: 14px;
}

.boredr-only-top {
    border-top: solid;
    border-color: black;
    border-width: 1px;
    margin-top: 15px;
}

.box-address {
    margin-top: 40px;
}

.table>tbody>tr>td,
.table>tbody>tr>th,
.table>tfoot>tr>td,
.table>tfoot>tr>th,
.table>thead>tr>td,
.table>thead>tr>th {
    line-height: 0.5 !important;
    vertical-align: inherit !important;
    border-top: 1px solid #ddd;
    border: 1px solid black !important;
    font-size: 15px;
    color: black !important;
}

tr {
    height: 21px !important;
}

.border_full {
    border-style: solid;
    padding: 7px;
    border-color: black;
    border-width: 1px;
}

.boredr_left {
    border-left: solid;
    padding: 7px;
    border-color: black;
    border-width: 1px;
}

.boredr_right {
    border-right: solid;
    padding: 7px;
    border-color: black;
    border-width: 1px;
}

.boredr_left_right {
    border-right: solid;
    border-left: solid;
    padding: 7px;
    border-color: black;
    border-width: 1px;
}

.boredr_only_bottom {
    border-bottom: solid;
    /* padding: 7px; */
    border-color: black;
    border-width: 1px;
}

.boredr_only_top {
    border-top: solid;
    padding: 7px;
    border-color: black;
    border-width: 1px;
}

.text_style_2 {
    margin-left: -12px;
    font-weight: bold;
    float: left;
    margin-top: -8px;
}

.photo_style {
    border: 1px solid;
    height: 165px;
    width: 155px;
    text-align: center;
    margin-left: 20px;
    margin-top: -15px !important;
}

.heading_three {
    margin-top: -12px;
    font-size: 25px;
    margin-bottom: -12px;
    text-transform: uppercase;
    text-decoration: underline;
}

.header-heading {
    color: #141488;
    margin-left: -80px;
}

.pb-5 {
    padding-bottom: 5px !important;
}

.headings {
    font-size: 24px !important;
}

.table_exam td {
    font-size: 25px !important;
    padding: 9px !important;
}

.table_exam th {
    font-size: 18px !important;
    padding: 4px !important;
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
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header noprint">
            <div class="row">
                <div class="col-8 h5">
                    <i class="fa fa-print"></i> Indent View Karavali Transport
                    <small>Print/Save </small>
                </div>
                <div class="col-4">

                    <button style="float:right;" class="btn btn-primary" type="button"
                        title="Print or Save the Mark Card" onClick="window.print()"><i class="fa fa-download"></i>
                        Print/Save</button>
                </div>
            </div>

        </section>
        <section class="content">
            <div class="box-header noprint">
                <!-- <h3 class="box-title">Students Details <span style="margin-left:50px">Total Students: </span></h3> -->
            </div><!-- /.box-header -->
            <div class="row">
                <div class="col-xs-12">

                    <div class="A4 enable-print">

                        <?php if(!empty($identInfo))
                            {   ?>
                        <div class="row boredr_only_top boredr_left_right boredr_only_bottom">
                            <div class="col-2">

                                <img height="110" class="pull-left" width="110" src="<?php echo $company_logo; ?>"
                                    alt="logo">
                            </div>
                            <div class="col-8">
                                <div class="header-heading text-center">
                                    <b style="font-size: 35px; font-weight: 900; text-transform: uppercase;">KARAVALI
                                        TRANSPORT</b>
                                    <p style="margin-top: 0px; font-size:16px; text-transform: uppercase;">TRANSPORT
                                        CONTRACTOR, FLEET OWNER & BULK MOVER</p>
                                    <p style="margin-top: -35px; font-size:16px;">Register Transport MRPL</p>
                                    <p style="margin-bottom: -35px; margin-top: -35px; font-size:16px;">'Ayshwarya',First Floor, Near SBI Bank, Katla MRPL Road,
                                       Surathkal - 575 014</p>

                                </div>
                            </div>
                            <div class="col-2">
                                <div class="header-heading text-center">

                                    <p style="margin-top: 0px; font-size:15px; ">Call: &nbsp;&nbsp;&nbsp;&nbsp;
                                        9880539811 <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        8792935901
                                        <br> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        8088773364
                                        <br> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        7090034300
                                      </p>

                                </div>
                            </div>
                        </div>
                        <div class="row boredr_left_right boredr_only_bottom">
                            <div class="col-5">
                                <p style="color: #141488; font-size:16px;">Melwin D'Souza <br> Mob : 7022088824

                                </p>
                                <p style="color: #141488; font-size:16px;">To,<br>
                                    <b style="font-weight: 700;">Mangalore Refinery & Petrochemicals Ltd.</b><br>
                                    Marketing Department<br>
                                    Kuthethoor P.O., Via Katipalla<br>
                                    Mangalore - 575 030
                                </p>
                            </div>
                            <div class="col-4">
                                <p style="margin-top:10px; color: #141488; font-size:20px;">PRODUCT INDENT</p>
                            </div>
                            <div class="col-3">
                                <p class="" style=" float:left; color: #141488; font-size:20px;">Sr. No. : <b
                                        style="color:red"><?php echo $identInfo->row_id; ?></b></p>
                                <p class="" style=" float:left; color: #141488; font-size:20px;">Date :
                                    <?php echo date('d-m-Y',strtotime($identInfo->date)); ?></p>
                            </div>

                            <div class="col-12 ">
                                <p style="margin-top:-20px; color: #141488; font-size:16px;">Sir,</p>
                                <p
                                    style="font-weight: 700; margin-top:-30px; margin-bottom:0px; margin-left:40px; color: #141488; font-size:16px;">
                                    Subject: Indent for loading <u>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $identInfo->product_code; ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>(product
                                    with grade)</p>
                            </div>
                        </div>

                        <div class="row boredr_left_right boredr_only_bottom">
                            <div class="col-12" style="padding-left: 0px; padding-right: 0px;">
                                <div class="table-responsive ">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td width="450">Contract Number</td>
                                            <td><?php echo $identInfo->contract_number; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">Customer Code / Ship to Party</td>
                                            <td><?php echo $identInfo->customer_code; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">CUSTOMER NAME</td>
                                            <td><?php echo strtoupper($identInfo->customer_name); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">Product Code</td>
                                            <td><?php echo $identInfo->product_code; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">QUANTITY WITH UNIT</td>
                                            <td><?php echo $identInfo->qty_unit; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">DESTINATION & DISTANCE IN KM (ONE WAY)</td>
                                            <td><?php echo $identInfo->destination_km; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">L.R. Number (if interstate)</td>
                                            <td><?php echo $identInfo->lr_number; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">Transporter Code</td>
                                            <td><?php echo "<b style='font-weight: 700;'>23000241</b>"; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">Transporter Name</td>
                                            <td><?php echo "<b style='font-weight: 700;'>KARAVALI TRANSPORT</b>"; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">GSTIN</td>
                                            <td><?php echo "<b style='font-weight: 700;'>29ABYPD4537C2ZF</b>"; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">Tank Truck No.</td>
                                            <td><?php echo $identInfo->tank_truck_number; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">Shipping Bill No.</td>
                                            <td><?php echo $identInfo->shipping_bill_no; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">Container No.</td>
                                            <td><?php echo $identInfo->container_no; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">DRIVER NAME</td>
                                            <td><?php echo $identInfo->driver_name; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">DL Number / Validity</td>
                                            <td><?php echo $identInfo->dl_num_validity; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">Driver Signature</td>
                                            <td><?php echo ""; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">CLEANER NAME</td>
                                            <td><?php echo $identInfo->cleaner_name; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="450">Fitness Certificate valid upto</td>
                                            <td><?php  if($identInfo->fitness_cert_valid_date != NULL){
                                            echo date('d-m-Y',strtotime($identInfo->fitness_cert_valid_date)); 
                                        } ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td width="450">Unladen & Gross Vehicle Wt. as per RC</td>
                                            <td><?php echo ""; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>


                        </div>

                        <div class="row boredr_left_right boredr_only_bottom">
                            <div class="col-12">
                                <p style=" color: #141488; font-size:16px;">
                                    We certify that Truck Crew is medically fit for loading and Truck / TT is placed
                                    inside MRPL premises <br>
                                    before submitting indent.<br>
                                    Kindly arrange to load the tank truck.<br>
                                    Thanking You.
                                </p>
                                <p style=" color: #141488; font-size:16px;">
                                    Transporter's authorised Signatory <br>
                                    Name : <br>
                                    Mob :

                                </p>
                            </div>

                        </div>
                        <?php  } ?>
                    </div>


                </div>
            </div>

            <div class="box-footer clearfix noprint">
                <button style="float:right;" class="btn btn-primary" type="button" title="Print or Save the Mark Card"
                    onClick="window.print()"><i class="fa fa-download"></i> Print/Save</button>
            </div>
        </section>
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
jQuery(document).ready(function() {


});
</script>