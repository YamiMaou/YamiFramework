<?php 
namespace YamiTec\Interfaces;

use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\RouteCollector;

interface Router {
    public function __construct($_config);
    public function controller();
    public function isActive();
}
abstract class RouterInterface implements Router
{
    private $_activeRoutes;
    private $_inactiveRoutes;

    public function __construct($_config){
        $_config = [
            "inRoutes" => ["home" => "app\Controllers\HomeController"],
            "Routes" => ["out" => "app\Controllers\HomeController"],
        ];
        $this->_activeRoutes = $_config["Routes"];
        $this->_inactiveRoutes = $_config["inRoutes"];
    }

    public function controller()
    {
        try {
            $router = new RouteCollector();
            $router->filter("login", function () {
                if($this->isActive()){
                    echo "Active <br />";
                } else {
                    echo "not Active ";
                }
            });
            foreach($this->_activeRoutes as  $rota => $controller){
                $router->controller($rota,$controller);
            }

            $router->group(["before" => "login"], function ($router) {
                foreach ($this->_inactiveRoutes as $rota => $controller) {
                    $router->controller($rota, $controller);
                }
            });
            $dispatcher = new Dispatcher($router->getData());
            $view = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            return $view;
        } catch (\Exception $e) {
            echo "Rota não existe : ".$e->getMessage();
            return false;
        }
    }

    public function isActive(){
        return true;
    }

}