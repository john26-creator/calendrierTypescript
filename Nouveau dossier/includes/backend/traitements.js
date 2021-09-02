var DispatcherBackendPath = "../controllers/DispatcherBackend.php";

function deleteEntreprise (id) {
	if (confirm("Supprimer cette entreprise ?")) {
		$.post(DispatcherBackendPath, 
        {
			id : id,
			fonction : "deleteEntreprise"
		},
		function(data, status){
			if (status == "success") {
				alert("Entreprise supprimée");
				window.location.reload();
		}
	});
  }
}

function deleteConsultant (id) {
	if (confirm("Supprimer ce consultant ?")) {
		$.post(DispatcherBackendPath, 
        {
			id : id,
			fonction : "deleteConsultant"
		},
		function(data, status){
			if (status == "success") {
				alert("Consultant supprimé");
				window.location.reload();
		}
	});
  }
	
}

function displayCreerEntreprise () { 
	$.post(DispatcherBackendPath, 
    {
		fonction : "creerEntrepriseForm"
	},
    function(data, status){
	    if (status == "success") {
		  $("#mainContainer").html(data);
		}
	});
}

function setEntreprise (event, idEntreprise, idConsultant){
	var functionName = "";
	if(event.target.checked == true) {
		functionName = "setEntreprise";
	}
	else {
		functionName = "unSetEntreprise";
	}
	$.post(DispatcherBackendPath, 
		    {
				idEntreprise : idEntreprise,
				idConsultant : idConsultant,
				fonction : functionName
			},
		    function(data, status){
			});
}

function setDivision (event, idDivision, idEmploye){
	var functionName = "";
	if(event.target.checked == true) {
		functionName = "setDivision";
	}
	else {
		functionName = "unSetDivision";
	}
	$.post(DispatcherBackendPath, 
		    {
				idDivision : idDivision,
				idEmploye : idEmploye,
				fonction : functionName
			},
		    function(data, status){
			});
}



function displayCreerConsultant () {
	$.post(DispatcherBackendPath, 
		    {
				fonction : "displayCreerConsultant"
			},
		    function(data, status){
			    if (status == "success") {
				  $("#mainContainer").html(data);
				}
			});
}

function displayAjouterEmployeForm (idEntreprise) {
	$.post(DispatcherBackendPath, 
		    {
				id : idEntreprise,
				fonction : "displayAjouterEmployeForm"
			},
		    function(data, status){
			    if (status == "success") {
				  $("#mainContainer").html(data);
				}
			});
}

function createEmploye (event, idEntreprise) {
	event.preventDefault();
	$.post(DispatcherBackendPath, 
		    {
				id: $('input[name=id]').val(),
				email: $('input[name=email]').val(),
				fonction : "createEmploye"
		    },
		    function(data, status){
			    if (status == "success") {
			    	window.location.reload();
				}
			});
}

function displayEntrepriseForm (id) {
	$.post(DispatcherBackendPath, 
    {
		id : id,
		fonction : "displayEntrepriseForm"
	},
    function(data, status){
	    if (status == "success") {
		  $("#mainContainer").html(data);
		}
	});
}

function displayConsultantForm (id) {
	$.post(DispatcherBackendPath, 
		    {
				id : id,
				fonction : "displayConsultantForm"
			},
		    function(data, status){
			    if (status == "success") {
				  $("#mainContainer").html(data);
				}
			});
}

function displayConsultantEntreprises (id) {
	$.post(DispatcherBackendPath, 
		    {
				id : id,
				fonction : "displayConsultantEntreprises"
			},
		    function(data, status){
			    if (status == "success") {
				  $("#mainContainer").html(data);
				}
			});
}

$(document).ready(function (e) {
 $("#form").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
        url: "ajaxupload.php",
		type: "POST",
		data:  new FormData(this),
		contentType: false,
        cache: false,
		processData:false,
		beforeSend : function()
		   {
			//$("#preview").fadeOut();
			$("#err").fadeOut();
		   },
		success: function(data)
		   {
				if(data=='invalid')
				{
					// invalid file format.
					$("#err").html("Invalid File !").fadeIn();
				}
				else
				{
					 // view uploaded file.
					 $("#preview").html(data).fadeIn();
					 $("#form")[0].reset(); 
				}
			},
		error: function(e) 
			{
				$("#err").html(e).fadeIn();
			}          
		});
	}));
});

