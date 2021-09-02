<?php


class TIME_LIMIT  {
    const success = "success";
    const failFiveMinutes = "failFiveMinutes";
    const failDay = "failDay";
}

class STATUS {
    const success = "success";
    const renewPassword = "renewPassword";
    const fail = "fail";
}

class ID {
    const idEmploye = "idEmploye";
    const idEmployeur = "entreprise";
    const idConsultant = "consultant";
    const idEntrepriseConsultant = "id_entreprise";
    const idAdministrateur = "id";
}


class LOGIN {
    const login = "login";
    const pwd = "motdepasse";
}

class Utils {
    
    
    
    
    public static function RandPassword( $length ) {
        
        $chars = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ023456789+@!$%?&";
        $result = substr(str_shuffle($chars),0,$length);
        return "1a". $result . "/A";
        
    }
    
    public static function encryptPassword ($motDePasse) {
        /* encrypting */
        $password = hash('sha512', $motDePasse);
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    public static function isEmailValid($email){
        if (strlen($email) < 6) {
            return false;
        } else {
            return preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email);
        }
    }
    
    public static function isPasswordValid ($password) {
        if (strlen($password) < 8) {
            return false;
        } else {
            $test = preg_match("#[A-Z]#", $password) + preg_match("#[a-z]#", $password) + preg_match("#[0-9]#", $password) + preg_match("#[^a-zA-Z0-9]#", $password);
            if($test == 4){
                return true;
            }
            else {
                return false;
            }
        }
    }
    
    public static function SendRenewPasswordEmail ($email, $newPassword) {
        $objet = 'Nouveau mot de passe';
        $to = $email;
        
        //===== Cr�ation du header du mail.
        $header = "From: CORP-SCAN <no-reply@corp-scan.com> \n";
        $header .= "Reply-To: ".$to."\n";
        $header .= "MIME-version: 1.0\n";
        $header .= "Content-type: text/html; charset=utf-8\n";
        $header .= "Content-Transfer-Encoding: 8bit";
        
        //===== Contenu de votre message
        $contenu = "<html";
        $contenu .= "<body>";
        $contenu .= "<p style='text-align: center; font-size: 18px'><b>Bonjour Mr, Mme</b>,</p><br/>";
        $contenu .= "<p style='text-align: justify'><i><b>Nouveau mot de passe : </b></i>". $newPassword ."</p><br/>";
        $contenu .= "</body>";
        $contenu .= "</html>";
        
        //===== Envoi du mail
        return mail($to, $objet, $contenu, $header);
    }
    
    public static function sendRelanceMBIEmail ($email) {
        $objet = 'Relance Malach Burnout Inventory';
        
        //===== Cr�ation du header du mail.
        $header = "From: CORP-SCAN <no-reply@corp-scan.com> \n";
        $header .= "Reply-To: ".$email."\n";
        $header .= "MIME-version: 1.0\n";
        $header .= "Content-type: text/html; charset=utf-8\n";
        $header .= "Content-Transfer-Encoding: 8bit";
        
        //===== Contenu de votre message
        $contenu = "<html>";
        $contenu .= "<body>";
        $contenu .= "<p style='text-align: center; font-size: 18px'><b>Bonjour Mr, Mme</b>,</p><br/>";
        $contenu .= "<p style='text-align: justify'><i><b>N'oubliez pas de remplir votre formulaire MBI</b></i></p><br/>";
        $contenu .= "<p style='text-align: justify'><i><b>Rendez vous sur votre <a href=\"https://corp-scan.com/employe/indexEmploye.php\">Espace Collaborateur</a></b></i></p><br/>";
        $contenu .= "</body>";
        $contenu .= "</html>";
        
        //===== Envoi du mail
        return mail($email, $objet, $contenu, $header);
    }
    
