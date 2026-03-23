<?php include 'header.php'; ?>

<!-- Toast Notification -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100;">
    <div id="toastAdd" class="toast align-items-center text-white bg-success border-0" role="alert" data-bs-delay="1500">
        <div class="d-flex">
            <div class="toast-body d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <span>Item adicionado! 🍔</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="main-header">
    <div class="container">
        <div class="logo-container">
            <img src="../assets/McDonaldsLogo.png" alt="McDonald's" class="logo-img">
            <div>
                <h1>McDonald's Builder</h1>
                <p class="tagline">Monte seu lanche dos sonhos</p>
            </div>
        </div>
    </div>
</header>

<!-- Category Navigation -->
<nav class="category-nav">
    <div class="nav nav-pills" id="categoryTabs" role="tablist">
        <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#pao" type="button">
            Pães
        </button>
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#recheio" type="button">
            Recheios
        </button>
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#complemento" type="button">
            Complementos
        </button>
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#bebida" type="button">
            Bebidas
        </button>
    </div>
</nav>

<!-- Main Content -->
<main class="container mt-3">
    <div class="tab-content">
        <!-- Pães -->
        <div class="tab-pane fade show active" id="pao">
            <h3 class="section-title"><i class="bi bi-bread"></i> Escolha seu Pão</h3>
            <div class="row g-3" id="categoria-pao">
                <?php foreach ($ingredientes as $item): if ($item['categoria'] == 'pao'): ?>
                    <div class="col-6 col-md-3 col-lg-2 animate-slide">
                        <div class="product-card category-pao">
                            <div class="product-image">
                                <img src="<?= htmlspecialchars($item['imagem']) ?>" 
                                     alt="<?= htmlspecialchars($item['nome']) ?>"
                                     onerror="this.src='https://via.placeholder.com/150x140/f5a623/ffffff?text=🍞'">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($item['nome']) ?></h5>
                                <p class="card-price">R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>
                                <button class="add-btn" 
                                        onclick="addItem('pao', <?= $item['preco'] ?>, '<?= addslashes($item['nome']) ?>')"
                                        aria-label="Adicionar <?= htmlspecialchars($item['nome']) ?>">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; endforeach; ?>
            </div>
        </div>

        <!-- Recheios -->
        <div class="tab-pane fade" id="recheio">
            <h3 class="section-title"><i class="bi bi-heart-fill"></i> Selecione os Recheios</h3>
            <div class="row g-3" id="categoria-recheio">
                <?php foreach ($ingredientes as $item): if ($item['categoria'] == 'recheio'): ?>
                    <div class="col-6 col-md-3 col-lg-2 animate-slide">
                        <div class="product-card category-recheio">
                            <div class="product-image">
                                <img src="<?= htmlspecialchars($item['imagem']) ?>" 
                                     alt="<?= htmlspecialchars($item['nome']) ?>"
                                     onerror="this.src='https://via.placeholder.com/150x140/DA291C/ffffff?text=🍖'">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($item['nome']) ?></h5>
                                <p class="card-price">R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>
                                <button class="add-btn" 
                                        onclick="addItem('recheio', <?= $item['preco'] ?>, '<?= addslashes($item['nome']) ?>')"
                                        aria-label="Adicionar <?= htmlspecialchars($item['nome']) ?>">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; endforeach; ?>
            </div>
        </div>

        <!-- Complementos -->
        <div class="tab-pane fade" id="complemento">
            <h3 class="section-title"><i class="bi bi-plus-circle"></i> Adicione Complementos</h3>
            <div class="row g-3" id="categoria-complemento">
                <?php foreach ($ingredientes as $item): if ($item['categoria'] == 'complemento'): ?>
                    <div class="col-6 col-md-3 col-lg-2 animate-slide">
                        <div class="product-card category-complemento">
                            <div class="product-image">
                                <img src="<?= htmlspecialchars($item['imagem']) ?>" 
                                     alt="<?= htmlspecialchars($item['nome']) ?>"
                                     onerror="this.src='https://via.placeholder.com/150x140/28a745/ffffff?text=🥬'">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($item['nome']) ?></h5>
                                <p class="card-price">R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>
                                <button class="add-btn" 
                                        onclick="addItem('complemento', <?= $item['preco'] ?>, '<?= addslashes($item['nome']) ?>')"
                                        aria-label="Adicionar <?= htmlspecialchars($item['nome']) ?>">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; endforeach; ?>
            </div>
        </div>

        <!-- Bebidas -->
        <div class="tab-pane fade" id="bebida">
            <h3 class="section-title"><i class="bi bi-cup"></i> Escolha sua Bebida</h3>
            <div class="row g-3" id="categoria-bebida">
                <?php foreach ($ingredientes as $item): if ($item['categoria'] == 'bebida'): ?>
                    <div class="col-6 col-md-3 col-lg-2 animate-slide">
                        <div class="product-card category-bebida">
                            <div class="product-image">
                                <img src="<?= htmlspecialchars($item['imagem']) ?>" 
                                     alt="<?= htmlspecialchars($item['nome']) ?>"
                                     onerror="this.src='https://via.placeholder.com/150x140/007bff/ffffff?text=🥤'">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($item['nome']) ?></h5>
                                <p class="card-price">R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>
                                <button class="add-btn" 
                                        onclick="addItem('bebida', <?= $item['preco'] ?>, '<?= addslashes($item['nome']) ?>')"
                                        aria-label="Adicionar <?= htmlspecialchars($item['nome']) ?>">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; endforeach; ?>
            </div>
        </div>
    </div>
