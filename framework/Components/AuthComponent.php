<?php
include_once FRW_COMPONENTS . 'Component.php';
include_once FRW_FILES . 'TableLoader.php';
include_once FRW_FILES . 'Models/Request.php';

class AuthComponent extends Component {

	protected $_usersTable = 'Users';
	protected $_nameField = 'username';
	protected $_passwordField = 'password';
	protected $_currentUser = '';
	
	public function initiate(array $config = array()) {
		parent::initiate($config);
		if(!empty($config['users_table'])) {
			$this->_usersTable = $config['users_table'];
		}
		if(!empty($config['name_field'])) {
			$this->_nameField = $config['name_field'];
		}
		if(!empty($config['password_field'])) {
			$this->_passwordField = $config['name_field'];
		}
	}
	
	public function authenticate($username, $password) {
		$users = TableLoader::get($this->_usersTable);
		$res = $users->query()->select()->where(array($this->_nameField.'=' => $username))->execute();
		if(empty($res)) {
			return null;
		}
		
		$user = $res[0];
		if($user->password == $this->passwordHash($password)) {
			unset($user->password);
            Request::sessionSet($this->_usersTable, $user->serialize());
			return $user;
		}
		return null;
	}

	public function getSession() {
	//unset($_SESSION);

	//echo json_encode($_SESSION);
	    if(!empty($_SESSION[$this->_usersTable])) {
	        return $_SESSION[$this->_usersTable];
        }
        return null;
    }

    public function clearSession() {
        unset($_SESSION[$this->_usersTable]);
    }
	
	public static function passwordHash($password) {
		return hash('sha512', $password . ConfigLoader::get('salt'));
	}
}
?>