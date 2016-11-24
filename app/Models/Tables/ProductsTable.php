<?php 
include_once FRW_FILES . "Models/Table.php";

class ProductsTable extends Table {

	public function __construct(array $config = array()) {
		parent::__construct(array(
			'displayField' => 'title',
		));
	}
	
	public function getFields() {
		return array(
			'id' => array('int', 6, array('primary' => true)),
			'title' => array('string', 255, array('null' => false)),
            'description' => array('text', 255, array('null' => false)),
			'images' => array('text', 255, array('null' => false)),
			'price' => array('float', 255, array('null' => false)),
			'stock' => array('int', 6, array('null' => true))
		);
	}
}

?>