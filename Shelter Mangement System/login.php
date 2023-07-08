<?php
session_start();
include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  //something was posted
  $user_name = $_POST['username'];
  $password = $_POST['password'];

  if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
  {

    //read from database
    $query = "select * from Management where First_Name = '$user_name' limit 1";
    $result = mysqli_query($con, $query);
   
    if($result)
    {
      if($result && mysqli_num_rows($result) > 0)
      {
        $user_data = mysqli_fetch_assoc($result);
        if($user_data['Pass'] === $password)
        {
          echo "gud password!";
          $_SESSION['user_id'] = $user_data['Management_ID'];
          header("Location: Admin\Dashboard.php");
          die;
        }
      }
    }
    echo "wrong username or password!";
  }
  else
  {
    echo "enter username or password!";
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
      <a class="navbar-brand" href="#">TWS</a>
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
          <li class="nav-item">
            <a class="nav-link active" href="#">Login <span class="sr-only">(current)</span></a>
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
    .screen{
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: linear-gradient(180deg,rgb(239, 243, 243),rgb(201, 56, 56));
        
    }
    .login{
        width:  450px;
        height: min-content;
        padding: 20px;
        border-radius: 12px;
        background: #fff;
        text-align: center;
    }
    .login h1{
        font-size: 35px;
        margin-bottom: 12px;
    }
    .login form{
        font-size: 20px;
        font-style: normal;
    }
    
    .login form .form-group{
        margin-bottom: 12px;
    }
    
    .login form input[type="submit"]
    {
        font-size: 20px;
        margin-top: 15px;
    } 
    </style>
    <div class="screen">
        <div class="login">
            <h1 class="text-center">Todds Welfare Society</h1>
            <br><br>
            <span id="msg" style="color: red;"></span>
                <form class="needs-validation" method="post" action="#">
                    <div class="form-group was validated">
                        <label class="form-label" for="username">Username: </label><br>
                        <input class="form-control" type="username" name="username" placeholder="UserName" class="form-control">
                    
                    </div>
                    <div class="form-group was validated">
                        <label class="form-label" for="password">Password: </label><br>
                        <input class="form-control" type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Login" class="btn btn-outline-danger w 100">
                    </div>
                </form>
        </div>
    </div>
    </html>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>