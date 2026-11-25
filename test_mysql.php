<?php
// Étape 1 : Obtenir une connexion à MySQL
$cnx = new mysqli('db', 'teetim', 'teetim', 'teetim');

// Étape 2 : Écrire une requête (commande) SQL
$requeteProduits = "SELECT nom, prix FROM produit LIMIT 10";

// Étape 3 : Exécuter la commande sur la connexion MySQL
$resultat = $cnx -> query($requeteProduits);

// Étape 4 dans le code HTML plus bas...
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test intégration PHP/MySQL</title>
</head>
<body>
    <h2>Les 10 premiers produits (nom et prix)</h2>
    <ul>
        <?php while($unProduit = $resultat->fetch_object()): ?>
            <li><?= $unProduit->nom; ?> (<?= $unProduit->prix; ?>)</li>
        <?php endwhile; ?>
    </ul>
</body>
</html>