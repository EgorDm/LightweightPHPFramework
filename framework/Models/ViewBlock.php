<?php

/**
 * Created by PhpStorm.
 * User: EgorDm
 * Date: 02-Oct-16
 * Time: 23:12
 */
class ViewBlock
{

    private $_views = array();
    private $_active = null;

    public function __construct()
    {
    }

    public function start($name)
    {
        $this->_views[$name] = '';
        $this->_active = $name;
        ob_start();
    }

    public function end()
    {
        if ($this->_active == null) return;
        $buffer = ob_get_clean();
        $this->_views[$this->_active] .= $buffer;
        $this->_active = null;
    }

    public function get($name) {
        return $this->_views[$name];
    }

    public function set($name, $content) {
        $this->_views[$name] = $content;
    }

}