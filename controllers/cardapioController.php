<?php
class cardapioController extends controller{

	private $info;

	public function __construct(){
		parent::__construct();

		$this->verificarLogin();

		$this->info = array(
			'title' => 'Cardapio'
		);
	}

	public function index(){
		$produtos = new Produtos();
		$this->info['list'] = $produtos->getAll();
		$this->info['page_css'] = 'cardapio.css';
        $this->loadTemplate('cardapio', $this->info);
	}

}