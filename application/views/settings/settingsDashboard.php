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
<?php
$warning = $this->session->flashdata('warning');
if ($warning) {
?>
<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <i class="fa fa-check mx-2"></i>
    <strong>warning!</strong> <?php echo $this->session->flashdata('warning'); ?>
</div>
<?php } ?>
<div class="row">
    <div class="col-12">
        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
    </div>
</div>
<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row ">
            <div class="col  padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-1 card-content-title">
                        <div class="row ">
                            <div class="col-md-6 col-8 text-white ">Admin Settings</div>
                            <div class="col-md-6 col-4"> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck pull-right  "><i
                                        class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#caste">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Commitee Role</h6>
                </div>

                <div id="caste" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addCommitteeRole" action="<?php echo base_url() ?>addCommitteeRole"
                                method="post" role="form">
                                <div class="row form-contents">
                                    <div class="col-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="Committee" name="committee"
                                                placeholder="Enter Committee Role" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Committee Role</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($commiteeInfo)) {
                        foreach ($commiteeInfo as $committee) { ?>
                                            <tr class="text-dark">
                                                <td><?php echo $committee->role; ?></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteRole" href="#"
                                                        data-row_id="<?php echo $committee->row_id; ?>"
                                                        title="Delete"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php }
                      } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Committee Role Not
                                                Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Card End -->
                </div>
                <!--collapse End -->
            </div>

            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#relation">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Relation Info</h6>
                </div>
                <div id="relation" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addRelationInfo" action="<?php echo base_url() ?>addRelationInfo"
                                method="post" role="form">
                                <div class="row form-contents">
                                    <div class="col-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="relation" name="relation"
                                                placeholder="Enter Relation" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Relation</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($relationshipInfo)) {
                                              foreach ($relationshipInfo as $relation) { ?>
                                            <tr class="text-dark">
                                                <td><?php echo $relation->relation_name; ?></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteRelation" href="#"
                                                        data-row_id="<?php echo $relation->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php }
                                            } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Relation Not Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Quick Post -->
            </div>

            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card ">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#asset">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Asset Type</h6>
                </div>

                <div id="asset" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addAsset" action="<?php echo base_url() ?>addAsset" method="post"
                                role="form">
                                <div class="row form-contents">
                                    <div class="col-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="asset" name="asset"
                                                placeholder="Enter Asset" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Asset Type</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($assetInfo)) {
                        foreach ($assetInfo as $asset) { ?>
                                            <tr class="text-dark">
                                                <td><?php echo $asset->asset_type; ?></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteAsset" href="#"
                                                        data-row_id="<?php echo $asset->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php }
                      } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Asset Not Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card ">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#year">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Year</h6>
                </div>

                <div id="year" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addyear" action="<?php echo base_url() ?>addyear" method="post"
                                role="form">
                                <div class="row form-contents">
                                    <div class="col-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="year" name="year"
                                                placeholder="Enter Year" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Year</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($yearInfo)) {
                                            foreach ($yearInfo as $year) { ?>
                                            <tr class="text-dark">
                                                <td><?php echo $year->year; ?></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteYearInfo" href="#"
                                                        data-row_id="<?php echo $year->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php }
                                            } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Year Not Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card ">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#subscription">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Amount</h6>
                </div>

                <div id="subscription" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addSubscriptionAmount"
                                action="<?php echo base_url() ?>addSubscriptionAmount" method="post" role="form">
                                <div class="row form-contents">
                                    <div class="col-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="subscription"
                                                name="subscription" placeholder="Enter Amount"
                                                autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($subscriptionInfo)) {
                                            foreach ($subscriptionInfo as $amount) { ?>
                                            <tr class="text-dark">
                                                <td><?php echo $amount->amount; ?></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteSubscriptionInfo" href="#"
                                                        data-row_id="<?php echo $amount->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php }
                      } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Amount Not Found
                                            </td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#income">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Income Type</h6>
                </div>
                <div id="income" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addIncomeInfo" action="<?php echo base_url() ?>addIncomeType"
                                method="post" role="form">
                                <div class="row form-contents">
                                    <div class="col-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="relation" name="income_type"
                                                placeholder="Enter Relation" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Income Type</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($incomeTypeInfo)) {
                                              foreach ($incomeTypeInfo as $income) { ?>
                                            <tr class="text-dark">
                                                <td><?php echo $income->income_type; ?></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteIncomeType" href="#"
                                                        data-row_id="<?php echo $income->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php }
                                            } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Income type not Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#gothra">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Gothra</h6>
                </div>

                <div id="gothra" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addGothra" action="<?php echo base_url() ?>addGothra"
                                method="post" role="form">
                                <div class="row form-contents">
                                    <div class="col-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="gothra" name="gothra"
                                                placeholder="Enter Gothra" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Gothra</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($gothraInfo)) {
                                        foreach ($gothraInfo as $gothra) { ?>
                                            <tr class="text-dark">
                                            <form role="form"  action="<?php echo base_url() ?>updateGothra" method="post" role="form">
                                                <input type="hidden" name="row_id" value="<?php echo $gothra->row_id; ?>">
                                                <td><input type="text" class="form-control" name="gothra_update" value="<?php echo $gothra->gothra; ?>"></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteGothra" href="#"
                                                        data-row_id="<?php echo $gothra->row_id; ?>"
                                                        title="Delete"><i class="fa fa-trash"></i></a>
                                            <input type="submit" class="btn btn-primary"
                                            value="Update" />
                                                </td>
                                           </form>
                                            </tr>
                                            <?php }
                                         } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Gothra Not
                                                Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Card End -->
                </div>
                <!--collapse End -->
            </div>

            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#nakshathra">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Nakshathra</h6>
                </div>
                <div id="nakshathra" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addNakshathra" action="<?php echo base_url() ?>addNakshathra"
                                method="post" role="form">
                                <div class="row form-contents">
                                    <div class="col-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="nakshathra" name="nakshathra"
                                                placeholder="Enter Nakshathra" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Nakshathra</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($nakshathraInfo)) {
                                              foreach ($nakshathraInfo as $nakshathra) { ?>
                                            <tr class="text-dark">
                                            <form role="form" action="<?php echo base_url() ?>updateNakshathra" method="post" role="form">
                                              <input type="hidden" name="row_id" value="<?php echo $nakshathra->row_id; ?>">
                                                <td><input type="text" class="form-control" name="nakshatra_update" value="<?php echo $nakshathra->nakshathra; ?>"></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteNakshathra" href="#"
                                                        data-row_id="<?php echo $nakshathra->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                <input  type="submit" class="btn  btn-primary"
                                            value="Update" />
                                                </td>
                                                </form>
                                            </tr>
                                            <?php }
                                            } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Nakshathra Not Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Quick Post -->
            </div>


            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card ">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#masa">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Masa</h6>
                </div>

                <div id="masa" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addMasa" action="<?php echo base_url() ?>addMasa" method="post"
                                role="form">
                                <div class="row form-contents">
                                    <div class="col-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="masa" name="masa"
                                                placeholder="Enter Masa" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Masa</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($masaInfo)) {
                        foreach ($masaInfo as $masa) { ?>
                                            <tr class="text-dark">
                                            <form role="form" action="<?php echo base_url() ?>updateMasa" method="post" role="form">
                                            <input type="hidden" name="row_id" value="<?php echo $masa->row_id; ?>">
                                                <td><input type="text" class="form-control" name="masa_update" value="<?php echo $masa->masa; ?>"></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteMasa" href="#"
                                                        data-row_id="<?php echo $masa->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                            <input type="submit" class="btn btn-primary"
                                            value="Update" />
                                                </td>
                                           </form>
                                            </tr>
                                            <?php }
                      } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Masa Not Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card ">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#tithi">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Tithi</h6>
                </div>

                <div id="tithi" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addTithi" action="<?php echo base_url() ?>addTithi" method="post"
                                role="form">
                                <div class="row form-contents">
                                    <div class="col-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="tithi" name="tithi"
                                                placeholder="Enter Tithi" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Tithi</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($tithiInfo)) {
                                            foreach ($tithiInfo as $tithi) { ?>
                                            <tr class="text-dark">
                                                <td><?php echo $tithi->tithi; ?></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteTithi" href="#"
                                                        data-row_id="<?php echo $tithi->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php }
                                            } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Tithi Not Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card ">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#rashi">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Rashi</h6>
                </div>

                <div id="rashi" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addRashi"
                                action="<?php echo base_url() ?>addRashi" method="post" role="form">
                                <div class="row form-contents">
                                    <div class="col-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="rashi"
                                                name="rashi" placeholder="Enter Rashi"
                                                autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Rashi</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($rashiInfo)) {
                                            foreach ($rashiInfo as $rashi) { ?>
                                             <form role="form" id=""
                                             action="<?php echo base_url() ?>updateRashi" method="post" role="form">
                                            <tr class="text-dark">
                                                <input type="hidden" name="row_id" value="<?php echo $rashi->row_id ?>">
                                                <td><input type="text" class="form-control" name="rashi_update" value="<?php echo $rashi->rashi ?>"></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteRashi" href="#"
                                                        data-row_id="<?php echo $rashi->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                            <input type="submit" class="btn btn-primary"
                                            value="Update" />
                                                </td>
                                            </tr>
                                            </form>
                                            <?php }
                      } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Rashi Not Found
                                            </td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card ">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#Committetype">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Committe type</h6>
                </div>

                <div id="Committetype" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="committetype" action="<?php echo base_url() ?>addCommittetype" method="post"
                                role="form">
                                <div class="row form-contents">
                                    <div class="col-4">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="committetype" name="committetype"
                                                placeholder="Enter Type" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                    <!-- <div class="form-group">
                                        <select class="form-control " id="year" name="year">
                                            <option value="">Select Year
                                                </option>
                                            <option value="2022">2022</option>
                                            <option value="2021">2021</option>
                                        </select>
                                    </div> -->
                                </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Committe type</th>
                                                <!-- <th>Year</th> -->
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($committetypeInfo)) {
                                            foreach ($committetypeInfo as $committetype) { ?>
                                            <tr class="text-dark">
                                                <td><?php echo $committetype->type; ?></td>
                                               <!-- <td><?php //echo $committetype->year; ?></td> -->
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteCommittetype" href="#"
                                                        data-row_id="<?php echo $committetype->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php }
                                            } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Committetype Not Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card ">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#Event">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Events</h6>
                </div>

                <div id="Event" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="events" action="<?php echo base_url() ?>addEvents" method="post"
                                role="form">
                                <div class="row form-contents">
                                    <div class="col-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="events" name="events"
                                                placeholder="Enter Event" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Events</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($EventtypeInfo)) {
                                            foreach ($EventtypeInfo as $event) { ?>
                                            <tr class="text-dark">
                                                <td><?php echo $event->events; ?></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteEventtype" href="#"
                                                        data-row_id="<?php echo $event->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php }
                                            } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Events Not Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card ">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#occation">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Occation Info</h6>
                </div>

                <div id="occation" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="" action="<?php echo base_url() ?>addOccation" method="post"
                                role="form">
                                <div class="row form-contents">
                                    <div class="col-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="" name="occation"
                                                placeholder="Enter Occation" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Occation</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($occationInfo)) {
                                            foreach ($occationInfo as $occation) { ?>
                                            <tr class="text-dark">
                                                <td><?php echo $occation->occation; ?></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteOccation" href="#"
                                                        data-row_id="<?php echo $occation->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php }
                                            } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Occation Not Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card ">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#paksha">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Paksha Info</h6>
                </div>

                <div id="paksha" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="" action="<?php echo base_url() ?>addPaksha" method="post"
                                role="form">
                                <div class="row form-contents">
                                    <div class="col-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="" name="paksha"
                                                placeholder="Enter Paksha" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Paksha</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($pakshaInfo)) {
                                            foreach ($pakshaInfo as $paksha) { ?>
                                            <tr class="text-dark">
                                                <td><?php echo $paksha->paksha; ?></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deletePaksha" href="#"
                                                        data-row_id="<?php echo $paksha->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php }
                                            } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Paksha Not Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card ">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#Expense">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Expense Name</h6>
                </div>

                <div id="Expense" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="expense" action="<?php echo base_url() ?>addExpenseName" method="post"
                                role="form">
                                <div class="row form-contents">
                                    <div class="col-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="expense_name" name="expense_name"
                                                placeholder="Enter Expense" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Expense Name</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($expenseNameInfo)) {
                                            foreach ($expenseNameInfo as $expense) { ?>
                                            <tr class="text-dark">
                                                <td><?php echo $expense->expense_name; ?></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteExpenseName" href="#"
                                                        data-row_id="<?php echo $expense->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php }
                                            } else { ?>
                                            <td colspan="2" style="background-color: #83c8ea7d;">Expense Not Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card ">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#purpose">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Purpose Info</h6>
                </div>

                <div id="purpose" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="" action="<?php echo base_url() ?>addPurpose" method="post"
                                role="form">
                                <div class="row form-contents">
                                    <div class="col-4 col-lg-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="" name="purpose_name"
                                                placeholder="Enter Purpose" autocomplete="off" required>
                                        </div>
                                    </div>
                                 
                                    <div class="col-4 mb-1 col-lg-4">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Purpose</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($purposeInfo)) {
                                            foreach ($purposeInfo as $purpose) { ?>
                                            <tr class="text-dark">
                                                <td><?php echo $purpose->purpose_name; ?></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deletePurpose" href="#"
                                                        data-row_id="<?php echo $purpose->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php }
                                            } else { ?>
                                            <td colspan="4" style="background-color: #83c8ea7d;">Purpose Not Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-lg-6 col-md-6 col-12 mb-2 column_padding_card ">
                <div class="card-header border-bottom m-0 p-2 card_head_dashboard settings_card" data-toggle="collapse"
                    data-target="#donationType">
                    <a class="float-right mb-0 setting_pointer">Click here </a>
                    <h6 class="m-0 text-dark">Donation Type Info</h6>
                </div>

                <div id="donationType" class="collapse">
                    <div class="card card-small h-100">
                        <div class="card-body d-flex flex-column p-1">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="" action="<?php echo base_url() ?>addDonationType" method="post"
                                role="form">
                                <div class="row form-contents">
                                    <div class="col-4 col-lg-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="" name="donation_name"
                                                placeholder="Enter Type" autocomplete="off" required>
                                        </div>
                                    </div>
                                 
                                    <div class="col-4 mb-1 col-lg-4">
                                        <input style="float:right;" type="submit" class="btn btn-block btn-primary"
                                            value="Add" />
                                    </div>
                                </div>
                            </form>

                            <div class="row mx-0">
                                <div class="col-lg-12 col-12 p-0 mt-0 ">
                                    <table class="table table-bordered text-dark mb-0">
                                        <thead class="text-center">
                                            <tr class="table_row_background">
                                                <th>Donation Type</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if (!empty($donationTypeInfo)) {
                                            foreach ($donationTypeInfo as $type) { ?>
                                            <tr class="text-dark">
                                                <td><?php echo $type->donation_type; ?></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger deleteDonationType" href="#"
                                                        data-row_id="<?php echo $type->row_id; ?>" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php }
                                            } else { ?>
                                            <td colspan="4" style="background-color: #83c8ea7d;">Donation Not Found</td>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script>
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    return true;
}

jQuery(document).ready(function() {
    $('select').selectpicker();
});
</script>