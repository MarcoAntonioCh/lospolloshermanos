<?php
class cadastroController extends controller{

	private $info;

	public function __construct(){
		parent::__construct();
		$this->info = array(
			'title' => 'Cadastro'
		);
	}

	public function index(){
		$this->info['page_css'] = 'cadastro.css';
		$this->loadTemplate('cadastro', $this->info);
	}

	public function cadastro_action() {

		$nome     = $_POST['nome'];
		$email    = $_POST['email'];
		$cpf      = $_POST['cpf'];
		$endereco = $_POST['endereco'];
		$telefone = $_POST['telefone'];
		$senha    = $_POST['senha'];
		$senhaC   = $_POST['senhaC']; 

		$cpf_limpo = preg_replace('/\D/', '', $cpf);
		$telefone_limpo = preg_replace('/\D/', '', $telefone);

		if(!empty($email) && !empty($senha) && !empty($nome)) {

			if($senha != $senhaC) {
				header("Location: ".BASE_APP."cadastro");
				exit;
			}

			$u = new Usuarios();

			if(count($u->getUsuarioByEmail($email)) > 0) {
				header("Location: ".BASE_APP."cadastro");
				exit;
			}

			$u->nome     = $nome;
			$u->email    = $email;
			$u->cpf      = $cpf_limpo;
			$u->endereco = $endereco;
			$u->telefone = $telefone_limpo;
			$u->senha    = $senha;
			
			$u->adicionar();

			if($u->validateLogin($email, $senha)){
				header("Location: ".BASE_APP."servico");
			    exit;
			}
		}

		header("Location: ".BASE_APP."cadastro");
		exit;
	}
}