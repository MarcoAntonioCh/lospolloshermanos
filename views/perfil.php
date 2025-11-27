<section class="hero">
    <h1>Olá, <?php echo htmlspecialchars(explode(' ', $usuario['nome'])[0]); ?>!</h1>
    <p>Gerencie suas informações e pedidos</p>
</section>

<main>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <div class="card-header-flex">
                    <div class="card-title-wrapper">
                        <div class="icon-circle red">
                            <span class="icon">👤</span>
                        </div>
                        <div>
                            <h2 class="card-title">Informações Pessoais</h2>
                            <p class="card-description">Visualize e edite seus dados</p>
                        </div>
                    </div>
                    <a href="<?php echo BASE_APP; ?>login/logout" class="btn-outline" style="text-decoration: none;">
                        <span class="icon">🚪</span>
                        Sair
                    </a>
                </div>
            </div>
            <div class="card-content">
                <form id="profileForm" action="<?php echo BASE_APP; ?>perfil/update_action" method="POST">
                    
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

                    <div class="form-group">
                        <label for="name">Nome Completo</label>
                        <input type="text" id="name" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input type="tel" id="phone" name="telefone" value="<?php echo htmlspecialchars($telefone_formatado); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="address">Endereço</label>
                        <input type="text" id="address" name="endereco" value="<?php echo htmlspecialchars($usuario['endereco']); ?>" disabled>
                    </div>

                    <div class="button-group">
                        <button type="button" class="btn-primary" id="editBtn" onclick="enableEdit()">
                            Editar Informações
                        </button>
                        <button type="button" class="btn-secondary" id="deleteBtn" onclick="confirmarExclusao()" style="color: #cc0000; border-color: #cc0000;">
                            <span class="icon" style="font-style: normal;">🗑️</span> Deletar Conta
                        </button>
                        <button type="submit" class="btn-primary hidden" id="saveBtn">
                            <span class="icon">💾</span>
                            Salvar Alterações
                        </button>
                        <button type="button" class="btn-secondary hidden" id="cancelBtn" onclick="cancelEdit()">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title-wrapper">
                    <div class="icon-circle gold">
                        <span class="icon">📦</span>
                    </div>
                    <h2 class="card-title">Histórico de Pedidos</h2>
                </div>
            </div>
            <div class="card-content">
                <div class="order-list">
                    
                    <?php if (empty($pedidos)): ?>
                        <p class="card-description" style="text-align: center;">Você ainda não fez nenhum pedido.</p>
                    <?php endif; ?>

                    <?php foreach ($pedidos as $pedido): ?>
                    <div class="order-card">
                        <div class="order-header">
                            <div>
                                <h3 class="order-id">Pedido #<?php echo $pedido['numero_pedido_usuario']; ?></h3>
                                <div class="order-date">
                                    <span class="icon">🕐</span>
                                    <span><?php echo date('d/m/Y \à\s H:i', strtotime($pedido['data_pedido'])); ?></span>
                                </div>
                            </div>
                            <span class="badge confirmed">Confirmado</span>
                        </div>

                        <div class="order-items">
                            <?php 
                            // 1. Vamos calcular o subtotal dos itens aqui
                            $subtotal_itens = 0;
                            foreach ($pedido['itens'] as $item): 
                                $item_total = $item['preco_unit'] * $item['quantidade'];
                                $subtotal_itens += $item_total;
                            ?>
                            <div class="order-item">
                                <div class="order-item-info">
                                    <p class="order-item-name"><?php echo htmlspecialchars($item['nome']); ?></p>
                                    <p class="order-item-quantity">Quantidade: <?php echo $item['quantidade']; ?></p>
                                </div>
                                <p class="order-item-price">R$ <?php echo number_format($item_total, 2, ',', '.'); ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="separator"></div>
                        <div class="order-address">
                            <span class="icon">📍</span>
                            <span><?php echo htmlspecialchars($usuario['endereco']); ?></span>
                        </div>

                        <div class="order-total-details">
                            <div class="order-total-row">
                                <span class="order-total-label-small">Subtotal</span>
                                <span class="order-total-value-small">R$ <?php echo number_format($subtotal_itens, 2, ',', '.'); ?></span>
                            </div>

                            <?php if ($pedido['valor_entrega'] > 0): ?>
                                <div class="order-total-row">
                                    <span class="order-total-label-small">Taxa de Entrega</span>
                                    <span class="order-total-value-small">R$ <?php echo number_format($pedido['valor_entrega'], 2, ',', '.'); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <div class="order-total-row final-total">
                                <span class="order-total-label">Total do Pedido</span>
                                <span class="order-total-value">R$ <?php echo number_format($pedido['valor_total'], 2, ',', '.'); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    </div>
            </div>
        </div>
    </div>
</main>
<div id="modalDelete" class="modal-overlay hidden">
    <div class="modal-box">
        <div class="modal-icon">⚠️</div>
        <h3>Tem certeza que deseja excluir?</h3>
        <p>Todos os seus dados e histórico de pedidos serão apagados permanentemente. Essa ação não pode ser desfeita.</p>
        
        <div class="modal-buttons">
            <button class="btn-cancel" onclick="fecharModal()">Cancelar</button>
            <a href="<?php echo BASE_APP; ?>perfil/deletar" class="btn-confirm">Sim, Excluir Conta</a>
        </div>
    </div>
</div>
<script>
    function enableEdit() {
        const inputs = document.querySelectorAll('#profileForm input');
        inputs.forEach(input => input.disabled = false);
        document.getElementById('editBtn').classList.add('hidden');
        document.getElementById('saveBtn').classList.remove('hidden');
        document.getElementById('cancelBtn').classList.remove('hidden');
        const deleteBtn = document.getElementById('deleteBtn');
        if(deleteBtn) deleteBtn.classList.add('hidden');
    }

    function cancelEdit() {
        const inputs = document.querySelectorAll('#profileForm input');
        inputs.forEach(input => input.disabled = true);
        
        document.getElementById('name').value = '<?php echo htmlspecialchars($usuario['nome']); ?>';
        document.getElementById('email').value = '<?php echo htmlspecialchars($usuario['email']); ?>';
        document.getElementById('phone').value = '<?php echo htmlspecialchars($telefone_formatado); ?>';
        document.getElementById('address').value = '<?php echo htmlspecialchars($usuario['endereco']); ?>';
        
        document.getElementById('editBtn').classList.remove('hidden');
        document.getElementById('saveBtn').classList.add('hidden');
        document.getElementById('cancelBtn').classList.add('hidden');
        const deleteBtn = document.getElementById('deleteBtn');
        if(deleteBtn) deleteBtn.classList.remove('hidden');
    }

    function confirmarExclusao(event) {
        if(event) event.preventDefault(); 
        
        const modal = document.getElementById('modalDelete');
        modal.classList.remove('hidden');
    }

    function fecharModal() {
        const modal = document.getElementById('modalDelete');
        modal.classList.add('hidden');
    }

    window.onclick = function(event) {
        const modal = document.getElementById('modalDelete');
        if (event.target == modal) {
            fecharModal();
        }
    }

</script>   