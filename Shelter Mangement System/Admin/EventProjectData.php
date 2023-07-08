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

    <title>Todds Welfare Society - Project/Event Data</title>
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
            <a class="nav-link" href="Dashboard.php">Back to Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Project/Event
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="rescueData.php">Rescues</a>
              <a class="dropdown-item" href="memberData.php">Management</a>
              <a class="dropdown-item" href="publicData.php">Public</a>
              <a class="dropdown-item" href="#">Event/Project</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <style>
    .cols{background-color:#f3f3f3}
    .tbl{
      padding :70px;
    }
    </style>
<div class="container">
      <div class="row">
        <div class="col-md-12">
                  <div class="card mt-3">
                      <div class="card-header">
                        <h4>Projects/Events</h4>
                      </div>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="card shadow mt-3">
                    <div class="card-header">
                      <h5>Filter 
                      </h5>
                      </div>
                      <div class="col-md-6 mt-3 mb-3"><!--md is ig area, mt is top mb is bottom-->
                      <form action="" method="post">
                        <span>Status:</span><br>
                        All <input type="radio" value="ALL"  name="statusbt"><br>
                        Future <input type="radio" value="Future"  name="statusbt"><br>
                        Completed <input type="radio" value="Completed"  name="statusbt"><br>
                        On Going <input type="radio" value="Ongoing"  name="statusbt"><br><br>
                        <input type="submit" value="Submit" name="submit" class="btn btn-outline-dark w 100">
                      </div>
                      </form>
                  </div>
              </div>
        <div class="col-md-9 mt-3">
                <h4>Projects Data</h4>
                    <table class="table table-bordered table-responsive">
                    <tr class="cols">
                    <th scope="col">#</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Area</th>
                    <th scope="col">Starting date</th>
                    <th scope="col">Ending date</th>
                    <th scope="col">Goal</th>
                    <th scope="col">Status</th>
                    </tr>
                        <!-- Fetching data from DB--> 
                        <?php
                        if(isset($_POST['statusbt']))
                        {
                            $_status=$_POST['statusbt'];
                            if($_status!='ALL')
                                $sql = "SELECT * FROM Projects where Project_status='$_status'";
                            else
                                $sql = "SELECT * FROM Projects";
                        }
                        else
                            $sql = "SELECT * FROM Projects";

                        $result = $con -> query($sql); 
                        if($result -> num_rows > 0)
                        {
                            while($row = $result -> fetch_assoc())
                            {
                            echo"<tr><td>". $row["Project_ID"] ."</td><td>". $row["Project_Name"] ."</td><td>". $row["Area"] ."</td><td>". $row["Starting_Date"] ."</td><td>". $row["Ending_Date"] ."</td><td>". $row["Goal"] ."</td><td>". $row["Project_status"] ."</td></tr>";
                            }
                            echo"</table>";
                        }
                        else 
                            echo"0 Results";
                        ?>
                     </table>
              <h4>Event Data</h4>
              <table class="table table-bordered table-responsive">
              <tr class="cols">
              <th scope="col">#</th>
              <th scope="col">Event Name</th>
              <th scope="col">Venue</th>
              <th scope="col">Event date</th>
              <th scope="col">about Event</th>
              <th scope="col">People Registered</th>
              </tr>
                <!-- Fetching data from DB--> 
                <?php
                
                 $sql = "SELECT Events.Event_ID,Event_Name,Venue,Event_Date,aboutEvent,count(EventPublicData.Public_ID) as Registeredpeople FROM Events left join EventPublicData ON Events.Event_ID=EventPublicData.Event_ID group by Event_ID " ;

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
              
        </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>