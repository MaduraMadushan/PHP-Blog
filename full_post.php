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
  <link rel="stylesheet" href="css/fron_end.css">
  <link rel="stylesheet" href="css/full_post.css">
   <script type="text/javascript" src="js/googlemap.js"></script>
   
  <title>Blogen Admin Area</title>
  <style>
        @media (max-width: 576px) {
          nav .container{
            width:100%;
          }
        }
    </style>
</head>
<body>
   <nav class="navbar navbar-light navbar-toggleable-md bg-primary navbar-inverse">
        <div class="container">
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
          
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="fron_end.php?Page">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="about.php">About</a>
                  </li>
                  
                  <li class="nav-item">
                      <a class="nav-link" href="#contact">Contact</a>
                  </li>
              </ul>

              <form class="form-inline">
                <input type="text" class="form-control" name="Search" placeholder="Search">
                <button class="btn btn-outline-success" name="SearchButton">Search</button>
              </form>
            </div>
          </div>
    </nav>
        <br> 
      <div class="container">
        <div class="row">
          <div class="col-sm-2">
          </div>
            <div class="col-sm-8">
        <?php 
        global $Connection;
        if (isset($_GET["SearchButton"])) {
          $Search=$_GET["Search"];
          $ViewQuery="SELECT * FROM admin_panel WHERE
          datetime LIKE '%$Search%' OR 
          title LIKE '%$Search%' OR
          category LIKE '%$Search%' OR
          post LIKE '%$Search%'
          ";


        }else{
          $PostIDFromURL=isset($_GET['id']) ? $_GET['id'] : '';
            $ViewQuery="SELECT * FROM admin_panel WHERE id='$PostIDFromURL'";}
            $Execute = mysqli_query($Connection,$ViewQuery);
            
            while ($DataRows=mysqli_fetch_array($Execute)) {
              $PostId = $DataRows["id"];
              $DateTime=$DataRows["datetime"];
              $Title = $DataRows["title"];
              $Category = $DataRows["category"];
              $Admin = $DataRows["author"];
              $Lat = $DataRows["lat"];
              $Long = $DataRows["longn"];
              $Image = $DataRows["image"];
              $Post = $DataRows["post"];
        ?>
        
         <div class="card mb-3">
          <img id="imagehead" class="img-fluid" alt="Responsive image" src="Upload/<?php echo $Image; ?>" >
          <div class="card-body">
            <h1 class="card-title text-center"><?php echo htmlentities($Title);?></h1>
            <p class="description">Category : <?php echo htmlentities($Category);?>
            Published on : <?php echo htmlentities($DateTime)?> </p>
            
            <p class="post"><?php
            
           echo nl2br($Post); ?></p>
            <div id="map">
            </div>
            <script>
                  function initMap() {
                    var colombo = {lat: <?php $Lat;?>, <?php $Long;?>};
                    var map = new google.maps.Map(document.getElementById('map'), {
                      zoom: 10,
                      center: colombo
                    });
                    var marker = new google.maps.Marker({
                      position: colombo,
                      map: map
                    });

                  }
                </script>
                <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDr5ijf1AweMNS1VtBN5ccIWsvQacWJRBo&callback=initMap">
                </script>
        </div>
        
        </div>
        <?php }
         ?>
          </div>
          </div >
            </div>
    
<footer id="contact">
  <div id="bcColour">
    <div class="footer alert-primary " id="footer" >
        
            <div class="row">
                <div class="col-sm-4">
                    <h3> General Office </h3>
                    <ul>
                        <li> <a href="#"> Vidya Mawatha, Colombo 07. </a> </li>
                        <li>  <a href="#">Tel  :   +94-112-665170</a></li>
                        <li> <a href="#"> Fax  :   +94-112-665170</a> </li>
                        
                    </ul>
                </div>
                <div class="col-sm-4 ">
                    <h3> National Council for Disaster Management</h3>
                    <ul>
                        <li> <a href="#"> Vidya Mawatha, Colombo 07.
                              Director </a> </li>
                        <li> <a href="#"> Tel   : +94-112-665185  </a> </li>
                        <li> <a href="#"> Fax  : +94-112-665098 </a> </li>
                        
                    </ul>
                </div>
                <div class=" col-sm-4 ">
                    <h3> Contact Details of the Ministry</h3>
                    <ul>
                        <li> <a href="#"> Hon. Anura Priyadarshana Yapa(Minister)</a> </li>
                        <li> <a href="#">  Tel   : +94-112-665404 </a> </li>
                        <li> <a href="#"> Fax  : +94-112-665280 </a> </li>
                        
                    </ul>
                </div>
                
               
            </div>
            <!--/.row--> 
        
        <!--/.container--> 
    </div>
    <!--/.footer-->
    
    </div>
    <!--/.footer-bottom--> 
</footer>

  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  
</body>
</html>