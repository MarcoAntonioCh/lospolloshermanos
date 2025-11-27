<?php
class homeController extends controller{

	private $info;

	public function __construct(){
		parent::__construct();

		$this->info = array(
			'title' => 'Home'
		);
	}

	public function index(){
		$this->info['page_css'] = 'home.css';
		$this->loadTemplate('home', $this->info);
	}

}