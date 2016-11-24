<?php
include_once FRW_FILES . 'BaseController.php';
include_once APP_TABLES . 'UsersTable.php';
include_once APP_TABLES . 'ProductsTable.php';

class MainController extends BaseController
{
	public function initiate() {
	    $this->loadComponent('Auth');
        $this->loadComponent('Notification');
		$this->loadComponent('Cart');
        parent::initiate();
	}

    protected function beforeAction()
    {
        parent::beforeAction();
        $user = $this->Auth->getSession();
        if($user != null) {
            $this->set('username', $user['username']);
        }
    }


    public function index() {
        $products = TableLoader::get('products');
		$result = $products->query()->select()->execute();
		$this->set('products', $result);
		$this->set('cart', $this->Cart->getCart());
    }
	
	public function login() {
		if($this->_request->method == 'POST') {
			$username = $this->_request->post['username'];
			$password = $this->_request->post['password'];
			$res = $this->Auth->authenticate($username, $password);
			if($res != null) {
				$this->Notification->success("Welcome $username");
				$this->redirect(array('action' => 'index'));
				return;
			}
			$this->Notification->error('Wrong username or password!');
		}
	}
	
	public function register() {
		if($this->_request->method == 'POST') {
			$users = TableLoader::get('users');
			$user = $users->createEntity();
			$user->set('username', $this->_request->post['username']);
			$user->set('password', $this->_request->post['password']);
			$user->set('email', $this->_request->post['email']);
			$user->set('city', $this->_request->post['city']);
			$user->set('address', $this->_request->post['address']);
            $user->set('zip', $this->_request->post['zip']);
			$user->role = 0;
			$res = $users->query()->insert(array($user))->execute();
			if($res) {
				$this->Notification->success('Succesvol geregistreerd. Log nu in.');
				$this->redirect(array('action' => 'login'));
			}
		}
		$this->Notification->error('Please check if you filled in correct info.');
		$this->redirect(array('action' => 'login'));
	}

	public function logout() {
        $this->Auth->clearSession();
        $this->Notification->success('Succesfully logged out.');
        $this->redirect(array('action' => 'index'));
    }

	public function addProduct() {
		if($this->_request->method == 'POST') {
			$products = TableLoader::get('products');
			$product = $products->createEntity();
			$product->set('title', $this->_request->post['title']);
			$product->set('description', $this->_request->post['description']);
			$product->set('images', $this->_request->post['images']);
			$product->set('price', $this->_request->post['price']);
			$product->set('stock', $this->_request->post['stock']);
			$res = $products->query()->insert(array($product))->execute();
			if($res) {
				$this->Notification->success('Succesfully added a product.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Notification->error('Please check if you filled in correct info.');
			}
		}
	}
	
	public function addcart() {
		if($this->_request->method == 'POST') {
			$productId = $this->_request->post['product'];
			$products = TableLoader::get('products');
			$product = $products->query()->select()->where(array('id=' => $productId))->execute();
			if(!empty($product)) {
			    if($this->Cart->addToCart($product[0])) {
                    $this->Notification->success('Product is added to your cart.');
                } else {
                    $this->Notification->error('Not enough in stock.');
                }
			} else {
				$this->Notification->error('No product found.');
			}
		}
		$this->redirect(array('action' => 'index'));
	}

}