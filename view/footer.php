<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Estado global do carrinho
let total = 0;
let categorias = { pao: 0, recheio: 0, complemento: 0, bebida: 0 };
let itens = [];

// Inicialização
document.addEventListener('DOMContentLoaded', function() {
    atualizarContador();
    window.toastEl = document.getElementById('toastAdd');
    window.toast = new bootstrap.Toast(toastEl, { delay: 1500 });
    window.checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
    window.successModal = new bootstrap.Modal(document.getElementById('successModal'));
});

// Toggle do painel do carrinho
function toggleCart() {
    const panel = document.getElementById('cartPanel');
    const icon = document.getElementById('cartToggleIcon');
    panel.classList.toggle('collapsed');
    icon.className = panel.classList.contains('collapsed') ? 'bi bi-chevron-down' : 'bi bi-chevron-up';
}

// ✅ FUNÇÃO showToast CORRIGIDA
function showToast(message, type = 'success') {
    const toastEl = document.getElementById('toastAdd');
    const toastBody = toastEl.querySelector('.toast-body');
    
    // Reseta classes anteriores
    toastEl.classList.remove('bg-success', 'bg-danger', 'bg-warning', 'bg-info');
    
    // Aplica nova classe conforme tipo
    const bgClass = {
        'success': 'bg-success',
        'danger': 'bg-danger', 
        'warning': 'bg-warning',
        'info': 'bg-info'
    }[type] || 'bg-success';
    
    toastEl.classList.add(bgClass);
    
    // Atualiza mensagem e ícone
    const icon = type === 'success' ? 'check-circle' : 
                 type === 'danger' ? 'exclamation-circle' :
                 type === 'warning' ? 'exclamation-triangle' : 'info-circle';
    
    toastBody.innerHTML = `
        <i class="bi bi-${icon}-fill fs-5"></i> 
        <span>${message}</span>
    `;
    
    // Cria nova instância do toast (evita cache)
    const toast = new bootstrap.Toast(toastEl, { 
        delay: 2000,
        autohide: true 
    });
    
    toast.show();
}

// Adicione item a lista
function addItem(tipo, preco, nome) {
    categorias[tipo]++;
    total += preco;
    itens.push({ tipo, preco, nome });
    
    atualizarLista();
    atualizarContador();
    
    // Animação no botão
    if (event?.target) {
        event.target.classList.add('pulse');
        setTimeout(() => event.target.classList.remove('pulse'), 300);
    }
    
    // Mostra APENAS toast de sucesso ao adicionar item
    showToast('Item adicionado! 🍔', 'success');
}

// Remover item por índice
function removerItem(index) {
    const item = itens[index];
    categorias[item.tipo]--;
    total -= item.preco;
    itens.splice(index, 1);
    atualizarLista();
    atualizarContador();
}

// Remover item por nome (primeira ocorrência)
function removerItemPorNome(nome) {
    const index = itens.findIndex(item => item.nome === nome);
    if (index !== -1) {
        const item = itens[index];
        categorias[item.tipo]--;
        total -= item.preco;
        itens.splice(index, 1);
        atualizarLista();
        atualizarContador();
    }
}

// Atualizar lista visual do carrinho
function atualizarLista() {
    const lista = document.getElementById('lista-itens');
    
    if (itens.length === 0) {
        lista.innerHTML = `
            <div class="empty-cart">
                <i class="bi bi-cart-x"></i>
                <p>Seu lanche está vazio<br><small>Adicione ingredientes para começar!</small></p>
            </div>
        `;
    } else {
        const agrupados = {};
        itens.forEach(item => {
            const key = item.nome;
            if (!agrupados[key]) {
                agrupados[key] = { ...item, qtd: 1, indices: [itens.indexOf(item)] };
            } else {
                agrupados[key].qtd++;
                agrupados[key].indices.push(itens.indexOf(item));
            }
        });
        
        lista.innerHTML = Object.values(agrupados).map(item => `
            <div class="cart-item animate-slide">
                <div class="cart-item-name">
                    <span class="cart-item-qtd">${item.qtd}x</span>
                    ${item.nome}
                </div>
                <div class="d-flex align-items-center">
                    <span class="cart-item-price">R$ ${(item.preco * item.qtd).toFixed(2).replace('.', ',')}</span>
                    <button class="remove-btn" onclick="removerItemPorNome('${item.nome.replace(/'/g, "\\'")}')">
                        <i class="bi bi-dash"></i>
                    </button>
                </div>
            </div>
        `).join('');
    }
    
    document.getElementById('total').innerText = `R$ ${total.toFixed(2).replace('.', ',')}`;
}

