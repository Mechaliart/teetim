<?php

/************ Librairie de code pour gérer le catalogue des produits **********/

/**
 * Retourne les thèmes.
 * @return array Tableau contenant des objets représentant les thèmes.
 */
function obtenirThemes() {
  $cnx = new mysqli('db', 'teetim', 'teetim', 'teetim');
  $resultat = $cnx->query("SELECT * FROM theme");
  // return $resultat->fetch_all(MYSQLI_ASSOC);

  $themes = [];
  while($uneLigne = $resultat->fetch_object()) {
    $themes[] = $uneLigne;
  }
  return $themes;
}

/**
 * Retourne les produits de la catégorie demandée.
 * @param string $categorie Catégorie de produits (ex: teeshirts, casquettes, etc.)
 * @param string $critereTri Valeur du critère de tri.
 * @param string $critereFiltre Valeur du critère de filtre.
 * @return array Tableau contenant des objets qui représentent les produits.
 */
function obtenirProduits($categorie, $critereTri, $critereFiltre)
{
  $cnx = new mysqli('db', 'teetim', 'teetim', 'teetim');
  $clauseWhere = ($critereFiltre==="tous") ? "" : "WHERE thm_id=$critereFiltre";
  $sql = "SELECT * FROM produit $clauseWhere ORDER BY $critereTri";
  $resultat = $cnx->query($sql);
  $produits = [];
  while($prod = $resultat->fetch_object()) {
    $produits[] = $prod;
  }
  return $produits;
}

