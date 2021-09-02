<html>
    <head>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/import/importBootstrapJquerryCSS.php");?>
       
        <link rel="icon" href="../logoIco.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

    .service{
    background-color: #f7f7f7;
    border: 1px solid #e4e8ea;
    text-align: center;
    border-radius: 5px;
    padding: 20px 20px 40px;
    margin-bottom: 20px;
    
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



</style>
<!-- font awesome Icons-->
<script src="https://kit.fontawesome.com/3e8af49a76.js" crossorigin="anonymous"></script>

    </head>
    <body>
        <div class="header">
           <div align="center"><img src="LOGO.png"/></div>
        </div>
        <div class="container">
            
            <div class="row" style="margin-top: 70px; margin-left:10px; margin-right: 10px;">
                <div id="1" class="col-sm-12 col-md-12 col-lg-4">
                    
                    <a href="employeur/indexEmployeur.php"><div class="service card-body">
                        <div style="font-size:45px;padding: 20px 20px 20px;"><i class="fas fa-user-tie"></i></div>
                        <p class="card-text"> Espace Organisation </p>   
                    </div></a>
                </div>
            
                <div  id="2" class="col-sm-12 col-md-12 col-lg-4">
                <a href="employe/indexEmploye.php"> 
                    <div class="service  card-body">
                        <div style="font-size:45px;padding: 20px 20px 20px;"><i class="fas fa-users"></i></div>
                        <p class="card-text"> Espace Locataire </p>
                    </div>
                </a>
                </div>
                               
                <div id="4" class="col-sm-12 col-md-12 col-lg-4">
                    <a href="backend/index.php">
                    <div class="service  card-body">
                        <div style="font-size:45px;padding: 20px 20px 20px;"><i class="fas fa-user-cog"></i></div>
                        <p class="card-text"> Espace Administrateur</p>
                    </div>
                </a>
                </div>
            </div>
            
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"); ?>
    </body>
</html>
        