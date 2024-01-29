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
                                    <i class="fa fa-user"></i> Transporter Management
                                </span>
                            </div>
                            <div class="col-lg-6 col-sm-8 col-4 ">
                                <a class="btn btn-primary mobile-btn pull-right"
                                    href="<?php echo base_url(); ?>addTransporterPageView"><i class="fa fa-plus"></i>
                                    Add New</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col padding_left_right_null">
                <div class="card card-small mb-4">
                    <div class="card-body p-1 pb-3 text-center table-responsive">
                    <table id="transporter_list" style="width:100%"
                            class="display table  table-striped table-hover">
                            <thead>
                                <tr>
                                <th>Transporter Name</th>
                                <th>Contact Number</th>
                                <th>Firm</th>
                                <th>Address</th>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/transporter/transporter.js" charset="utf-8">
</script>
<script type="text/javascript">
jQuery(document).ready(function() {
    $('#transporter_list thead tr').clone(true).appendTo( '#transporter_list thead' );
    $('#transporter_list thead tr:eq(1) th').each( function (i) {
        
        var title = $(this).text();
        if(title != 'Actions'){
        $(this).html( '<div class="form-group position-relative mb-0 mt-0 search-padding"><input type="text" class="form-control input-sm " placeholder="Search" '+title+'" /> </div>' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    }else{
        $(this).html( '' );
    }
    } );
    var table =  $('#transporter_list').DataTable({
       
        processing : true,
        orderCellsTop: true,
        fixedHeader: true,
        language: {
            search: "",
            searchPlaceholder: "Search records",
            "lengthMenu":     "Show _MENU_ Transporters",
            "infoFiltered":   "(filtered from _MAX_ total Transporters)",
            "info":           "Showing _START_ to _END_ of _TOTAL_ Transporters",
            "infoEmpty":      "Showing 0 to 0 of 0 Transporters",
        processing: '<img src="'+baseURL+'assets/dist/img/load.gif" width="100"  width="100" alt="loader">'
    },
   
        "ajax": {
            url: '<?php echo base_url(); ?>/getTransporterDetails ',
            type: 'POST',
            // dataType: 'json',
        },
    });


    jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});
</script>