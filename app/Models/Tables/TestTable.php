<?php 
include_once FRW_FILES . "Models/Table.php";

class TestTable extends Table {

	public function __construct(array $config = array()) {
		parent::__construct(array(
			'table' => strtolower(str_replace('Table', '', get_class($this))),
			'alias' => strtolower(str_replace('Table', '', get_class($this))),
			'primaryKey' => 'id',
			'displayField' => 'name',
			'entityClass' => str_replace('Table', '', get_class($this)),
		));
		echo $this->_entityClass;
	}
	
	public function getFields() {
		return array(
			'id' => array('integer', 6),
			'name' => array('string', 255),
		);
	}

}

?>