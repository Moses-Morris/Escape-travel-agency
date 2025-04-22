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
                    <h4 class="card-title">Events</h4>
                    <a href="createevent.php" type="button" class="btn btn-primary btn-rounded btn-fw">Create new Event</a>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Image </th>
                            <th> EventName </th>
                            <th> Description </th>
                            <th> Tagline </th>
                            <th> Activities </th>
                            <th> Location </th>
                            <th> Destination </th>
                            <th> Price </th>
                            <th> Status </th>
                            <th> Option </th>
                            <th> Startdate </th>
                            <th> Enddate </th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php


                                       $result = mysqli_query($conn,"SELECT * FROM Events
                                                                                                WHERE AgentID = $agentID  ");
                                        while($row = mysqli_fetch_array($result)){
                                            $ID = $row["EventID"];
                                            $Name = $row["Name"];
                                            $desc = $row["Description"];
                                            $tag = $row["Tagline"];
                                            $activities = $row["Activities"];
                                            $location = $row["Location"];
                                            $dest = $row["DestinationID"];
                                            $price = $row["Price"];
                                            $status = $row["Status"];
                                            $active = $row["Status"];
                                            $Sdate = $row["StartDate"];
                                            $Edate = $row["EndDate"];
                                            $img = $row["ImageURL"];
                                            
                                    
                                    
                                            //Get destination through booking
                                            $dest = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$dest ");
                                            $r3 = mysqli_fetch_array($dest);
                                            $nr3 = $r3["Name"];

                                     
                                            print "
                                                <td class='py-1'>
                                                    <img src=". $img." alt='image' />
                                                </td>
                                                
                                                <td> ". $Name."</td>
                                                <td> ".$desc."</td>
                                                <td> ".$tag."</td>
                                                <td> ".$activities."</td>
                                                <td> ".$location."</td>
                                                <td> ".$nr3."</td>
                                                <td> ".$price."</td>
                                                <td> ".$status."</td>
                                                <td> ".$active."</td>
                                                <td> ".$Sdate."</td>
                                                <td> ".$Edate."</td>
                                               
                                                <td>
                                                      <a href='viewevent.php?eventid=". urlencode($ID) ."'' type='button' class='btn btn-primary btn-rounded btn-fw'>View</a>
                                                </td>
                                                </tr>
                                                ";



                                      };

                                    ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>














<?php
    include 'footer.php';
?>