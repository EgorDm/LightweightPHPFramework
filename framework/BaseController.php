<?php
include_once FRW_FILES . 'Models/Request.php';
include_once FRW_FILES . 'Models/View.php';
include_once FRW_FILES . 'TableLoader.php';
abstract class BaseController
{
	protected $_request = null;

    protected $_view = null;

    protected $_components = array();

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->initiate();
    }

    public function initiate()
    {
        $this->_request = new Request();
    }

    public function redirect($location)
    {
		if(gettype($location) == 'array') {
			$location = $this->link($location);
		}
        header("Location: $location");
        exit();
    }
	
	public function link($params) {
		$controller = !empty($params['controller']) ? $params['controller'] : $GLOBALS['controller'];
		$action = !empty($params['action']) ? $params['action'] : 'index';
		$query = !empty($params['query']) ? $params['query'] : null;
		$ret = 'http://'. BASE . '/' . $controller . '/' . $action;
		if(!empty($query)) {
			$first = true;
			foreach($query as $key => $val) {
				if($first) {
					$ret.= '?';
				}
				$ret.= "$key=$val";
				$first = false;
			}
		}
		return $ret;
	}

    public function callAction($action = 'index') {
        if(method_exists ($this, $action)) {
            $this->_view = new View($GLOBALS['controller'], $action);
            $this->beforeAction();
            $this->$action();
            $this->afterAction();
            $this->_view->render();
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "Action $action doesnt exist";
        }
    }

    protected function beforeAction() {
        foreach ($this->_components as $key => $val) {
            $val->beforeAction();
        }
    }

    protected function afterAction() {
        foreach ($this->_components as $key => $val) {
            $val->afterAction($this->_view);
        }
    }

    protected function loadComponent($name, $config = array()) {
        $file = $name.'Component';
        if (file_exists(FRW_COMPONENTS . $file.'.php')) {
            include FRW_COMPONENTS . $file.'.php';
        } else if(file_exists(APP_COMPONENTS . $file.'.php')) {
            include APP_COMPONENTS . $file.'.php';
        } else {
            return;
        }
        $this->_components[$name] = new $file($config);
        $this->$name = $this->_components[$name];
    }

    public function set($name, $value) {
        $this->_view->$name = $value;
    }
	
	public $vars = array();

    public function __set($name, $value) {
        $this->vars[$name] = $value;
    }

    public function __get($name) {
        return $this->vars[$name];
    }
}