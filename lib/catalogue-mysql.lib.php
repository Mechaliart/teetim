<?php

/************ Librairie de code pour gérer le catalogue des produits **********/

/**
 * Retourne les thèmes et les produits de la catégorie demandée.
 * @param string $categorie Catégorie de produits (ex: teeshirts, casquettes, etc.)
 * @param string $codeLangue Code en deux lettres de la langue d'affichage.
 * @param string $critereTri Valeur du critère de tri.
 * @return array Tableau contenant les deux tableaux des thèmes et des produits.
 */
function obtenirCatalogue($categorie, $codeLangue, $critereTri)
{
  $catalogue = json_decode(file_get_contents("data/$categorie.json"));
  $themes = [];
  $produits = [];

  foreach ($catalogue as $codeTheme => $detailTheme) {
    $themes[$codeTheme] = $detailTheme->theme->$codeLangue;

    $produits = array_merge($produits, $detailTheme->produits);
  }
  // Trier le tableau $produits avant de le retourner
  // Utiliser comme fonction de comparaison la fonction nommée suivant la 
  // variable $critereTri
  if (function_exists($critereTri)) {
    usort($produits, $critereTri);
  } else {
    shuffle($produits);
  }


  return [$themes, $produits];
}

/**
 * Fonction de comparaison des prix descendants des produits.
 * @param stdClass $prd1 Objet correspondant au premier produit à comparer.
 * @param stdClass $prd2 Objet correspondant au deuxième produit à comparer.
 * @return int Nombre entier positif, négatif, ou 0 selon la comparaison.
 */
function prixDesc($prd1, $prd2)
{
  return 100 * $prd2->prix - 100 * $prd1->prix;
}

/**
 * Fonction de comparaison des prix ascendants des produits.
 * @param stdClass $prd1 Objet correspondant au premier produit à comparer.
 * @param stdClass $prd2 Objet correspondant au deuxième produit à comparer.
 * @return int Nombre entier positif, négatif, ou 0 selon la comparaison.
 */
function prixAsc($prd1, $prd2)
{
  return 100 * $prd1->prix - 100 * $prd2->prix;
}

// Nom asc
// Plus tard (plus compliqué)

// Nom desc
// Plus tard 

// Ventes desc
/**
 * Fonction de comparaison des chiffres de vente en ordre descendant des produits.
 * @param stdClass $prd1 Objet correspondant au premier produit à comparer.
 * @param stdClass $prd2 Objet correspondant au deuxième produit à comparer.
 * @return int Nombre entier positif, négatif, ou 0 selon la comparaison.
 */
function ventesDesc($prd1, $prd2)
{
  return $prd2->ventes - $prd1->ventes;
}

/**
 * Fonction de comparaison des dates d'ajout au catalogue en ordre descendant.
 * @param stdClass $prd1 Objet correspondant au premier produit à comparer.
 * @param stdClass $prd2 Objet correspondant au deuxième produit à comparer.
 * @return int Nombre entier positif, négatif, ou 0 selon la comparaison.
 */
function dacDesc($prd1, $prd2)
{
  if ($prd2->dac > $prd1->dac) {
    return 1;
  } else if ($prd2->dac < $prd1->dac) {
    return -1;
  } else {
    return 0;
  }
}