    public static function sendRelanceSuiviEmail ($email) {
        $objet = 'Relance Suivi hebdomadaire';
        
        //===== Cr�ation du header du mail.
        $header = "From: CORP-SCAN <no-reply@corp-scan.com> \n";
        $header .= "Reply-To: ".$email."\n";
        $header .= "MIME-version: 1.0\n";
        $header .= "Content-type: text/html; charset=utf-8\n";
        $header .= "Content-Transfer-Encoding: 8bit";
        
        //===== Contenu de votre message
        $contenu = "<html>";
        $contenu .= "<body>";
        $contenu .= "<p style='text-align: center; font-size: 18px'><b>Bonjour Mr, Mme</b>,</p><br/>";
        $contenu .= "<p style='text-align: justify'><i><b>N'oubliez pas de remplir votre suivi hebdomadaire </b></i></p><br/>";
        $contenu .= "<p style='text-align: justify'><i><b>Rendez vous sur votre <a href=\"https://corp-scan.com/employe/indexEmploye.php\">Espace Collaborateur</a></b></i></p><br/>";
        $contenu .= "</body>";
        $contenu .= "</html>";
        
        //===== Envoi du mail
        return mail($email, $objet, $contenu, $header);
    }
    
    public static function sendInfoPersoEmployeEmail ($email, $message) {
        $objet = 'Informations personnelles';
        
        //===== Cr�ation du header du mail.
        $header = "From: CORP-SCAN <no-reply@corp-scan.com> \n";
        $header .= "Reply-To: ".$email."\n";
        $header .= "MIME-version: 1.0\n";
        $header .= "Content-type: text/html; charset=utf-8\n";
        $header .= "Content-Transfer-Encoding: 8bit";
        
        //===== Contenu de votre message
        $contenu = "<html>";
        $contenu .= "<head>";
        $contenu .= '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">';
        $contenu .= '<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">';
        $contenu .= '<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>';
        $contenu .= '<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>';
        $contenu .= '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>';
        $contenu .= "</head>";
        $contenu .= "<body>";
        $contenu .= $message;
        $contenu .= "</body>";
        $contenu .= "</html>";
        
        //===== Envoi du mail
        return mail($email, $objet, $contenu, $header);
    }
    
    private static function verifyTimeLimit ($utilisateur) {
        $timeNow = new DateTime("NOW", new DateTimeZone('Europe/Paris'));
        
        $timeLastTentative = new DateTime($utilisateur->getLastTentative(),new DateTimeZone('Europe/Paris'));
        
        $diff = Utils::dateDiff($timeNow->getTimestamp() , $timeLastTentative->getTimestamp());
        
        if ($utilisateur->getNbTentatives()+1 >= 5) {
            if ($diff['day'] < 1) {
                return "failDay";
            }
            else return TIME_LIMIT::success;
        }
        else if ($utilisateur->getNbTentatives()+1 >= 3) {
            if ($diff['minute'] >= 5 || $diff['hour'] >= 1 || $diff['day'] >= 1) {
                return "success";
                
            }
            else return TIME_LIMIT::failFiveMinutes;
        }
        else return TIME_LIMIT::success;
    }
    
    private static function dateDiff($date1, $date2){
        $diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, ainsi �viter d'avoir une diff�rence n�gative
        $retour = array();
        
        $tmp = $diff;
        $retour['second'] = $tmp % 60;
        
        $tmp = floor( ($tmp - $retour['second']) /60 );
        $retour['minute'] = $tmp % 60;
        
        $tmp = floor( ($tmp - $retour['minute'])/60 );
        $retour['hour'] = $tmp % 24;
        
        $tmp = floor( ($tmp - $retour['hour'])  /24 );
        $retour['day'] = $tmp;
        return $retour;
    }
    
