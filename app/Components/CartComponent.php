<?php
include_once FRW_COMPONENTS . 'Component.php';
include_once FRW_FILES . 'TableLoader.php';
include_once FRW_FILES . 'Models/Request.php';

class CartComponent extends Component {

	protected $_cartKey = 'Cart';

	public function initiate(array $config = array()) {
		parent::initiate($config);
		if(!empty($config['cart_key'])) {
			$this->_cartKey = $config['cart_key'];
		}
	}
	
	public function addToCart($product, $amount = 1) {
		$data = array('id' => $product->id, 'title' => $product->title, 'price' => $product->price, 'amount' => 0);
		if(isset($_SESSION[$this->_cartKey]['Items'][$product->id])) {
			$data = $_SESSION[$this->_cartKey]['Items'][$product->id];
		}
		$data['amount'] += $amount;
        if($product->stock < $data['amount']) {
            return false;
        }
		$_SESSION[$this->_cartKey]['Items'][$product->id] = $data;
        return true;
	}
	
	public function removeFromCart($product, $amount = 999) {
		if(!isset($_SESSION[$this->_cartKey]['Items'][$product->id])) {
			return;
		}
		$data = $_SESSION[$this->_cartKey]['Items'][$product->id];
		if($data['amount'] < $amount) {
			unset($_SESSION[$this->_cartKey]['Items'][$product->id]);
		} else {
			$data['amount'] -= $amount;
			$_SESSION[$this->_cartKey]['Items'][$product->id] = $data;
		}
	}
	
	public function getCart() {
		return $_SESSION[$this->_cartKey];
	}

}