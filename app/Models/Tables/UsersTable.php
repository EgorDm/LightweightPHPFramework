<?php 
include_once FRW_FILES . "Models/Table.php";

class UsersTable extends Table {

	public function __construct(array $config = array()) {
		parent::__construct(array(
			'displayField' => 'username',
		));
	}
	
	public function getFields() {
		return array(
			'id' => array('int', 6, array('primary' => true)),
			'username' => array('string', 255, array('null' => false)),
            'password' => array('string', 255, array('null' => false)),
			'email' => array('string', 255, array('null' => false)),
			'role' => array('int', 6, array('null' => false)),
			'city' => array('string', 255, array('null' => false)),
			'address' => array('string', 255, array('null' => false)),
			'zip' => array('string', 255, array('null' => false)),
		);
	}
}

?>