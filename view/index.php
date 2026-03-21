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

    <h4>🥤 Bebidas</h4>
    <div class="row">
        <?php foreach ($ingredientes as $item): ?>
            <?php if ($item['categoria'] == 'bebida'): ?>
                <div class="col-md-3">
                    <div class="card mb-3 text-center">
                        <img src="<?= $item['imagem'] ?>">
                        <div class="card-body">
                            <h5><?= $item['nome'] ?></h5>
                            <p>R$ <?= $item['preco'] ?></p>
                            <button class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;"
                                onclick="addItem('bebida', <?= $item['preco'] ?>, '<?= $item['nome'] ?>')">
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

    <button class="btn btn-secondary mb-3" onclick="limparLista()">
        Limpar Lista
    </button>

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
        let agrupados = {};

        itens.forEach(item => {
            if (!agrupados[item.nome]) {
                agrupados[item.nome] = { ...item, qtd: 1 };
            } else {
                agrupados[item.nome].qtd++;
            }
        });

        Object.values(agrupados).forEach(item => {
            lista.innerHTML += `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    ${item.nome} ${item.qtd > 1 ? `(x${item.qtd})` : ''}
                    <div>
                        <span class="me-2">R$ ${(item.preco * item.qtd).toFixed(2)}</span>
                        <button class="btn btn-sm btn-danger" onclick="removerItemPorNome('${item.nome}')">
                            -
                        </button>
                    </div>
                </li>
            `;
        });
    }

    document.getElementById('total').innerText = total.toFixed(2);
}

function limparLista() {
    itens = [];
    total = 0;

    categorias = {
        pao: 0,
        recheio: 0,
        complemento: 0,
        bebida: 0
    };

    atualizarLista();
}

function removerItemPorNome(nome) {
    let index = itens.findIndex(item => item.nome === nome);

    if (index !== -1) {
        let item = itens[index];

        categorias[item.tipo]--;
        total -= item.preco;

        itens.splice(index, 1);

        atualizarLista();
    }
}

function finalizar() {
    if (categorias.pao === 0) {
        alert("Você precisa adicionar pelo menos 1 pão!");
        return;
    }

    if (categorias.recheio === 0) {
        alert("Adicione pelo menos 1 recheio!");
        return;
    }

    let nome = prompt("Digite seu nome:");

    if (!nome) {
        alert("Nome obrigatório!");
        return;
    }

    fetch('salvar_pedido.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ nome, total })
    })
    .then(res => res.json())
    .then(data => {
        alert(`Pedido #${data.id} confirmado!\nCliente: ${nome}\nTotal: R$ ${total.toFixed(2)}`);

        // reset
        itens = [];
        total = 0;
        categorias = { pao: 0, recheio: 0, complemento: 0, bebida: 0 };

        atualizarLista();
    });
}
</script>

<?php include 'footer.php'; ?>