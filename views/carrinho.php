<main>
    <div class="container">
        <div class="faixa-carrinho">
            <span id="t1">Seu Carrinho</span>
            <span id="t2">Revise seus pedidos antes de finalizar</span>
        </div>
        <div class="carrinho">
            <div class="itens">
                <p class="text">Itens do Pedido</p>

                <?php if(empty($list)): ?>
                    <p style="text-align: center; font-family: var(--font1); margin-top: 50px;">
                        Seu carrinho está vazio.
                    </p>
                <?php else: ?>
                    <?php foreach($list as $item): ?>
                    <div class="order1"> <img src="<?php echo BASE_APP.'media/produtos/'.$item['url_foto']; ?>" alt="<?php echo $item['nome']; ?>">
                        <div class="info">
                            <span id="nome-p">
                                <?php echo $item['nome']; ?>
                                <a href="<?php echo BASE_APP; ?>carrinho/remover/<?php echo $item['id_produto']; ?>">
                                    <img src="<?php echo BASE_APP; ?>assets/images/delete.png" alt="lixeira">
                                </a>
                            </span>
                            <span id="desc-p">
                                <?php echo $item['descricao']; ?>
                            </span>
                            <span id="preco">
                                R$ <?php echo number_format($item['vlr_produto'], 2, ',', '.'); ?> 
                                <div class="quantidade">
                                    <a href="<?php echo BASE_APP; ?>carrinho/diminuir/<?php echo $item['id_produto']; ?>">-</a>
                                    <span><?php echo $item['quantidade']; ?></span>
                                    <a href="<?php echo BASE_APP; ?>carrinho/aumentar/<?php echo $item['id_produto']; ?>">+</a>
                                </div>
                            </span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            <div class="pedido">
                <p class="res-pedido">Resumo do Pedido</p>
                <div class="valores">
                    <div class="subtotal">
                        <span id="sub">Subtotal</span>
                        <span id="total">R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
                    </div>
                    <div class="entrega">
                        <span id="entre">Entrega</span>
                        <span id="ga">R$ <?php echo number_format($entrega, 2, ',', '.'); ?></span>
                    </div>
                    <div class="line"><hr></div>
                </div>
                <div class="total">
                    <span id="to">Total</span>
                    <span id="tal">R$ <?php echo number_format($total + $entrega, 2, ',', '.'); ?></span>
                </div>
                <div class="btn-fin-p">
                    <a href="<?php echo BASE_APP; ?>pagamento">Finalizar Pedido</a>
                </div>
                <div class="btn-con-c">
                    <a href="<?php echo BASE_APP; ?>cardapio">Continuar Comprando</a>
                </div>
            </div>
        </div>
    </div>
</main>