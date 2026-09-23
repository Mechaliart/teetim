<?php
// Indiquer la page
$page = "teeshirts";

// Inclure le fichier commun contenant le haut du code des écrans de UI
include_once('commun/entete.inc.php');

// Documenter (avec PHPDoc) la variable $_
/** @var stdClass $_ */
?>
<main class="page-teeshirts">
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