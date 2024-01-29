<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row p-0">
            <div class="col  padding_left_right_null">
                <div class="card card-small  p-0 m-b-1">
                    <div class="card-body p-2">
                        <div class="row c-m-b">
                            <div class="col-lg-6 col-sm-12 col-12">
                                <span class="page-title">
                                    <i class="fa fa-users"></i> Staff Management
                                </span>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <form action="<?php echo base_url() ?>employeeListing" method="POST" id="searchList">
                                    <div class="input-group search-box">
                                        <input type="text" name="searchText" value=""
                                            class="form-control searchText input-md pull-right"
                                            placeholder="Search By Name/Mobile/Email" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-md btn-primary searchList"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="row c-m-t">
                            <div class="col-lg-6 col-8 mobile-title">
                                <span class="page-sub-title mobile-title">Total Staffs: <?php echo $count; ?></span>
                            </div>
                            <div class="col-lg-6 col-4 ">
                                <div class="form-group">
                                    <a class="btn btn-primary mobile-btn pull-right"
                                        href="<?php echo base_url(); ?>addEmployeePageView"><i class="fa fa-plus"></i>
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
                                <form action="<?php echo base_url() ?>employeeListing" method="POST"
                                    id="byFilterMethod">
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="employee_id" id="employee_id" value="<?php echo $employee_id ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By ID"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-id-card"></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width " type="text"
                                                name="employee_name" id="employee_name"
                                                value="<?php echo $employee_name ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By Name"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-user"></i></div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text" name="email"
                                                id="email" value="<?php echo $email ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By Email"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-user"></i></div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text"
                                                name="contact_number" id="contact_number"
                                                value="<?php echo $contact_number ?>"
                                                class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By Phone"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-phone"></i></div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <select class="form-control is-valid input-sm mobile-width" id="role"
                                            name="role">
                                            <?php if($role != "") { ?>
                                            <option value="<?php echo $role; ?>" selected><b>Sorted:
                                                    <?php echo $role; ?></b></option>
                                            <option value="">ALL</option>
                                            <option value="Employee">Employee</option>
                                            <option value="Director">Director</option>
                                            <option value="Manager">Manager</option>
                                            <?php } else { ?>
                                            <option value="">Select Any</option>
                                            <option value="Employee">Employee</option>
                                            <option value="Director">Director</option>
                                            <option value="Manager">Manager</option>
                                            <?php
                                            } ?>
                                        </select>
                                    </th>
                                    <th width="180" class="text-center btn-padding"><button type="submit"
                                            class="btn btn-success btn-block mobile-width"> Search</button></th>
                                </form>
                            </tr>
                            <tr class=" text-white bg-black ">
                                <th>Staff ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Role</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                    if(!empty($employeeRecords))
                    {
                        foreach($employeeRecords as $record)
                        {
                    ?>
                                <tr class="text-black">
                                <td><?php echo $record->employee_id ?></td>
                                <td><?php echo $record->employee_name ?></td>
                                <td><?php echo $record->email ?></td>
                                <td><?php echo $record->contact_number ?></td>
                                <td><?php echo $record->role ?></td>
                                <td class="text-center">
                               
                                    <a class="btn  btn-sm btn-info"
                                        href="<?php echo base_url().'editEmployeePageView/'.$record->employee_id; ?>"
                                        title="Edit"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger deleteEmployee" href="#"
                                        data-employee_id="<?php echo $record->employee_id; ?>" title="Delete"><i
                                            class="fas fa-trash"></i></a>
                            
                                </td>
                            </tr>
                            <?php
                        }
                    } else { ?>
                            <tr>
                                <td class="text-center " colspan="10">
                                    No Data Found!!.
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/employee/deleteEmployee.js" charset="utf-8">
</script>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#searchList").attr("action", baseURL + "employeeListing/" + value);
        jQuery("#searchList").submit();
    });
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#byFilterMethod").attr("action", baseURL + "employeeListing/" + value);
        jQuery("#byFilterMethod").submit();
    });
    jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
    });
});
</script>