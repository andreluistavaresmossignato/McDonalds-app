<?php include 'header.php'; ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">🍔 Monte seu Lanche</h2>

    <h4>🍞 Pães</h4>
    <div class="row">
        <?php foreach ($ingredientes as $item): ?>
            <?php if ($item['categoria'] == 'pao'): ?>
                <div class="col-md-3">
                    <div class="card mb-3 text-center">
                        <img src="<?= $item['imagem'] ?>" class="card-img-top">
                        <div class="card-body">
                            <h5><?= $item['nome'] ?></h5>
                            <p>R$ <?= $item['preco'] ?></p>
                            <button class="btn btn-warning" onclick="addItem('pao', <?= $item['preco'] ?>)">
                                Adicionar
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <h4>🍖 Recheios</h4>
    <div class="row">
        <?php foreach ($ingredientes as $item): ?>
            <?php if ($item['categoria'] == 'recheio'): ?>
                <div class="col-md-3">
                    <div class="card mb-3 text-center">
                        <img src="<?= $item['imagem'] ?>">
                        <div class="card-body">
                            <h5><?= $item['nome'] ?></h5>
                            <p>R$ <?= $item['preco'] ?></p>
                            <button class="btn btn-danger" onclick="addItem('recheio', <?= $item['preco'] ?>)">
                                Adicionar
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <h4>🥬 Complementos</h4>
    <div class="row">
        <?php foreach ($ingredientes as $item): ?>
            <?php if ($item['categoria'] == 'complemento'): ?>
                <div class="col-md-3">
                    <div class="card mb-3 text-center">
                        <img src="<?= $item['imagem'] ?>">
                        <div class="card-body">
                            <h5><?= $item['nome'] ?></h5>
                            <p>R$ <?= $item['preco'] ?></p>
                            <button class="btn btn-success" onclick="addItem('complemento', <?= $item['preco'] ?>)">
                                Adicionar
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <hr>

    <h3>Total: R$ <span id="total">0.00</span></h3>

    <button class="btn btn-primary mt-2" onclick="finalizar()">Finalizar Pedido</button>
</div>

<script>
let total = 0;
let categorias = {
    pao: 0,
    recheio: 0,
    complemento: 0
};

function addItem(tipo, preco) {
    categorias[tipo]++;
    total += preco;
    document.getElementById('total').innerText = total.toFixed(2);
}

function finalizar() {
    if (categorias.pao == 0 || categorias.recheio == 0 || categorias.complemento == 0) {
        alert("Você precisa escolher pelo menos 1 item de cada categoria!");
        return;
    }

    alert("Pedido finalizado! Total: R$ " + total.toFixed(2));
}
</script>

<?php include 'footer.php'; ?>