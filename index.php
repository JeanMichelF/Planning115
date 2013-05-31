<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 05/03/13
 * Time: 19:32
 * To change this template use File | Settings | File Templates.
 */
include __DIR__.'/bootstrap.php';

$debug=false;

if ($debug == true) {
    echo "<pre>";
    if (!empty($_FILES)) {
        var_dump($_FILES);
    }

    if (!empty($_POST)) {
        var_dump($_POST);
    }
    echo PHP_EOL . PHP_EOL . "[REQUEST_URI]" . $_SERVER['REQUEST_URI'];
    echo PHP_EOL . PHP_EOL . "[PATH_INFO]" .  $_SERVER['PATH_INFO'];
    //include __DIR__ . '/vue/conversion.php';
}

require_once 'router.php';

$r = new Router("/bakubaku/planning115"); // create router instance

$r->map('/bakubaku/planning115/', array('controller' => 'home'));
$r->map('/bakubaku/planning115/aide', array('controller' => 'help'));
$r->map('/bakubaku/planning115/accueil', array('controller' => 'home'));
$r->map('/bakubaku/planning115/upload-fichier', array('controller' => 'upload'));
$r->map('/bakubaku/planning115/upload-complete', array('controller' => 'upload', 'action' => 'complete'));
$r->map('/bakubaku/planning115/planning-de-:name', array('controller' => 'download'), array('name' => '.*'));

$r->default_routes();
$r->execute();

if ($debug == true) {
    echo PHP_EOL . PHP_EOL . "request_uri : " . $r->request_uri;
    echo PHP_EOL . PHP_EOL . "controller : " . $r->controller; // will return name as it appears in url, ex: 'user_images'
    echo PHP_EOL . PHP_EOL . "controller_name : " . $r->controller_name; // will return processed name of controller
    // for example, if class name in url is 'user_images', then 'controller_name' var will be UserImages
    echo PHP_EOL . PHP_EOL . "action : " . $r->action;
    echo PHP_EOL . PHP_EOL . "id : " . $r->id; // if parameter :id presents
    echo PHP_EOL . PHP_EOL . "params : ";
    print_r($r->params); // array(...)
    echo PHP_EOL . PHP_EOL . "route_found : " . $r->route_found; // true - if route found, false - if not
    //echo PHP_EOL . PHP_EOL . "routes : ";
    //print_r($r->routes); // true - if route found, false - if not
    echo "</pre>";
}
ob_start();
if ($r->route_found) {
    if (is_file('./controller/' . $r->controller_name . '.php')) {
        try {
            call_user_func_array(array(__NAMESPACE__ .'\controller\\' . $r->controller_name, $r->action . 'Action'), array($r->params));
        } catch (BadFunctionCallException $e) {
            header("HTTP/1.0 500 Internal Server Error");
            $e->getTraceAsString();
            // @todo mettre page d'erreur 500 ou redirection sur la home ?
        }
    } else {
        header("HTTP/1.0 404 Not Found");
        // @todo mettre page d'erreur 404
        print "controller pas trouve " . $r->controller_name; exit();
    }
} else {
    header("HTTP/1.0 404 Not Found");
    // @todo mettre page d'erreur 404
    print "route pas trouvee"; exit();
}
echo ob_get_clean();