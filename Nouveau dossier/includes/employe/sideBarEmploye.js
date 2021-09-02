var DispatcherPath = "../controllers/DispatcherEmploye.php";

function infoPerso () {
	$.post(DispatcherPath,
    {fonction : "infoPerso"},
    function(data, status){
	    if (status == "success") {
	    $('#mainContainer').show();//-----ON OUVRE LE VOLET ---------
		  $("#mainContainer").html(data);
	  }
  });
}


function getAll (id_division=0) {
	$('#mainContainer').show();//-----ON OUVRE LE VOLET ---------
	$.post(DispatcherPath,
		{
			fonction: "getAll",
			division: id_division
		},
		function(data, status){
			setChart6 (data.global, data.stress, data.anxiete, data.energie, data.sommeil, data.digestion, "Evolution globale du bien être", "getAll", true, id_division);
		},
		"json");
}

function bilan (bilan) {
$.post("../../employe/formulaireBurnout.php",
    {bilan: bilan},
    function(data, status){
	    if (status == "success") {
		  $('#mainContainer').show();//-----ON OUVRE LE VOLET ---------
		  $("#mainContainer").html(data);
		}
	});
}


function bilan (bilan) {
    $.post("../../employe/formulaireBurnout.php",
    {bilan: bilan},
        function(data, status){
            if (status == "success") {
                $("#mainContainer").html(data);
                $("#Q1").show();
                $("#Q2").hide();
                $("#Q3").hide();
                $("#Q4").hide();
                $("#Q5").hide();
        }
    });
}





var numero = 1;
const slideLenght = 6;
function ChangeSlide(sens) {

    			$("#Q1").hide();
                $("#Q2").hide();
                $("#Q3").hide();
                $("#Q4").hide();
                $("#Q5").hide();


    numero = numero + sens;

    if (numero < 1)
        numero = slideLenght - 1;
    if (numero > slideLenght - 1)
        numero = 1;
    $("#Q" + numero).show();
}








function verifSuiviFieldsBurnout () {
	return $('input[name=Question1]:checked').val() != null &&
		   $('input[name=Question2]:checked').val() != null &&
		   $('input[name=Question3]:checked').val() != null &&
		   $('input[name=Question4]:checked').val() != null &&
		   $('input[name=Question5]:checked').val() != null &&
		   $('input[name=Question6]:checked').val() != null &&
		   $('input[name=Question7]:checked').val() != null &&
		   $('input[name=Question8]:checked').val() != null &&
		   $('input[name=Question9]:checked').val() != null &&
		   $('input[name=Question10]:checked').val() != null &&
		   $('input[name=Question11]:checked').val() != null &&
		   $('input[name=Question12]:checked').val() != null &&
		   $('input[name=Question13]:checked').val() != null &&
		   $('input[name=Question14]:checked').val() != null &&
		   $('input[name=Question15]:checked').val() != null &&
		   $('input[name=Question16]:checked').val() != null &&
		   $('input[name=Question17]:checked').val() != null &&
		   $('input[name=Question18]:checked').val() != null &&
		   $('input[name=Question19]:checked').val() != null &&
		   $('input[name=Question20]:checked').val() != null &&
		   $('input[name=Question21]:checked').val() != null &&
		   $('input[name=Question22]:checked').val() != null;
}

function submitBurnout (event, bilan) {
	event.preventDefault();
	if (verifSuiviFieldsBurnout()) {
			$.post(DispatcherPath,
			{
				fonction : "submitBurnout",
				bilan : bilan,
				Question1 : $('input[name=Question1]:checked').val(),
				Question2 : $('input[name=Question2]:checked').val(),
				Question3 : $('input[name=Question3]:checked').val(),
				Question4 : $('input[name=Question4]:checked').val(),
				Question5 : $('input[name=Question5]:checked').val(),
				Question6 : $('input[name=Question6]:checked').val(),
				Question7 : $('input[name=Question7]:checked').val(),
				Question8 : $('input[name=Question8]:checked').val(),
				Question9 : $('input[name=Question9]:checked').val(),
				Question10 : $('input[name=Question10]:checked').val(),
				Question11 : $('input[name=Question11]:checked').val(),
				Question12 : $('input[name=Question12]:checked').val(),
				Question13 : $('input[name=Question13]:checked').val(),
				Question14 : $('input[name=Question14]:checked').val(),
				Question15 : $('input[name=Question15]:checked').val(),
				Question16 : $('input[name=Question16]:checked').val(),
				Question17 : $('input[name=Question17]:checked').val(),
				Question18 : $('input[name=Question18]:checked').val(),
				Question19 : $('input[name=Question19]:checked').val(),
				Question20 : $('input[name=Question20]:checked').val(),
				Question21 : $('input[name=Question21]:checked').val(),
				Question22 : $('input[name=Question22]:checked').val()
			},
			function(data, status){
		     	setPolarChart(data);
		     	refreshSideBar ();
			},
			"json");
		}
		
	else {
		$("#errorMessage").html('<div class="alert alert-danger"> Il faut répondre à toutes les questions. </div>');
	}
}

function downloadEmployeInfo () {
	$.post(DispatcherPath,
			{
				fonction : "downloadEmployeInfo",
			},
	 function(data, status, request){
	     	console.log (data);
	     	console.log (status);
	     	var disposition = request.getResponseHeader('content-disposition');
            var matches = /"([^"]*)"/.exec(disposition);
	     	var filename = (matches != null && matches[1] ? matches[1] : 'file.csv');
	     	//
            // The actual download
            var blob = new Blob([data], { type: 'application/csv' });
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = filename;

            document.body.appendChild(link);

            link.click();

            document.body.removeChild(link);
          }
	  );
}

