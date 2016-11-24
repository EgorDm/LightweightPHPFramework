<?php 
include_once FRW_FILES . "TableLoader.php";
include_once FRW_FILES . "Models/Query.php";
include_once FRW_FILES . "Helpers/SQLConverterHelper.php";

abstract class Table {

	protected $_table = "";
	
	protected $_alias = "";
	
	protected $_primaryKey = "";
	
	protected $_displayField = "";
	
	protected $_entityClass = "";


	public function __construct(array $config = array())
    {
		if(!empty($config['table'])) {
			$this->_table = $config['table'];
		} else {
            $this->_table = strtolower(str_replace('Table', '', get_class($this)));
        }
		if(!empty($config['alias'])) {
			$this->_alias = $config['alias'];
		} else {
            $this->_alias = strtolower(str_replace('Table', '', get_class($this)));
        }
		if(!empty($config['primaryKey'])) {
			$this->_primaryKey = $config['primaryKey'];
		} else {
            $this->_primaryKey = 'id';
        }
		if(!empty($config['displayField'])) {
			$this->_displayField = $config['displayField'];
		} else {
            $this->_displayField = 'id';
        }
		if(!empty($config['entityClass'])) {
			$this->_entityClass = $config['entityClass'];
		} else {
            $this->_entityClass = str_replace('Table', '', get_class($this)).'Entity';
        }
		$this->initialize($config);
	}
	
	public function initialize(array $config = array()) {
	}
	
	public function create() {
		$connection = TableLoader::connectSQL();
        $query = SQLConverterHelper::buildCreateTable($this->_table, $this->getFields());
        if ($connection->query($query) === TRUE) {
            return true;
        } else {
            echo "Error creating table: " . $connection->error;
            return false;
        }
	}
	
	public abstract function getFields();

    public function getTableName() {
        return $this->_table;
    }

    /**
     * @return Entity
     */
    public function createEntity() {
        include_once(APP_ENTITIES . $this->_entityClass .'.php');
        return new $this->_entityClass();
    }
	
	public function query() {
		return new Query(TableLoader::connectSQL(), $this);
	}
	
	public function get() {
	}
	
	

}
?>