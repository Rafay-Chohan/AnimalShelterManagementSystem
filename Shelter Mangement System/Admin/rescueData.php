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

    <title>Todds Welfare Society - Rescue Data</title>
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
              Rescues
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Rescues</a>
              <a class="dropdown-item" href="memberData.php">Management</a>
              <a class="dropdown-item" href="publicData.php">Public</a>
              <a class="dropdown-item" href="EventProjectData.php">Event/Project</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <style>
    .cols{background-color:#f3f3f3}
    
    </style>
 <div class="container">
      <div class="row">
        <div class="col-md-12">
                  <div class="card mt-3">
                      <div class="card-header">
                          <h4>Rescued Animals</h4>
                      </div>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="card shadow mt-3">
                    <div class="card-header">
                      <h5>Filter 
                      </h5>
                      </div>
                      <div class="col-md-6 mt-3 mb-3"> 
                      <form action="" method="post">
                        All <input type="radio" value="ALL"  name="typebt"><br>
                        <span>Type:</span><br>
                        Cat <input type="radio" value="Cat"  name="typebt"><br>
                        Dog <input type="radio" value="Dog"  name="typebt"><br><br>

                        <span>Gender:</span><br>
                        Male <input type="radio" value="Male"  name="genderbt"><br>
                        Female <input type="radio" value="Female"  name="genderbt"><br><br>
                        Sterile: <input type="checkbox" name="Sterile" value="Yes">
                        Vacinated: <input type="checkbox" name="Vac_status" value="Yes">
                        <input type="submit" value="Submit" name="submit" class="btn btn-outline-dark w 100">
                      </div>
                      </form>
                  </div>
              </div>
        <div class="col-md-9 mt-3">
              <h4>Rescues Data</h4>
              <table class="table table-bordered table-responsive">
                <tr class="cols">
                  <th scope="col">#</th>
                  <th scope="col">Animal</th>
                  <th scope="col">Name</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Age</th>
                  <th scope="col">Sterile</th>
                  <th scope="col">Vac_status</th>
                  <th scope="col">Status</th>
                  <th scope="col">Rescued Date</th>
                </tr>
                <!-- Fetching data from DB--> 
                <?php
                  if(isset($_POST['typebt']))//Check for Type
                    $_type=$_POST['typebt'];
                  else
                    $_type="ALL";
                  if(($_type!="ALL") && (isset($_POST['genderbt'])))//if Type And Gender Both are Selected
                  {
                    $_gender=$_POST['genderbt'];
                    if((isset($_POST['Sterile'])) && (isset($_POST['Vac_status'])))//Both Sterile and Vac_status Checked
                      $sql = "SELECT * FROM Rescues WHERE Animal ='$_type' AND Gender ='$_gender' AND Vac_status ='Yes'AND Sterile ='Yes'" ;
                    else if(isset($_POST['Vac_status']))//Vac_status Checked
                      $sql = "SELECT * FROM Rescues WHERE Animal ='$_type' AND Gender ='$_gender' AND Vac_status ='Yes'" ;
                    else if(isset($_POST['Sterile']))//Sterile Checked
                      $sql = "SELECT * FROM Rescues WHERE Animal ='$_type' AND Gender ='$_gender' AND Sterile ='Yes' " ;
                    else//None Checked
                      $sql = "SELECT * FROM Rescues WHERE Animal ='$_type' AND Gender ='$_gender' " ;
                  }
                  else if($_type!="ALL")//If only Type is selected
                  { 
                    if((isset($_POST['Sterile'])) && (isset($_POST['Vac_status'])))//Both Sterile and Vac_status Checked
                      $sql = "SELECT * FROM Rescues WHERE Animal ='$_type' AND Vac_status ='Yes'AND Sterile ='Yes'" ;
                    else if(isset($_POST['Vac_status']))//Vac_status Checked
                      $sql = "SELECT * FROM Rescues WHERE Animal ='$_type' AND Vac_status ='Yes'" ;
                    else if(isset($_POST['Sterile']))//Sterile Checked
                      $sql = "SELECT * FROM Rescues WHERE Animal ='$_type' AND Sterile ='Yes' " ;
                    else//None Checked
                      $sql = "SELECT * FROM Rescues WHERE Animal ='$_type' " ; 
                  }
                  else if(isset($_POST['genderbt']))//If only Gender is Selected
                  {
                    $_gender=$_POST['genderbt'];
                    if((isset($_POST['Sterile'])) && (isset($_POST['Vac_status'])))//Both Sterile and Vac_status Checked
                      $sql = "SELECT * FROM Rescues WHERE Gender ='$_gender' AND Vac_status ='Yes'AND Sterile ='Yes'" ;
                    else if(isset($_POST['Vac_status']))//Vac_status Checked
                      $sql = "SELECT * FROM Rescues WHERE Gender ='$_gender' AND Vac_status ='Yes'" ;
                    else if(isset($_POST['Sterile']))//Sterile Checked
                      $sql = "SELECT * FROM Rescues WHERE Gender ='$_gender' AND Sterile ='Yes' " ;
                    else//None Checked
                      $sql = "SELECT * FROM Rescues WHERE Gender ='$_gender' " ;
                  }
                  else//If none is selected
                  {
                    if((isset($_POST['Sterile'])) && (isset($_POST['Vac_status'])))//Both Sterile and Vac_status Checked
                      $sql = "SELECT * FROM Rescues WHERE Vac_status ='Yes'AND Sterile ='Yes'" ;
                    else if(isset($_POST['Vac_status']))//Vac_status Checked
                      $sql = "SELECT * FROM Rescues WHERE Vac_status ='Yes'" ;
                    else if(isset($_POST['Sterile']))//Sterile Checked
                      $sql = "SELECT * FROM Rescues WHERE Sterile ='Yes' " ;
                    else//None Checked
                      $sql = "SELECT * FROM Rescues " ;
                  }
              

                  $result = $con -> query($sql);
                  if($result -> num_rows > 0)
                  {
                    while($row = $result -> fetch_assoc())
                    {
                      echo"<tr><td>". $row["Rescue_ID"] ."</td><td>". $row["Animal"] ."</td><td>". $row["Name"] ."</td><td>". $row["Gender"] ."</td><td>". $row["Age"] ."</td><td>". $row["Sterile"] ."</td><td>". $row["Vac_status"] ."</td><td>". $row["Status"] ."</td><td>". $row["rescued_Date"] ."</td></tr>";
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