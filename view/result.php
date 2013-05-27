<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 20/04/13
 * Time: 23:47
 * To change this template use File | Settings | File Templates.
 */
?>
<?php
    include_once __DIR__ . '/partial/navigation.php';
?>
<?php
if (isset($errorMessage)) :
?>
<div class="row-fluid">
    <div class="offset2 span8">
        <div class="alert alert-danger">
            <button type="button" class="close">&times;</button>
            <strong>Echec lors de l'import ! <span class="toggleConsole pull-right">Plus de détails</span></strong>
        </div>
        <div class="console">
            <p>
                Resultats
            </p>
                <pre><?php echo $errorMessage; ?></pre>
        </div>
    </div>
</div>
<?php
elseif (isset($warningMessage)) :
?>
<div class="row-fluid">
    <div class="offset2 span8">
        <div class="alert alert-warning">
            <button type="button" class="close">&times;</button>
            <strong>Problèmes lors de l'import ! <span class="toggleConsole pull-right">Plus de détails</span></strong>
        </div>
        <div class="console">
            <p>
                Resultats
            </p>
                <pre><?php echo $warningMessage; ?></pre>
        </div>
    </div>
</div>
<?php
elseif (isset($debugMessage)) :
?>
<div class="row-fluid">
    <div class="offset2 span8">
        <div class="alert alert-success">
            <button type="button" class="close">&times;</button>
            <strong>Import réussi ! <span class="toggleConsole pull-right">Plus de détails</span></strong>
        </div>
        <div class="console">
            <p>
                Resultats
            </p>
                <pre><?php echo $debugMessage; ?></pre>
        </div>
    </div>
</div>
<?php
endif;
?>
<?php
if (isset($generatedFiles)):
?>
<div class="row-fluid">
    <div class="offset2 span8">
        <p>
            Fichiers générés :
        </p>
        <ul>
            <?php
                foreach($generatedFiles as $generatedFile):
            ?>
                <li><a href="./planning-de-<?php echo $generatedFile['urlName']; ?>"><i class="icon-calendar icon-2x"></i>&nbsp;Planning <?php echo $generatedFile['name']; ?></a></li>
            <?php
                endforeach;
            ?>
        </ul>
    </div>
</div>
<?php
endif;
?>