function updateEntreprise (event,id) {
	event.preventDefault();
	if (verifyMEForm($('input[name=email]').val(),$('input[name=password]').val())) {
		var fd = new FormData();
	    var files = $('#logoEntreprise')[0].files[0];
	    fd.append('file',files);
	    fd.append('id',id);
	    fd.append('entreprise',$('input[name=entreprise]').val());
	    fd.append('siret',$('input[name=siret]').val());
	    fd.append('ape',$('input[name=ape]').val());
	    fd.append('bilan',$('input[name=bilan]').val());
	    fd.append('semaine',$('input[name=semaine]').val());
	    fd.append('adresse',$('input[name=adresse]').val());
	    fd.append('dirigeant',$('input[name=dirigeant]').val());
	    fd.append('email',$('input[name=email]').val());
	    fd.append('password',$('input[name=password]').val());
	    fd.append('fonction',"updateEntreprise");
	
		$.ajax({
		    type: "POST",
		    url: DispatcherBackendPath,
		    data: fd,
		    processData: false,
		    contentType: false,
		    success:  function(data){
		    	if (data == "fail") {
		    		alert("Une erreur est survenue");
		    		
		    	}
		    	else {
		    		alert("Entreprise mise à jour");
					window.location.reload();
		    	}
			}
		});
	}
}

function updateConsultant (event,id) {
	event.preventDefault();
		var fd = new FormData();
	    fd.append('id',id);
	    fd.append('nom',$('input[name=nom]').val());
	    fd.append('prenom',$('input[name=prenom]').val());
	    fd.append('email',$('input[name=email]').val());
	    fd.append('fonction',"updateConsultant");
	
		$.ajax({
		    type: "POST",
		    url: DispatcherBackendPath,
		    data: fd,
		    processData: false,
		    contentType: false,
		    success:  function(data){
		    	if (data == "fail") {
		    		alert("Une erreur est survenue");
		    	}
		    	else {
		    		alert("Consultant mis à jour");
					window.location.reload();
		    	}
			}
		});
}


function creerEntreprise (event) {
	event.preventDefault();
	if (verifyCEForm($('input[name=email]').val(),$('input[name=password]').val())) {
		var fd = new FormData();
	    var files = $('#logoEntreprise')[0].files[0];
	    fd.append('file',files);
	    fd.append('entreprise',$('input[name=entreprise]').val());
	    fd.append('siret',$('input[name=siret]').val());
	    fd.append('ape',$('input[name=ape]').val());
	    fd.append('adresse',$('input[name=adresse]').val());
	    fd.append('dirigeant',$('input[name=dirigeant]').val());
	    fd.append('email',$('input[name=email]').val());
	    fd.append('password',$('input[name=password]').val());
	    fd.append('fonction',"creerEntreprise");
	
		$.ajax({
		    type: "POST",
		    url: DispatcherBackendPath,
		    data: fd,
		    processData: false,
		    contentType: false,
		    success:  function(data){
		    	if (data == "fail") {
		    		alert("Une erreur est survenue");
		    	}
		    	else {
			    	alert("Entreprise crée");
					window.location.reload();
		    	}
			}
		});
	}
}

function creerConsultant (event) {
	event.preventDefault();
	var fd = new FormData();
    fd.append('nom',$('input[name=nom]').val());
    fd.append('prenom',$('input[name=prenom]').val());
    fd.append('email',$('input[name=email]').val());
    fd.append('fonction',"creerConsultant");

	$.ajax({
	    type: "POST",
	    url: DispatcherBackendPath,
	    data: fd,
	    processData: false,
	    contentType: false,
	    success:  function(data){
	    	if (data == "fail") {
	    		alert("Une erreur est survenue");
	    	}
	    	else {
		    	alert("Consultant crée");
				window.location.reload();
	    	}
		}
	});
}

