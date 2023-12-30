<?php
namespace Framework;
use ReflectionMethod;
class Dispatcher
{
    private Router $router;
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function handle(string $path)
    {
        $params = $this->router->match($path);

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

       // $controller ="App\Controllers\\". ucwords($params["controller"]) ;

        $controller = $this->getControllerName($params);

        $action = $this->getActionName($params);




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

        $args = $this->getActionArguments($controller,$action,$params);
// we can use this for actions also
        $controller_object->$action(...$args);

// so this if block can be removed
        //if ($action === "index") {
        //    $controller_object ->index();
        //} elseif ($action === 'show') {
        //    $controller_object ->show();
        //}
    }

    private function getActionArguments(string $controller,string $action,array $params): array
    {
        $args = [];
        $method = new ReflectionMethod($controller,$action);
        foreach ($method->getParameters() as $parameter) {
            $name = $parameter->getName();
            $args[$name]  =  $params[$name];
        }
        return $args;
    }

    private function getControllerName(array $params):string
    {
        $controller = $params["controller"];
        $controller =str_replace("-","",ucwords(strtolower($controller),"-")) ;

        $namespace = "App\Controllers";

        if (array_key_exists("namespace",$params)){
            $namespace .= "\\" . $params["namespace"];
        }

        return $namespace . "\\" . $controller;
    }

    private function getActionName(array $params):string
    {
        $action = $params["action"];
        $action =lcfirst( str_replace("-","",ucwords(strtolower($action),"-"))) ;

        return  $action;
    }
}