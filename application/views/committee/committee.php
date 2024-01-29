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
                            <div class="col-lg-6 col-sm-8 col-8">
                                <span class="page-title">
                                    <i class="fa fa-user"></i> Committee Management
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
                        <table id="member-list" style="width:100%"
                            class="display table table-striped table-hover nowrap ">
                            <thead>
                                <tr>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <!-- <th>Email</th> -->
                                    <th>Contact Number</th>
                                    <th>Role</th>
                                    <th>Committee Type</th>
                                    <th>Year</th>
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
                                    <span class="text-white mobile-title" style="font-size : 20px">Add Member
                                        Details</span>
                                </div>
                                <div class=" col-md-2 col-2">
                                    <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                                </div>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <?php $this->load->helper("form"); ?>
                                <form role="form" id="addCommittee" action="<?php echo base_url() ?>addCommittee"
                                    method="post" role="form" enctype="multipart/form-data">
                                    <div class="row form-contents">
                                        <div class="col-lg-4  padding_left_right_null">
                                            <div class="card card-small c-border mb-4 p-2">
                                                <div class="card-header  text-center">
                                                    <div>
                                                        <label for="fname">Profile Image (Optional)</label>
                                                    </div>
                                                    <img src="<?php echo base_url(); ?>assets/dist/img/usr.png"
                                                        class="avatar rounded-circle img-thumbnail" width="130"
                                                        height="130" src="#" id="uploadedImage" name="userfile"
                                                        width="130" height="130" alt="avatar">
                                                    <input type="file" class="form-control-sm" id="vImg"
                                                        name="userfile">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8  padding_left_right_null">
                                            <div class="card card-small c-border p-4 ">
                                                <div class="form-row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="committee_name">Name*</label>
                                                            <input type="text" class="form-control " id="committee_name"
                                                                name="committee_name" placeholder="Enter Name"
                                                                onkeydown="return alphaOnly(event)" autocomplete="off"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-lg-6 col-12">
                                                        <div class="form-group">
                                                            <label for="contact_number_one">Contact
                                                                Number*</label>
                                                            <input type="text" class="form-control "
                                                                id="contact_number_one" name="contact_number_one"
                                                                placeholder="Enter Contact Number One" maxlength="10"
                                                                minlength="10" onkeypress="return isNumberKey(event)"
                                                                autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <div class="form-group">
                                                            <label for="contact_number_two">Contact Number
                                                                Two</label>
                                                            <input type="text" class="form-control "
                                                                id="contact_number_two" name="contact_number_two"
                                                                placeholder="Enter Contact Number Two" maxlength="10"
                                                                minlength="10" onkeypress="return isNumberKey(event)"
                                                                autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-lg-6 col-12">
                                                        <div class="form-group">
                                                            <label for="email">Email address</label>
                                                            <input type="email" class="form-control email " id="email"
                                                                name="email" maxlength="128"
                                                                placeholder="Enter Email Address" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <div class="form-group">
                                                            <label for="asset_type">Role*</label>
                                                            <select class="form-control " id="role" name="role"
                                                                required>
                                                                <option value=""> Select Role
                                                                </option>
                                                                <?php if(!empty($committeeRoleInfo)) {
                                                                            foreach($committeeRoleInfo as $role ){?>
                                                                <option value="<?php echo $role->row_id;?>">
                                                                    <?php echo $role->role;?></option>
                                                                <?php }}?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col-lg-6 col-12">
                                                        <div class="form-group">
                                                            <label for="">Committee Type*</label>
                                                            <select class="form-control" id="type" name="type" 
                                                                required >
                                                                <option value=""> Select Type
                                                                </option>
                                                                <?php if(!empty($committeeTypeInfo)) {
                                                                            foreach($committeeTypeInfo as $type ){?>
                                                                <option value="<?php echo $type->row_id;?>">
                                                                    <?php echo $type->type;?></option>
                                                                <?php }}?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-12">
                                                        <div class="form-group">
                                                            <label for="asset_type">Year*</label>
                                                            <select class="form-control " id="year" name="year"
                                                                required>
                                                                <option value=""> Select Year
                                                                </option>
                                                                <option value="2018">2018</option>
                                                                <option value="2019">2019</option>
                                                                <option value="2020">2020</option>
                                                                <option value="2021">2021</option>
                                                                <option value="2022">2022</option>
                                                                <option value="2023">2023</option>
                                                                <option value="2024">2024</option>
                                                                <option value="2025">2025</option>
                                                                <option value="2026">2026</option>

                                                              
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-12">
                                                        <div class="form-group">
                                                            <label for="committee_address">Address</label>
                                                            <textarea class="form-control " placeholder="Enter Address"
                                                                name="committee_address" id="committee_address" rows="3"
                                                                autocomplete="off"></textarea>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-primary" style="float : left"
                                                    value="Submit" />
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                        </div>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/committee/committee.js" charset="utf-8">
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

        "oSearch": {"sSearch": "2022"},

        processing: true,
        orderCellsTop: true,
        fixedHeader: true,
        responsive: true,
        language: {
            search: "",
            searchPlaceholder: "Search records",
            "lengthMenu": "Show _MENU_ Members",
            "infoFiltered": "(filtered from _MAX_ total members)",
            "info": "Showing _START_ to _END_ of _TOTAL_ members",
            "infoEmpty": "Showing 0 to 0 of 0 members",


            processing: '<img src="' + baseURL + 'assets/dist/img/load.gif" width="150"  alt="loader">'

        },

        columnDefs: [{
            width: 150,
            targets: 0
        }],


        "ajax": {
            url: '<?php echo base_url(); ?>/getCommitteeDetails ',
            type: 'POST',

            // dataType: 'json',
        },
    });



    jQuery(document).on("click", ".deleteCommittee", function() {
        $("#wizard-picture").change(function() {
            readURL(this);
        });
        var row_id = $(this).data("row_id"),
            hitURL = baseURL + "deleteCommittee",
            currentRow = $(this);

        var confirmation = confirm("Are you sure to delete this committee member?");

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
                    alert("Committee member successfully deleted");
                } else if (data.status = false) {
                    alert("Committee member deletion failed");
                } else {
                    alert("Access denied..!");
                }
            });
        }
    });
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