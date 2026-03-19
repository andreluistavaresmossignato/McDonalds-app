<?php include 'header.php'; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

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
                            <button class="btn btn-warning rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;"
                                onclick="addItem('pao', <?= $item['preco'] ?>, '<?= $item['nome'] ?>')">
                                <i class="bi bi-plus-lg"></i>
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
                            <button class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;"
                                onclick="addItem('recheio', <?= $item['preco'] ?>, '<?= $item['nome'] ?>')">
                                <i class="bi bi-plus-lg"></i>
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
                            <button class="btn btn-success rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;"
                                onclick="addItem('complemento', <?= $item['preco'] ?>, '<?= $item['nome'] ?>')">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <hr>

    <h4 class="mt-4">🧾 Itens adicionados:</h4>

    <ul class="list-group mb-3" id="lista-itens">
        <li class="list-group-item text-center">Nenhum item ainda</li>
    </ul>

    <hr>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 999;">
    <div class="bg-dark text-white p-3 rounded shadow">
        <h5>Total: R$ <span id="total">0.00</span></h5>
        <button class="btn btn-warning w-100 mt-2" onclick="finalizar()">
            Finalizar Pedido
        </button>
    </div>
</div>
</div>

<script>
let total = 0;

let categorias = {
    pao: 0,
    recheio: 0,
    complemento: 0
};

let itens = [];

function addItem(tipo, preco, nome) {
    categorias[tipo]++;
    total += preco;

    itens.push({ tipo, preco, nome });

    atualizarLista();

    let toast = new bootstrap.Toast(document.getElementById('toastAdd'), {
        delay: 1000
    });
    toast.show();
}

function removerItem(index) {
    let item = itens[index];

    categorias[item.tipo]--;
    total -= item.preco;

    itens.splice(index, 1);

    atualizarLista();
}

function atualizarLista() {
    let lista = document.getElementById('lista-itens');
    lista.innerHTML = "";

    if (itens.length === 0) {
        lista.innerHTML = '<li class="list-group-item text-center">Nenhum item ainda</li>';
    } else {
        itens.forEach((item, index) => {
            lista.innerHTML += `
                <li class="list-group-item">
                    ${item.nome} - R$ ${item.preco.toFixed(2)}
                    <button class="btn btn-sm btn-danger ms-2" onclick="removerItem(${index})">
                        Remover
                    </button>
                </li>
            `;
        });
    }

    document.getElementById('total').innerText = total.toFixed(2);
}

function finalizar() {
    if (categorias.pao === 0) {
        alert("Você precisa adicionar pelo menos 1 pão!");
        return;
    }

    if (categorias.recheio === 0 || categorias.complemento === 0) {
        alert("Adicione pelo menos 1 recheio e 1 complemento!");
        return;
    }

    alert("Pedido finalizado! Total: R$ " + total.toFixed(2));
}
</script>

<?php include 'footer.php'; ?>