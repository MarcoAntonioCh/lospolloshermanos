<?php
class pedidoConcluidoController extends controller{

	private $info;

	public function __construct(){
		parent::__construct();
		$this->verificarLogin();
		$this->info = array(
			'title' => 'Pedido Concluído'
		);
	}
	
	public function finalizar($metodo_pagamento = 'pix') {
        
        if(empty($_SESSION['carrinho'])) {
            header("Location: ".BASE_APP);
            exit;
        }

        $produtos_model = new Produtos();
        $ids = array_keys($_SESSION['carrinho']);
        $produtos = $produtos_model->getProdutosByIds($ids);

        $total_pedido = 0;
        foreach($produtos as $key => $produto) {
            $qtd = $_SESSION['carrinho'][$produto['id_produto']];
            $produtos[$key]['quantidade'] = $qtd;
            $total_pedido += $produto['vlr_produto'] * $qtd;
        }

        $taxa_entrega = (isset($_SESSION['tipo_entrega']) && $_SESSION['tipo_entrega'] == 'pickup') ? 0 : 9.90;
        $total_pedido += $taxa_entrega;

        $id_usuario = $this->infoUsuario['id_usuario'];

        $pedidos_model = new Pedidos();
        $id_pedido = $pedidos_model->criarPedido($id_usuario, $total_pedido, $taxa_entrega, $metodo_pagamento, $produtos);

        unset($_SESSION['carrinho']);
        unset($_SESSION['tipo_entrega']);

        header("Location: ".BASE_APP."pedidoConcluido/index/".$id_pedido);
        exit;
    }

	public function index($id_pedido = 0){
		if(intval($id_pedido) == 0) {
            header("Location: ".BASE_APP);
            exit;
        }

		$pedidos_model = new Pedidos();
		
		$dados = array(
			'page_css' => 'pedidoConcluido.css',
			'usuario' => $this->infoUsuario,
			'pedido' => $pedidos_model->getPedido($id_pedido),
			'itens' => $pedidos_model->getItensDoPedido($id_pedido)
		);

        if(empty($dados['pedido']) || $dados['pedido']['id_usuario'] != $this->infoUsuario['id_usuario']) {
            header("Location: ".BASE_APP);
            exit;
        }
		
		$this->loadTemplate('pedidoConcluido', $dados);
	}
}