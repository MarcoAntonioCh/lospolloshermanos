<main>
    <div class="container">
        <div class="faixa-pedido">
            <span id="t1"><img src="<?php echo BASE_APP; ?>assets/images/check.png" alt="pedido concluido"></span>
            <span id="t2">Pedido Confirmado!</span>
        </div>
        <div class="data-pedido">
            <div class="text">
                <p>Informações do Pedido (Nº <?php echo $pedido['numero_pedido_usuario']; ?>)</p>
            </div>
            <div class="infos">
                <div class="time">
                    <img src="<?php echo BASE_APP; ?>assets/images/tempo.png" alt="tempo">
                    <p id="t1">Tempo estimado</p>
                    <p id="t2">35 - 45 minutos</p>
                </div>
                <div class="loc">
                    <img src="<?php echo BASE_APP; ?>assets/images/location.png" alt="localizacao">
                    <p id="t1">Endereço</p>
                    <p id="t2"><?php echo htmlspecialchars($usuario['endereco']); ?></p>
                </div>
                <div class="tel">
                    <img src="<?php echo BASE_APP; ?>assets/images/telefone.png" alt="telefone">
                    <p id="t1">Contato</p>
    
                <?php
                    $telefone = $usuario['telefone'];
                    $telefone_formatado = '';

                    if (strlen($telefone) == 11) {
                        $telefone_formatado = preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $telefone);
                    } elseif (strlen($telefone) == 10) {
                        $telefone_formatado = preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $telefone);
                    } else {
                        $telefone_formatado = $telefone;
                    }
                ?>
    
    <p id="t2"><?php echo htmlspecialchars($telefone_formatado); ?></p>
    </div>
            </div>
            <div class="line"><hr></div>
            <div class="itens-pedido">
                <p id="texto">Itens do Pedido</p>
                <div class="pedido">

                    <?php 
                    $subtotal = 0;
                    foreach($itens as $item): 
                        $item_total = $item['preco_unit'] * $item['quantidade'];
                        $subtotal += $item_total;
                    ?>
                        <div class="pedido1"> <div class="infped">
                                <p id="nome-p"><?php echo htmlspecialchars($item['nome']); ?></p>
                                <p id="quant">Quantidade: <?php echo $item['quantidade']; ?></p>
                            </div>
                            <p id="valor">R$ <?php echo number_format($item_total, 2, ',', '.'); ?></p>
                        </div>
                    <?php endforeach; ?>
                    
                </div>
            </div>
            <br>
            <div class="line"><hr></div>
            <div class="valores">
                <div class="subtotal">
                    <p id="t-valor">Subtotal</p>
                    <p id="valor">R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></p>
                </div>
                <div class="entrega">
                    <p id="t-valor">Entrega</p>
                    <p id="valor">R$ <?php echo number_format($pedido['valor_entrega'], 2, ',', '.'); ?></p>
                </div>
                <div class="total">
                    <p id="t-valor">Total</p>
                    <p id="valor">R$ <?php echo number_format($pedido['valor_total'], 2, ',', '.'); ?></p>
                </div>
            </div>
        </div>
    </div>
</main>