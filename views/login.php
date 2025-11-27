    <main>
        <div class="saudacao">
            <p id="t1">Bem-Vindo de volta!</p>
            <p id="t2">Entre na sua conta para continuar.</p>
        </div>
        <div class="container">
            <div class="formulario">
                <div class="texto">
                    <p id="t1">Login</p>
                    <p id="t2">Entre com seu email e senha</p>
                </div>
                <form action="<?php echo BASE_APP; ?>login/login_action" method="POST" id="form">
                    <label for="email" name="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="seu@gmail.com" autocomplete="off">
                    <label for="senha" name="senha">Senha</label>
                    <input type="password" name="senha" id="senha" placeholder="********" autocomplete="off">
                    <a href="#" class="forget_pass">Esqueceu a senha?</a>
                    <input type="submit" value="Entrar" id="submit" autocomplete="off">
                    <div class="log">
                        <p id="login">Não tem conta? 
                            <a href="<?php echo BASE_APP; ?>cadastro">Cadastre-se</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </main>