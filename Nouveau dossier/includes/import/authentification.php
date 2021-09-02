    <div id="main" class="main col-xs-12 col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3">
<div style="margin-left: 4%; margin-right: 4%;">
        <form class="form-signin" method="POST" onsubmit="connexion (event);">
            
            <div class="form-group">
                <br/>
                <h1 class="h3 center mb-3 font-weight-normal">
                <?php 
                if (strpos($_SERVER['PHP_SELF'] , 'Employeur') !== false) {
                    echo'<div align="center"><div style="font-size:45px;padding: 10px 10px 10px;"><i class="fas fa-user-tie"></i></div></div>'; 
                } else if (strpos($_SERVER['PHP_SELF'] , 'Employe') !== false) {
                    echo'<div align="center"><div style="font-size:45px;padding: 10px 10px 10px;"><i class="fas fa-users"></i></div></div>';
                } else if (strpos($_SERVER['PHP_SELF'] , 'Consultant') !== false) {
                    echo'<div align="center"><div style="font-size:45px;padding: 10px 10px 10px;"><i class="fas fa-user-edit"></i></div></div>';
                } else {
                    echo'<div align="center"><div style="font-size:45px;padding: 10px 10px 10px;"><i class="fas fa-user-cog"></i></div></div>';
                }
                ?>
                
                </h1>
                <br/>
            </div>
            
                <label for="login" class="sr-only">Email address</label>
                <input type="email" id="login" name="login" class="form-control" placeholder="Email address" required="" autofocus="" style="margin-bottom:20px;">
            
            

                <label for="motdepasse" class="sr-only">Password</label>
                <input type="password" id="motdepasse" name="motdepasse" class="form-control" placeholder="Password" required="">
                
            <div class="checkbox mb-3">
                <label>
                  <input type="checkbox" value="remember-me"> Remember me </label>
              </div>
            <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="Sign in"/>
            <p class="mt-5 mb-3 text-muted">© 2020</p>
        </form>
        </div>
</div>

        <div id="mainContainer"> </div>