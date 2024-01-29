<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $pageTitle; ?></title>
    <link rel="icon" type="image/png" href="<?php echo $company_logo; ?>">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.0.0"
        href="<?php echo base_url(); ?>assets/dist/styles/shards-dashboards.1.0.0.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/styles/extras.1.0.0.min.css">
    <link href="<?php echo base_url(); ?>assets/dist/css/style.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Auto select box-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

    <!-- Auto select box-->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    <!--data-table-->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <style>
    .error {
        color: red;
        font-weight: normal;
    }
    </style>
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
    var baseURL = "<?php echo base_url(); ?>";
    </script>
    <!--font-awesome-->
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <a href="<?php echo base_url(); ?>" class="logo">
            <div class="container-fluid">
                <div class="row">
                    <!-- Main Sidebar -->
                    <aside class="main-sidebar sticky-top col-12 col-md-3 col-lg-2 px-0">
                        <div class="main-navbar">
                            <nav
                                class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
                                <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 2;">
                                    <div class="d-table m-auto  display-none-parro">
                                        <img id="main-logo" class="d-inline-block align-top mr-1 "
                                            style="max-width: 39px;"
                                            src="<?php echo base_url(); ?>assets/dist/img/parro_logo.png" alt="">
                                        <span class="d-none d-md-inline ml-1 " style="font-size: 20px;"><span
                                                style="color : green">Parro</span><span
                                                style="color : #434896">Think</span></span>
                                    </div>
                                    <div class="m-auto  display-none-bs">
                                        <img id="main-logo" class="d-inline-block   " style="max-width: 45px;"
                                            src="<?php echo $company_logo ?>" alt="">
                                    </div>
                                </a>
                                <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                                    <i class="material-icons">&#xE5C4;</i>
                                </a>
                            </nav>
                        </div>
                        <div class="nav-wrapper">
                            <ul class="nav flex-column">


                                <?php

                                if($role == ROLE_OFFICE){ ?>
                                <!-- <li class="nav-item">
                                    <a href="#identMenu" data-toggle="collapse" aria-expanded="false"
                                        class="nav-link  dropdown-toggle">
                                        <i class="fa fa-truck"></i>
                                        <span>Indent</span>
                                    </a>
                                    <ul class="collapse list-unstyled " id="identMenu">
                                        <li class="nav-item nav-margin ">
                                            <a class="nav-link" href="<?php echo base_url(); ?>viewIdent">
                                                <i class="fa fa fa-bus"></i>
                                                <span>Indent</span>
                                            </a>
                                        </li>
                                        <li class="nav-item nav-margin ">
                                            <a class="nav-link " href="<?php echo base_url(); ?>customerListing">
                                                <i class="fa fa-users"></i>
                                                <span>Customer</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li> -->
                                <?php  }
                            if($role == ROLE_ADMIN || $role == ROLE_DIRECTOR || $role == ROLE_EMPLOYEE)
                            {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url(); ?>dashboard">
                                        <i class="fas fa-tachometer-alt"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>committeeListing">
                                    <i class="fas fa-user"></i>
                                        <span>Committee Info</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link dropdown-toggle" href="#devtMenu" data-toggle="collapse" aria-expanded="false" >
                                    <i class="fas fa-users"></i>
                                        <span>Devotees Info</span>
                                    </a>
                                    <ul class="collapse list-unstyled " id="devtMenu">
                                        <li class="nav-item nav-margin ">
                                            <a class="nav-link" href="<?php echo base_url(); ?>devoteeListing">
                                                <i class="fa fa-user"></i>
                                                <span>Devotees</span>
                                            </a>
                                        </li>
                                        <li class="nav-item nav-margin ">
                                            <a class="nav-link " href="<?php echo base_url(); ?>familyListing">
                                                <i class="fa fa-users"></i>
                                                <span>Family</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>subscriptionListing">
                                        <i class="fa fa-user"></i>
                                        <span>Subscription</span>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                                        class="nav-link  dropdown-toggle">
                                        <i class="fa fa-truck"></i>
                                        <span>Vehicle</span>
                                    </a>
                                    <ul class="collapse list-unstyled " id="pageSubmenu">
                                        <li class="nav-item nav-margin ">
                                        
                                            <a href="#ownSubmenu" data-toggle="collapse" aria-expanded="false"
                                                class="nav-link nav-item dropdown-toggle">
                                            <i class="fa fa fa-bus"></i>
                                            <span>Own</span>
                                            </a>
                                            <ul class="collapse list-unstyled " id="ownSubmenu">
                                                <li class="nav-item nav-margin ">
                                                    <a class="nav-link" href="<?php echo base_url(); ?>OwnOtherVehicleListing">
                                                        <i class="fa fa-truck"></i>
                                                        <span>Other</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item nav-margin">
                                                    <a class="nav-link " href="<?php echo base_url(); ?>OwnSelfVehicleListing">
                                                        <i class="fa fa-truck"></i>
                                                        <span>Self</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            
                                        </li>
                                        <li class="nav-item nav-margin ">
                                            <a class="nav-link" href="<?php echo base_url(); ?>LeaseVehicleListing">
                                                <i class="fa fa-truck"></i>
                                                <span>Lease</span>
                                            </a>
                                        </li>
                                        <li class="nav-item nav-margin">
                                            <a class="nav-link " href="<?php echo base_url(); ?>transporterListing">
                                                <i class="fa fa-user"></i>
                                                <span>Transporter Info</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li> -->

                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>dailyDetailsListing">
                                        <i class="fa fa-calendar"></i>
                                        <span>Day Panchanga</span>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>eventListing">
                                        <i class="fa fa-list"></i>
                                        <span>Events</span>
                                    </a>
                                </li>

                                <!-- <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>DailyPoojaListing">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>Daily Pooja</span>
                                    </a>
                                </li> -->

                                
                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>donationListing">
                                    <i class="fa fa-money"></i>
                                        <span>Donation Info</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>sevaListing">
                                    <i class="fas fa-user"></i>
                                        <span>Seva Info</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link dropdown-toggle" href="#poojaInfo" data-toggle="collapse" aria-expanded="false" >
                                    <i class="fas fa-users"></i>
                                        <span>Daily Pooja</span>
                                    </a>
                                    <ul class="collapse list-unstyled " id="poojaInfo">
                                        <li class="nav-item nav-margin ">
                                            <a class="nav-link" href="<?php echo base_url(); ?>DailyPoojaListing">
                                            <i class="fas fa-calendar-alt"></i>
                                                <span>Date Pooja</span>
                                            </a>
                                        </li>
                                        <li class="nav-item nav-margin ">
                                            <a class="nav-link " href="<?php echo base_url(); ?>PanchangaPoojaListing">
                                                <i class="fa fa-users"></i>
                                                <span>Panchanga Pooja</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>


                                <li class="nav-item">
                                    <a href="#cashSubmenu" data-toggle="collapse" aria-expanded="false"
                                        class="nav-link  dropdown-toggle">
                                        <i class="fas fa-calculator"></i>
                                        <span>Accounts</span>
                                    </a>
                                    <ul class="collapse list-unstyled " id="cashSubmenu">
                                        <li class="nav-item nav-margin">
                                            <a class="nav-link " href="<?php echo base_url(); ?>bankListing">
                                            <i class="fa fa-university"></i>
                                                <span>Bank Account</span>
                                            </a>
                                        </li>
                                        <li class="nav-item nav-margin">
                                            <a class="nav-link" href="<?php echo base_url(); ?>cashAccountListing">
                                            <i class="fa fa-money"></i>
                                                <span>Cash Account</span>
                                            </a>
                                        </li>
                                        <li class="nav-item nav-margin">
                                            <a class="nav-link " href="<?php echo base_url(); ?>cashLedgerListing">
                                            <i class="fas fa-book"></i>
                                                <span>Cash Ledger</span>
                                            </a>
                                        </li>
                                        <li class="nav-item nav-margin">
                                            <a class="nav-link " href="<?php echo base_url(); ?>expenseListing">
                                            <i class="fas fa-share-square"></i>
                                                <span>Expenses</span>
                                            </a>
                                        </li>
                                        <li class="nav-item nav-margin">
                                            <a class="nav-link" href="<?php echo base_url(); ?>incomeListing">
                                            <i class="fa fa-money"></i>
                                                <span>Income</span>
                                            </a>
                                        </li>
                                        <li class="nav-item nav-margin">
                                            <a class="nav-link " href="<?php echo base_url(); ?>cashBookListing">
                                                <i class="fa fa-money"></i>
                                                <span>Cash Book</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- <li class="nav-item">
                                    <a href="#fuelSubmenu" data-toggle="collapse" aria-expanded="false"
                                        class="nav-link  dropdown-toggle">
                                        <i class="material-icons">ev_station</i>
                                        <span>Fuel</span>
                                    </a>
                                    <ul class="collapse list-unstyled " id="fuelSubmenu">
                                        <li class="nav-item nav-margin">
                                            <a class="nav-link " href="<?php echo base_url(); ?>fuelAccountListing">
                                                <i class="fa fa-money"></i>
                                                <span>Fuel Account</span>
                                            </a>
                                        </li>

                                        <li class="nav-item nav-margin">
                                            <a class="nav-link " href="<?php echo base_url(); ?>fuelBookListing">
                                                <i class="fa fa-book"></i>
                                                <span>Fuel Book</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li> -->
                                <!-- <li class="nav-item ">
                                    <a href="#transportSubmenu" data-toggle="collapse" aria-expanded="false"
                                        class="nav-link  dropdown-toggle">
                                        <i class="fa fa-road"></i>
                                        <span>Transport</span>
                                    </a>
                                    <ul class="collapse list-unstyled " id="transportSubmenu">
                                        <li class="nav-item nav-margin">
                                            <a class="nav-link " href="<?php echo base_url(); ?>clearPonchTransportListing">
                                            <i class="fa fa-road"></i>
                                                <span>Ponch Clear</span>
                                            </a>
                                        </li>

                                        <li class="nav-item nav-margin">
                                            <a class="nav-link " href="<?php echo base_url(); ?>pendingPonchTransportListing">
                                                <i class="fa fa-road"></i>
                                                <span>Ponch Pending</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li> -->

                                
                                <!-- <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>bankTransactionListing">
                                    <i class="fa fa-list"></i>
                                        <span>Bank Transaction</span>
                                    </a>
                                </li> -->


                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>report">
                                        <i class="fa fa-file"></i>
                                        <span>Report</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>employeeListing">
                                        <i class="fa fa-users"></i>
                                        <span>Staffs</span>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>assetListing">
                                    <i class="fas fa-building"></i>
                                        <span>Assets</span>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>billListing">
                                    <i class="fa fa-file-alt"></i>
                                        <span>Billing</span>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a href="#identMenu" data-toggle="collapse" aria-expanded="false"
                                        class="nav-link  dropdown-toggle">
                                        <i class="fa fa-truck"></i>
                                        <span>Indent</span>
                                    </a>
                                    <ul class="collapse list-unstyled " id="identMenu">
                                        <li class="nav-item nav-margin ">
                                            <a class="nav-link" href="<?php echo base_url(); ?>viewIdent">
                                                <i class="fa fa fa-bus"></i>
                                                <span>Indent</span>
                                            </a>
                                        </li>
                                        <li class="nav-item nav-margin ">
                                            <a class="nav-link " href="<?php echo base_url(); ?>customerListing">
                                                <i class="fa fa-users"></i>
                                                <span>Customer</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>partyListing">
                                        <i class="fas fa-user"></i>
                                        <span>Party</span>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>addCompanyProfile">
                                        <i class="fas fa-cog"></i>
                                        <span>Place Profile</span>
                                    </a>
                                </li>
                            
                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>settings">
                                        <i class="fas fa-cogs"></i>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>profile">
                                        <i class="fa fa-user"></i>
                                        <span>My Profile</span>
                                    </a>
                                </li>
                                <?php
                              }
                            ?>
                                <?php  if(false)
                            {
                            ?>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url(); ?>dashboard">
                                        <i class="fas fa-tachometer-alt"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>committeeListing">
                                        <i class="fa fa-user"></i>
                                        <span>committee Info</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                                        class="nav-link  dropdown-toggle">
                                        <i class="fa fa-truck"></i>
                                        <span>Vehicle</span>
                                    </a>
                                    <ul class="collapse list-unstyled " id="pageSubmenu">
                                        <li class="nav-item nav-margin ">
                                            
                                            
                                            <a href="#ownSubmenu" data-toggle="collapse" aria-expanded="false"
                                                class="nav-link  dropdown-toggle">
                                            <i class="fa fa fa-bus"></i>
                                            <span>Own</span>
                                            </a>
                                            <ul class="collapse list-unstyled " id="ownSubmenu">
                                                <li class="nav-item nav-margin ">
                                                    <a class="nav-link" href="<?php echo base_url(); ?>OwnVehicleListing">
                                                        <i class="fa fa-truck"></i>
                                                        <span>Other</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item nav-margin">
                                                    <a class="nav-link " href="<?php echo base_url(); ?>OwnVehicleListing">
                                                        <i class="fa fa-user"></i>
                                                        <span>Self</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="nav-item nav-margin ">
                                            <a class="nav-link" href="<?php echo base_url(); ?>LeaseVehicleListing">
                                                <i class="fa fa-truck"></i>
                                                <span>Lease</span>
                                            </a>
                                        </li>
                                        <li class="nav-item nav-margin">
                                            <a class="nav-link " href="<?php echo base_url(); ?>transporterListing">
                                                <i class="fa fa-user"></i>
                                                <span>Transporter Info</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#cashSubmenu" data-toggle="collapse" aria-expanded="false"
                                        class="nav-link  dropdown-toggle">
                                        <i class="fa fa-money"></i>
                                        <span>Cash</span>
                                    </a>
                                    <ul class="collapse list-unstyled " id="cashSubmenu">
                                        <li class="nav-item nav-margin">
                                            <a class="nav-link " href="<?php echo base_url(); ?>cashAccountListing">
                                                <i class="fa fa-money"></i>
                                                <span>Cash Account</span>
                                            </a>
                                        </li>
                                        <li class="nav-item nav-margin">
                                            <a class="nav-link " href="<?php echo base_url(); ?>cashLedgerListing">
                                                <i class="fa fa-money"></i>
                                                <span>Cash Ledger</span>
                                            </a>
                                        </li>

                                        <li class="nav-item nav-margin">
                                            <a class="nav-link " href="<?php echo base_url(); ?>cashBookListing">
                                                <i class="fa fa-money"></i>
                                                <span>Cash Book</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item ">
                                   
                                    <a href="#transportSubmenu" data-toggle="collapse" aria-expanded="false"
                                        class="nav-link  dropdown-toggle">
                                        <i class="fa fa-road"></i>
                                        <span>Transport</span>
                                    </a>
                                    <ul class="collapse list-unstyled " id="transportSubmenu">
                                        <li class="nav-item nav-margin">
                                            <a class="nav-link " href="<?php echo base_url(); ?>clearPonchTransportListing">
                                            <i class="fa fa-road"></i>
                                                <span>Ponch Clear</span>
                                            </a>
                                        </li>

                                        <li class="nav-item nav-margin">
                                            <a class="nav-link " href="<?php echo base_url(); ?>pendingPonchTransportListing">
                                                <i class="fa fa-road"></i>
                                                <span>Ponch Pending</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>bankListing">
                                        <i class="fa fa-bank"></i>
                                        <span>Bank Info</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>bankTransactionListing">
                                        <i class="fa fa-bank"></i>
                                        <span>Bank Transaction</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>report">
                                        <i class="fa fa-files-o"></i>
                                        <span>Report</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>addCompanyProfile">
                                        <i class="far fa-building"></i>
                                        <span>Company Profile</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo base_url(); ?>profile">
                                        <i class="fa fa-user"></i>
                                        <span>My Profile</span>
                                    </a>
                                </li> -->
                                <?php
                              }
                            ?>
                            </ul>
                        </div>
                    </aside>
                    <!-- End Main Sidebar -->
                    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
                        <div class="main-navbar sticky-top bg-white">
                            <!-- Main Navbar -->
                            <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
                                <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                                    <div class="input-group input-group-seamless ml-3 p-2" style="line-height: 2;">
                                        <img src="<?php echo $company_logo; ?>" height="50px">
                                        <h5 class="company-name"> <?php echo $company_name; ?>
                                    </div>
                                    </h5>
                                </form>
                                <ul class="navbar-nav border-left flex-row header-nav ">
                                    <!-- <li class="nav-item border-right dropdown notifications">
                                        <a title="Click here to help guide" class="nav-link nav-link-icon text-center"
                                            target="_blank"
                                            href="<?php echo base_url() ?>assets/downloads/KARAVALI_USER_GUIDE.pdf"
                                            role="button" id="dropdownMenuLink">
                                            <div class="nav-link-icon__wrapper">
                                                <i class="material-icons">help</i>
                                            </div>
                                        </a>
                                    </li> -->
                                    <li class="nav-item border-right dropdown notifications">
                                        <a class="nav-link nav-link-icon text-center" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <div class="nav-link-icon__wrapper">
                                                <i class="material-icons">access_time</i>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-small"
                                            aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#">
                                                <div class="notification__icon-wrapper">
                                                    <div class="notification__icon">
                                                        <i class="material-icons">access_time</i>
                                                    </div>
                                                </div>
                                                <div class="notification__content">
                                                    <span class="notification__category">Last Login:</span>
                                                    <p><?= empty($last_login) ? "First Time Login" : date('d-m-Y h:m:s A', strtotime($last_login)); ?>
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <!-- <li class="nav-item border-right dropdown notifications">
                                        <a class="nav-link nav-link-icon text-center" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <div class="nav-link-icon__wrapper">
                                                <i class="fas fa-bell"></i>
                                                <?php 
                                                $i = 1;
                                                if(!empty($insuranceNotification) && !empty($roadTaxNotification) && !empty($fcNotification) && !empty($fcNotification) && !empty($karnatakaPermitNotification) && !empty($nationalPermitNotification) && !empty($emissionNotification)) { ?>
                                                <a class="dropdown-item" href="#">
                                                    <div class="notification__icon-wrapper">
                                                        <div class="notification__icon">
                                                            <i class="material-icons">notifications_none</i>
                                                        </div>
                                                    </div>
                                                    <div class="notification__content mt-2">
                                                        Notification Not Found
                                                    </div>
                                                </a>
                                                <?php } else if(!empty($insuranceNotification)){
                                                foreach($insuranceNotification as $notification){ 
                                                    ?>
                                                <span class="badge badge-pill badge-danger"><?php echo $i++; ?></span>
                                                <?php  } } ?>

                                                <?php 
                                                if(!empty($roadTaxNotification)){
                                                foreach($roadTaxNotification as $notification){ 
                                                    ?>
                                                <span class="badge badge-pill badge-danger"><?php echo $i++; ?></span>
                                                <?php  } } ?>

                                                <?php 
                                                if(!empty($fcNotification)){
                                                foreach($fcNotification as $notification){ 
                                                    ?>
                                                <span class="badge badge-pill badge-danger"><?php echo $i++; ?></span>
                                                <?php  } } ?>

                                                <?php 
                                              
                                                if(!empty($karnatakaPermitNotification)){
                                                foreach($karnatakaPermitNotification as $notification){ 
                                                    ?>
                                                <span class="badge badge-pill badge-danger"><?php echo $i++; ?></span>
                                                <?php  } } ?>

                                                <?php 
                                                
                                                if(!empty($nationalPermitNotification)){
                                                foreach($nationalPermitNotification as $notification){ 
                                                    ?>
                                                <span class="badge badge-pill badge-danger"><?php echo $i++; ?></span>
                                                <?php  } } ?>

                                                <?php 
                                                
                                                if(!empty($emissionNotification)){
                                                foreach($emissionNotification as $notification){ 
                                                    ?>
                                                <span class="badge badge-pill badge-danger"><?php echo $i++; ?></span>
                                                <?php  } } ?>

                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-small"
                                            aria-labelledby="dropdownMenuLink">
                                            <?php 
                                                if(!empty($insuranceNotification)){
                                                foreach($insuranceNotification as $notification){ ?>
                                            <a class="dropdown-item" href="#">
                                                <div class="notification__icon-wrapper">
                                                    <div class="notification__icon">
                                                        <i class="material-icons">notifications_active</i>
                                                    </div>
                                                </div>
                                                <div class="notification__content mt-1">
                                                    <b><?php echo $notification->vehicle_number; ?> : This Vehicle
                                                        Insurance
                                                        will expire on
                                                        <?php echo date('d-m-Y',strtotime($notification->insurance_date)); ?>
                                                    </b>
                                                </div>
                                            </a>
                                            <?php }  } ?>


                                            <?php 
                                                if(!empty($roadTaxNotification)){
                                                foreach($roadTaxNotification as $notification){ ?>
                                            <a class="dropdown-item" href="#">
                                                <div class="notification__icon-wrapper">
                                                    <div class="notification__icon">
                                                        <i class="material-icons">notifications_active</i>
                                                    </div>
                                                </div>
                                                <div class="notification__content mt-1">
                                                    <b><?php echo $notification->vehicle_number; ?> : This Vehicle Road
                                                        tax
                                                        will be lapse on
                                                        <?php echo date('d-m-Y',strtotime($notification->road_tax_date)); ?>
                                                    </b>
                                                </div>
                                            </a>
                                            <?php }  } ?>

                                            <?php 
                                                if(!empty($fcNotification)){
                                                foreach($fcNotification as $notification){ ?>
                                            <a class="dropdown-item" href="#">
                                                <div class="notification__icon-wrapper">
                                                    <div class="notification__icon">
                                                        <i class="material-icons">notifications_active</i>
                                                    </div>
                                                </div>
                                                <div class="notification__content mt-1">
                                                    <b><?php echo $notification->vehicle_number; ?> : This Vehicle FC
                                                        will be lapse on
                                                        <?php echo date('d-m-Y',strtotime($notification->fc_date)); ?>
                                                    </b>
                                                </div>
                                            </a>
                                            <?php }  } ?>

                                            <?php 
                                                if(!empty($karnatakaPermitNotification)){
                                                foreach($karnatakaPermitNotification as $notification){ ?>
                                            <a class="dropdown-item" href="#">
                                                <div class="notification__icon-wrapper">
                                                    <div class="notification__icon">
                                                        <i class="material-icons">notifications_active</i>
                                                    </div>
                                                </div>
                                                <div class="notification__content mt-1">
                                                    <b><?php echo $notification->vehicle_number; ?> : This Vehicle
                                                        Karnataka Permit
                                                        will be lapse on
                                                        <?php echo date('d-m-Y',strtotime($notification->karnataka_permit_date));?>
                                                    </b>
                                                </div>
                                            </a>
                                            <?php }  } ?>

                                            <?php 
                                                if(!empty($nationalPermitNotification)){
                                                foreach($nationalPermitNotification as $notification){ ?>
                                            <a class="dropdown-item" href="#">
                                                <div class="notification__icon-wrapper">
                                                    <div class="notification__icon">
                                                        <i class="material-icons">notifications_active</i>
                                                    </div>
                                                </div>
                                                <div class="notification__content mt-1">
                                                    <b><?php echo $notification->vehicle_number; ?> : This Vehicle
                                                        National Permit
                                                        will be lapse on
                                                        <?php echo date('d-m-Y',strtotime($notification->national_permit_date));?>
                                                    </b>
                                                </div>
                                            </a>
                                            <?php }  } ?>


                                            <?php 
                                                if(!empty($emissionNotification)){
                                                foreach($emissionNotification as $notification){ ?>
                                            <a class="dropdown-item" href="#">
                                                <div class="notification__icon-wrapper">
                                                    <div class="notification__icon">
                                                        <i class="material-icons">notifications_active</i>
                                                    </div>
                                                </div>
                                                <div class="notification__content mt-1">
                                                    <b><?php echo $notification->vehicle_number; ?> : This Vehicle
                                                        Emission
                                                        will be lapse on
                                                        <?php echo date('d-m-Y',strtotime($notification->emission_date));?>
                                                    </b>
                                                </div>
                                            </a>
                                            <?php }  } ?>
                                        </div>
                                    </li> -->
                                    <li class="nav-item dropdown nav-profile">
                                        <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown"
                                            href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                            <?php if(!empty($profile_image)){ ?>
                                            <img class="user-avatar rounded-circle mr-2"
                                                src="<?php echo $profile_image; ?>" alt="User Avatar">
                                            <?php } else { ?>
                                            <img class="user-avatar rounded-circle mr-2"
                                                src="<?php echo base_url(); ?>assets/dist/img/usr.png"
                                                alt="User Avatar">
                                            <?php } ?>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-small dropdown-margin">

                                            <div class="row  user-header">
                                                <div class="col-12 col-lg-12 ">
                                                    <?php if(!empty($profile_image)){ ?>
                                                    <img class=" rounded-circle text-center "
                                                        src="<?php echo $profile_image; ?>" alt="User Avatar"
                                                        height="100" width="100">
                                                    <?php } else { ?>
                                                    <img class=" rounded-circle  text-center"
                                                        src="<?php echo base_url(); ?>assets/dist/img/usr.png"
                                                        alt="User Avatar" height="100" width="100">
                                                    <?php } ?>
                                                    <p>
                                                        <?php echo $employee_name; ?>
                                                        <br>
                                                        <span style="font-size:12px;"><?php echo $role_text; ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr class="mt-0 mb-1">
                                            <!-- Menu Footer-->
                                            <div class="row user-footer ">
                                                <div class="col-12 col-lg-12 ">
                                                    <a href="<?php echo base_url(); ?>profile"
                                                        class="btn  btn-primary profile-btn pull-left "><i
                                                            class="fa fa-user-circle"></i> Profile</a>
                                                    <a href="<?php echo base_url(); ?>logout"
                                                        class="btn  btn-danger signout-btn  pull-right"><i
                                                            class="fa fa-sign-out"></i> Sign out</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <nav class="nav">
                                    <a href="#"
                                        class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
                                        data-toggle="collapse" data-target=".header-navbar" aria-expanded="false"
                                        aria-controls="header-navbar">
                                        <i class="material-icons">&#xE5D2;</i>
                                    </a>
                                </nav>
                            </nav>
                        </div>