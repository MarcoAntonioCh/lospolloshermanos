<?php
class Usuarios extends model{

	public $id_usuario;
	public $nome;
	public $email;
	public $senha;
	public $cpf;
	public $endereco;
	public $telefone;

	public function adicionar(){
		$sql = "INSERT INTO usuario(nome, email, senha, cpf, endereco, telefone) 
		            VALUES (:nome, :email, :senha, :cpf, :endereco, :telefone)";

		$sql = $this->db->prepare($sql);
		$sql->bindValue(":nome", $this->nome);
		$sql->bindValue(":email"  , $this->email);
		$sql->bindValue(":senha"   , $this->senha);
		$sql->bindValue(":cpf", $this->cpf);
		$sql->bindValue(":endereco", $this->endereco);
		$sql->bindValue(":telefone", $this->telefone);
		$sql->execute();
	}

	public function editar(){
		$sql = "UPDATE usuario
		           SET email    = :email
		             , nome       = :nome
		             , senha      = :senha
					 , telefone   = :telefone
					 , cpf        = :cpf
					 , endereco   = :endereco
		         WHERE id_usuario = :id_usuario";

		$sql = $this->db->prepare($sql);
		$sql->bindValue(":nome", $this->nome);
		$sql->bindValue(":email"  , $this->email);
		$sql->bindValue(":senha"   , $this->senha);
		$sql->bindValue(":cpf", $this->cpf);
		$sql->bindValue(":endereco", $this->endereco);
		$sql->bindValue(":telefone", $this->telefone);
		$sql->bindValue(":id_usuario", $this->id_usuario);
		$sql->execute();
	}

	public function excluirConta($id_usuario) {
		$sql = "DELETE FROM usuario WHERE id_usuario = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id_usuario);
		$sql->execute();
	}

	public function getAll(){
		$retorno = array();

		$sql = "SELECT * FROM usuario ORDER BY nome";

		$sql = $this->db->query($sql);
		if($sql->rowCount() > 0){
			$retorno = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}

		return $retorno;
	}

	public function getUsuarioByEmail($email){
		$retorno = array();

		$sql = 'SELECT * 
				  FROM usuario
				 WHERE email = :email';

		$sql = $this->db->prepare($sql);
		$sql->bindValue(':email', $email);
		$sql->execute();

		if($sql->rowcount() > 0){
			$retorno = $sql->fetch(\PDO::FETCH_ASSOC);
		}

		return $retorno;
	}

	public function validateLogin($email, $senha){
		$sql = "SELECT *
		          FROM usuario
		         WHERE email = :email
		           AND senha   = :senha";
	
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);		           
		$sql->bindValue(":senha"  , $senha);
		$sql->execute();

		if($sql->rowCount() > 0){
			$dados = $sql->fetch(\PDO::FETCH_ASSOC);

			$token = md5(date('Ymdhis').rand(0,999));

			$sql = "UPDATE usuario SET token = :token 
			         WHERE id_usuario = :id_usuario";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":token"      , $token);		           
			$sql->bindValue(":id_usuario" , $dados['id_usuario']);
			$sql->execute();

			$_SESSION['token'] = $token;

			return true;
		}

		return false;
	}

	public function isLogged(){
		if(!empty($_SESSION['token'])){
			$token = $_SESSION['token'];

			$sql = "SELECT *
		              FROM usuario
		             WHERE token = :token";
	
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":token", $token);		
			$sql->execute();

			if($sql->rowCount() > 0){
				$_SESSION['usuario_logado'] = $sql->fetch(\PDO::FETCH_ASSOC);
				return true;
			}
		}
		return false;
	}

	public function logout() {
		if(!empty($_SESSION['token'])) {
			$token = $_SESSION['token'];

			$sql = "UPDATE usuario SET token = NULL WHERE token = :token";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":token", $token);
			$sql->execute();
		}

		unset($_SESSION['token']);
		unset($_SESSION['carrinho']);
        unset($_SESSION['tipo_entrega']);
	}

}