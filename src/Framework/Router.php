<?php

namespace Framework;

/**
 * Class that will take care of the routing and all the routes in the project
 */
class Router
{
    /**
     * The routes that we can have
     * @var array
     */
    private array $routes = [];

    /**
     * Method to add new routes
     * @param string $path the path of the route
     * @param array $params the controller and the action
     * @return void
     */

    public function add(string $path, array $params=[]):void
    {
        $this->routes[] = [
            "path" => $path,
            "params" => $params
        ];
    }

    /**
     * Method that will match the url path with existing routes
     * @param string $path of the url
     * @return array|bool
     */
    public function match(string $path):array|bool
    {
        $path = trim($path, "/");
        foreach ($this->routes as $route) {
            /*  # is a delimiter, inside we can put our reg expression
           ^ - special character that will match the start of the string
           $ - special character that will match the end of the string
           [ ] - will match any of the characters inside
                 ex: #a[123]b#   - string a2b = is a match
               [0-7] : is a character range for any number between 0 and 7
               [a-z0-9 ] - used for single characters
           * - repetition : zero or more times
           + - repetition : one or more times
               #a*bc# - string aaabc = is a match ( also for 'abc' or 'bc' )
               #a+bc# - string aaabc = is a match ( also for 'abc' but not for 'bc' )
           () - we can use parenthesis to group the matches in our pattern
               : the preg_match function will have an array that will save all the
                 matches from the patters : first element is the full path and the next
                 ones will be the groups that we made using parenthesis
           (?<name>[a-z]+) - we can name our captures groups using ?<name> or ?'name' inside
                  the name can be anything that contains only letters and numbers
       */
//            $pattern="#/[a-z]+/[a-zA-Z_]+/(?'controller'[a-z]+)/(?'action'[a-z]+)$#";
//
//            echo $pattern, "\n",$route["path"],"\n";

           $pattern= $this->getPatternFromRoutePath($route["path"]);

            if( preg_match($pattern,$path,$matches)) {
                $matches = array_filter($matches,"is_string",ARRAY_FILTER_USE_KEY);

                $params = array_merge($matches,$route["params"]);
                print_r($params);
                return $params;
            }
        }

       /* foreach ($this->routes as $route) {
            if ($route["path"] === $path) {
                return $route['params'];
            }
        }
       */
        return false;
    }

    private function getPatternFromRoutePath(string $route_path):string
    {
        $route_path = trim($route_path,'/');
        $segments = explode("/",$route_path);
        $segments = array_map(function (string $segment):string {
            if(preg_match("#^\{([a-zA-Z][a-zA-Z0-9_]*)\}$#",$segment,$matches)){
                $segment = "(?<".$matches[1].">[^/]*)";
            }
            return $segment;
        },$segments);
          return "#^". implode("/",$segments) ."$#";
    }
}