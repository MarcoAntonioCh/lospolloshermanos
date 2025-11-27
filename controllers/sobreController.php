<?php
class sobreController extends controller{

	private $info;

	public function __construct(){
		parent::__construct();

		$this->info = array(
			'title' => 'Sobre'
		);
	}

	public function index(){
		$this->info['page_css'] = 'sobre.css';
        $this->loadTemplate('sobre', $this->info);
	}

}