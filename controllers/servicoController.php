<?php
class servicoController extends controller{

	private $info;

	public function __construct(){
		parent::__construct();

		$this->verificarLogin();

		$this->info = array(
			'title' => 'Servico'
		);
	}

	public function setTipoEntrega($tipo = 'delivery') {
        
        if($tipo == 'delivery') {
            $_SESSION['tipo_entrega'] = 'delivery';
        } elseif ($tipo == 'pickup') {
            $_SESSION['tipo_entrega'] = 'pickup';
        }
        
        header("Location: ".BASE_APP."cardapio");
        exit;
    }

	public function index(){
		$this->info['page_css'] = 'servicos.css';
        $this->loadTemplate('servico', $this->info);
	}

}