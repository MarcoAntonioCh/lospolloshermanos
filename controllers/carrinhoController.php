<?php
class carrinhoController extends controller{

	private $info;

	public function __construct(){
		parent::__construct();
		$this->verificarLogin();
		$this->info = array(
			'title' => 'Carrinho'
		);
	}

	public function index() {
        $produtos = new Produtos();
        $taxa_entrega = 9.90;
        if(isset($_SESSION['tipo_entrega']) && $_SESSION['tipo_entrega'] == 'pickup') {
            $taxa_entrega = 0;
        }
        $dados = array(
            'list' => array(),
            'total' => 0,
            'entrega' => $taxa_entrega
        );
        if(isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
            $ids = array_keys($_SESSION['carrinho']);
            $dados['list'] = $produtos->getProdutosByIds($ids);
            foreach($dados['list'] as $key => $produto) {
                $id_produto = $produto['id_produto'];
                $qtd = $_SESSION['carrinho'][$id_produto];
                $dados['list'][$key]['quantidade'] = $qtd;
                $dados['list'][$key]['subtotal_item'] = $produto['vlr_produto'] * $qtd;
                $dados['total'] += $dados['list'][$key]['subtotal_item'];
            }
        }
        $this->info['page_css'] = 'carrinho.css';
        $viewData = array_merge($this->info, $dados);
        $this->loadTemplate('carrinho', $viewData);
    }

	public function adicionar($id_produto = 0) {
        $id_produto = intval($id_produto);
        if($id_produto > 0) {
            if (!isset($_SESSION['carrinho'])) { $_SESSION['carrinho'] = array(); }
            if (isset($_SESSION['carrinho'][$id_produto])) {
                $_SESSION['carrinho'][$id_produto]++; 
            } else {
                $_SESSION['carrinho'][$id_produto] = 1;
            }
        }
        $this->responderJSON();
    }

    public function aumentar($id_produto = 0) {
        $id_produto = intval($id_produto);
        if($id_produto > 0 && isset($_SESSION['carrinho'][$id_produto])) {
            $_SESSION['carrinho'][$id_produto]++;
        }
        if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'carrinho') !== false) {
             header("Location: ".BASE_APP."carrinho"); exit;
        }
        $this->responderJSON();
    }

    public function diminuir($id_produto = 0) {
        $id_produto = intval($id_produto);
        if($id_produto > 0 && isset($_SESSION['carrinho'][$id_produto])) {
            if($_SESSION['carrinho'][$id_produto] > 1) {
                $_SESSION['carrinho'][$id_produto]--;
            } else {
                unset($_SESSION['carrinho'][$id_produto]);
            }
        }
        if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'carrinho') !== false) {
             header("Location: ".BASE_APP."carrinho"); exit;
        }
        $this->responderJSON();
    }

    public function remover($id_produto = 0) {
        $id_produto = intval($id_produto);
        if($id_produto > 0 && isset($_SESSION['carrinho'][$id_produto])) {
            unset($_SESSION['carrinho'][$id_produto]);
        }
        if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'carrinho') !== false) {
             header("Location: ".BASE_APP."carrinho"); exit;
        }
        $this->responderJSON();
    }

    private function responderJSON() {
        $total_itens = 0;
		if(!empty($_SESSION['carrinho'])) {
			foreach($_SESSION['carrinho'] as $qtd) {
				$total_itens += $qtd;
			}
		}
        
        header('Content-Type: application/json');
        echo json_encode(['total_itens' => $total_itens]);
        exit;
    }
}