    public static function connexion ($dao,$id) {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        // On va vérifier les variables
        $login = htmlentities(strtolower(trim($_POST[LOGIN::login])));
        $motdepasse = $_POST[LOGIN::pwd];
        
        $data = STATUS::fail;
        
        if(!isset($login) || !isset($motdepasse)) {return STATUS::fail;}
        if(!Utils::isEmailValid($login) || !Utils::isPasswordValid($motdepasse)) {return STATUS::fail;}
        
        else
        {
            $results = $dao->findByEmail(md5($login));
            
            // On v�rifie si ce login existe
            if(count ($results) == 1)
            {
                $result = $results [0];
                
                $verifLimit = Utils::verifyTimeLimit ($result);
                
                $encryptedPassword = $result->getMotDePasse();
                $verify = hash('sha512', $motdepasse);
                $verifPassword = password_verify($verify,$encryptedPassword);
                
                if ($verifLimit == TIME_LIMIT::success) {
                    if ($verifPassword) {
                        if ($result->getDMP() == 1) { 
                            $_SESSION[$id] = $result->getId();
                            $_SESSION[STATUS::renewPassword] = 1;
                            $data = STATUS::renewPassword;
                            $dao->resetLastTentativeAndlastConnexion($result->getId());
                        }
                        else if ($result->getDMP() == 0) {
                            $_SESSION[$id] = $result->getId();
                            if ($dao instanceof ConsultantDAO) {
                                $consultant_EmployeurDAO = new Consultant_Employeur;
                                $results = $consultant_EmployeurDAO->findByIdConsultant($_SESSION[$id]);
                                $_SESSION['id_entreprise'] = $results[0]->getId_Employeur();
                            }
                            $data =  STATUS::success;
                            //fait � l'entre�e dans la page afin de recuperer la date de derniere connexion avant
                            //Qu'elle soit mise � jour
                            $dao->resetLastTentativeAndlastConnexion($result->getId());
                        }
                    } else {
                        $dao->resetLastTentative($result->getId());
                        if ($result->getNbTentatives() == 5) {
                            $dao->resetLastTentativeAndlastConnexion($result->getId());
                            $data = STATUS::fail;
                        }
                        else {
                            $nb_tentatives = $result->getNbTentatives() + 1;
                            $dao->updateTentatives ($result->getId(),$nb_tentatives, false);
                            if ($nb_tentatives == 5) { $data = TIME_LIMIT::failDay; }
                            else {$data = STATUS::fail;}
                        }
                    }
                }
                else  {
                    $nb_tentatives = $result->getNbTentatives() + 1;
                    if ($nb_tentatives >= 5) {
                        if ($result->getNbTentatives() == 4) {
                            $dao->updateTentatives ($result->getId(),$nb_tentatives, false);
                        }
                        $data = TIME_LIMIT::failDay;
                    }
                    else if ($nb_tentatives >= 3)  {
                        if ($result->getNbTentatives() == 2) {
                            $dao->updateTentatives ($result->getId(),$nb_tentatives, false);
                        }
                        $data = TIME_LIMIT::failFiveMinutes;
                    }
                    else {$data = $verifLimit;}
                }
            }
        }
        return $data;
    }
    
    public static function deconnexion () {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        session_destroy();
    }
    
    public static function lastConnexion($dao, $id) {
        $utilisateur = $dao->findById($_SESSION[$id])[0];
        $resultat = NULL;
        if ($utilisateur->getLastConnexion() == NULL) {
            $resultat = "premi&egrave;re connexion";
        }
        else {$resultat = $utilisateur->getLastConnexion();}
        $dao->resetLastTentativeAndlastConnexion($utilisateur->getId());
        return $resultat;
    }
    
    
    public static function sendRenewPasswordMail ($dao) {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        
        $mail = htmlentities(strtolower(trim($_POST["email"]))); // On r�cup�re le mail afin d envoyer le mail pour la r�cup�ration du mot de passe�
        if (isset($mail) && Utils::isEmailValid($mail)){
            
            $users = $dao->findByEmail(md5($mail));
            if(count($users)==1){
                // On g�n�re un mot de passe � l'aide de la fonction RAND de PHP
                $newPassword = Utils::RandPassword(8);
                echo $newPassword;
                $newEncryptedPassword = Utils::encryptPassword($newPassword);
                Utils::SendRenewPasswordEmail($mail, $newPassword);
                $dao->updatePasswordAndDMdp($users[0]->getId(), $newEncryptedPassword);
                Utils::deconnexion ();
                return STATUS::success;
            }
            return STATUS::fail;
        }
        return STATUS::fail;
    }
    
    public static function renouvelerMotDePasse ($dao, $id) {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        // On va vérifier les variables
        if(!isset($_SESSION[$id]) &&  !isset($_POST[LOGIN::login])) {return STATUS::fail;}
        else if (!Utils::isPasswordValid($_POST[LOGIN::pwd])) {return STATUS::fail;}
        else
        {
            $results = $dao->findById($_SESSION[$id]);
            // On v�rifie si ce login existe
            if(count ($results) == 1)
            {
                /* encrypting */
                if($results[0]->getDMP() == 1) {
                    $password = hash('sha512', $_POST[LOGIN::pwd]);
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    
                    $dao->updatePasswordAndDMdp($_SESSION[$id],$password);
                    $dao->setDMdp($_SESSION[$id],0);
                    
                    Utils::deconnexion ();
                    return STATUS::success;
                }
            }
            
            return STATUS::fail;
        }
        return STATUS::fail;
    }
    
}
?>