function diplayBilanInit () {
	$.post(DispatcherPath,
        {
			fonction: "diplayBilanInit"
		},
     function(data, status){
     	setPolarChart(data);
	},
	"json");    	
}

function diplayBilanFin () {
	$.post(DispatcherPath,
        {
			fonction: "diplayBilanFin"
		},
     function(data, status){
     	setPolarChart(data);
	},
	"json"); 
}

function suivitSemaine (semaine) {
	$.post(
        'suivitSemaine.php', 
        {semaine : semaine},
		function(data, status){
			if (status == "success") {
				$('#mainContainer').show();//-----ON OUVRE LE VOLET ---------
				$("#mainContainer").html(data);
		}
	});
}

function verifSuiviFields () {
	return $('input[name=Question1]:checked').val() != null &&
		   $('input[name=Question2]:checked').val() != null &&
		   $('input[name=Question3]:checked').val() != null &&
		   $('input[name=Question4]:checked').val() != null &&
		   $('input[name=Question5]:checked').val() != null;
}

function refreshSideBar () {
	$.post(
		'../includes/employe/sideBarEmploye.php',
		{fonction : "refreshSideBar"},
		function(data, status){
			if(status == "success") {

				$("#sideBarEmploye").html(data);
			}
		});
}

function submitSuivit (event) {
	event.preventDefault();
	if (verifSuiviFields()) {
		
		    $.post(DispatcherPath,
		        {
					Question1 : $('input[name=Question1]:checked').val(),
					Question2 : $('input[name=Question2]:checked').val(),
					Question3 : $('input[name=Question3]:checked').val(),
					Question4 : $('input[name=Question4]:checked').val(),
					Question5 : $('input[name=Question5]:checked').val(),
					fonction : "submitSuivit"
				},
				function(data, status){
					if (status == "success") {
	
						refreshSideBar ();
				}
			});
    	$('#mainContainer').hide(); // ------QUESTIONNAIRE TERMINÉ, ON FERME LE VOLET.--------
		numero2 = 1; // ------ ON REINITIALISE LE COMPTEUR A 1 --------
		alert('données envoyées, merci');
		
	} else {
		$("#errorMessage").html('<div class="alert alert-danger"> Il faut répondre à toutes les questions. </div>');
		
	}
}



function connexion (event) {
	event.preventDefault();
	$.post(DispatcherPath,
        {
			fonction: "connexion",
			login : $('#login').val(),
			motdepasse : $('#motdepasse').val()
		},
		function(data){
			if (data == "success") {
				window.location.replace(location.protocol+'//' + window.location.hostname + "/employe/ecranEmploye.php");
			}
			else if (data == "renewPassword") {
				window.location.replace(location.protocol+'//' + window.location.hostname + "/employe/renouvlerMotDePasseEmploye.php");
			}
			else if (data == "failFiveMinutes") {
				$("#main").html('<div class="alert alert-danger">Identifiants incorrects <br/>compte bloqué 5 minutes<br/></div>');
			}
			else if (data == "failDay") {
				$("#main").html('<div class="alert alert-danger">Identifiants incorrects <br/>compte bloqué 24 heures<br/></div>');
			}
			else {
				$("#main").html('<div class="alert alert-danger">Identifiants incorrects <br/> <a class="stretched-link" href="/employe/envoyerMotDePasseEmploye.php" temp_href="indexEmploye.php">Renouveler</a><br/><br/></div>');
			}
	});
}

function sendRenewPasswordMail(event) {
	event.preventDefault();
	$.post(DispatcherPath, 
	     {
		 	fonction : "sendRenewPasswordMail",
		 	email : $('#email').val()
		 },
			function(data){
			 window.location.replace(location.protocol+'//' + window.location.hostname + "/employe/indexEmploye.php");
		});
}

function renouvelerMotDePasse (event) {
	event.preventDefault();
	if(verifyform()){
		$.post(DispatcherPath, 
		     {
			 	fonction : "renouvelerMotDePasse",
			 	motdepasse : $('#motdepasse').val()
			 },
				function(data){
					if (data == "success") {
						window.location.replace(location.protocol+'//' + window.location.hostname + "/employe/indexEmploye.php");
				}
		});
	}
}

function deconnexion () {
	$.post(DispatcherPath, 
        {fonction : "deconnexion"},
		function(data, status){
			if (status == "success") {
				window.location.replace(location.protocol+'//' + window.location.hostname + "/employe/indexEmploye.php");
		}
	});
}



var numero2 = 1;
const slideLenght2 = 7;
function ChangeSlide2(sens) {

    $("#Q1").hide();
    $("#Q2").hide();
    $("#Q3").hide();
    $("#Q4").hide();
    $("#Q5").hide();
    $("#Q6").hide();

    numero2 = numero2 + sens;

    if (numero2 < 1)
        numero2 = slideLenght2 - 1;
    if (numero2 > slideLenght2 - 1)
        numero2 = 1;
    $("#Q" + numero2).show();
}

function suivitSemaine (semaine) {
    $.post(
        'suivitSemaine.php', 
        {semaine : semaine},
        function(data, status){
            if (status == "success") {
                $("#mainContainer").html(data);
                $("#Q1").show();
                $("#Q2").hide();
                $("#Q3").hide();
                $("#Q4").hide();
                $("#Q5").hide();
                $("#Q6").hide();

        }
    });
}





