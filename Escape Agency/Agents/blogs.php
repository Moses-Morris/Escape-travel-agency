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
                    <h4 class="card-title">My Blogs</h4>
                    <a href="createblog.php" type="button" class="btn btn-primary btn-rounded btn-fw">Create new Blog</a>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                          <th>BlogImg</th>
                            <th>Blog Title</th>
                            <th>Destination</th>
                            
                            <th>Tag</th>
                            
                            <th>Subtitle</th>
                            <th>Published Date</th>
                            <th>Blog Content</th>
                            <th>Blog Keywords</th>
                            <th> Created On</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <?php
                                    $result = mysqli_query($conn,"SELECT * FROM blogs WHERE Role='agent' AND AuthorID=$agentID ");
                                    while($row = mysqli_fetch_array($result)){
                                            $ID = $row["BlogID"];
                                            $dest = $row["DestinationID"];
                                            $img = $row["BlogImage"];
                                            $tag = $row["Tagline"];
                                            $title = $row["BlogTitle"];
                                            $subtitle = $row["Subtitle"];
                                            $PublishDate = $row["PublishedDate"];
                                            $content = $row["BlogContent"];
                                            $keywords = $row["Keywords"];
                                            $created = $row["Created_at"];
                                            $stat = $row["Status"];
                                        
                                             //Get destination through destinations
                                            $dest = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$dest ");
                                            $r3 = mysqli_fetch_array($dest);
                                            $nr3 = $r3["Name"];

                                            print "
                                                 <td>
                                                    <img src= ". $img." >
                                                  </td>
                                                  <td> ". $title."</td>
                                                 <td> ". $nr3."</td>
                                                 
                                                 <td> ". $tag."</td>
                                                 
                                                 <td> ". $subtitle."</td>
                                                 <td> ". $PublishDate."</td>
                                                 <td> ". $content."</td>
                                                 <td> ". $keywords."</td>
                                                 <td> ". $created."</td>
                                                 <td> ". $stat."</td>
                                                 <td> ". $stat."</td>
                                                 <td>
                                                      <a href='viewblog.php?blogid=".urlencode($ID)."' type='button' class='btn btn-primary btn-rounded btn-fw'>View</a>
                                                </td>
                                                </tr>                                            ";
                                        
                                    }



                            
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