</main>

<!-- Cart Panel (Fixed Bottom) -->
<div class="cart-panel" id="cartPanel" style="max-width: 100vw;">
    <button class="cart-toggle" onclick="toggleCart()">
        <i class="bi bi-chevron-up" id="cartToggleIcon"></i>
    </button>
    
    <div class="cart-header">
        <div class="cart-title">
            <i class="bi bi-basket"></i>
            <span>Seu Pedido</span>
            <span class="badge bg-danger rounded-pill" id="cartCount">0</span>
        </div>
        <button class="btn-clear" onclick="limparLista()">
            <i class="bi bi-trash"></i> Limpar
        </button>
    </div>
    
    <div class="cart-items" id="lista-itens">
        <div class="empty-cart">
            <i class="bi bi-cart-x"></i>
            <p>Seu lanche está vazio<br><small>Adicione ingredientes para começar!</small></p>
        </div>
    </div>
    
    <div class="cart-footer">
        <div class="cart-total">
            Total: <span id="total">R$ 0,00</span>
        </div>
        <button class="btn btn-checkout" onclick="finalizar()">
            <i class="bi bi-bag-check"></i> Finalizar
        </button>
    </div>
</div>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-check2-circle"></i> Confirmar Pedido
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="checkoutForm">
                    <div class="mb-3">
                        <label for="nomeCliente" class="form-label">
                            <i class="bi bi-person"></i> Seu Nome
                        </label>
                        <input type="text" class="form-control" id="nomeCliente" 
                               placeholder="Digite seu nome para o pedido" required>
                    </div>
                    
                    <div class="order-summary">
                        <h6 class="mb-3"><i class="bi bi-list-ul"></i> Resumo do Pedido</h6>
                        <div id="modalItens"></div>
                        <div class="order-total">
                            Total: <span id="modalTotal">R$ 0,00</span>
                        </div>
                    </div>
                    
                    <div class="alert alert-info d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle"></i>
                        <small>Seu pedido será preparado em aproximadamente 5 minutos!</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x"></i> Cancelar
                </button>
                <button type="button" class="btn btn-checkout" onclick="confirmarPedido()">
                    <i class="bi bi-check-lg"></i> Confirmar Pedido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
        <div class="modal-header justify-content-center border-0 pb-0">
            <div class="rounded-circle bg-success d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                <i class="bi bi-check2-all text-white fs-1"></i>
            </div>
        </div>
        <br>
            <div class="modal-body pt-0">
                <h4 class="fw-bold mb-2">Pedido Confirmado!</h4>
                <p class="text-muted mb-3">Seu lanche está sendo preparado com carinho.</p>
                
                <div class="bg-light rounded p-3 mb-3">
                    <p class="mb-1"><strong>Pedido #<span id="pedidoId"></span></strong></p>
                    <p class="mb-1">Cliente: <span id="pedidoNome"></span></p>
                    <p class="mb-0">Total: <strong id="pedidoTotal" class="text-danger"></strong></p>
                </div>
                
                <p class="small text-muted">
                    <i class="bi bi-clock"></i> Tempo estimado: 5-7 minutos
                </p>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <button type="button" class="btn btn-checkout" data-bs-dismiss="modal" onclick="novoPedido()">
                    <i class="bi bi-plus-circle"></i> Novo Pedido
                </button>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>