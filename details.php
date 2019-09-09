<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php 
if (isset($_POST["Submit"])) {
  $Title = mysqli_real_escape_string($Connection,$_POST["Title"]);
  $Category = mysqli_real_escape_string($Connection,$_POST["Category"]);
  $Threat = mysqli_real_escape_string($Connection,$_POST["CategoryP2"]);
  $Post = mysqli_real_escape_string($Connection,$_POST["Post"]);
  date_default_timezone_get("Asia/Colombo");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S", $CurrentTime );
  $DateTime;
  $Admin="John";
  $Image=$_FILES["Image"]["name"];
  $Target="upload/".basename($_FILES["Image"]["name"]);
  if (empty($Title)) {
    $_SESSION["ErrorMessage"] = "Title can't be empty";
    Redirect_to("index.php");
  }
  else if(strlen($Title)<2) {
    $_SESSION["ErrorMessage"] = "Title Should be at-least 2 Characters";
    Redirect_to("index.php");
  }
  else{
    global $Connection;
    $EditFromURL=$_GET['Edit'];
    $Query ="UPDATE admin_panel SET datetime='$DateTime',title='$Title',
    category='$Category', threat='$Threat',author='$Admin',image='$Image',post='$Post'
    WHERE id='$EditFromURL'";
    $Execute = mysqli_query($Connection,$Query);
    move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
    if($Execute){
      $_SESSION["SuccessMessagePost"]= "Post Update Successfully";
      Redirect_to("index.php");
    }
    else{
      $_SESSION["ErrorMessage"] = "Something Went Wrong. Try Again !";
       Redirect_to("index.php");
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
  <style type="text/css">
    .FieldInfo{
      background-color: yellow;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-toggleable-sm navbar-inverse bg-inverse p-0">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a href="index.html" class="navbar-brand mr-3">Blogen</a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item px-2">
            <a href="index.html" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item px-2">
            <a href="posts.html" class="nav-link">Posts</a>
          </li>
          <li class="nav-item px-2">
            <a href="categories.html" class="nav-link">Categories</a>
          </li>
          <li class="nav-item px-2">
            <a href="users.html" class="nav-link">Users</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown mr-3">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Welcome Brad</a>
            <div class="dropdown-menu">
              <a href="profile.html" class="dropdown-item">
                <i class="fa fa-user-circle"></i> Profile
              </a>
              <a href="settings.html" class="dropdown-item">
                <i class="fa fa-gear"></i> Settings
              </a>
            </div>
          </li>
          <li class="nav-item">
            <a href="login.html" class="nav-link">
              <i class="fa fa-user-times"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>Post One</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="actions" class="py-4 mb-4 bg-faded">
    <div class="container">
      <div class="row">
        <div class="col-md-3 mr-auto">
          <a href="index.php" class="btn btn-secondary btn-block"><i class="fa fa-arrow-left"></i> Back To Dashboard</a>
        </div>

        
      </div>
    </div>
  </section>

  <!-- POST EDIT -->
  <section id="edit-post">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Edit Post</h4>
            </div>
            <div class="card-block">
      <div>
          <?php 

          $SerachQueryParameter=$_GET['Edit'];
          global $Connection;
            $ViewQuery="SELECT * FROM admin_panel WHERE id='$SerachQueryParameter'";
            $Execute = mysqli_query($Connection,$ViewQuery);
            
            while ($DataRows=mysqli_fetch_array($Execute)) {
              $TitleUpdated = $DataRows["title"];
              $CategoryUpdated = $DataRows["category"];
              $ThreatUpdate = $DataRows["threat"];
              $ImageUpdated = $DataRows["image"];
              $PostUpdated = $DataRows["post"];
            }
          ?>
          <form action="details.php?Edit=<?php echo $SerachQueryParameter;?>" method="post" enctype="multipart/form-data">
            <fieldset>
              <div class="form-group">
                
                  
                <label for="title" class="form-control-label">Title</label>
                <input value="<?php echo $TitleUpdated; ?>" class="form-control" type="text" name="Title" id="title" placeholder="Title">
              </div>
              <div class="form-group">
                <span class="FieldInfo">Existing Category:</span>
                <?php echo $CategoryUpdated;?>
                <br>
                <label for="categoryselect">Category:</label>
                <select class="form-control" id="categoryselect" name="Category">
                  <?php 
                  global $Connection;
                  $ViewQuery="SELECT * FROM category";
                  $Execute = mysqli_query($Connection,$ViewQuery);
                  while ($DataRows=mysqli_fetch_array($Execute)) {
                    $Id = $DataRows["id"];
                    $CategoryName = $DataRows["name"];

                  ?>
                  <option><?php echo $CategoryName ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="categoryselect"><span class="FieldInfo">Existing Threat Level:</span>
                
                  <?php 
                  global $Connection;
                  $ViewQuery="SELECT * FROM admin_panel";
                  $Execute = mysqli_query($Connection,$ViewQuery);
                  while ($DataRows=mysqli_fetch_array($Execute)) {
                    $Threat = $DataRows["threat"];
                    if("Low" == $Threat){
                    ?>
                  <span style="background-color: Green;"><?php echo $Threat; ?></span>
                  <?php } else if("Guarded" == $Threat) {?>
                  
                  <span style="background-color: Blue;"><?php echo $Threat; ?></span>
                  <?php }else if ("Elevated" == $Threat) {?>
                  
                  <span style="background-color: Yellow;"><?php echo $Threat; ?></span>
                  <?php }else if ("High" == $Threat) {?>
                  
                  <span style="background-color: Orange;"><?php echo $Threat; ?></span>
                 <?php }else if ("Severe" == $Threat) {?>
                  
                  <span style="background-color: red;"><?php echo $Threat; ?></span>
                  <?php }?>
                  <?php } ?>
                    </label>  
                </div>
                <div class="form-group">
                <label for="categoryselect"><span class="FieldInfo">Threat Level:</span></label>
                <select class="form-control" id="categoryselect" name="CategoryP2">
                  
                      <option style="background-color: Green;"> Low</option>
                      <option style="background-color: Blue;">Guarded</option>
                      <option style="background-color: Yellow;">Elevated </option>
                      <option style="background-color: Orange;">High </option>
                      <option style="background-color: red;">Severe  </option>

                </select>
              </div>
              <div class="form-group">
                

                <span class="FieldInfo">Existing Image:</span>
                <img src="upload/<?php echo $ImageUpdated;?>" type="File" name="Image" id="imageselect" width=170px height=70px >
                <br>
                <label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
                <input type="File" class="form-control" name="Image" id="imageselect">

              </div>
              <div class="form-group">
                <label for="postarea">Post:</label>
                <textarea class="form-control" name="Post" id="postarea" height=150px>
                  <?php echo $PostUpdated; ?>
                </textarea>
              </div>
              <br>
              <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Update Post">
            </fieldset>
              <br>
          </form>
        </div>
         </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer id="main-footer" class="bg-inverse text-white mt-5 p-5">
    <div class="container">
      <div class="row">
        <div class="col">
          <p class="lead text-center">Copyright &copy; 2017 Blogen</p>
        </div>
      </div>
    </div>
  </footer>


  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  
</body>
</html>
