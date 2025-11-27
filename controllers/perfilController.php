<?php
class perfilController extends controller {

    private $info;

    public function __construct() {
        parent::__construct();
        $this->verificarLogin();
        $this->info = array(
            'title' => 'Meu Perfil'
        );
    }

    public function index() {
        
        $pedidos_model = new Pedidos();
        
        $pedidos = $pedidos_model->getPedidosDoUsuario($this->infoUsuario['id_usuario']);

        foreach($pedidos as $key => $pedido) {
            $pedidos[$key]['itens'] = $pedidos_model->getItensDoPedido($pedido['id_pedido']);
        }

        $dados = array(
            'page_css' => 'perfil.css',
            'usuario' => $this->infoUsuario, 
            'pedidos' => $pedidos 
        );
        
        $this->loadTemplate('perfil', $dados);
    }


    public function update_action() {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];
        
        $telefone_limpo = preg_replace('/\D/', '', $telefone);

        $u = new Usuarios();
        $u->id_usuario = $this->infoUsuario['id_usuario'];
        $u->nome = $nome;
        $u->email = $email;
        $u->telefone = $telefone_limpo;
        $u->endereco = $endereco;
        $u->senha = $this->infoUsuario['senha']; 
        $u->cpf = $this->infoUsuario['cpf']; 
        
        $u->editar();

        header("Location: ".BASE_APP."perfil");
        exit;
    }

    public function deletar() {
        $u = new Usuarios();
        
        $u->excluirConta($this->infoUsuario['id_usuario']);

        unset($_SESSION['token']);
        unset($_SESSION['carrinho']);
        unset($_SESSION['tipo_entrega']);
        unset($_SESSION['usuario_logado']);

        header("Location: ".BASE_APP);
        exit;
    }
}