<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php 
if (isset($_POST["Submit"])) {
  $Username = mysqli_real_escape_string($Connection,$_POST["Username"]);
  $Password = mysqli_real_escape_string($Connection,$_POST["Password"]);
  
  if (empty($Username)||empty($Password) ) {
    $_SESSION["ErrorMessage"] = "All Fields must  be filled out";
    Redirect_to("login.php");
  }
  
  else{
    $Found_Account=Login_Attempt($Username ,$Password);
    if ($Found_Account) {
      $_SESSION["User_Id"]=$Found_Account["id"];
      $_SESSION["Username"]=$Found_Account["username"];
      $_SESSION["SuccessMessageLogin"]="Welcome {$_SESSION["Username"]}";
      Redirect_to("index.php");
    }
    else{
      $_SESSION["ErrorMessage"]="Invalid Username / Password";
      Redirect_to("login.php");
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Blogen Admin Area</title>
</head>
<body>
 
  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1><i class="fa fa-user"></i> The Department of Disaster Management</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="actions" class="py-4 mb-4 bg-faded">
    <div class="container">
      <div class="row">

      </div>
    </div>
  </section>

  <!-- LOGIN -->
  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div><?php echo Message();?></div>
          <div class="card">
            <div class="card-header">
              <h4>Account Login</h4>
            </div>
            <div class="card-block">
              <form action="login.php" method="post">
                <div class="form-group">
                  <label for="email" class="form-control-label">Email</label>
                  <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
                </div>
                <div class="form-group">
                  <label for="password" class="form-control-label">Password</label>
                  <input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
                </div>
                <input class="btn btn-primary btn-block" type="Submit" name="Submit" value="Login">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

 


  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('editor1');
  </script>
</body>
</html>
