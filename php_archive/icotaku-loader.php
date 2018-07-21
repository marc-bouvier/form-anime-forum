<?php
/**
 * Loads and parse icotaku anime page and extracts anime info.
 */
function getIcotakuInfos($url){
  $HTML = file_get_contents($url); // Recup le HTML de la page
  if(!$HTML) return;
  preg_match('/<h1>(.*?)<\/h1>/', $HTML, $Name); 
  preg_match('/Origine : <\/b>(.*?)<\/div>/', $HTML, $Origin); 
  preg_match('/Catégorie : <\/b>(.*?)<\/div>/', $HTML, $Cat);
  preg_match_all('/<a href=\"\/genre\/fiche\/[0-9]+.html\">(.*?)<\/a>/', $HTML, $genre);
  $strGenre = "";
  foreach($genre[1] as $value){
    $strGenre .= $value . ", ";
  }
  preg_match_all('/<a href=\"\/theme\/fiche\/[0-9]+.html\">(.*?)<\/a>/', $HTML, $theme);
  $strTheme = "";
  foreach($theme[1] as $value){
    $strTheme .= $value . ", ";
  }
  preg_match('/<b>Public visé : <\/b>(.*?)<\/div>/', $HTML, $Public);
  preg_match('/Nombre d\'épisode : <\/b>(.*?)<\/div>/', $HTML, $EpisodeNb);
  preg_match('/Durée d\'un épisode : <\/b>(.*?)mins/', $HTML, $EpisodeTime);
  preg_match('/Saison : <\/b>(.*?)<\/div>/', $HTML, $Saison);
  preg_match('/Année de production : <\/b>(.*?)<\/div>/', $HTML, $Prod);
  preg_match('/Diffusion : <\/b>(.*?)<\/div>/', $HTML, $Diff);
  preg_match_all('/<a href=\"\/studio\/fiche\/[0-9]+.html\">(.*?)<\/a>/', $HTML, $Studio);
  $strStudio = "";
  foreach($Studio[1] as $value){
    $strStudio .= $value . ", ";
  }
  preg_match('/<p align=\'justify\'>(.*?)<br \/>/',$HTML, $Story);
  $infos = array(
    trim($Name[1]), // Name
    trim($Origin[1]),	
    trim($Cat[1]),
    trim($strGenre),
    trim($strTheme),
    trim($Public[1]),  // 5
    trim($EpisodeNb[1]),
    trim($EpisodeTime[1]),
    trim($Saison[1]),
    trim($Prod[1]),
    trim($Diff[1]), // 10
    trim($strStudio),
    trim($Story[1]), // 12
    $genre[1],
    $theme[1],
  );
  return $infos;
}
?>