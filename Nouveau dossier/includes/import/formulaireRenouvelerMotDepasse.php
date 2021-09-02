<form class="form-signin needs-validation" novalidate method="post" onsubmit="renouvelerMotDePasse (event);">
	<img class="mb-4" src="../images/logo_allonge.jpeg" width="320" height="109">
	<h1 class="h3 mb-3 font-weight-normal">Changement de mot de passe</h1>
	<label for="motdepasse" class="sr-only">Mot de passe</label>
	<input type="password" 
		   minlength="8" 
		   id="motdepasse" 
		   name="motdepasse" 
		   class="form-control" 
		   placeholder="mot de passe" 
		   required=""
		   pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
	<div class="valid-feedback">Valide</div>
    <div class="invalid-feedback">Longueur minimale 8. dont au moins une majuscule et un nombre ou un caract&egrave;re sp&eacute;cial</div>	
	<div class="checkbox mb-3">
	<label for="confirmation" class="sr-only">Confirmation</label>
	<input type="password" 
		   minlength="8" 
		   id="confirmation" 
		   name="confirmation" 
		   class="form-control" 
		   placeholder="confirmation" 
		   required=""
		   pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
	<div class="valid-feedback">Valide</div>
    <div class="invalid-feedback">Longueur minimale 8. dont au moins une majuscule et un nombre ou un caract&egrave;re sp&eacute;cial</div>	
	<button type="submit" id="submit" class="btn btn-lg btn-primary btn-block" name="submit" >Renouveler</button>
	<p class="mt-5 mb-3 text-muted">© 2020</p>
</form>

<script type="text/javascript">
(function() {
	  'use strict';
	  window.addEventListener('load', function() {
	    // Fetch all the forms we want to apply custom Bootstrap validation styles to
	    var forms = document.getElementsByClassName('needs-validation');
	    // Loop over them and prevent submission
	    var validation = Array.prototype.filter.call(forms, function(form) {
	      form.addEventListener('submit', function(event) {
	        if (form.checkValidity() === false) {
	          event.preventDefault();
	          event.stopPropagation();
	        }
	        form.classList.add('was-validated');
	      }, false);
	    });
	  }, false);
	})();
</script>