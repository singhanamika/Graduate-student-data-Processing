<!DOCTYPE html>
<?php

$mysqli = new mysqli("localhost", "root");
$databaseSelect = 'userauthdb';
$error = "";
$username = "";
$password = "";
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }

$db = mysqli_select_db ($mysqli, $databaseSelect);

if (! $db) {
  echo "no db";
  
}
  if (isset($_POST['submit'])) {

    if (empty(($_POST['lg_username'])) || empty(($_POST['lg_password']))){
      $error = "Username or Password is invalid";

    }
    else{

    $username=$_POST['lg_username'];
    $password=$_POST['lg_password'];

    $query = "select * from login where password='$password' and username='$username'";
    $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
      // Initializing Session
      header("location: pages/landingPage.html"); // Redirecting To Other Page
  } 
    else {
      $error = "Username or Password is invalid";
  }
  mysqli_close($mysqli);
  }
}

?>

<html>
  <head>
      <title>Graduate Outcome Data Processing</title>
      <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
      
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <h4 class="h4">GODP</h4>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right">
              <a type="link" class="btn btn-primary" href="../index.html" role="button" disabled>Home</a>
              <a type="link" class="btn btn-primary" href="dataVerify.php" role="button" disabled>Data Editing</a>
              <a type="link" class="btn btn-primary" href="#" role="button" disabled>Dashboard</a>
              <a type="link" class="btn btn-primary" href="graphGeneration.html" role="button" disabled>Graph Generation</a>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav> <!-- /Nav -->

 <div class="jumbotron">
      <div class="container" >
        <h1>Welcome to GODP</h1>
        <h3>(Graduate Outcome Data Processing)</h3>
      </div>
    </div>

    <div class="container">
 <div class="text-center col-xl-6 col-md-6 col-xs-6 ">
  <h4>Login</h4>
  <!-- Main Form -->
  <div class="login-form-1">

    <form id="login-form" class="text-left" method = "POST">

      <div class=""></div>
      <div class="main-login-form">
        <div class="login-group">
          <div class="form-group">
            <label for="lg_username" class="sr-only">Username</label>
            <input type="text" class="form-control" id="lg_username" name="lg_username" placeholder="Username">
          </div>
          <div class="form-group">
            <label for="lg_password" class="sr-only">Password</label>
            <input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="Password">
          </div>
          <div class="form-group login-group-checkbox">
            <input type="checkbox" id="lg_remember" name="lg_remember">
            <label for="lg_remember">Remember</label>
          </div>
        </div>
        <input class="btn" type="submit" name = "submit" value = ">" class="login-button"></i></input>
        <span><?php echo $error; ?></span>
      </div>
      <div>
        <p>Forgot Your Password? <a href="#">Click Here</a></p>
        <p>New User? <a href="pages/register.php">Create New Account</a></p>
      </div>
    </form>
  </div>
  <!-- end:Main Form -->
</div>
      

      <nav class="navbar navbar-default navbar-fixed-bottom">
        <p>&copy; Pace University - Career Services Center</p>
      </nav>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript ================================================== -->
    <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
    <script src="javascripts/basicJs.js"></script>    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>