<?php
session_start();
include("connection.php");
include("functions.php");


if($_SERVER['REQUEST_METHOD'] == "POST")
{
  //something was posted
  $user_name =$_POST['username'];
  $second_name =$_POST['secondName'];
  $gender = $_POST['Gender'];
  $DOB = $_POST['DOB'];
  $CNIC = $_POST['CNIC'];
  $Phone = $_POST['Phone'];
  $Event_ID = $_POST['Event_ID'];


  if(!empty($user_name) && !empty($second_name) && !empty($gender)&& !empty($DOB)&& !empty($CNIC)&& !empty($Phone) && !empty($Event_ID) && !is_numeric($user_name))
		{

			//save to database
      try
      {
        $query2 = "INSERT INTO EventPublicData (Event_ID,Public_ID) VALUES('$Event_ID','$CNIC')";
        $result = mysqli_query($con, $query2);
        if ($result) {
         $query = "insert into Public (First_Name,Second_Name,Gender,DOB,CNIC,Phone,Type_Public) VALUES('$user_name','$second_name','$gender','$DOB','$CNIC','$Phone','Event')";
			   mysqli_query($con, $query);
        }
      }
      catch(Exception)
      { 
        echo '<script>alert("CNIC Already Registered to this Event")</script>';
        goto a;
      } 
      echo '<script>alert("Successfully Registered")</script>';
			header("Location: aboutUs.php");
			die;
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
            <a class="nav-link" href="aboutUS.php">Back</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Register <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>

    
    <style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    #text{

        height: 30px;
        border-radius: 5px;
        padding: 4px;
        border: solid thin #aaa;
        width: 100%;
}
    .screen{
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: linear-gradient(180deg,rgb(239, 243, 243),rgb(201, 56, 56));
        
    }
    .signUp{
        width:  450px;
        height: min-content;
        padding: 20px;
        border-radius: 12px;
        background: #fff;
        text-align: center;
    }
   
    </style>
    <div class="screen">
        <div class="signUp">
            <h2 class="text-center">Todds Welfare Society</h2>
            
                <form class="needs-validation" method="post" action="#">
                      
                        <input id="text" type="username" name="username" placeholder="First Name" class="form-control"><br>
                    
                        <input id="text" type="secondName" name="secondName" placeholder="Last Name" class="form-control"><br>
                    
                        <input id="text" type="Gender" name="Gender" placeholder="Male/Female" class="form-control"><br>
                    
                        <input id="text" type="DOB" name="DOB" placeholder="DOB: yyyy-mm-dd" class="form-control"><br>
                    
                        <input id="text" type="CNIC" name="CNIC" placeholder="CNIC: _____-_______-_" class="form-control"><br>
                    
                        <input id="text" type="Phone" name="Phone" placeholder="Phone#" class="form-control"><br>

                        <?php
                            $sql = "SELECT Event_ID FROM Events order by Event_Date Asc Limit 1";
                            $result = mysqli_query($con,$sql);

                            echo "<select id=\"text\"type=\"Event_ID\" name=\"Event_ID\"  class=\"form-control\">";
                            echo"<option value=\"\"> Event_ID </option>";
                            while ($row = $result -> fetch_assoc()) {
                              echo "<option value='".$row["Event_ID"]."'>".$row["Event_ID"]."</option>"; 
                            }
                            echo "</select><br>";
                          ?>
                    
                    <div class="form-group">
                        <input type="submit" value="Register" class="btn btn-outline-danger w 100">
                    </div>
                </form>
        </div>
    </div>
    <div>

    </div>
    </html>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>