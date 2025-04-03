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
                    <h4 class="card-title">My Discounts</h4>
                    <a href="" type="button" class="btn btn-primary btn-rounded btn-fw">Create new Discounts</a>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> DiscountName </th>
                            <th> Destination </th>
                            <th> CODE </th>
                            <th> Description </th>
                            <th> Discount </th>
                            <th>Status</th>
                            <th> StartDate </th>
                            <th> EndDate</th>
                            <th> NumOfVouchers</th>
                            <th> Running </th>
                            <th> Date Created </th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php
                                       $today = date('Y-m-d');

                                       $result = mysqli_query($conn,"SELECT * FROM Discounts
                                                                                                WHERE AgentID = $agentID  ");
                                        
                                        while($row = mysqli_fetch_array($result)){
                                            $name = $row["DiscountName"];
                                            $dest = $row["DestinationID"];
                                            $code = $row["Code"];
                                            $desc = $row["Description"];
                                            $discount = $row["Discount"];
                                            $active = $row["Status"];
                                            $Sdate = $row['StartDate'];
                                            $Edate = $row['EndDate'];
                                            $num = $row['NumOfCodes'];
                                            $date = $row["Created_at"];
                                           
                                            if ($Edate > $today){
                                              $it = "Running";
                                            }else{
                                              $it = "Over";
                                            }
                                    
                                    
                                            
                                             //Get destination through destinations
                                             $dest = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$dest ");
                                             $r3 = mysqli_fetch_array($dest);
                                             $nr3 = $r3["Name"];

                                     
                                            print "
                                                
                                                <td> ". $name."</td>
                                                <td> ". $nr3."</td>
                                                <td> ".$code."</td>
                                                <td> ".$desc."</td>
                                                <td> ". $discount."</td>
                                                <td> ".$active."</td>
                                                <td> ".$Sdate."</td>
                                                 <td> ".$Edate."</td>
                                                <td> ".$num."</td>
                                                <td> ".$it."</td>
                                                 <td> ".$date."</td>
                                                
                                               <td>
                                                      <a href='' type='button' class='btn btn-primary btn-rounded btn-fw'>View</a>
                                                </td>
                                                <td>
                                                      <a href='' type='button' class='btn btn-primary btn-rounded btn-fw'>View</a>
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