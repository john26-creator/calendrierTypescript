<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=magasin', "root", "");
    $sth = $dbh->prepare("SELECT * from personne");
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_CLASS, 'Personne');
        echo "<table >";
        echo "<thead>";
        echo "<th>nom</th>";
        echo "<th>prenom</th>";
        echo "</thead>";
        echo "<tbody>";
    foreach ($result as $personne) {
        echo "<tr>";
        echo "<td>" . $personne->getNom() . "</td>";
        echo "<td>" . $personne->getPrenom() . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    $stmt = null;
    $dbh = null;
} catch (PDOException $e) {
    echo $e->getMessage();
}
