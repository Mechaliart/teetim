<?php

/** 
 * @var stdClass $_ Raccourci pour la section texte de cette page. 
 * @var string $langue Code de la langue active.
 */

// Librairie du catalogue de produits.
include('lib/catalogue.lib.php');

// Définir la variable $page pour indiquer la page affichée.
$page = 'teeshirts';
// Inclure la partie de haut de la page.
include('parties-communes/entete.php');

// Gérer l'intéractivité de filtre et tri.
// $tri = (isset($_GET['tri'])) ? $_GET['tri'] : 'aleatoire';
$tri = $_GET['tri'] ?? 'RAND()';
// $filtre = (isset($_GET['filtre'])) ? $_GET['filtre'] : 'tous';
$filtre = $_GET['filtre'] ?? 'tous';

$themes = obtenirThemes();
// print_r($themes);
$produits = obtenirProduits(1, $tri, $filtre);

// Formatteur des montants d'argent
$formatteurMontants = new NumberFormatter($langue, NumberFormatter::CURRENCY);
?>
<main class="page-produits page-teeshirts">
	<article class="amorce">
		<h1><?= $_->titrePage ?></h1>
		<form class="controle">
			<div class="filtre">
				<label for="filtre">Filtrer par thème : </label>
				<select name="filtre" id="filtre">
					<option value="tous">Tous les produits</option>

					<!-- Gabarit d'une option de thème -->
					<?php foreach ($themes as $unTheme) : ?>
						<option 
							<?= ($filtre==$unTheme->id) ? ' selected ' : ''; ?>
							value="<?= $unTheme->id; ?>"
						>
							<?= $unTheme->nom; ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="tri">
				<label for="tri">Trier par : </label>
				<select name="tri" id="tri">
					<option <?= ($tri == 'RAND()') ? ' selected ' : ''; ?> value="RAND()">Aléatoire</option>
					<option <?= ($tri == 'ventes DESC') ? ' selected ' : ''; ?> value="ventes DESC">Meilleur vendeur</option>
					<option <?= ($tri == 'prix ASC') ? ' selected ' : ''; ?> value="prix ASC">Prix / ascendant</option>
					<option <?= ($tri == 'prix DESC') ? ' selected ' : ''; ?> value="prix DESC">Prix / descendant</option>
					<option <?= ($tri == 'nom ASC') ? ' selected ' : ''; ?> value="nom ASC">Alpha / ascendant</option>
					<option <?= ($tri == 'nom DESC') ? ' selected ' : ''; ?> value="nom DESC">Alpha / descendant</option>
					<option <?= ($tri == 'dac DESC') ? ' selected ' : ''; ?> value="dac DESC">Nouveauté</option>
				</select>
			</div>
		</form>
	</article>
	<article class="principal">
		<!-- Gabarit -->
		<?php foreach ($produits as $prd) : ?>
			<div class="produit">
				<span class="image">
					<img 
						src="images/produits/teeshirts/<?= ($prd->fichier_image!=='') ? $prd->fichier_image : 'vert.png'; ?>" 
						alt="<?= $prd->nom; ?>"
						onerror="evt => evt.target.src = 'images/produits/teeshirts/vert.png'"
						
					>
				</span>
				<span class="nom"><?= $prd->nom; ?></span>
				<span class="prix"><?= $formatteurMontants->formatCurrency($prd->prix, 'CAD'); ?></span>
			</div>
		<?php endforeach; ?>
	</article>
</main>
<?php include('parties-communes/pied2page.php'); ?>