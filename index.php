<?php
require "init.php";

$path = parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);
// this will give us just the path, without the query string

$router = new Framework\Router();

// more exact rutes must be put in front, and more general routes must be put last
$router->add(ROOT."/{title}/{id:\d+}/{page:\d+}",["controller"=>"products","action"=>"showPage"]);
$router->add(ROOT."/admin/{controller}/{action}",["namespace"=>"Admin"]);
$router->add(ROOT."/home/index",["controller"=>"home","action"=>"index"]);
$router->add(ROOT."/products",["controller"=>"products","action"=>"index"]);
$router->add(ROOT."/",["controller"=>"home","action"=>"index"]);
$router->add(ROOT."/{controller}/{id:\d+}/{action}");
$router->add(ROOT."/{controller}/{action}");



$dispatcher = new Framework\Dispatcher($router);
$dispatcher->handle($path);