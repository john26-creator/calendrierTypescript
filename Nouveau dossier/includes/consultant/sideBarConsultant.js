var DispatcherPath = "../controllers/DispatcherConsultant.php";

function setEntreprise (idEntreprise) {
	$.post(DispatcherPath,
	        {
				fonction: "setEntreprise",
				id_entreprise: idEntreprise
			},
	    function(data, status){
				document.location.reload(true);
			});
}

function connexion (event) {
	traitementConnexion(event,
			DispatcherPath,
			location.protocol+'//' + window.location.hostname + "/consultant/ecranConsultant.php",
			location.protocol+'//' + window.location.hostname + "/consultant/renouvlerMotDePasseConsultant.php",
			'<div class="alert alert-danger">Identifiants incorrects <br/> <a class="stretched-link" href="/consultant/envoyerMotDePasseConsultant.php" temp_href="indexConsultant.php">Renouveler</a><br/><br/></div>');
}

function sendRenewPasswordMail(event) {
	traitementSendRenewPasswordMail(event,
			DispatcherPath,
			location.protocol+'//' + window.location.hostname + "/consultant/indexConsultant.php");
}

function renouvelerMotDePasse (event) {
	traitementRenouvelerMotDePasse(event,
			DispatcherPath,
			location.protocol+'//' + window.location.hostname + "/consultant/indexConsultant.php");
}

function deconnexion () {
	traitementDeconnexion(DispatcherPath,
			location.protocol+'//' + window.location.hostname + "/consultant/indexConsultant.php");
}

function formEntreprise () {
	$.post(DispatcherPath, 
		     {
			 	fonction : "formEntreprise",
			 },
				function(data){
				 $("#mainContainer").html(data);
			});
}

function updateSuiviEntreprise (event) {
	event.preventDefault();
	$.post(DispatcherPath, 
	     {
		 	fonction : "updateSuiviEntreprise",
		 	bilan : $('#bilan').val(),
		 	week: $('#semaine').val()
		 },
			function(data){
			 if (data == "success") {
				 $("#mainContainer").html("Entreprise mise &agrave; jour</br></br></br></br>");
			 }
			 else {
				 $("#mainContainer").html("Une erreur s'est produite lors de la mise &agrave; jour</br></br></br></br>");
			 }
		});
}

function relancerMBI () {
	$.post(DispatcherPath, 
		     {
			 	fonction : "relancerMBI",
			 },
				function(data){
				 if (data == "success") {
					 $("#mainContainer").html("Relance effectu&eacute;e</br></br></br></br>");
				 }
				 else {
					 $("#mainContainer").html("Une erreur s'est produite lors de l'envoie de mail</br></br></br></br>");
				 }
			});
	
}

function relancerSuivi () {
		$.post(DispatcherPath, 
			     {
				 	fonction : "relancerSuivi",
				 },
					function(data){
					 if (data == "success") {
						 $("#mainContainer").html("Relance effectu&eacute;e</br></br></br></br>");
					 }
					 else {
						 $("#mainContainer").html("Une erreur s'est produite lors de l'envoie de mail</br></br></br></br>");
					 }
				});
		
}