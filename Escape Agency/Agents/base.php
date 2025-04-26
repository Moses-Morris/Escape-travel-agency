<?php
        include_once 'config/connection.php';
        
        
        session_start();
        $check=$_SESSION['Email'];
        $session=mysqli_query($conn, "SELECT AgentID,Email, CompanyName, AgentType from Agents where Email='$check' ");
        $row=mysqli_fetch_array($session);
        $login_session=$row['Email'];
        $Company = $row['CompanyName'];
        $agentID = $row['AgentID']; 
        $agentType = $row['AgentType'];
        if(!isset($login_session))
        {
          echo "You Failed !!";
          header('Location: alogin.php');
        } 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AGENTS DASHBOARD</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css"> -->
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
      <a class="navbar-brand brand-logo me-5" href="index.html"><img src="assets/images/logo.svg" class="me-2" alt="logo" /></a>
      <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
    </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>
    <ul class="navbar-nav mr-lg-2">
      <li class="nav-item nav-search d-none d-lg-block">
        <div class="input-group">
          <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
            <span class="input-group-text" id="search">
              <i class="icon-search"></i>
            </span>
          </div>
          <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
        </div>
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
          <i class="icon-bell mx-0"></i>
          <span class="count"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-success">
                <i class="ti-info-alt mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">Application Error</h6>
              <p class="font-weight-light small-text mb-0 text-muted"> Just now </p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-warning">
                <i class="ti-settings mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">Settings</h6>
              <p class="font-weight-light small-text mb-0 text-muted"> Private message </p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-info">
                <i class="ti-user mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">New user registration</h6>
              <p class="font-weight-light small-text mb-0 text-muted"> 2 days ago </p>
            </div>
          </a>
        </div>
      </li>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
          <img src="assets/images/faces/face28.jpg" alt="profile" />
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item">
            <i class="ti-settings text-primary"></i> Settings </a>
          <a class="dropdown-item">
            <i class="ti-power-off text-primary"></i> Logout </a>
        </div>
      </li>
      <li class="nav-item nav-settings d-none d-lg-flex">
        <a class="nav-link" href="#">
          <i class="icon-ellipsis"></i>
        </a>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="bookings.php">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">My Bookings</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="destinations.php">
        <i class="icon-columns menu-icon"></i>
        <span class="menu-title">My Destinations</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="events.php">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">My Events</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="activities.php">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">My Activities</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="listings.php">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">My Listings</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="services.php">
        <i class="icon-grid-2 menu-icon"></i>
        <span class="menu-title">My Services</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="payments.php">
        <i class="icon-contract menu-icon"></i>
        <span class="menu-title">My Payments</span>
      </a>
    </li>
    

    <li class="nav-item">
      <a class="nav-link" href="notifications.php">
        <i class="mdi mdi-arrow-down-bold-hexagon-outline menu-icon"></i>
        <span class="menu-title">Notifications</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="discounts.php">
        <i class="mdi mdi-barrel menu-icon"></i>
        <span class="menu-title">My Discounts and Ads</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="reviews.php">
        <i class="mdi mdi-blur-radial menu-icon"></i>
        <span class="menu-title">My Reviews</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="blogs.php">
        <i class="mdi mdi-chart-bubble menu-icon"></i>
        <span class="menu-title">My Blogs</span>
      </a>
    </li>
    
    
    
    
  </ul>
</nav>
        