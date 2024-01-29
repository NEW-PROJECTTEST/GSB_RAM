<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>ParroThink Application : Forgot Password</title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      <!-- icons -->
      <link rel="icon"   href="assets/dist/img/parro_logo.png"> 
        <link rel="apple-touch-icon" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon" sizes="57x57" href="images/ico/apple-touch-icon-57-precomposed.png">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" id="main-stylesheet" data-version="1.0.0" href="<?php echo base_url(); ?>assets/dist/styles/shards-dashboards.1.0.0.min.css"> 
        <link rel="stylesheet" href="styles/extras.1.0.0.min.css">
        <link href="<?php echo base_url(); ?>assets/dist/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
        </script>
    </head>
    <body class="hold-transition login-page">
       <div class="row margin_left_right_null">
        <div class="card mx-auto login_card">
          <div class="card-header pb-0">
            <div class="col-12">
              <h6><b>Sign In</b></h6>
            </div>
          </div>
          <div class="card-body">
            <div class="col-12 text-center">
              <img src="<?php echo base_url(); ?>assets/dist/img/parro_logo.png" height="80px">
            </div>
            <div class="col-12 mb-2">
            <span><b style="font-size: 25px;"><span class="parro">Parro</span><span class="crm">Think</span></b></span>
            </div>
            <?php $this->load->helper('form'); ?>
            <div class="row">
                <div class="col-md-12">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
            </div>
              <?php
              $this->load->helper('form');
              $error = $this->session->flashdata('error');
              if($error)
              { ?>
                  <div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <?php echo $error; ?>                    
                  </div>
              <?php }
              $success = $this->session->flashdata('success');
              if($success){
                  ?>
                  <div class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <?php echo $success; ?>                    
                  </div>
              <?php } ?>
              <form action="<?php echo base_url(); ?>resetPasswordUser" method="post" id="">
            <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text material-icons">email</span>
                  </div>
                  <input type="email" class="form-control" style="text-transform: capitalize;" placeholder="Email" id="emailId" name="emailId"  autocomplete="off" required>
              </div>
              <div class="row">
                <div class="col-xs-6 col-sm-6  col-md-12">
                  <input type="submit" class="btn btn_submit btn-block" value="Submit" />
                </div>
              </div>
              <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-12">
                  <a href="<?php echo base_url() ?>" class="float-right" style="margin-top: 10px;">Back to Login</a><br>
                </div>
            </div>
            </form>
          </div>
          <div class="card-footer">
            <div class="col-xs-12 text-center">
            <span class="">&copy;<script>document.write(new Date().getFullYear())</script>-20 <a href="http://www.parrophins.com/" target="_blank"><span class="parro">Parro</span><span class="crm">phins</span></a>The Wings of Technology.</span>
            </div>
          </div>
        </div>
      </div>
  </body>
</html>
    <script src="<?php echo base_url(); ?>assets/js/student/forgotPassword.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script>
    jQuery(document).ready(function(){
      jQuery('.datepicker').datepicker({
      autoclose: true,
      format : "yyyy-mm-dd"
      });
    });
</script>
  
