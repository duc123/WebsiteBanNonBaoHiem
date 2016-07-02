<?php

/**
 * Description of loader
 *
 * @author duc
 */
class Loader {

    private $controllerName;
    private $controllerClass;
    private $action;
    private $urlvalues;

    public function __construct($urlvalues) {
        $this->urlvalues = $urlvalues;
        if ($this->urlvalues['controller'] == "") {
            $this->controllerName = "home";
            $this->controllerClass = "HomeController";
        } else {
            $this->controllerName = strtolower($this->urlvalues['controller']);
            $this->controllerClass = ucfirst(strtolower($this->urlvalues['controller'])) . "Controller";
        }

        if ($this->urlvalues['action'] == "") {
            $this->action = "index";
        } else {
            $this->action = strtolower($this->urlvalues['action']);
            
        }
    }

    public function createController() {
        //kiem tra controller class duoc yeu cau co ton tai ko?
        if (file_exists("controllers/" . $this->controllerName . ".php")) {
            require 'controllers/' . $this->controllerName . '.php';
        } else {
            require 'controllers/error.php';
            return new ErrorController('badurl', $this->urlvalues);
        }

        //kiem tra class co ton tai ko
        if (class_exists($this->controllerClass)) {
            $parents = class_parents($this->controllerClass);

            //class co thua ke tu BaseController class ko?
            if (in_array("BaseController", $parents)) {
                //class co chua action duoc yeu cau ko?
                if (method_exists($this->controllerClass, $this->action)) {
                    return new $this->controllerClass($this->action, $this->urlvalues);
                } else {
                    //bad action error
                    require 'controllers/error.php';
                    return new ErrorController('badurl', $this->urlvalues);
                }
            } else {
                //bad controller error
                require 'controllers/error.php';
                return new ErrorController('badurl', $this->urlvalues);
            }
        } else {
            //bad controller error
            require 'controllers/error.php';
            return new ErrorController('badurl', $this->urlvalues);
        }
    }

}
