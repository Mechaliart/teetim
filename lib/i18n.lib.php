<?php

/******** Librairie des fonctions utiles à l'i18n *****************************/

/**
 * Obtient la liste des codes de langues disponibles sur le site.
 * @return array Tableau des codes de langues.
 */
function obtenirLanguesDisponibles()
{
  $languesDispo = [];
  $contenuI18n = scandir('i18n');
  for ($i = 0; $i < count($contenuI18n); $i++) {
    $fichier = $contenuI18n[$i];
    if ($fichier != '.' && $fichier != '..') {
      $languesDispo[] = substr($fichier, 0, 2);
    }
  }
  return $languesDispo;
}


/**
 * Détermine la langue active du site.
 * @param array $languesPermises Tableau des codes ISO639-1 des langues 
 * disponibles
 * @return string Code de la langue en 2 lettres 
 */



function determinerLangue($languesPermises)
{
  // 1 . Langue par défaut
$langue = 'fr';

// 2. Langue mémorisée dans un témoin HTTP
if (isset($_COOKIE['choixLangue']) && in_array($_COOKIE['choixLangue'], $languesDispo)) {
	$langue = $_COOKIE['choixLangue'];
}

// 3. Langue spécifiée explicitement
if (isset($_GET['lan']) &&  in_array($_GET['lan'], $languesDispo)) {
	$langue = $_GET['lan'];
	setcookie('choixLangue', $langue, time() + 30 * 24 * 3600);
}
return $langue;

}

function obtenirTextes($codeLangue, $nomPage){

$textesJSON = file_get_contents("i18n/" . $langue . ".json");
$textes = json_decode($textesJSON);
// Variables raccourcis pour les parties communes
$_ent = $textes->entete;
$_pp = $textes->pp;
// Variable raccourci pour toutes les pages spécifiques
$_ = @$textes->$nomPage;

return [ $_ent, $_pp, $_ ];


}
