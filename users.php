<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php Confirm_Login(); ?>
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
  <nav class="navbar navbar-toggleable-sm navbar-inverse bg-inverse p-0">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item px-2">
            <a href="index.php" class="nav-link">Dashboard</a>
          </li>
          
          <li class="nav-item px-2">
            <a href="categories.php" class="nav-link">Categories</a>
          </li>
          <li class="nav-item px-2">
            <a href="users.php" class="nav-link active">Users</a>
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

  <header id="main-header" class="py-2 bg-warning text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1><i class="fa fa-users"></i> Users</h1>
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

<div class="container"><?php echo SuccessMessage();?></div>
  <!-- POSTS -->
  <section id="users">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Users</h4>
            </div>
            <table class="table table-striped">
              <thead class="thead-inverse">
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Admin Name</th>
                  <th>Added By</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
            global $Connection;
            $ViewQuery="SELECT * FROM registration";
            $Execute = mysqli_query($Connection,$ViewQuery);
            $Count=0;
            while ($DataRows=mysqli_fetch_array($Execute)) {
              $Id = $DataRows["id"];
              $DateTime=$DataRows["datetime"];
              $Username = $DataRows["username"];
              $Admin=$DataRows["addedby"];
              $Count++;
            ?>
            <tr>
              <td><?php echo $Count; ?></td>
              <td><?php echo $DateTime; ?></td>
              <td><?php echo $Username; ?></td>
              <td><?php echo $Admin; ?></td>
              <td>
                <a href="deleteadmin.php?id=<?php echo $Id;?>">
                  <span class="btn btn-danger">Delete</span>
                </a>
              </td>
            </tr>
            <?php } ?>
              </tbody>
            </table>

           
          </div>
        </div>
      </div>
    </div>
  </section>

  


  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  
</body>
</html>
