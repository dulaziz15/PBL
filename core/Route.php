<?php
namespace Pbl\Core;

abstract class Route {
    protected $routes = [];

    public function route($controller = null, $sub = '', $id = '') {
        if (isset($this->routes[$sub])) {
            $method = $this->routes[$sub];
            if ($controller && method_exists($controller, $method)) {
                $controller->$method($id);
            } else {
                $this->handleNotFound();
            }
        } else {
            $this->handleNotFound();
        }
    }

    protected function handleNotFound() {
        header('location:../view/404.php');
        exit;
    }
}