function verifyMEForm (email, password) {
	if (!email.match(/^([\w0-9\.\-])+\@(([a-zA-Z0-9\-])+\.)+[a-zA-Z]{2,4}$/)) {
		return false;
	}
	else if (password.length> 0 && password.length <8) {
		return false;
	}
	else if (password.length> 0 && !password.match(/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/)) {
		return false;
	}
	else if(! $('input[name=entreprise]').val() ||
	   ! $('input[name=siret]').val() || 
	   ! $('input[name=ape]').val() ||
	   ! $('input[name=adresse]').val() ||
	   ! $('input[name=dirigeant]').val()){
		return false;
	}
	else {
		return true;
	}
}

function verifyCEForm (email, password) {
	if (!email.match(/^([\w0-9\.\-])+\@(([a-zA-Z0-9\-])+\.)+[a-zA-Z]{2,4}$/)) {
		return false;
	}
	else if (password.length <8) {
		return false;
	}
	else if (!password.match(/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/)) {
		return false;
	}
	else if(! $('input[name=entreprise]').val() ||
	   ! $('input[name=siret]').val() || 
	   ! $('input[name=ape]').val() ||
	   ! $('input[name=adresse]').val() ||
	   ! $('input[name=dirigeant]').val() || 
	   ! $('#logoEntreprise').val()){
		return false;
	}
	else {
		return true;
	}
}

function addEmployesFromCsv (event) {
	event.preventDefault();
	var fd = new FormData();
    var files = $('#employes')[0].files[0];
    fd.append('file',files);
    fd.append('fonction',"addEmployesFromCsv");

	$.ajax({
	    type: "POST",
	    url: DispatcherBackendPath,
	    data: fd,
	    processData: false,
	    contentType: false,
	    success:  function(data){
	    	alert("Employés ajoutés");
	    	window.location.reload();
			//displayEntrepriseForm (id);
		}
	});
}

function setEvaluationBurnout (event) {
	event.preventDefault();
	var fd = new FormData();
    var files = $('#mbi')[0].files[0];
    fd.append('file',files);
    fd.append('fonction',"setEvaluationBurnout");

	$.ajax({
	    type: "POST",
	    url: DispatcherBackendPath,
	    data: fd,
	    processData: false,
	    contentType: false,
	    success:  function(data){
	    	alert("Evaluation MBI ajoutées");
	    	window.location.reload();
			//displayEntrepriseForm (id);
		}
	});
}


function setOrganigramTree (event) {
	event.preventDefault();
	var fd = new FormData();
    var files = $('#tree')[0].files[0];
    fd.append('file',files);
    fd.append('fonction',"setOrganigramTree");

	$.ajax({
	    type: "POST",
	    url: DispatcherBackendPath,
	    data: fd,
	    processData: false,
	    contentType: false,
	    success:  function(data){
	    	alert("Organigramme ajouté");
	    	window.location.reload();
			//displayEntrepriseForm (id);
		}
	});

}

function setSuivitEmploye (event) {
	event.preventDefault();
	var fd = new FormData();
    var files = $('#suivi')[0].files[0];
    fd.append('file',files);
    fd.append('fonction',"setSuivitEmploye");

	$.ajax({
	    type: "POST",
	    url: DispatcherBackendPath,
	    data: fd,
	    processData: false,
	    contentType: false,
	    success:  function(data){
	    	alert("Suivit bine être des employés ajouté");
	    	window.location.reload();
			//displayEntrepriseForm (id);
		}
	});

}


function displayEntrepriseEmployes (id) {
	$.post(DispatcherBackendPath,
    {
		id : id,
		fonction: "displayEntrepriseEmployes"
	},
    function(data, status){
	    if (status == "success") {
		  $("#mainContainer").html(data);
		}
	});
}

function updateEmploye (event,id) {
	event.preventDefault();
	$.post(DispatcherBackendPath,
    {
		id : id,
		email : $('input[name=email]').val(),
		fonction : "updateEmploye2"
	},
    function(data, status){
	    if (status == "success") {
		  displayEmployeForm (id);
		}
	});
}

