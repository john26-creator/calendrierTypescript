

function infoPerso () {
	$.post(DispatcherPath,
        {
			fonction: "infoPerso"
		},
    function(data, status){
	    if (status == "success") {
		  $("#mainContainer").html(data);
	  }
  });
}

function getAll (id_division=0) {
	$.post(DispatcherPath,
		{
			fonction: "getAll",
			division: id_division
		},
		function(data, status){
			setCharts(data.global,data.stress,"Evolution globale du bien être", "getAll",true, id_division);
		},
		"json");
}

function displayBilanInit (id_division=0) {
	$.post(DispatcherPath,
        {
			fonction: "diplayBilanInit",
			division: id_division
		},
     function(data, status){
     	setBarChart(data,"displayBilanInit", true, id_division);
	},
	"json");    
}

function displayBilanFin (id_division=0) {
	$.post(DispatcherPath,
        {
			fonction: "diplayBilanFin",
			division: id_division
		},
     function(data, status){
     	setBarChart(data,"displayBilanFin", true, id_division);
	},
	"json"); 
}

//whoschart = {global,stress,sommeil...}
function divisionDropDowList (whoschart,selectedValue=0) {
	var span = document.createElement("span");
	var label = document.createElement("label");
	label.setAttribute("for", "divisions");
	label.innerHTML = "Liste des divisions";
	
	var dropDown = document.createElement("select");
	dropDown.addEventListener("change", (event) => {
		switch (whoschart) {
		case "getAll" : getAll (dropDown.value); break;
		case "displayBilanInit" : displayBilanInit (dropDown.value); break;
		case "displayBilanFin" : displayBilanFin (dropDown.value); break;
		}
	});

	dropDown.setAttribute("name", "divisions");
	dropDown.setAttribute("id", "divisions");
	span.appendChild(label);
	span.appendChild(dropDown);

	addOptionToSelect(dropDown,"global",0);

	$.post(DispatcherPath,
        {
			fonction: "divisions",
		},
    	function(data){data.forEach(element => {addOptionToSelect(dropDown,element.nom,element.division,selectedValue);});}
    	,
	"json");
	return span;
}

function addOptionToSelect (dropDown, name, value, selectedValue) {
	var option = document.createElement("option");
	option.setAttribute("value", value);
	option.innerHTML = name;
	if(value === selectedValue) {
		option.setAttribute("selected", true);
	}
	dropDown.appendChild(option);
}

function traitementConnexion (event, path,success,renewPassword,error) {
	event.preventDefault();
	$.post(path,
        {
			fonction: "connexion",
			login : $('#login').val(),
			motdepasse : $('#motdepasse').val()
		},
		function(data){
			if (data == "success") {
				window.location.replace(success);
			}
			else if (data == "renewPassword") {
				window.location.replace(renewPassword);
			}
			else if (data == "failFiveMinutes") {
				$("#main").html('<div class="alert alert-danger">Identifiants incorrects <br/>compte bloqué 5 minutes<br/></div>');
			}
			else if (data == "failDay") {
				$("#main").html('<div class="alert alert-danger">Identifiants incorrects <br/>compte bloqué 24 heures<br/></div>');
			}
			else {
				$("#main").html(error);
			}
	});
}

function traitementSendRenewPasswordMail(event,path,success) {
	event.preventDefault();
	$.post(path, 
	     {
		 	fonction : "sendRenewPasswordMail",
		 	email : $('#email').val()
		 },
			function(data){
				window.location.replace(success);
		});
}

function traitementRenouvelerMotDePasse (event,path,success) {
	event.preventDefault();
	if(verifyform()){
		$.post(path, 
		     {
			 	fonction : "renouvelerMotDePasse",
			 	motdepasse : $('#motdepasse').val()
			 },
				function(data){
					if (data == "success") {
						window.location.replace(success);
			}
		});
	}
}

function traitementDeconnexion (path,success) {
	$.post(path, 
        {fonction : "deconnexion"},
		function(data, status){
			if (status == "success") {
				window.location.replace(success);
		}
	});
}

