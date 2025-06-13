<?php
 include_once 'config/connection.php';
 $msg = " ";

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Agent Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
   
          <div class="content-wrapper">
             <div>
                <h4>Register and setup company details</h4>
            </div>
            <div class="row " style="background-color:#fff;">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Company Details</h4>
                    
                    <form class="forms-sample">
                      <div class="form-group">
                        <label >Company Profile Image</label>
                        <input type="file" class="form-control"  placeholder="You can also use Company Logo" autofill=false>
                      </div>
                      <div class="form-group">
                        <label>Agent Type</label>
                        <select class="form-select form-select-sm">
                            <option>Adventure</option>
                            <option>Travel</option>
                            <option>Hosting</option>
                            <option>Cruise</option>
                            <option>Transport</option>
                            
                        </select>
                      </div>
                      <div class="form-group">
                        <label >Email address</label>
                        <input type="email" class="form-control"  placeholder="Email" autocomplete=false>
                      </div>
                      <div class="form-group">
                        <label >Company Description</label>
                        <small>: What the Company Does</small>
                        <input type="text" class="form-control"  placeholder="For Example 'Luxury ocean cruises and private yacht experiences..'" autofill=false>
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control"  placeholder="Password">
                      </div>
                      <div class="form-group">
                        <label >Confirm Password</label>
                        <input type="password" class="form-control"  placeholder="Password">
                      </div>
                    
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Company Information</h4>
                   
                    
                      <div class="form-group">
                        <label >Phone Number</label>
                        <input type="text" class="form-control"  placeholder="Agent Phone Number">
                      </div>
                      <div class="form-group">
                            <label>Country</label>
                            <script type="text/javascript" src="../js/countries.js"></script>
                            <select onchange="print_state('state',this.selectedIndex);" id="country" name ="country" class="form-select form-select-sm"></select>
                        </div>
                        <div class="form-group">
                            <label>Location/State</label>
                            <select name="location" id ="state" placeholder="Location" class="form-select form-select-sm"></select>
                            <script language="javascript">print_country("country");</script>
                        </div>
                      <div class="form-group">
                        <label >Services Provided</label>
                        <input type="textarea" class="form-control"  placeholder="e.g International & Local Tours, Flight Booking">
                      </div>
                      <div class="form-group">
                        <label >Key Words</label> <br>
                        <small>These help the company speciality easy for clients to find and be ranked. *Seperate with a comma</small>
                        <input type="text" class="form-control"  placeholder="e.g Luxury Travel, Flight Booking, Tours">
                      </div>
                      <div class="form-check">
                        <label class="form-check-label text-muted">
                          <input type="checkbox" class="form-check-input" required>
                          <a href="#">Remember me</a>
                          <i class="input-helper"></i></label>
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
            <div>
</div>
        

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>