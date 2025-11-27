<?php
class controller{
	
	protected $db;
	protected $isUserLoggedIn = false;
	protected $infoUsuario = array();
	protected $cartCount = 0;

	public function __construct(){
		global $config;

		$u = new Usuarios(); 
		
		if($u->isLogged()) {
			$this->isUserLoggedIn = true;
			$this->infoUsuario = $_SESSION['usuario_logado'];
		}

		if(!empty($_SESSION['carrinho'])) {
			foreach($_SESSION['carrinho'] as $qtd) {
				$this->cartCount += $qtd;
			}
		}
	}

	protected function verificarLogin() {
    	if(!$this->isUserLoggedIn) {
        	header("Location: ".BASE_APP."login");
        	exit;
    	}
	}

	public function loadView($viewName, $viewData = array()){
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()){
		$viewData['is_logged_in'] = $this->isUserLoggedIn;
		$viewData['cart_count'] = $this->cartCount;
		extract($viewData);	
		include 'views/template.php';
	}

	public function loadViewInTemplate($viewName, $viewData){
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}
}