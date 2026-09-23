<?php
// Indiquer la page
$page = "casquettes";

// Inclure le fichier commun contenant le haut du code des écrans de UI
include_once('commun/entete.inc.php');
// Ajouter une "annotation" (commentaire de documentation) pour
// signifier à PHPIntelephense que la variable $_ existe dans ce 
// contexte.
/** @var stdClass $_ */
?>
<main class="page-casquettes">
    <article class="amorce">
        <h1><?= $_->amorceH1; ?></h1>
    </article>
    <article class="principal">
        <?= $_->enConstruction; ?>
    </article>
</main>
<?php
// Inclure le fichier commun contenant la partie du bas du code des écrans de UI
include_once('commun/p2p.inc.php');
?>