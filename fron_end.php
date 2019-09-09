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
  <title>Home</title>
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
        <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-3">The Department of Disaster Management</h1>
    
  </div>
</div>
          <div class="row">
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


                  }
                  elseif (isset($_GET["Category"])) {
                    $Category=$_GET["Category"];
                    $ViewQuery="SELECT * FROM admin_panel WHERE category='$Category'";
                  }
                  elseif (isset($_GET["Page"])) {
                    $Page=$_GET["Page"];
                    if ($Page==0||$Page<1) {
                      $ShowPostFrom=0;
                    }else{
                    $ShowPostFrom = ($Page*3)-3;}
                    $ViewQuery="SELECT * FROM admin_panel LIMIT $ShowPostFrom,3";
                  }
                  else{
                      $ViewQuery="SELECT * FROM admin_panel LIMIT 0,3";}
                      $Execute = mysqli_query($Connection,$ViewQuery);
                      
                      while ($DataRows=mysqli_fetch_array($Execute)) {
                        $PostId = $DataRows["id"];
                        $DateTime=$DataRows["datetime"];
                        $Title = $DataRows["title"];
                        $Category = $DataRows["category"];
                        $Threat = $DataRows["threat"];
                        $Admin = $DataRows["author"];
                        $Image = $DataRows["image"];
                        $Post = $DataRows["post"];
                  ?>
                  <div class="card " id="cardS">
                      <div class="card-header">
                        
                      </div>
                      <div class="card-body">
 
                        <img class="img-fluid" alt="Responsive image" src="upload/<?php echo $Image; ?>" width="727" height="200">
                        <h1 class="card-title text-center"><?php echo htmlentities($Title);?></h1>
                       <h5 class="description text-center" ><?php echo htmlentities($Category);?></h5>
                        <h4 class="card-title" id="post"><?php
                            if (strlen($Post)>150) {
                              $Post=substr($Post, 0,250).'...';
                            }
                           echo $Post; ?></h4>
                        
                        <p class="card-text text-center"><small class="text-muted">Published on: <?php echo htmlentities($DateTime)?></small></p>
                        
                      </div>
                      <div class="card-footer text-muted">
                        <?php if("Low" == $Threat){?>
                        <a href="full_post.php?id=<?php echo $PostId; ?>"
                         class="btn  btn-block" style="background-color: Green; color: white;" >Read More</a>
                         <?php } else if("Guarded" == $Threat){?>
                         <a href="full_post.php?id=<?php echo $PostId; ?>"
                         class="btn  btn-block" style="background-color: Blue; color: white;" >Read More</a>
                         <?php } else if ("Elevated" == $Threat){?>
                         <a href="full_post.php?id=<?php echo $PostId; ?>"
                         class="btn  btn-block" style="background-color: Yellow; color: black;">Read More</a>
                         <?php } else if ("High" == $Threat){?>
                         <a href="full_post.php?id=<?php echo $PostId; ?>"
                         class="btn btn-primary btn-block" style="background-color: Orange; color: white;">Read More</a>
                         <?php } else if ("Severe" == $Threat) {?>
                         <a href="full_post.php?id=<?php echo $PostId; ?>"
                         class="btn  btn-block" style="background-color: red; color: white; ">Read More</a>
                         <?php }?>
                      </div>
                    </div>
                   <?php }
                    ?>
                   
            
            <nav aria-label="Page navigation example">
                        <ul class="pagination pull-left pagination-lg">
                             <?php
                             global $Connection;
                             $ViewQuery="SELECT COUNT(*) FROM admin_panel ";
                            $Execute = mysqli_query($Connection,$ViewQuery);
                            $Row=mysqli_fetch_array($Execute);
                            $TotalPost=array_shift($Row);
                            $PostPerPage=$TotalPost/3;
                            $PostPerPage=ceil($PostPerPage);
                            for ($i=1; $i <=$PostPerPage; $i++) { 
                              if(isset($Page)){
                              if ($i==$Page) {

                             ?>
                             <li class="active page-item" ><a class="page-link" href="fron_end.php?Page=<?php echo $i; ?>"><?php echo $i;?></a></li>
                             <?php }
                             else{ ?>
                             <li class="page-item"><a class="page-link" href="fron_end.php?Page=<?php echo $i; ?>"><?php echo $i;?></a></li>
                             <?php
                             }
                            }
                             } ?>
                       </ul>
                       </nav>
            </div>







            <div class="col-sm-4">
              <div class="card border-primary mb-3 hidden-md-down" style="max-width: 40rem;">
                <div class="card-header text-center"><h2>Category</h2></div>
                <div class="card-body text-primary">
                  <?php
                    global $Connection;
                    $ViewQuery="SELECT * FROM category";
                    $Execute = mysqli_query($Connection,$ViewQuery);
                    
                    while ($DataRows=mysqli_fetch_array($Execute)) {
                      $Id = $DataRows["id"];
                      $Category=$DataRows["name"];
                      
                    ?>
                    <h4 class=" text-center ">
                    <p  href="Blog.php?Category=<?php echo $Category; ?>">
                    <span ><?php echo $Category."<br>"; ?></span>
                    </p></h4>
                    <?php } ?>
                </div>
            </div>
            <div class="card border-primary mb-3 hidden-md-down text-center" style="max-width: 40rem;">
              <div class="card-header"><h1>Thread Level</h1></div>
              <div class="card-body text-primary text-center">
                
                <h4 style="background-color: red; color: white;">Severe</h4>
                <h4 style="background-color: Orange; color: white;" >High</h4>
                <h4 style="background-color: Yellow; color: black;">Elevated</h4>
                <h4 style="background-color: Blue; color: white;">Guarded</h4>
                <h4 style="background-color: Green; color: white;">Low</h4>
              </div>
          </div>
      </div>
</div>
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