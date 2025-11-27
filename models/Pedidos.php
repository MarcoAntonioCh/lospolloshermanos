<?php
class Pedidos extends model {

    public function criarPedido($id_usuario, $total_pedido, $taxa_entrega, $metodo_pagamento, $produtos) {
        
        $sql_max = "SELECT MAX(numero_pedido_usuario) as max_num 
                    FROM pedido 
                    WHERE id_usuario = :id_usuario";
        
        $sql_max = $this->db->prepare($sql_max);
        $sql_max->bindValue(':id_usuario', $id_usuario);
        $sql_max->execute();
        
        $resultado = $sql_max->fetch(\PDO::FETCH_ASSOC);
        $proximo_numero = $resultado['max_num'] + 1;


        $sql = "INSERT INTO pedido (id_usuario, numero_pedido_usuario, forma_pagamento, valor_total, valor_entrega) 
                VALUES (:id_usuario, :num_pedido_usr, :forma_pag, :total, :entrega)";
        
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_usuario', $id_usuario);
        $sql->bindValue(':num_pedido_usr', $proximo_numero);
        $sql->bindValue(':forma_pag', $metodo_pagamento);
        $sql->bindValue(':total', $total_pedido);
        $sql->bindValue(':entrega', $taxa_entrega);
        $sql->execute();

        $id_pedido = $this->db->lastInsertId();

        foreach ($produtos as $produto) {
            $sql_item = "INSERT INTO pedido_itens (id_pedido, id_item, quantidade, preco_unit) 
                         VALUES (:id_pedido, :id_item, :qtd, :preco)";
            
            $sql_item = $this->db->prepare($sql_item);
            $sql_item->bindValue(':id_pedido', $id_pedido);
            $sql_item->bindValue(':id_item', $produto['id_produto']);
            $sql_item->bindValue(':qtd', $produto['quantidade']);
            $sql_item->bindValue(':preco', $produto['vlr_produto']);
            $sql_item->execute();
        }

        return $id_pedido;
    }

    public function getPedido($id_pedido) {
        $array = array();
        $sql = "SELECT * FROM pedido WHERE id_pedido = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id_pedido));

        if($sql->rowCount() > 0) {
            $array = $sql->fetch(\PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function getItensDoPedido($id_pedido) {
        $array = array();
        
        $sql = "SELECT pi.*, p.nome 
                FROM pedido_itens pi
                JOIN produtos p ON pi.id_item = p.id_produto
                WHERE pi.id_pedido = ?";
        
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id_pedido));
        
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
        
        return $array;
    }

    public function getPedidosDoUsuario($id_usuario) {
        $array = array(); 
        
        $sql = "SELECT * FROM pedido 
                WHERE id_usuario = ? 
                ORDER BY data_pedido DESC, id_pedido DESC"; 
        
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id_usuario));

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
        
        return $array; 
    }

}