// Atualizar contador de itens
function atualizarContador() {
    const count = itens.length;
    const badge = document.getElementById('cartCount');
    badge.innerText = count;
    badge.style.display = count > 0 ? 'inline-block' : 'none';
}

// Limpar lista
function limparLista() {
    if (itens.length === 0) return;
    
    if (confirm('Deseja realmente limpar todo o seu pedido?')) {
        itens = [];
        total = 0;
        categorias = { pao: 0, recheio: 0, complemento: 0, bebida: 0 };
        atualizarLista();
        atualizarContador();
    }
}

// Finaliza o pedido
function finalizar() {
    if (categorias.pao === 0) {
        showToast('Adicione pelo menos 1 pão!', 'warning');
        expandCart();
        return;
    }
    if (categorias.recheio === 0) {
        showToast('Adicione pelo menos 1 recheio!', 'warning');
        expandCart();
        return;
    }
    if (itens.length === 0) {
        showToast('Seu carrinho está vazio!', 'warning');
        return;
    }
    
    preencherResumoModal();
    checkoutModal.show();
    document.getElementById('nomeCliente').focus();
}

// Expande o carrinho se estiver recolhido
function expandCart() {
    const panel = document.getElementById('cartPanel');
    if (panel.classList.contains('collapsed')) {
        toggleCart();
    }
}

// Preenche o resumo no modal de checkout
function preencherResumoModal() {
    const container = document.getElementById('modalItens');
    
    if (itens.length === 0) {
        container.innerHTML = '<p class="text-muted">Nenhum item</p>';
    } else {
        const agrupados = {};
        itens.forEach(item => {
            if (!agrupados[item.nome]) {
                agrupados[item.nome] = { ...item, qtd: 1 };
            } else {
                agrupados[item.nome].qtd++;
            }
        });
        
        container.innerHTML = Object.values(agrupados).map(item => `
            <div class="order-item">
                <span>${item.nome} ${item.qtd > 1 ? `<small class="text-muted">x${item.qtd}</small>` : ''}</span>
                <strong>R$ ${(item.preco * item.qtd).toFixed(2).replace('.', ',')}</strong>
            </div>
        `).join('');
    }
    
    document.getElementById('modalTotal').innerText = `R$ ${total.toFixed(2).replace('.', ',')}`;
}

// Confirmar pedido via AJAX
function confirmarPedido() {
    const nome = document.getElementById('nomeCliente').value.trim();
    
    if (!nome) {
        showToast('Por favor, digite seu nome!', 'warning');
        return;
    }
    
    const btn = document.querySelector('#checkoutModal .btn-checkout');
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Processando...';
    
    fetch('salvar_pedido.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ nome, total })
    })
    .then(res => res.json())
    .then(data => {
        checkoutModal.hide();
        
        document.getElementById('pedidoId').innerText = data.id;
        document.getElementById('pedidoNome').innerText = nome;
        document.getElementById('pedidoTotal').innerText = `R$ ${total.toFixed(2).replace('.', ',')}`;
        
        successModal.show();
    })
    .catch(err => {
        console.error('Erro:', err);
        showToast('Erro ao processar pedido. Tente novamente!', 'danger');
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = originalText;
    });
}

// Novo pedido após sucesso
function novoPedido() {
    itens = [];
    total = 0;
    categorias = { pao: 0, recheio: 0, complemento: 0, bebida: 0 };
    document.getElementById('nomeCliente').value = '';
    atualizarLista();
    atualizarContador();
}

// Formatação de preço helper
function formatarPreco(valor) {
    return `R$ ${valor.toFixed(2).replace('.', ',')}`;
}
</script>

</body>
</html>