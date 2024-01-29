<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ParroThink Application | Admin System Log in</title>
    <!-- icons -->
    <link rel="icon" href="assets/dist/img/parro_logo.png"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.0.0" href="<?php echo base_url(); ?>assets/dist/styles/shards-dashboards.1.0.0.min.css"> 
    <link rel="stylesheet" href="styles/extras.1.0.0.min.css">
    <link href="<?php echo base_url(); ?>assets/dist/css/style.css" rel="stylesheet" type="text/css" />
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
  </head>
  <body class="hold-transition login-page">
  <div class="loader">
    <img id="loader_img" src="<?php echo base_url(); ?>assets/dist/img/loader.gif" width="150" class="img-fluid" alt="loader">
  </div>
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
            <form action="<?php echo base_url(); ?>loginMe" method="post" id="login">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text material-icons text-dark">person</span>
                </div>
                <input type="text" class="form-control input_type" placeholder="Username (Employee ID / Email)" name="username" autocomplete="off" required/>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text material-icons text-dark">lock</span>
                </div>
                <input type="password" class="form-control input_type" placeholder="Password" name="password" autocomplete="off" required/>
              </div>
              <button type="submit" class="btn btn-log btn-block">Sign In</button>
            </form>
            <!-- <a class="float-right" style="margin-top: 10px;" href="<?php echo base_url() ?>forgotPassword">Forgot Password</a> -->
          </div>
          <div class="card-footer">
            <div class="col-xs-12 text-center">
            <span class="">&copy;<script>document.write(new Date().getFullYear())</script>-<script>document.write(new Date().getFullYear()-1)</script> <a href="http://www.parrophins.com/" target="_blank"><span class="parro">Parro</span><span class="crm">phins</span></a>The Wings of Technology.</span>
            </div>
          </div>
        </div>
      </div>
  </body>
</html>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/scripts/extras.1.0.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/scripts/shards-dashboards.1.0.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/scripts/app/app-blog-overview.1.0.0.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <script>
     $(window).on("load", function() {
      preloaderFadeOutTime = 500;
      function hidePreloader() {
        var preloader = $('.loader');
        preloader.fadeOut(preloaderFadeOutTime);
      }
      hidePreloader();
     });
    </script>