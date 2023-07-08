<?php
session_start();

  include("connection.php");
  include("functions.php");

  $user_data = check_login($con);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Todds Welfare Society</title>
  </head>
  <body>

    <!-- NAV Bar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
      <a class="navbar-brand" href="http://localhost/testphp/test.php">TWS</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
          </li>
          
          
          <li class="nav-item">
            <a class="nav-link" href="addProject.php">Add Project</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Tables
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="rescueData.php">Rescues</a>
              <a class="dropdown-item" href="memberData.php">Management</a>
              <a class="dropdown-item" href="publicData.php">Public</a>
              <a class="dropdown-item" href="EventProjectData.php">Event/Project</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
        
      </div>
    </nav>
    
      
      <!-- Page Content-->
     <div class="container px-4 px-lg-5">
     <?php
      echo "<h2> Welcome ".$user_data["Designation"]." ".$user_data["First_Name"] ." !</h2>";
      ?>
      <!-- Heading Row-->
      <div class="row gx-4 gx-lg-5 align-items-center my-5">
          <div class="col-md-10 mb-3">
              <div class="card h-60">
                  <div class="card-body">
                      <h3 class="card-title">UpComing Event</h3>
                      <table class="table table-bordered table-responsive">
                      <tr class="cols">
                          <th scope="col">ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Area</th>
                          <th scope="col">Date</th>
                          <th scope="col">Description</th>
                          <th scope="col">People Registered</th>
                        </tr>
                        <!-- Fetching data from DB--> 
                        <?php
                           $sql = "SELECT Events.Event_ID,Event_Name,Venue,Event_Date,aboutEvent,count(EventPublicData.Public_ID) as Registeredpeople FROM Events left join EventPublicData ON Events.Event_ID=EventPublicData.Event_ID group by Event_ID order by Event_Date Asc Limit 1 " ;

                           $result = $con -> query($sql); 
                           if($result -> num_rows > 0)
                           {
                             while($row = $result -> fetch_assoc())
                             {
                               echo"<tr><td>". $row["Event_ID"] ."</td><td>". $row["Event_Name"] ."</td><td>". $row["Venue"] ."</td><td>". $row["Event_Date"] ."</td><td>". $row["aboutEvent"]."</td><td>". $row["Registeredpeople"] ."</td></tr>";
                             }
                             echo"</table>";
                           }
                           else 
                             echo"0 Results";
                         ?>
                      </table>  
                      <a class="btn btn-primary" href="addEvent.php">Add Event</a>
              </div>
          </div>
          </div>  
      </div>
      <!-- Call to Action-->
      <div class="card text-white bg-dark my-5 py-4 text-center">
          <div class="card-body"><p class="text-white m-0">TWS Todds Welfare Society</p></div>
      </div>
      <!-- Content Row-->
      <div class="row gx-4 gx-lg-5">
          <div class="col-md-5 mb-5">
              <div class="card h-60">
                  <div class="card-body">
                      <h3 class="card-title">Last Month</h3>
                      <table class="table table-bordered table-responsive">
                        <tr class="cols">
                          <th scope="col">Rescued</th>
                          <th scope="col">Adopted</th>
                          <th scope="col">Sponsored</th>
                          <th scope="col">Fostered</th>
                        </tr>
                       <!-- Fetching data from DB--> 
                       <?php
                          $sql = "SELECT count(*) as rescued FROM Rescues where Datediff(CURDATE(),rescued_Date) < 30";
                          $result = $con -> query($sql);
                          $sql2 = "SELECT count(*) as adopted FROM RescuePublicData where Datediff(CURDATE(),DateofProcess) < 30 AND Type_Public ='Adoption Parent'";
                          $result2 = $con -> query($sql2);
                          $sql3 = "SELECT count(*) as sponsored FROM RescuePublicData where Datediff(CURDATE(),DateofProcess) < 30 AND Type_Public ='Sponsor'";
                          $result3 = $con -> query($sql3);
                          $sql4 = "SELECT count(*) as fostered FROM RescuePublicData where Datediff(CURDATE(),DateofProcess) < 30 AND Type_Public ='Rescue Foster'";
                          $result4 = $con -> query($sql4);
                          if($result -> num_rows > 0)
                          {
                            while($row = $result -> fetch_assoc() AND $row2 = $result2 -> fetch_assoc() AND $row3 = $result3 -> fetch_assoc() AND $row4 = $result4 -> fetch_assoc() )
                            {
                              echo"<tr><td>". $row["rescued"]."</td><td>". $row2["adopted"]."</td><td>". $row3["sponsored"]."</td><td>". $row4["fostered"] ."</td></tr>";
                            }
                            echo"</table>";
                          }
                          else 
                            echo"0 Results";
                        ?>
                      </table></div>
                  <div class="card-footer"><a class="btn btn-primary btn-sm" href="rescueData.php">Rescue Data</a></div>
              </div>
          </div>
          <div class="col-md-4 mb-5">
              <div class="card h-60">
                  <div class="card-body">
                      <h3 class="card-title">Management</h3>
                      <table class="table table-bordered table-responsive">
                        <tr class="cols">
                        <th scope="col">Type:</th>
                          <th scope="col">Admin</th>
                          <th scope="col">Volunteers</th>
                        </tr>
                        <!-- Fetching data from DB--> 
                        <?php
                          $sql = "SELECT count(*) as admins FROM Management where Designation = 'Admin'";
                          $result = $con -> query($sql);
                          $sql2 = "SELECT count(*) as volunteers FROM Management where Designation = 'Volunteer'";
                          $result2 = $con -> query($sql2);
                          if($result -> num_rows > 0 AND $result2 -> num_rows > 0)
                          {
                            while($row = $result -> fetch_assoc() AND $row2 = $result2 -> fetch_assoc())
                            {
                              echo"<tr><td>"."Count:"."</td><td>". $row["admins"]."</td><td>". $row2["volunteers"] ."</td></tr>";
                            }
                            echo"</table>";
                          }
                          else 
                            echo"0 Results";
                        ?>
                      </table></div>
                  <div class="card-footer"><a class="btn btn-primary btn-sm" href="memberData.php">Management Data</a> <a class="btn btn-primary btn-sm" href="signup.php">Add Member</a></div>
              </div>
          </div>
          <div class="col-md-3 mb-5">
              <div class="card h-60">
                  <div class="card-body">
                      <h3 class="card-title">Rescues</h3>
                      <table class="table table-bordered table-responsive">
                        <tr class="cols">
                          <th scope="col">Type:</th>
                          <th scope="col">Cats</th>
                          <th scope="col">Dogs</th>
                        </tr>
                        <!-- Fetching data from DB--> 
                        <?php
                          $sql = "SELECT count(*) as cats FROM Rescues where Status <>'Adopted' And Status <> 'In Foster' And Status <> 'Sponsored' AND Animal = 'Cat'";
                          $result = $con -> query($sql);
                          $sql2 = "SELECT count(*) as dogs FROM Rescues where Status <>'Adopted' And Status <> 'In Foster' And Status <> 'Sponsored' AND Animal = 'Dog'";
                          $result2 = $con -> query($sql2);
                          if($result -> num_rows > 0 AND $result2 -> num_rows > 0)
                          {
                            while($row = $result -> fetch_assoc() AND $row2 = $result2 -> fetch_assoc())
                            {
                              echo"<tr><td>"."Count:"."</td><td>". $row["cats"]."</td><td>". $row2["dogs"] ."</td></tr>";
                            }
                            echo"</table>";
                          }
                          else 
                            echo"0 Results";
                        ?>
                      </table>
                    </div>
                  <div class="card-footer"><a class="btn btn-primary btn-sm" href="addRescue.php">Add Rescue</a></div>
              </div>
          </div>
      </div>
  </div>
  <!-- Footer-->
  <footer class="py-5 bg-dark">
      <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
  </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>