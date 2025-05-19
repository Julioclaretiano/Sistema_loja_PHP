<?php
require_once 'config.php';

// Inicializar carrinho na sessão
if(!isset($_SESSION['carrinho'])) $_SESSION['carrinho'] = [];

// Adicionar produto ao carrinho
if(isset($_GET['add'])){
    $id = intval($_GET['add']);
    if(isset($_SESSION['carrinho'][$id])){
        $_SESSION['carrinho'][$id]++;
    } else {
        $_SESSION['carrinho'][$id] = 1;
    }
    header('Location: carrinho.php');
    exit;
}

// Remover produto do carrinho
if(isset($_GET['del'])){
    $id = intval($_GET['del']);
    unset($_SESSION['carrinho'][$id]);
    header('Location: carrinho.php');
    exit;
}

// Listar produtos do carrinho
$produtos = [];
$total = 0;
if(count($_SESSION['carrinho'])){
    $ids = implode(',', array_keys($_SESSION['carrinho']));
    $produtos_query = $conn->query("SELECT * FROM produtos WHERE id IN ($ids)");
    while($p = $produtos_query->fetch_assoc()){
        $p['quantidade'] = $_SESSION['carrinho'][$p['id']];
        $p['subtotal'] = $p['preco'] * $p['quantidade'];
        $total += $p['subtotal'];
        $produtos[] = $p;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Carrinho de Compras</title>
</head>
<body>
    <h1>Carrinho de Compras</h1>
    <?php if(!$produtos): ?>
        <p>Carrinho vazio.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>Produto</th><th>Preço</th><th>Quantidade</th><th>Subtotal</th><th>Ações</th>
            </tr>
            <?php foreach($produtos as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['nome']) ?></td>
                <td>R$ <?= number_format($p['preco'],2,',','.') ?></td>
                <td><?= $p['quantidade'] ?></td>
                <td>R$ <?= number_format($p['subtotal'],2,',','.') ?></td>
                <td><a href="?del=<?= $p['id'] ?>">Remover</a></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td colspan="2"><strong>R$ <?= number_format($total,2,',','.') ?></strong></td>
            </tr>
        </table>
        <form method="POST" action="finalizar.php">
            <label>Cliente:
                <select name="cliente_id" required>
                    <option value="">Selecione...</option>
                    <?php
                    $clientes = $conn->query("SELECT * FROM clientes");
                    while($c = $clientes->fetch_assoc()):
                    ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
                    <?php endwhile; ?>
                </select>
            </label>
            <label>Método de Pagamento:
                <select name="pagamento" required>
                    <option value="Cartão">Cartão</option>
                    <option value="Depósito">Depósito</option>
                    <option value="PIX">PIX</option>
                </select>
            </label>
            <button type="submit" name="finalizar">Finalizar Pedido</button>
        </form>
    <?php endif; ?>
    <br>
    <a href="produtos.php">Continuar Comprando</a> |
    <a href="index.php">Voltar</a>
</body>
</html>