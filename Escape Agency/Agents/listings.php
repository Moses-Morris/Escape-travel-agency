<?php
    include 'base.php';
    include_once 'config/connection.php';
   
    //echo $getdd;
?>      

<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
            <div class="col-md-12 grid-margin">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">My Travel Option and Services</h4>
                    <h6>Create new Travel Option : Travel Services For Destinations</h5>
                    <h6>These are options that your clients can choose from when making a destination booking. It offers your client the option to choose their Traveling Choice.</h5>
                    <h6>leave it blank to allow clients to choose from other service providers or allow Escape agency to handle it for you.</h5>
                    <a href="" type="button" class="btn btn-primary btn-rounded btn-fw">Create new Travel Option</a>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                        <tr>
                        
                            <th> Destination </th>
                            
                            <th> Travel Mode </th>
                            <th> Details of Travel </th>
                            <th> Price </th>
                            <th> Created By : Agent </th>
                            <th> Option Created On  </th>
                            <th> Status </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php
                                      
                                       $result = mysqli_query($conn,"SELECT * FROM traveloptions d 
                                                                                                JOIN Agents a ON d.AgentID = a.AgentID
                                                                                                WHERE a.AgentID = $agentID OR a.AgentID = 0");
                                       while($row = mysqli_fetch_array($result)){
                                         $id = $row["TravelID"];
                                         $book = $row["BookingID"];
                                         $dest = $row["DestinationID"];
                                         $date = $row["Created_at"];
                                         $agent = $row["AgentID"];
                                         $status = $row["Status"];
                                         $mode = $row["TravelMode"];
                                         $details = $row["Details"];
                                         $price = $row["Prices"];
                                       
                                         
                                         
                                         if ($status == 'active'){
                                           $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'>Active</i>";
                                           $button = "<a href='./deactivy.php' class='badge badge-outline-success'>Deactivate</a>";
                                         }else{
                                           $icon = "<i class='mdi mdi-window-close  text-primary ml-auto'>Inactive</i> ";
                                           $button = "<a href='./deactivy.php' class='badge badge-outline-success'>Activate</a>";
                                         }
 
                                        
 
                                         
                                         //gET dest NAME
                                         $destname = mysqli_query($conn, "SELECT * FROM destinations WHERE DestinationID = $dest");
                                         $ddname = mysqli_fetch_array($destname);
                                         $getddname = $ddname['Name'];
                                         $getddimage = $ddname['ImageURL'];
 
 
                                          //gET agent anme
                                          $agent = mysqli_query($conn, "SELECT * FROM agents WHERE AgentID = $agent");
                                          $dd = mysqli_fetch_array($agent);
                                          $getddn = $dd['CompanyName'];
  
                                          if (($getddn == "") || ($agent == "0")){
                                            $company = "Escape Agency";
                                          } else{
                                            $company = $getddn;
                                          }
 
 
                                          //Get booking details
                                          $bookings = mysqli_query($conn, "SELECT * FROM bookings WHERE BookingID = $book");
                                          $ff = mysqli_fetch_array($bookings);
                                          $getuser = $ff['UserID'];
                                          $getDate = $ff['Created_at'];
                                          
 
                                          //get user
                                           
                                         $users = mysqli_query($conn, "SELECT * FROM users WHERE UserID = $getuser");
                                         $dd = mysqli_fetch_array($users);
                                         $getdd = $dd['Email'];
 
 
                                      
                                         print "
                                               
                                               <td> ".$getddname."</td>      
                                               <td> ".$mode."</td>
                                               <td> ".$details."</td>
                                               <td> ".$price."</td>
                                               <td> ".$company."</td>
                                               <td> ".$date."</td>
                                               <td> ".$icon."</td>
                                               <td>
                                                  ".$button."
                                               </td>
                                             </tr>";
 
 
 
                                       };
 

                                    ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                                    </div>
                                    </div>

            














            
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">My Properties and Services</h4>
                    <h6>Create new Properties for Destinations : Hosting</h5>
                    <a href="" type="button" class="btn btn-primary btn-rounded btn-fw">Create new Property</a>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> PropertyName </th>
                            <th> Location </th>
                            <th> Price </th>
                            <th> Services </th>
                            <th> Features </th>
                            
                            <th> Agent Options </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php
                                       $result = mysqli_query($conn,"SELECT * FROM agentproperties d 
                                                                                                JOIN Agents a ON d.AgentID = a.AgentID
                                                                                                WHERE a.AgentID = $agentID  ");
                                        while($row = mysqli_fetch_array($result)){
                                            $ID = $row["PropertyID"];
                                            $Name = $row["PropertyName"];
                                            $date = $row["Created_at"];
                                            $services = $row["Services"];
                                            $feat = $row["Features"];
                                            $desc = $row["Description"];
                                            $price = $row["Price"];
                                            $location = $row["Location"];
                                            $services = $row["Services"];
                                            $option = $row["OptionType"];
                                            $image = $row["ImageURL"];
                                        
                                      
                                    

                                     
                                            print "
                                                
                                                
                                                <td>
                                                    <img src='assets/images/faces/face1.jpg' alt='image' />
                                                    <span class='pl-2'>".$Name."</span>
                                                </td>
                                                <td> ".$location."</td>
                                                <td> ". $price." USD</td>
                                                <td> ".$services."</td>
                                                <td> ".$feat."</td>
                                                
                                                <td> ".$option."</td>
                                                
                                                <td>
                                                    <a href='viewproperty.php?propid=". urlencode($ID) ."' type='button' class='btn btn-primary btn-fw'>View Property</a>
                                                </td>
                                                </tr>";



                                      };

                                    ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                                    </div>
                                    </div></div></div>

                  <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Accomodation Information - Active Hostings</h4>
                    <a href="" type="button" class="btn btn-primary btn-rounded btn-fw">Create new Hosting</a>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Hosting Name </th>
                            <th> Type </th>
                            <th> Location </th>
                            <th> Price Per Night </th>
                            <th> Closest Destination </th>
                            <th> Agent </th>
                            <th> Actions </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php
                            $result = mysqli_query($conn,"SELECT * FROM accomodation WHERE active='active' AND AgentID=$agentID");
                            while($row = mysqli_fetch_array($result)){
                              $name = $row['Name'];
                              $dest = $row['DestinationID'];
                              $type = $row['Type'];
                              $price = $row['PricePerNight'];
                              $img = $row['ImageURL'];
                              $location = $row['Location'];
                              $Dist = $row['DistFromOrigin'];  //distance from destination
                              $agent = $row['AgentID'];

                              //Get image of agent 
                              $agentimg = mysqli_query($conn,"SELECT * FROM  agents  WHERE AgentID=$agent AND Status='active'");
                              $a_img = mysqli_fetch_array($agentimg);
                              $image_agent = $a_img['ProfileImg'];
                              $name_agent = $a_img['CompanyName'];


                              //Destination which is closest to the accomodation location
                              $destination = mysqli_query($conn,"SELECT * FROM  destinations  WHERE DestinationID=$dest AND Status='approved'");
                              $a_dest = mysqli_fetch_array($destination);
                              $image_dest = $a_dest['ImageURL'];
                              $name_dest = $a_dest['Name'];

                              if ($name_agent == ""){
                                $agentname= "Escape Agency";
                              }else{
                                $agentname = $name_agent ;
                              }

                              print "
                              
                                    <td>
                                      <img src='assets/images/faces/face1.jpg' alt='image' />
                                      <span class='pl-2'>".$name."</span>
                                    </td>
                                    <td>". $type." </td>
                                    <td> ".$location." </td>
                                    <td> ". $price." USD</td>
                                    <td> ".$name_dest."</td>
                                    <td> ".$agentname."</td>
                                    <td>
                                      <div class='badge badge-outline-success'>Active</div>
                                    </td>
                                    <td>
                                      <a href='./viewhosting.php?hostid=". urlencode($ID) ."' class='btn btn-primary '>View More Details</a>
                                    </td>
                                  </tr>";


                            }
                          ?>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
                </div>
              </div>














<?php
    include 'footer.php';
?>