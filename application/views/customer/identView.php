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
                                    <i class="fa fa-user"></i> Indent Management
                                </span>
                            </div>
                            <div class="col-lg-6 col-sm-8 col-4 ">
                              
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
                                    <th>Serial No.</th>
                                    <th>Date</th>
                                    <th>Contract Number</th>
                                    <th width="250">Customer Code</th>
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
    $('#party-list thead tr').clone(true).appendTo('#party-list thead');
    $('#party-list thead tr:eq(1) th').each(function(i) {

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
    var table = $('#party-list').DataTable({

        processing: true,
        orderCellsTop: true,
        fixedHeader: true,
        responsive: true,
        language: {
            search: "",
            searchPlaceholder: "Search records",
            "lengthMenu": "Show _MENU_ indents",
            "infoFiltered": "(filtered from _MAX_ total indents)",
            "info": "Showing _START_ to _END_ of _TOTAL_ indents",
            "infoEmpty": "Showing 0 to 0 of 0 indents",


            processing: '<img src="' + baseURL + 'assets/dist/img/load.gif" width="150"  alt="loader">'

        },

        columnDefs: [{
            width: 150,
            targets: 0
        }],


        "ajax": {
            url: '<?php echo base_url(); ?>/viewIdentData ',
            type: 'POST',

            // dataType: 'json',
        },
    });



    jQuery(document).on("click", ".deleteIndent", function() {
        var row_id = $(this).data("row_id"),
            hitURL = baseURL + "deleteIndent",
            currentRow = $(this);

        var confirmation = confirm("Are you sure to delete this Indent ?");

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
                    alert("Indent successfully deleted");
                } else if (data.status = false) {
                    alert("Indent deletion failed");
                } else {
                    alert("Access denied..!");
                }
            });
        }
    });
});
</script>