function deleteEmploye (id, idEntreprise) {
	$.post(DispatcherBackendPath,
    {
		id : id,
		idEntreprise : idEntreprise,
		fonction: "deleteEmploye"
	},
    function(data, status){
	    if (status == "success") {
		  displayEntrepriseEmployes (idEntreprise);
		}
	});
}

function resetEmploye (id, idEntreprise) {
	$.post(DispatcherBackendPath,
    {
		id : id,
		idEntreprise : idEntreprise,
		fonction: "resetEmploye"
	},
    function(data, status){
	    if (status == "success") {
		  displayEntrepriseEmployes (idEntreprise);
		}
	});
}

function displayEmployeForm (id) {
	$.post(DispatcherBackendPath,
    {
		id : id,
		fonction: "displayEmployeForm"
	},
    function(data, status){
	    if (status == "success") {
		  $("#mainContainer").html(data);
		}
	});
}

function listeEntreprises () {
	location.reload();
}

function connexion (event) {
	event.preventDefault();
	$.post(DispatcherBackendPath,
        {	
        	fonction: "connexion",
			login : $('#login').val(),
			motdepasse : $('#motdepasse').val()
			
			
		},
		function(data){
			if (data == "success") {
				window.location.replace(location.protocol +'//' + window.location.hostname + "/backend/ecranAdmin.php");
			}
			else if (data == "renewPassword") {
				window.location.replace(location.protocol+'//' + window.location.hostname + "/backend/renouvlerMotDePasseBackEnd.php");
			}
			else if (data == "failFiveMinutes") {
				$("#mainContainer").html('<div class="alert alert-danger">Identifiants incorrects <br/>compte bloqué 5 minutes<br/></div>');
			}
			else if (data == "failDay") {
				$("#mainContainer").html('<div class="alert alert-danger">Identifiants incorrects <br/>compte bloqué 24 heures<br/></div>');
			}
			else {
				$("#mainContainer").html('<div class="alert alert-danger">Identifiants incorrects <br/> <a class="stretched-link" href="/backend/envoyerMotDePasseBackEnd.php" temp_href="indexEmploye.php">Renouveler</a><br/><br/></div>');
			}
	});
			
}

function sendRenewPasswordMail(event) {
	event.preventDefault();
	$.post(DispatcherBackendPath, 
	     {
		 	fonction : "sendRenewPasswordMail",
		 	email : $('#email').val()
		 },
			function(data){
			 window.location.replace(location.protocol+'//' + window.location.hostname + "/backend/index.php");
		});
}

function renouvelerMotDePasse (event) {
	event.preventDefault();
	if(verifyform()){
		$.post(DispatcherBackendPath, 
		     {
			 	fonction : "renouvelerMotDePasse",
			 	motdepasse : $('#motdepasse').val()
			 },
				function(data){
					if (data == "success") {
						window.location.replace(location.protocol+'//' + window.location.hostname + "/backend/index.php");
				}
		});
	}
}

function deconnexion () {
	$.post(DispatcherBackendPath, 
        {fonction: "deconnexion"},
		function(data, status){
			if (status == "success") {
				window.location.replace(location.protocol + '//' + window.location.hostname + "/backend/index.php");
		}
	});
}

function setParent(select,divisionId) {
	var selectValue = select.options[select.selectedIndex].value;
	$.post(DispatcherBackendPath, 
	    {
			divisionId: divisionId,
			parentId: selectValue,
			fonction: "setParent"
		},
			function(data){
				reloadDivisionForm();
		});
}

function setDivisionName(input, divisionId) {
	var inputValue = input.value;
	$.post(DispatcherBackendPath, 
	    {
			divisionId: divisionId,
			inputValue: inputValue,
			fonction: "setDivisionName"
		},
			function(data){
				reloadDivisionForm();
		});
}

function reloadDivisionForm () {
	$.post(DispatcherBackendPath,
		{
			fonction: "getDivisionForm"
		},
		function(data){
			$("#divisionForm").html(data);
		});

}
