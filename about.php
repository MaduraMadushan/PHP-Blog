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
        <br>
        <div>
        <h2>Vision</h2>
        <h4>Towards a safer Sri Lanka</h4>
        </div>
         <br>
         <div>
        <h2>Mission</h2>
        <h4>To facilitate harmony and the prosperity and dignity of human life through effective prevention and mitigation of natural and man-made disasters in Sri Lanka</h4>
        </div>
         <br>
        <div>
        <h2>Objectives</h2>
        <h4>Protection of the Community from Disasters</h4>
        </div>
         <br>
        <div>
        <h2>Operative Structure</h2>
        <h4>Following Institutions are functioning under the Ministry for the Implementation of government policies to achieve these objectives.</h4>
        <ul>
          <li><h5>  Department of Meteorology <a href="http://www.meteo.gov.lk/">www.meteo.gov.lk</a></h5></li>
          <li><h5>Disaster Management Centre <a href=" http://www.dmc.gov.lk/">www.meteo.gov.lk</a></h5></li>
          <li><h5>  National Building Research Organisation <a href=" http://www.nbro.gov.lk/">www.meteo.gov.lk</a></h5></li>
          <li><h5>  National Disaster Relief Services Centre <a href=" http://www.ndrsc.gov.lk/">www.meteo.gov.lk</a></h5></li>
        </ul> 
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