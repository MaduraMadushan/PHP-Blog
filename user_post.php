
<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>

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
 
  <header id="main-header" class="py-2 bg-danger text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1><i class="fa fa-user"></i> </h1>
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

  
  <div class= "container">
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
  </div>
  

 


  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('editor1');
  </script>
</body>
</html>