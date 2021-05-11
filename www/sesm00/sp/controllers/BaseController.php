<?php


abstract class BaseController
{
    protected $view;

    public function __construct() {
        $actionName = strtolower(str_replace("Controller", "", get_class($this)));
        $this->view = $actionName . "View.php";
    }

    public function performAction() {
        ob_start();
        $this->action();
        $this->performView();
        return ob_get_clean();
    }

    public function performView() {
        $viewsDir = __DIR__ . '/../views/';
        if (file_exists($viewsDir . $this->view)) {
            require_once $viewsDir . $this->view;
        } else {
            trigger_error("Controller view not associated");
        }
    }

    public abstract function action();

}