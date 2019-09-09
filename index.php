<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php Confirm_Login(); ?>
<?php 
if (isset($_POST["Submit"])) {
  $Category = mysqli_real_escape_string($Connection,$_POST["Category"]);
  date_default_timezone_get("Asia/Colombo");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S", $CurrentTime );
  $DateTime;
  $Admin=$_SESSION["Username"];
  if (empty($Category)) {
    $_SESSION["ErrorMessage"] = "All Fields must  be filled out";
    Redirect_to("index.php");
  }
  else if(strlen($Category)>99) {
    $_SESSION["ErrorMessage"] = "Too Long Name";
    Redirect_to("index.php");
  }
  else{
    global $Connection;
    $Query = "INSERT INTO category(datetime,name,creatorname) VALUES('$DateTime','$Category','$Admin')";
    $Execute = mysqli_query($Connection,$Query);
    if($Execute){
      $_SESSION["SuccessMessage"]= "Category Added Successfully";
      Redirect_to("categories.php");
    }
    else{
      $_SESSION["ErrorMessage"] = "Categoty failed to Add";
      Redirect_to("index.php");
    }
  }
}
?>
<?php 
if (isset($_POST["SubmitP"])) {
  $Title = mysqli_real_escape_string($Connection,$_POST["TitleP"]);
  $Category = mysqli_real_escape_string($Connection,$_POST["CategoryP"]);
  $Threat = mysqli_real_escape_string($Connection,$_POST["CategoryP2"]);
  $Post = mysqli_real_escape_string($Connection,$_POST["PostP"]);
  $Lat = mysqli_real_escape_string($Connection,$_POST["lat"]);
  $Long = mysqli_real_escape_string($Connection,$_POST["long"]);
  date_default_timezone_get("Asia/Colombo");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y", $CurrentTime );
  $DateTime;
  $Admin=$_SESSION["Username"];
  $Image=$_FILES["ImageP"]["name"];
  $Target="upload/".basename($_FILES["ImageP"]["name"]);
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
    $Query = "INSERT INTO admin_panel(datetime,title,category,threat,author,lat,longn,image,post) VALUES('$DateTime','$Title','$Category','$Threat','$Admin','$Lat','$Long','$Image','$Post')";
    $Execute = mysqli_query($Connection,$Query);
    move_uploaded_file($_FILES["ImageP"]["tmp_name"], $Target);
    if($Execute){
      $_SESSION["SuccessMessagePost"]= "Post Added Successfully";
       Redirect_to("index.php");
    }
    else{
      $_SESSION["ErrorMessage"] = "Something Went Wrong. Try Again !";
      Redirect_to("index.php");
    }
  }
}
?>
<?php 
if (isset($_POST["Submit2"])) {
  $Username = mysqli_real_escape_string($Connection,$_POST["Username"]);
  $Password = mysqli_real_escape_string($Connection,$_POST["Password"]);
  $ConfirmPassword = mysqli_real_escape_string($Connection,$_POST["ConfirmPassword"]);
  date_default_timezone_get("Asia/Colombo");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y", $CurrentTime );
  $DateTime;
  $Admin=$_SESSION["Username"];
  if (empty($Username)||empty($Password)||empty($ConfirmPassword) ) {
    $_SESSION["ErrorMessage"] = "All Fields must  be filled out";
   Redirect_to("index.php");
  }
  else if(strlen($Password)<4) {
    $_SESSION["ErrorMessage"] = "Atleast 4 Characters For Password are Required";
    Redirect_to("Admins.php");
  }
  else if($Password!==$ConfirmPassword) {
    $_SESSION["ErrorMessage"] = "Password / Confirm Password does not match";
    Redirect_to("index.php");}
  else {
    global $Connection;
    $Query = "INSERT INTO registration(datetime,username,password,addedby) VALUES('$DateTime','$Username','$Password','$Admin')";
    $Execute = mysqli_query($Connection,$Query);
    if($Execute){
      $_SESSION["SuccessMessage"]= "Admin Added Successfully";
      Redirect_to("users.php");
    }
    else{
      $_SESSION["ErrorMessage"] = "Admin failed to Add";
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
  <title>Admin Area</title>
</head>
<body>
  <nav class="navbar navbar-toggleable-sm navbar-inverse bg-inverse p-0">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item px-2">
            <a href="index.html" class="nav-link active">Dashboard</a>
          </li>
          
          <li class="nav-item px-2">
            <a href="categories.php" class="nav-link">Categories</a>
          </li>
          <li class="nav-item px-2">
            <a href="users.php" class="nav-link">Users</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
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
          <h1><i class="fa fa-gear"></i> Dashboard</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="actions" class="py-4 mb-4 bg-faded">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addPostModal"><i class="fa fa-plus"></i> Add Post</a>
        </div>
        <div class="col-md-3">
          <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#addCategoryModal"><i class="fa fa-plus"></i> Add Category</a>
        </div>
        <div class="col-md-3">
          <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#addUserModal"><i class="fa fa-plus"></i> Add User</a>
        </div>
        <div class="col-md-3">
          <a href="fron_end.php?Page" target="_blank">
                  <span class="btn btn-primary btn-block">
                    home
                  </span>
                </a>
        </div>
      </div>
    </div>
  </section>

  <div class="container"><?php echo Message();?></div>
  <div class="container"><?php echo SuccessMessagepost();?></div>
  
  <div class="container"><?php echo SuccessMessagelogin();?></div>
  <!-- POSTS -->
  <section id="posts">
    <div class="container">
      
          <div class="card">
            <div class="card-header">
              <h4>Latest Posts</h4>
            </div>
            <table class="table table-striped ">
              <thead class="thead-inverse">
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Date</th>
                  <th>Author</th>
                  <th>Category</th>
                  
                  <th>Image</th>
                  <th>Action</th>
                  <th>Preview</th>
                  
                  
                </tr>
              </thead>
              <tbody>
                
                <tr>
                  <?php 
                    global $Connection;
                    $ViewQuery="SELECT * FROM admin_panel";
                    $Execute = mysqli_query($Connection,$ViewQuery);
                    $count=0;
                    while ($DataRows=mysqli_fetch_array($Execute)) {
                      $Id = $DataRows["id"];
                      $DateTime=$DataRows["datetime"];
                      $Title = $DataRows["title"];
                      $Category = $DataRows["category"];
                      $Admin = $DataRows["author"];
                      $Image = $DataRows["image"];
                      $Post = $DataRows["post"];
                      $count++;
                    ?>
                  <tr>
              <td><?php echo $count; ?></td>
              <td><?php 
              if (strlen($Title)>20) {
                $Title = substr($Title, 0,20).'..';
              }
              echo $Title; 
              ?></td>
              <td><?php
              if (strlen($DateTime)>11) {
                $DateTime = substr($DateTime, 0,11).'..';
              }
               echo $DateTime; 
               ?></td>
              <td><?php
              if (strlen($Admin)>6) {
                $Admin = substr($Admin, 0,6).'..';
              }
               echo $Admin; 
               ?></td>
              <td><?php echo $Category; ?></td>
              <td><img src="upload/<?php echo $Image; ?>" width="170" height="50px"></td>
              
              <td>
                <a href="details.php?Edit=<?php echo $Id; ?>">
                  <span class="btn btn-warning">
                    Edit
                  </span>
                </a>
                <a href="delete.php?Delete=<?php echo $Id; ?>">
                  <span class="btn btn-danger">
                    Delete
                  </span>
                </a>
              </td>
              <td>
                <a href="full_post.php?id=<?php echo $Id; ?>" target="_blank">
                  <span class="btn btn-primary">
                    Live Preview
                  </span>
                </a>
              </td>
            </tr>
            <?php } ?>
              </tbody>
            </table>
          </div>
       
        
      
    </div>
  </section>

 


  <!-- ADD POST MODAL -->
  <div class="modal fade" id="addPostModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="addPostModalLabel">Add Post</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div>
          <form action="index.php" method="post" enctype="multipart/form-data">
            <fieldset>
              <div class="form-group">
                <label for="title"><span class="FieldInfo">Title:</span></label>
                <input class="form-control" type="text" name="TitleP" id="title" placeholder="Title">
              </div>
              <div class="form-group">
                <label for="categoryselect"><span class="FieldInfo">Category:</span></label>
                <select class="form-control" id="categoryselect" name="CategoryP">
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
                <label for="title"><span class="FieldInfo">lat:</span></label>
                <input class="form-control" type="text" name="lat" id="title" placeholder="Title">
              </div>
              <div class="form-group">
                <label for="title"><span class="FieldInfo">long:</span></label>
                <input class="form-control" type="text" name="long" id="title" placeholder="Title">
              </div>
              <div class="form-group">
                <label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
                <input type="File" class="form-control" name="ImageP" id="imageselect">
              </div>
              <div class="form-group">
                <label for="postarea"><span class="FieldInfo">Post:</span></label>
                <textarea  class="form-control" name="PostP" id="postarea"></textarea>
              </div>
              <br>
              <input class="btn btn-primary btn-block"  type="Submit" name="SubmitP" value="Add New Post">
            </fieldset>
              <br>
          </form>
        </div>
        </div>
       
      </div>
    </div>
  </div>

  <!-- ADD CATEGORY MODAL -->
  
  <div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        
          <div class="modal-body">
            <div>
              <form action="index.php" method="post">
                <fieldset>
                  <div class="form-group">
                    <label for="Categoryname"><span class="FieldInfo">Name:</span></label>
                    <input class="form-control" type="text" name="Category" id="Categoryname" placeholder="Name">
                  </div>
                  <br>
                  <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Category">
                </fieldset>
                  <br>
              </form>
            </div>
            
          </div>
        
      </div>
    </div>
  </div>

  <!-- ADD USER MODAL -->
  <div class="modal fade" id="addUserModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div>
          <form action="index.php" method="post">
            <fieldset>
              <div class="form-group">
                <label for="Username"><span class="FieldInfo">UserName:</span></label>
                <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
              </div>
              <div class="form-group">
                <label for="Password"><span class="FieldInfo">Password:</span></label>
                <input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="ConfirmPassword"><span class="FieldInfo">Confirm Password:</span></label>
                <input class="form-control" type="Password" name="ConfirmPassword" id="ConfirmPassword" placeholder="Retype same Password">
              </div>
              <br>
              <input class="btn btn-warning btn-block" type="Submit" name="Submit2" value="Add New Admin">
            </fieldset>
              <br>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  
</body>
</html>
