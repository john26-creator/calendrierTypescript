<link rel="icon" href="../logoIco.png" />
<style type="text/css">
    body{
        height:auto;
        background-image:linear-gradient(#203a5d, #4ebac3);
        background-size: cover;
        background-repeat: no-repeat;
    }

    .main{
        margin-top:40%;
        margin-bottom: 10%;
        padding: 20px;
        background-color:rgba(255,255,255,0.7);
        border-radius: 7px;
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
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../../index.php">Accueil</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div id="header" class="row">
        <div class="col-lg-4 offset-lg-4 col-md-4 offset-md-4 col-xs-12 col-sm-12">
            <div id="main" class="main">
                <form class="form-signin" onsubmit="sendRenewPasswordMail (event);" method="post">

                    <h2 class="h3 mb-3 font-weight-normal"><div align="center">Envoi mot de passe</h2>
                    <label for="email" class="sr-only">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend" style="margin-bottom:20px;"><span class="input-group-text" aria-label="arobase">@</span></div><input type="email" placeholder="Adresse mail" name="mail" id ="email" class="form-control" placeholder="mot de passe" style="margin-bottom:20px;" required>

                        <button type="submit" name="oublie" class="btn btn-lg btn-primary btn-block">Envoyer</button>
                        <p class="mt-5 mb-3 text-muted"><div align="center">© 2020</p></div>
                </form>
            </div>
        </div>
        <div id="mainContainer"> </div>
    </div>
</div>
</body>
</html>