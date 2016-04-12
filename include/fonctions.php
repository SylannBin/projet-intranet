<?php
/*
* \Autheur: Nicolas BOUYSSOUNOUSE.
* \Vérificateur: Romain VINCENT.
* \Brief: Vérifie si l'utilisateur est connecté.
* \Return: Retourne 'true' si l'array global $_session contient la chaine de caractère 'ID'.
*/
function isConnected(){
  return isset($_SESSION['ID']);
}


/*
* \Autheur: Thomas BERARD.
* \Vérificateur: Théo GUIBOUD-RIBAUD.
* \Brief: Génération du haut de la page HTML.
* \Return: <!DOCTYPE html> & co.
*/
function hautPage () {
  return '<!DOCTYPE html>
<html>
<head>
  <title>GREPSI</title>
  <meta charset="UTF-8">
  <meta name="description" content="GREPSI - EPSI Grenoble">
  <meta name="keywords" content="EPSI, Grenoble">
  <meta name="language" content="fr">
  <meta name="author" content="Thomas BERARD, Nicolas BOUYSSOUNOUSE, Adrien CECCALDI, Nathan DESCOMBES, Jérôme FABBIAN, Florian GOJON, Théo GUIBOUD-RIBAUD, Guillaume SAYEN, Valentin SOVIGNET, Romain VINCENT">
  <link rel="stylesheet" type="text/css" href="style/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="style/grepsi.css">
</head>
<body>
  ';
}


/*
* \Autheur: Thomas BERARD.
* \Vérificateur: Théo GUIBOUD-RIBAUD.
* \Brief: Génération du bas de la page HTML.
* \Return: </body> & </html>.
*/
function basPage () {
  return '</body>
</html>';
}


/*
* \Autheur: Thomas BERARD.
* \Vérificateur: Théo GUIBOUD-RIBAUD.
* \Brief: Affiche la barre de navigation en tête de page.
* \Return: Barre de navigation.
*/
function afficheMenu () {
  return '<nav id="cssmenu">
  <ul>
  <li><a href="#">Accueil</a></li>
  <li><a href="#">page1</a></li>
  <li><a href="#">page2</a></li>
  <li><a href="#">page3</a></li>
  <li><a href="#">page4</a></li>
  <li><a href="#">page5</a></li>
  </ul>
  </nav>
';
}


/*
* \Autheur: Thomas BERARD.
* \Vérificateur: 
* \Brief: Affiche le footer en bas de page.
* \Return: Footer complet.
*/
function afficheFooter () {
  return '<footer class="footer-distributed">

      <div class="footer-right">

        <a href="https://www.facebook.com/Campus.EPSI.Grenoble" target="_blank"><img src="images/facebook-logo.png" alt="Facebook EPSI Grenoble" width="42" height="42" border="0"></a>
        <a href="https://twitter.com/EPSIGrenoble" target="_blank"><img src="images/twitter-logo.png" alt="Twitter EPSI Grenoble" width="42" height="42" border="0"></a>

      </div>

      <div class="footer-left">

        <a href="http://www.epsi.fr" target="_blank"><img src="images/epsi-logo.png" alt="Facebook EPSI Grenoble" width="120" border="0"></a>

      </div>

    </footer>
';
}
/**
* \Autheur: Florian GOJON.
* \Vérificateur: Nathan
* \Brief: Génére un tableau avec les id des 25 derniers messages.
* \Return: tableau.
*/
function listeMessages() {
  global $p_base;
  $requete = $p_base->query('select id, date from tchat order by date asc limit 25');
  $table = array();
  while($resultat = $requete->fetch()) {
    $table[] = $resultat['id'];
    $table[] .= $resultat['date'];
  }
  return $table;
}

/**
* \Autheur: Florian GOJON.
* \Vérificateur: 
* \Brief: Affiche les messages du chat
* \Return: une chaine HTML.
*/
function afficheMessageChat($table){
  global $p_base;
  $id = $table[0];
  $date = $table[1];
  $date = date("H:i:s");
  $requete = $p_base ->query('select contenu, pseudo from personne, tchat where personne.id = tchat.idpersonne and tchat.id =' . $id);
  $resultat = $requete->fetch();
  
  $pseudo = $resultat['pseudo'];
  $reponse = "<div class=chat><span class=pseudo>  ".$date. " : " .$pseudo. ' :' . "</span> ";
  
  $reponse .= "<span class=contenu>" . $resultat['contenu'] . "</span>";
  $reponse .= "</div>";
  return $reponse;
}
?>
