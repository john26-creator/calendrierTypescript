<?php 
if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
?>
<html>
    <head>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/import/importBootstrapJquerryCSS.php");?>
        <script src="../includes/common.js"></script>
        <script src="../includes/employe/sideBarEmploye.js"></script>
        <link rel="icon" href="../logoIco.png" />
        <meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
-->
<script src="https://kit.fontawesome.com/3e8af49a76.js" crossorigin="anonymous"></script>


<style>
  
  body{
    height:auto;
    background-image:linear-gradient(#203a5d, #4ebac3);
    background-size: cover;
    background-repeat: no-repeat;
  }

.navbar {
    position: relative;
    padding-top: 40px;
}

.navbar img{

  width:490px;

}

@media screen and (max-width:600px)
{
.navbar{
  padding-top: 0px;
}
}
@media screen and (min-width:600px)
{
.navbar-brand {
    position: absolute;
    left: 50%;
    margin-left: -230px !important;  /* 50% of your logo width */
    display: block;
}

}

@media screen and (max-width:600px)
{
 .navbar img{
    width: 250px;
  }
}

.main{ 
  margin-top:10%;
  margin-bottom: 10%;
  padding: 20px;
  background-color:rgba(255,255,255,0.7); 
  border-radius: 7px;
}


    .service{
    background-color: #f7f7f7;
    border: 1px solid #e4e8ea;
    text-align: center;
    border-radius: 5px;
    padding: 20px 20px 20px;
    margin-bottom: 20px;
    margin-top: 20px;
    
    }

    .service:hover{
        transition-duration: 0.7s;
        box-shadow: 0px 0px 15px black;
    }

    .header{
        
        width:100%;
        height: auto;
        background-image:linear-gradient(to bottom, #203a5d, 70%, #4ebac3);
       /*background-color: red;*/

    }
   
img{
    display: block;
    max-height: 75%;
    max-width: 75%;
}
 
    

    a{
        color : #4ebac3;
    }

    a:hover{
        transition-duration: 0.7s;
        color : #203a5d;
    }
    a:link {

        text-decoration: none !important;
    }

#myform {
    position: relative;
    
    margin: auto;
}

#precedent, #suivant {

    cursor: pointer;
    transition: opacity 0.3s ease;
    opacity: 0.5;
    font-size: 30px;
    color: white;
    background-color: rgba(0, 0, 0, 0.8);
    padding-left: 15px;
    padding-right: 15px;
    margin-bottom: 80px;
    margin-top: -20px;
    margin-left:5px;
    margin-right:5px;
}

#precedent {
    left: 0;
}

#suivant {
    right: 0;
    float:right;
}

#precedent:hover,#suivant:hover {
    opacity: 1;
}

</style>
</head>
<body>



<nav class="navbar navbar-expand-lg navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">
    <img src="../../logo-header-corpscan.png"  alt="corp-scan">
  	</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <?php if (!isset ($_SESSION["idEmploye"])) : ?>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../../index.php">Retour</a>
      </li>

    </ul>
  <?php endif; ?>
    <?php
      if (isset ($_SESSION["idEmploye"])) {
      ?>
    <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="" onclick="deconnexion()">Deconnexion</a>
            </li>
        </ul>

      <?php } ?>
  </div>
</nav>

	<div class="container">
	
