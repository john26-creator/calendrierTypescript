<?php
require $_SERVER['DOCUMENT_ROOT'] .'/employes/Autoloader.php';

Autoloader::register();

//création d'1 instance de la classe Employe
$employe = new Employe("albert", 35, 50000, "1XXXXXXXXXXXXX"); //apple au constructeur Employe via new
$employe->afficher(); //methode d'instance "afficher()" de la classe Employe

//création de 3 instances de la classe Employe::Technicien
$technicien1 = new Technicien("albert", 35, 50000, "1XXXXXXXXXXXXX", "a");
$technicien2 = new Technicien("roger", 55, 70000, "6XXXXXXXXXXXXX", "c");
$technicien3 = new Technicien("mohamed", 43, 60000, "6XXXXXXXXXXXXX", "b");

$technicien1->afficher(); //methode d'instance "afficher()" de la classe Technicien
echo "salaire calculé: " . $technicien1->calculeSalaire() . "\n";

//l'appel à une fonction statique se fait via le nom de la classe et non depuis une instance
echo Technicien::compare($technicien1,$technicien2);

////Types des instances de classe
//Un technicien est un technicien
echo "un technicien est un technicien " . ($technicien1 instanceof Technicien) . "\n";
//Un technicien est un employe
echo "un technicien est un employe " . ($technicien1 instanceof Employe) . "\n";
//Un employe n'est pas un technicien
echo "un employe est un technicien " . ($employe instanceof Technicien) . "\n";