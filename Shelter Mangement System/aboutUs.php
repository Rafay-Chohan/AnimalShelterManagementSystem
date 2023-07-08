<?php
session_start();

  include("connection.php");
  include("functions.php");

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
          <li class="nav-item">
            <a class="nav-link" href="test.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">About US <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Help Rescues
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="adoption.php">Adoption</a>
              <a class="dropdown-item" href="foster.php">Foster</a>
              <!-- <div class="dropdown-divider"></div> -->
              <a class="dropdown-item" href="sponsor.php">Sponsor</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

     <!-- Page Content-->
     <div class="container px-4 px-lg-5">
      <!-- Heading Row-->
      <div class="row gx-4 gx-lg-5 align-items-center my-5">
          <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="img1.jpg" alt="..." /></div>
          <div class="col-lg-5">
              <h1 class="font-weight-light">UpComing Event</h1>
              <table class="table table-bordered table-responsive">
                        <tr class="cols">
                          <th scope="col">ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Area</th>
                          <th scope="col">Date</th>
                          <th scope="col">Description</th>
                        </tr>
                        <!-- Fetching data from DB--> 
                        <?php
                          $sql = "SELECT Event_ID,Event_Name,Venue,Event_Date,aboutEvent FROM Events order by Event_Date Asc Limit 1";
                          $result = $con -> query($sql);
                          if($result -> num_rows > 0)
                          {
                            while($row = $result -> fetch_assoc())
                            {
                              echo"<tr><td>". $row["Event_ID"] ."</td><td>". $row["Event_Name"] ."</td><td>". $row["Venue"] ."</td><td>". $row["Event_Date"] ."</td><td>". $row["aboutEvent"] ."</td></tr>";
                            }
                            echo"</table>";
                          }
                          else 
                            echo"0 Results";
                        ?>
                      </table>
                      
              <a class="btn btn-primary" href="RegisterEvent.php">Register</a>
          </div>
      </div>
      <!-- Call to Action-->
      <div class="card text-white bg-dark my-5 py-4 text-center">
          <div class="card-body"><p class="text-white m-0">TWS Todds Welfare Society</p></div>
      </div>
      <!-- Content Row-->
      <div class="row gx-4 gx-lg-5">
          <div class="col-md-4 mb-5">
              <div class="card h-100">
                  <div class="card-body">
                      <h2 class="card-title">Completed Projects</h2>
                      <table class="table table-bordered table-responsive">
                        <tr class="cols">
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Area</th>
                          <th scope="col">Start_Date</th>
                          <th scope="col">End_Date</th>
                          <th scope="col">goal</th>
                        </tr>
                        <!-- Fetching data from DB--> 
                        <?php
                          $sql = "SELECT Project_ID,Project_Name,Area,Starting_Date,Ending_Date,Goal FROM Projects where Project_status ='Completed'";
                          $result = $con -> query($sql);
                          if($result -> num_rows > 0)
                          {
                            while($row = $result -> fetch_assoc())
                            {
                              echo"<tr><td>". $row["Project_ID"] ."</td><td>". $row["Project_Name"] ."</td><td>". $row["Area"] ."</td><td>". $row["Starting_Date"] ."</td><td>". $row["Ending_Date"] ."</td><td>". $row["Goal"] ."</td></tr>";
                            }
                            echo"</table>";
                          }
                          else 
                            echo"0 Results";
                        ?>
                      </table></div>
              </div>
          </div>
          <div class="col-md-4 mb-5">
              <div class="card h-100">
                  <div class="card-body">
                      <h2 class="card-title">On Going Projects</h2>
                      <table class="table table-bordered table-responsive">
                        <tr class="cols">
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Area</th>
                          <th scope="col">Start_Date</th>
                          <th scope="col">End_Date</th>
                          <th scope="col">goal</th>
                        </tr>
                        <!-- Fetching data from DB--> 
                        <?php
                          $sql = "SELECT Project_ID,Project_Name,Area,Starting_Date,Ending_Date,Goal FROM Projects where Project_status ='Ongoing'";
                          $result = $con -> query($sql);
                          if($result -> num_rows > 0)
                          {
                            while($row = $result -> fetch_assoc())
                            {
                              echo"<tr><td>". $row["Project_ID"] ."</td><td>". $row["Project_Name"] ."</td><td>". $row["Area"] ."</td><td>". $row["Starting_Date"] ."</td><td>". $row["Ending_Date"] ."</td><td>". $row["Goal"] ."</td></tr>";
                            }
                            echo"</table>";
                          }
                          else 
                            echo"0 Results";
                        ?>
                      </table></div>
              </div>
          </div>
          <div class="col-md-4 mb-5">
              <div class="card h-100">
                  <div class="card-body">
                      <h2 class="card-title">Future Projects</h2>
                      <table class="table table-bordered table-responsive">
                        <tr class="cols">
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Area</th>
                          
                          <th scope="col">goal</th>
                        </tr>
                        <!-- Fetching data from DB--> 
                        <?php
                          $sql = "SELECT Project_ID,Project_Name,Area,Goal FROM Projects where Project_status ='Future'";
                          $result = $con -> query($sql);
                          if($result -> num_rows > 0)
                          {
                            while($row = $result -> fetch_assoc())
                            {
                              echo"<tr><td>". $row["Project_ID"] ."</td><td>". $row["Project_Name"] ."</td><td>". $row["Area"] ."</td><td>". $row["Goal"] ."</td></tr>";
                            }
                            echo"</table>";
                          }
                          else 
                            echo"0 Results";
                        ?>
                      </table></div>
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