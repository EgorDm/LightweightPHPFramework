<?php
class ConfigLoader {

	protected static $_configs = array();
	
	public static function get($key, $config_alias = 'main_config') {
		if(!isset($_configs[$config_alias])) {
			$_configs[$config_alias] = require CONFIGS . $config_alias . '.php';
		}
		if(isset($_configs[$config_alias][$key])) {
			return $_configs[$config_alias][$key];
		}
		return null;
	}
	
	
}