<?php
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
define('ROOT', dirname(__FILE__));
define('FRW_FILES', ROOT . DS . 'framework' . DS);
define('FRW_COMPONENTS', FRW_FILES . DS . 'Components' . DS);
define('FRW_LIBS', FRW_FILES . DS . 'Libraries' . DS);
define('APP', ROOT . DS . 'app' . DS);
define('APP_TABLES', APP . 'Models' . DS . 'Tables' . DS);
define('APP_ENTITIES', APP . 'Models' . DS . 'Entities' . DS);
define('APP_CONTROLLERS', APP . 'Controllers' . DS);
define('APP_TEMPLATES', APP . 'Templates' . DS);
define('APP_LAYOUTS', APP . 'Templates' . DS . 'Layout' . DS);
define('APP_COMPONENTS', APP . DS . 'Components' . DS);
define('CONFIGS', APP . DS . 'Config' . DS);

include_once(FRW_FILES . 'Loaders' . DS . 'ConfigLoader.php');

$GLOBALS['action'] = 'index';
function startup()
{
    $path = ltrim($_SERVER['REQUEST_URI'], '/');
    $query = explode('?', $path);
    $elements = explode('/', $query[0]);
	$base = $_SERVER['HTTP_HOST'];
	for($i = 0; $i < ConfigLoader::get('url_offset'); $i++) {
		$base .= '/'.$elements[$i];
	}
	define('BASE', $base);
	
    for ($i = 0; $i < ConfigLoader::get('url_offset'); $i++) {
        unset($elements[0]);
    }
	$elements = array_values($elements);
	for($i = count($elements)-1; $i >= 0; $i--) {
		if(empty($elements[$i]) || $elements[$i] == '') {
			unset($elements[$i]);
		}
	}
	
    if (count($elements) == 0) {
        $GLOBALS['controller'] = ConfigLoader::get('default_controller');
        return;
    } else {
        $GLOBALS['controller'] = $elements[0];
    }

    if (count($elements) > 1) {
        $GLOBALS['action'] = $elements[1];
    }
}

function getController($controller)
{
    $ctrl_name = ucfirst($controller) . 'Controller';
    include_once(APP_CONTROLLERS . $ctrl_name . '.php');
    return new $ctrl_name();
}

startup();
$controller_instance = getController($GLOBALS['controller']);
$controller_instance->callAction( $GLOBALS['action']);