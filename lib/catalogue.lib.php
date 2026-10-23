<?php 
/*
 * Librairie de code pour gérer le catalogue
 */

/**
 * 
 * Retourne les thèmes et les produits de la catégorie demandée.
 * @param string $catalogue Catégorie de produits (ex: teeshirts, casquettes, etc.)
 * @param string $codeLangue Code de langue en 2 lettres de la langue d'affichage
 * @return array Tableau contenant les 2 tableaux des themes et des produits
 */

function obtenirCatalogue(){
    $catalogue = json_decode(file_get_contents("data/$catalogue.json"));
    $themes = [];
    $produits = [];

    foreach($catalogue as $codeThemes => $detailTheme){
        $themes[$codeThemes] = $detailTheme->theme->$codeLangue;
        $produits = array_merge($produits, $detailTheme->produits);
    }
    return [$themes, $produits];
}
?>