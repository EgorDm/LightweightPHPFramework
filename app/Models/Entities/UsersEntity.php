<?php
include_once FRW_FILES . "Models/Entity.php";
include_once FRW_FILES . 'Loaders/ConfigLoader.php';
include_once FRW_FILES . 'Components/AuthComponent.php';

class UsersEntity extends Entity
{
	public function set($name, $value) {
		if($name == 'password') {
            $value = AuthComponent::passwordHash(strval($value));
		}
		parent::set($name, $value);
	}
}