<?php
$profile_image ="";
$customer_name ="";
$profession ="";
$contact_number ="";
$dob ="";
$customer_id ="";
$gender ="";
$customer_type ="";
$email ="";
$contact_number ="";
$alternative_contact_number ="";
$designation ="";
$adhar_number ="";
$pan_number ="";
$gst_number ="";
$customer_address ="";

if(!empty($customerInfo)){
    $profile_image = $customerInfo->profile_image ;
    $customer_name = $customerInfo->customer_name ;
    $profession =$customerInfo->profession ;
    $contact_number =$customerInfo->contact_number ;
    $dob =$customerInfo->dob ;
    $customer_id =$customerInfo->customer_id ;
    $gender =$customerInfo->gender ;
    $customer_type =$customerInfo->customer_type ;
    $email =$customerInfo->email ;
    $contact_number =$customerInfo->contact_number ;
    $alternative_contact_number =$customerInfo->alternative_contact_number ;
    $designation =$customerInfo->designation ;
    $adhar_number =$customerInfo->adhar_number ;
    $pan_number =$customerInfo->pan_number ;
    $gst_number =$customerInfo->gst_number ;
    $customer_address =$customerInfo->customer_address ;
} 
?>
<div class="main-content-container container-fluid px-4 pt-2">
<div class="content-wrapper">
<div class="col-lg-12">
      <div class="card card-small c-border mb-4">
        <div class=" col-lg-12 col-sm-12">
          <img src="<?php echo $profile_image; ?>"   class="avatar rounded-circle img-thumbnail" width="150"  height="250"  id="uploadedImage" name="userfile" width="130" height="130" alt="Profile Image Not Uploaded"/>
          </div>
        <div class="row">
        <div class="col-lg-6 col-sm-12">
          <label for="fname" >Customer ID : </label>
          <span class="txt-color"><?php echo $customer_id; ?></span>
          </div>
          <div class="col-lg-6 col-sm-12">
          <label for="dob">Customer Name : </label>
          <span class="txt-color"><?php echo $customer_name; ?></span>
        </div>
      </div>
    </div>
  </div>
 </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/employee/editEmployee.js" type="text/javascript"></script>
<script type="text/javascript">
    function GoBackWithRefresh(event) {
        if ('referrer' in document) {
            window.location = document.referrer;
            /* OR */
            //location.replace(document.referrer);
        } else {
            window.history.back();
        }
    }
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;
            jQuery("#searchList").attr("action", link);
            jQuery("#searchList").submit();
        });
        jQuery('.resetFilters').click(function(){
          $(this).closest('form').find("input[type=text]").val("");
        }) 
 
   
});

</script>
