<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 20/04/13
 * Time: 23:47
 * To change this template use File | Settings | File Templates.
 */
?>
<div class="page-header">
    <h1>Convertissez le planning Excel en un planning importable dans un agenda
        (Google Calendar, iCal...)</h1>
</div>
<p>
    <i class="icon-warning-sign icon-large"></i>&nbsp;Attention :
    les données sont fournies à titre informatif, <strong>seul le planning Excel fait foi</strong>.<br/>
    Les informations DETACHES et HOTELS se basent sur le code couleur des cellules : il est possible
    qu'un changement de couleur ait lieu dans le planning Excel et rendent ces informations non
    disponibles.<br/>
    Aucune information dans le planning Excel ne permet de trouver l'année courante. Le script pose donc
    arbitrairement 2013 année date courante.
</p>
<?php
    include_once __DIR__ . '/partial/formulaire.php';
?>
