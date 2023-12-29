<?php
require "init.php";

$path = parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);
// this will give us just the path, without the query string

$router = new Framework\Router();
$router->add(ROOT."/{controller}/{action}");
$router->add(ROOT."/{controller}/{id}/{action}");
$router->add(ROOT."/home/index",["controller"=>"home","action"=>"index"]);
$router->add(ROOT."/products",["controller"=>"products","action"=>"index"]);
$router->add(ROOT."/",["controller"=>"home","action"=>"index"]);

$params = $router->match($path);

if ($params === false) {
    exit("No route matched!");
}

//*********************************************************************

//let's split the path, so we can have the controller and the action separately
    //$segments = explode("/",$path);

// the result will be an array with more elements :
//  - first one is empty because the path start with a separator "/"
//  - in our case we'll have the next elements from our root directory
//  - third will be the controller
//  - forth one will be the action

    // depending on what action is set, the script will show the corresponding view
            //$action = $_GET['action'];
    //we can also have more Controllers
            //$controller = $_GET["controller"];

// now we don't need to use anymore the superglobal $_GET for the action and the
// controller, since we have the segments from the path above

    //$controller = $segments[3];
    //$action = $segments[4];

//*********************************************************************

$controller ="App\Controllers\\". ucwords($params["controller"]) ;
$action = $params["action"];


// we can require the controller directly in the path,
// so we don't repeat ourselves,making a requirement in the if statement
    //require "src/Controllers/$controller.php";

// This line below, will create an object of either Home or Product class
// it doesn't matter that we don't have a capital letter
$controller_object = new $controller;


// so with this two lines, we can replace all of this if block below
    //if($controller === "products") {
    //    require "src/Controllers/Products.php";
    //    $controller_object = new Products();
    //} elseif ($controller === "home") {
    //    require "src/Controllers/Home.php";
    //    $controller_object = new Home();
    //}


// we can use this for actions also
$controller_object->$action();

// so this if block can be removed
    //if ($action === "index") {
    //    $controller_object ->index();
    //} elseif ($action === 'show') {
    //    $controller_object ->show();
    //}

