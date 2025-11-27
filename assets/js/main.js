document.addEventListener('DOMContentLoaded', function() {
    
    const addButtons = document.querySelectorAll('.btn-add-carrinho');
    const cartCounter = document.getElementById('cart-counter');

    function atualizarVisibilidadeContador() {
        const contagem = parseInt(cartCounter.innerText, 10);
        if (contagem > 0) {
            cartCounter.style.display = 'flex';
        } else {
            cartCounter.style.display = 'none';
        }
    }

    function showToast(message) {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toast = document.createElement('div');
        toast.classList.add('toast-notification');
        toast.innerText = message;

        container.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 3000);
    }


    addButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            
            e.preventDefault(); 
            const url = this.getAttribute('href');

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.total_itens !== undefined) {
                        cartCounter.innerText = data.total_itens;
                        
                        atualizarVisibilidadeContador();
                        
                        showToast('Item adicionado ao carrinho!');
                    }
                })
                .catch(error => {
                    console.error('Erro ao adicionar ao carrinho:', error);
                });
        });
    });

    atualizarVisibilidadeContador();
});