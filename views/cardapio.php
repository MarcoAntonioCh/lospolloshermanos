<main>
        <div class="container2">
            <h1>Nosso Cardápio</h1>
            <p>Descubra nossos pratos deliciosos preparados com ingredientes frescos</p>
        </div>
        <div class="itens">
            <?php foreach($list as $produto): ?>
                <div class="card">
                    <img src="<?php echo BASE_APP.'media/produtos/'.$produto['url_foto']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text"><?php echo $produto['nome']; ?></p>
                            <p class="card-text">R$ <?php echo number_format($produto['vlr_produto'],2,',','.'); ?></p>
                            <a href="<?php echo BASE_APP; ?>carrinho/adicionar/<?php echo $produto['id_produto']; ?>" class="buy btn-add-carrinho">
                                Adicionar ao carrinho
                            </a>
                        </div>
                </div>
            <?php endforeach; ?>
        <div style="height: 50px;"></div>
    </main>