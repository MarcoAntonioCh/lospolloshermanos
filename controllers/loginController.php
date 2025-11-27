<?php
class loginController extends controller{

	private $info;

	public function __construct(){
		parent::__construct();

		$this->info = array(
			'title' => 'Login'
		);
	}

	public function index(){
		$this->info['page_css'] = 'login.css';
		$this->loadTemplate('login', $this->info);
	}

	public function login_action(){

		unset($_SESSION['carrinho']);
        unset($_SESSION['tipo_entrega']);

		$email = $_POST['email'];
		$senha   = $_POST['senha'];

		if(!empty($email) && !empty($senha)){

			$u = new Usuarios();
			if($u->validateLogin($email, $senha)){
				header("Location: ".BASE_APP."servico");
				exit;
			}
		}
		header("Location: ".BASE_APP."login");
		exit;
	}

	public function logout() {
		$u = new Usuarios();
		$u->logout();

		header("Location: ".BASE_APP);
		exit;
	}
}