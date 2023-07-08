<?php
session_start();

  include("connection.php");
  include("functions.php");
  if(isset($_POST['username']))
  {
    //something was posted
    $user_name =$_POST['username'];
    $second_name =$_POST['secondName'];
    $gender = $_POST['Gender'];
    $DOB = $_POST['DOB'];
    $CNIC = $_POST['CNIC'];
    $Phone = $_POST['Phone'];
    $Rescue_ID = $_POST['Rescue_ID'];
  
  
    if(!empty($user_name) && !empty($second_name) && !empty($gender)&& !empty($DOB)&& !empty($CNIC)&& !empty($Phone) && !is_numeric($user_name))
      {
  
        //save to database
        try
        {
          $query2 = "INSERT INTO RescuePublicData (Rescue_ID,Public_ID,First_Name,Second_Name,Gender,DOB,Phone,Type_Public,DateofProcess) VALUES('$Rescue_ID','$CNIC','$user_name','$second_name','$gender','$DOB','$Phone','Adoption Parent',CURDATE())";
          $result = mysqli_query($con, $query2);
          if ($result) {
           $query = "insert into Public (First_Name,Second_Name,Gender,DOB,CNIC,Phone,Type_Public) VALUES('$user_name','$second_name','$gender','$DOB','$CNIC','$Phone','Adoption Parent')";
           mysqli_query($con, $query);
          }
        }
        catch(Exception)
        { 
          echo '<script>alert("Error while Registering")</script>';
          goto a;
        } 
        echo '<script>alert("Successfully Registered")</script>';
        $query3 = "Update Rescues set Status='Adopted' where Rescue_Id='$Rescue_ID'";
        mysqli_query($con, $query3);
      }else
      {
        echo '<script>alert("Please enter some valid information!")</script>';
        a:
      }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Todds Welfare Society - Adoption</title>
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
              <a class="nav-link" href="aboutUs.php">About US</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Adoption
                </a>
              <div class="dropdown-menu active" aria-labelledby="navbarDropdown">
                <a class="dropdown-item active" href="#">Adoption<span class="sr-only">(current)</span></a>
                <a class="dropdown-item" href="foster.php">Foster</a>
                <!-- <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="sponsor.php">Sponsor</a>
              </div>
            </li>
          </ul>
         
        </div>
      </nav>

    <style>
    .cols{background-color:#f3f3f3}
    .rols{background-color:#ffffff}
    .screen{
        display: flex;
        align-items: center;
        justify-content: center;    
    }
    
    .screen .signUp{
        width:  450px;
        height: min-content;
        padding: 20px;
        border-radius: 12px;
        background: #fff;
        text-align: center;
    }
   
    
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
                      <div class="col-md-5 mt-3 mb-3"> 
                      <form action="" method="post">
                        All <input type="radio" value="ALL"  name="typebt"><br>
                        <span>Type:</span><br>
                        Cat <input type="radio" value="Cat"  name="typebt"><br>
                        Dog <input type="radio" value="Dog"  name="typebt"><br><br>

                        <span>Gender:</span><br>
                        Male <input type="radio" value="Male"  name="genderbt"><br>
                        Female <input type="radio" value="Female"  name="genderbt"><br><br>
                        <input type="submit" value="Submit" name="submit" class="btn btn-outline-dark w 100">
                      </div>
                      </form>
                  </div>
              </div>
        <div class="col-md-9 mt-3">
              <h4>Adoption</h4>
              <table class="table table-bordered table-responsive">
                <tr class="cols">
                  <th scope="col">#</th>
                  <th scope="col">Animal</th>
                  <th scope="col">Name</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Age</th>
                  <th scope="col">Sterile</th>
                  <th scope="col">Vac_status</th>
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
                      $sql = "SELECT * FROM Rescues WHERE Animal ='$_type' AND Gender ='$_gender' AND Status='Adoption' " ;
                  }
                  else if($_type!="ALL")//If only Type is selected
                  { 
                    $sql = "SELECT * FROM Rescues WHERE Animal ='$_type' AND Status='Adoption' "; 
                  }
                  else if(isset($_POST['genderbt']))//If only Gender is Selected
                  {
                    $_gender=$_POST['genderbt'];
                    $sql = "SELECT * FROM Rescues WHERE Gender ='$_gender' AND Status='Adoption' " ;
                  }
                  else//If none is selected
                  {
                    $sql = "SELECT * FROM Rescues Where Status='Adoption'" ;
                  }
                  
                  $result = $con -> query($sql);
                  if($result -> num_rows > 0)
                  {
                    while($row = $result -> fetch_assoc())
                    {
                      echo"<tr class =\"rols\"><td>". $row["Rescue_ID"] ."</td><td>". $row["Animal"] ."</td><td>". $row["Name"] ."</td><td>". $row["Gender"] ."</td><td>". $row["Age"] ."</td><td>". $row["Sterile"] ."</td><td>". $row["Vac_status"] ."</td><td>". $row["rescued_Date"] ."</td></tr>";
                    }
                    echo"</table>";
                  }
                  else 
                    echo"0 Results";
                ?>
              </table>
              
              <?php
              if(!isset($_POST['Register']))
              {
                ?>
                  <form method="post">
                  <input type="submit" name="Register" id="Register" value="Adopt" /><br/>
                  </form>
                <?php
                if(isset($_POST['Register2'])&&isset($_POST['Register']))
                   unset($_POST['Register2']);
              }
              else if(!isset($_POST['Register2']))
              {
                ?>
                  <form method="post">
                  <input type="submit" name="Register2" id="Register2" value="Cancel" /><br/>
                  </form>
                <?php
                 if(isset($_POST['Register'])&&isset($_POST['Register2']))
                    unset($_POST['Register']);
              }
              ?>



        </div>
        </div>
        
        <?php
        if(isset($_POST['Register']))
        {
          
        ?>
        
        <div class="screen">
                  <div class="signUp">
                      <h3 class="text-center">Adopt Rescue</h3>
                      
                          <form class="needs-validation" method="post" action="#">
                                
                                  <input id="text" type="username" name="username" placeholder="First Name" class="form-control"><br>
                              
                                  <input id="text" type="secondName" name="secondName" placeholder="Last Name" class="form-control"><br>
                              
                                  <select id="text"type="Gender" name="Gender"  class="form-control">
                                      <option value=""> Gender </option>
                                      <option value="Male">Male</option>
                                      <option value="Female">Female</option>
                                  </select></br>
                              
                                  <input id="text" type="DOB" name="DOB" placeholder="DOB: yyyy-mm-dd" class="form-control"><br>
                              
                                  <input id="text" type="CNIC" name="CNIC" placeholder="CNIC: _____-_______-_" class="form-control"><br>
                              
                                  <input id="text" type="Phone" name="Phone" placeholder="Phone#" class="form-control"><br>

                                  <?php
                                      $sql = "SELECT Rescue_ID FROM Rescues Where Status ='Adoption' ";
                                      $result = mysqli_query($con,$sql);

                                      echo "<select id=\"text\"type=\"Rescue_ID\" name=\"Rescue_ID\"  class=\"form-control\">";
                                      echo"<option value=\"\"> Rescue ID </option>";
                                      while ($row = $result -> fetch_assoc()) {
                                        echo "<option value='".$row["Rescue_ID"]."'>".$row["Rescue_ID"]."</option>"; 
                                      }
                                      echo "</select><br>";
                                  ?>
                              
                              <div class="form-group">
                                  <input type="submit" value="Adopt" class="btn btn-outline-danger w 100">
                              </div>
                          </form>
                  </div>
            </div>
            <?php
          
        }
        ?>
    </div>
  


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>