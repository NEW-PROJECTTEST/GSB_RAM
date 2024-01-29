
          <footer class=" main-footer d-flex p-0 px-3 bg-white border-top noprint">
            <span class="copyright ml-auto my-auto mr-2 noprint">Copyright © 2023-24
              <a href="http://www.parrophins.com/" target="_blank" rel="nofollow">Parrophins.</a> All rights reserved
            </span>
          </footer>
         <!--<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>SchoolPhins - SJPUC</b> Admission System 2019
        </div>
        <strong>Copyright &copy; <script>document.write(new Date().getFullYear())</script> <a href="<?php echo base_url(); ?>">SchoolPhins - SJPUC</a>.</strong> All rights reserved.
    </footer> -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>



    <script src="<?php echo base_url(); ?>assets/dist/scripts/extras.1.0.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/scripts/shards-dashboards.1.0.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/scripts/app/app-blog-overview.1.0.0.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>

     <!-- Auto select box-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

     <!-- Auto select box-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

      <!--data-table-->
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');

      $('#selectAll').click(function(){
        if ($('#selectAll').is(':checked')) {
        $('.singleSelect').prop('checked', true); 
        } else {
        $('.singleSelect').prop('checked', false);
        }
      }); 
    </script>
  </body>
</html>