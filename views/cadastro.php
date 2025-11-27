<main>
        <div class="saudacao">
            <p id="t1">Junte-se à Família</p>
            <p id="t2">Crie sua conta e aproivete nossos benefícios</p>
        </div>
        <div class="container">
            <div class="formulario">
                <div class="texto">
                    <p id="t1">Cadastro</p>
                    <p id="t2">Preencha seus dados para criar uma conta</p>
                </div>
                <form action="<?php echo BASE_APP; ?>cadastro/cadastro_action" method="POST" id="form">
                    <label for="nome" name="nome">Nome Completo</label>
                    <input type="text" name="nome" id="nome" placeholder="Seu Nome" autocomplete="off">
                    <label for="email" name="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="seu@gmail.com" autocomplete="off"> 
                    <label for="telefone" name="telefone">Telefone</label>
                    <input type="tel" name="telefone" id="telefone" placeholder="(00) 00000-0000" autocomplete="off">
                    <label for="cpf" name="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" placeholder="000.000.000-00" autocomplete="off">
                    <label for="endereco" name="endereco">Endereço</label>
                    <input type="text" name="endereco" id="endereco" placeholder="Rua, Número, Bairro..." autocomplete="off">
                    <label for="senha" name="senha">Senha</label>
                    <input type="password" name="senha" id="senha" placeholder="********" autocomplete="off">
                    <label for="senhaC" name="senhaC">Confirmar Senha</label>
                    <input type="password" name="senhaC" id="senhaC" placeholder="********" autocomplete="off">
                    <input type="submit" value="Criar Conta" id="submit" autocomplete="off">
                    <div class="log">
                        <p id="login">Já tem uma conta? 
                            <a href="<?php echo BASE_APP; ?>login">Faça login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    
        const cpfInput = document.getElementById('cpf');
        const telInput = document.getElementById('telefone');

        cpfInput.addEventListener('input', function(e) {
        
        let value = e.target.value.replace(/\D/g, '');
        value = value.substring(0, 11); 

        let formatted = '';
        if (value.length > 9) {
                formatted = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
        } else if (value.length > 6) {
            formatted = value.replace(/(\d{3})(\d{3})(\d{3})/, '$1.$2.$3');
        } else if (value.length > 3) {
            formatted = value.replace(/(\d{3})(\d{3})/, '$1.$2');
        } else {
            formatted = value;
        }
        
        e.target.value = formatted;
        }); 

        telInput.addEventListener('input', function(e) {
        
        let value = e.target.value.replace(/\D/g, '');
        value = value.substring(0, 11); 

        let formatted = '';
        if (value.length > 10) {
            formatted = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        } else if (value.length > 6) {
            formatted = value.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
        } else if (value.length > 2) {
            formatted = value.replace(/(\d{2})(\d{1,5})/, '($1) $2');
        } else if (value.length > 0) {
            formatted = value.replace(/(\d{1,2})/, '($1');
        }
        
        e.target.value = formatted;
    });

});
</script>