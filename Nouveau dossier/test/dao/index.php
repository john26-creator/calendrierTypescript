<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des voitures</title>
    <script src="scripts/voiture.js" defer></script>
</head>

<body>
    <div id="content"></div>
    <div>
        <form action="#" method="post" onsubmit="ajouterVoiture(event)">
            <input type="text" name="immat"  placeholder="IMMATRICULATION">
            <input type="text" name="couleur"  placeholder="COULEUR">
            <input type="text" name="marque"  placeholder="MARQUE">
            <input type="text" name="modele"  placeholder="MODELE">
            <button type="submit">Ajouter</button>
        </form>
    </div>
</body>

</html>