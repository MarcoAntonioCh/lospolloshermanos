<?php
class pagamentoController extends controller{

	private $info;

	public function __construct(){
		parent::__construct();

		$this->verificarLogin();

		$this->info = array(
			'title' => 'Pagamento'
		);
	}

	public function index(){
		$this->info['page_css'] = 'pagamento.css';
        $this->loadTemplate('pagamento', $this->info);
	}

}