<?php
class Route {
    function start() {
        $url = $_SERVER['REQUEST_URI'];
        $route = explode('/', trim(parse_url($url, PHP_URL_PATH), '/'));

        if (isset($route[1]) && $route[1]) {
            $controller_name = $route[1];
        } else {
            $controller_name = CONTROLLERDEFAULT;
        }

        if (isset($route[2]) && $route[2]) {
            $action = $route[2];
        } else {
            $action = ACTIONDEFAULT;
        }

        $query_params = [];
        if (!empty($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $query_params);
        }

        $controller_path = 'controllers/' . strtolower($controller_name) . '.php';
        $model_path = 'models/' . strtolower($controller_name) . '.php';

        if (file_exists($model_path)) {
            include $model_path;
        }

        $controller = null;
        if (file_exists($controller_path)) {
            include $controller_path;
            $controller_class = $controller_name . 'Controller';
            if (class_exists($controller_class)) {
                $controller = new $controller_class;
            } else {
                die("Controller class $controller_class not found.");
            }
        } else {
            die("Controller file $controller_path not found.");
        }

        if ($controller && method_exists($controller, $action)) {
            if (!empty($query_params)) {
                $controller->$action($query_params);
            } else {
                $controller->$action();
            }
        } else {
            die("Action $action not found in controller $controller_name.");
        }
    }
}
