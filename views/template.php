<!DOCTYPE html>
<html>
<head>
    <title>Los Pollos Hermanos</title>
    
    <link href="<?php echo BASE_APP; ?>assets/styles/style.css?v=<?php echo time(); ?>" rel="stylesheet">

    <?php if (isset($page_css)): ?>
        <link href="<?php echo BASE_APP; ?>assets/styles/<?php echo $page_css; ?>?v=<?php echo time(); ?>" rel="stylesheet">
    <?php endif; ?>
    
    <meta charset="utf-8">
    <meta name='viewport' content="width=device-width, initial-scale=1.0,maximum-scale=1.0">
</head>
<body>	

	<header>
        <img src="<?php echo BASE_APP; ?>assets/images/lospolloshermanos.png" alt="logo-los-pollos-hermanos">
        <nav>
            <a href="<?php echo BASE_APP; ?>">Início</a>
            <a href="<?php echo BASE_APP; ?>servico">Cardápio</a>
            <a href="<?php echo BASE_APP; ?>sobre">Sobre</a>
        </nav>

		<div class="botoes">
			
			<?php if(isset($is_logged_in) && $is_logged_in == true): ?>
				<div class="basket">
					<a href="<?php echo BASE_APP; ?>carrinho">
						<img src="<?php echo BASE_APP; ?>assets/images/shoppingCart.png" alt="carrinho">
					</a>
					<span id="cart-counter"><?php echo $cart_count; ?></span>	
				</div>
				<div class="account">
    				<a href="<?php echo BASE_APP; ?>perfil">
        				<img src="<?php echo BASE_APP; ?>assets/images/account.png" alt="Minha Conta">
    				</a>
				</div>
				<div class="btnPedir">
					<a href="<?php echo BASE_APP; ?>servico">Peça Agora</a>
				</div>

			<?php else: ?>

				<div class="cadastro">
					<a href="<?php echo BASE_APP; ?>cadastro">Cadastre-se</a>
				</div>
				<div class="login">
					<a href="<?php echo BASE_APP; ?>login">Login</a>
				</div>

			<?php endif; ?>
        </div>
	</header>

	<main>
		<?php $this->loadViewInTemplate($viewName, $viewData); ?>
	</main>
	<div id="toast-container"></div>
	<footer>
        <p class="tx1">
            &copy;2025 Los Pollos Hermanos.
        </p>
        <p class="tx2">
            Qualidade e sabor em cada mordida.
        </p>
    </footer>
	</footer>
    <script src="<?php echo BASE_APP; ?>assets/js/main.js?v=<?php echo time(); ?>"></script>
</body>
</html>
</body>
</html>