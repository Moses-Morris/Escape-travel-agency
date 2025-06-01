<?php
    include 'base.php';
?>



<!-- partial -->
<div class="main-panel">
          <div class="content-wrapper">
            
            
            <h4><i class="mdi mdi-library-books  text-primary ml-auto"></i> Blogs Details  </h4>
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>All Blogs</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $blog = mysqli_query($conn,"SELECT COUNT(*) FROM  blogs");
                              $r = mysqli_fetch_row($blog);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                              print "
                              <p class='text-success ml-4 mb-0 font-weight-medium'>+5%</p>
                                ";

                                print "</div>
                                    <h6 class='text-muted font-weight-normal'> Total Blogs</h6>";
                              ?>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-format-align-left text-primary ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Published Blogs</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $blog = mysqli_query($conn,"SELECT COUNT(*) FROM  blogs WHERE Published='1'");
                              $r = mysqli_fetch_row($blog);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                              print "
                              <p class='text-success ml-4 mb-0 font-weight-medium'>+5%</p>
                                ";

                                print "</div>
                                    <h6 class='text-muted font-weight-normal'> Total Published Blogs</h6>";
                              ?>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Inactive Blogs</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $blog = mysqli_query($conn,"SELECT COUNT(*) FROM  blogs WHERE Published='1' AND Status='inactive'");
                              $r = mysqli_fetch_row($blog);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                              print "
                              <p class='text-success ml-4 mb-0 font-weight-medium'>+5%</p>
                                ";

                                print "</div>
                                    <h6 class='text-muted font-weight-normal'> Total Published and Inactive Blogs</h6>";
                              ?>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-account-card-details text-success ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">All Blog Details</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            
                            <th> Blog ID </th>
                            <th> BlogName </th>
                            <th> Published By </th>
                            <th> Published On </th>
                            <th> Destination </th>
                            <th> Created On</th>
                            <th> TagLine </th>
                            <th> Subtitle </th>
                            <th> Content </th>
                            <th> Keywords</th>
                            <th>  Status </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php
                                      $result = mysqli_query($conn,"SELECT * FROM blogs ORDER BY Created_at DESC");
                                      while($row = mysqli_fetch_array($result)){
                                        $id = $row["BlogID"];
                                        $author = $row["AuthorID"];
                                        $role = $row["Role"];
                                        $dest = $row["DestinationID"];
                                        $blogimg = $row["BlogImage"];
                                        $date = $row["Created_at"];
                                        $tag = $row["Tagline"];
                                        $title = $row["BlogTitle"];
                                        $subtitle = $row["Subtitle"];
                                        $status = $row["Status"];
                                        $pub_date = $row["PublishedDate"];
                                        $content = $row["BlogContent"];
                                        $key = $row["Keywords"];
                                        $pub = $row["Published"];

                                      
                                        
                                        
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

                                        



                                        if ($role == 'agent'){
                                          //gET agent anme
                                          $agent = mysqli_query($conn, "SELECT * FROM agents WHERE AgentID = $author");
                                          $dd = mysqli_fetch_array($agent);
                                          $getddn = $dd['CompanyName'];
  
                                          if (($getddn == "") || ($agent == "0")){
                                            $authoname= "Escape Agency";
                                          } else{
                                            $authoname = $getddn;
                                          }

                                        }else{
                                            //get user
                                            $users = mysqli_query($conn, "SELECT * FROM users WHERE UserID = $author");
                                            $dd = mysqli_fetch_array($users);
                                            $authoname = $dd['Email'];

                                           }
                                           
                                       
                                      
                                     
                                        print "
                                              <td> ".$id."</td>
                                              <td> ".$title."</td>
                                              
                                              <td> ".$authoname.": ".$role."</td>
                                              <td>".$pub_date."</td>
                                              <td> ".$getddname."</td>
                                              <td> ".$date."</td>
                                              <td> ".$tag."</td>
                                              <td> ".$subtitle."</td>
                                              <td> ".$content."</td>
                                              <td> ".$key."</td>
                                              
                                              <td> ".$icon."</td>
                                              <td>
                                                <a href='./viewblog.php?blogid=". urlencode($id) ."' class='btn btn-primary '>View More Details</a>
                                              </td>
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
            </div>

                                    </div>
                                    
<?php
    include 'footer.php';
?>