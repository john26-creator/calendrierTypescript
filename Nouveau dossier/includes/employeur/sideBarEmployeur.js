var DispatcherPath = "../controllers/DispatcherEmployeur.php";


function connexion (event) {
    traitementConnexion(event,
        DispatcherPath,
        location.protocol+'//' + window.location.hostname + "/employeur/ecranEmployeur.php",
        location.protocol+'//' + window.location.hostname + "/employeur/renouvlerMotDePasseEmployeur.php",
        '<div class="alert alert-danger">Identifiants incorrects <br/> <a class="stretched-link" href="/employeur/envoyerMotDePasseEmployeur.php" temp_href="indexEmployeur.php">Renouveler</a><br/><br/></div>');
}

function sendRenewPasswordMail(event) {
    traitementSendRenewPasswordMail(event,
        DispatcherPath,
        location.protocol+'//' + window.location.hostname + "/employeur/indexEmployeur.php");
}

function renouvelerMotDePasse (event) {
    traitementRenouvelerMotDePasse(event,
        DispatcherPath,
        location.protocol+'//' + window.location.hostname + "/employeur/indexEmployeur.php");
}

function deconnexion () {
    traitementDeconnexion(DispatcherPath,
        location.protocol+'//' + window.location.hostname + "/employeur/indexEmployeur.php");
}