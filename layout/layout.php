<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 20/04/13
 * Time: 23:15
 * To change this template use File | Settings | File Templates.
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Planning 115</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <!-- Bootstrap -->
    <link href="./static/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="./static/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="./static/css/bootstrap-fileupload.min.css" rel="stylesheet" media="screen">
    <link href="./static/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link href="./static/css/font-awesome-ie7.min.css" rel="stylesheet" media="screen">
    <link href="./static/css/planning.css" rel="stylesheet" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <?php
        if (isset($css)) {
            foreach ($css as $styleSheet) {
                echo '<link href="./static/css/' . $styleSheet . '.css" rel="stylesheet" media="screen">';
            }
        }
    ?>
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type="text/javascript" src="./static/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="./static/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./static/js/bootstrap-fileupload.min.js"></script>
    <?php
        if (isset($scripts)) {
            foreach ($scripts as $script) {
                echo '<script type="text/javascript" src="./static/js/' . $script . '.js"></script>';
            }
        }
    ?>
</head>
<body>
    <div class="container-fluid well">
        <?php
            if (isset($includeNavigation) && $includeNavigation) {
                include_once sprintf('%s/../view/partial/navigation.php', __DIR__);
            }
        ?>
        <?php
            if (isset($view)) {
                include sprintf('%s/../view/%s.php', __DIR__, $view);
            }
        ?>
    </div>
    <?php
        if (isset($includeFooter) && $includeFooter) {
            include sprintf('%s/../view/partial/footer.php', __DIR__);
        }
    ?>
</body>
</html>