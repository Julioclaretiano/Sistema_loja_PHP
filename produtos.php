<?php
require_once 'config.php';

// Inserir novo produto
if(isset($_POST['add'])){
    $nome = $conn->real_escape_string($_POST['nome']);
    $preco = floatval($_POST['preco']);
    $estoque = intval($_POST['estoque']);
    $conn->query("INSERT INTO produtos (nome, preco, estoque) VALUES ('$nome', $preco, $estoque)");
    header('Location: produtos.php');
    exit;
}

// Remover produto
if(isset($_GET['del'])){
    $id = intval($_GET['del']);
    $conn->query("DELETE FROM produtos WHERE id=$id");
    header('Location: produtos.php');
    exit;
}

// Listar produtos
$produtos = $conn->query("SELECT * FROM produtos");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Produtos</title>
</head>
<body>
    <h1>Produtos</h1>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="number" step="0.01" name="preco" placeholder="Preço" required>
        <input type="number" name="estoque" placeholder="Estoque" required>
        <button type="submit" name="add">Adicionar Produto</button>
    </form>

    <h2>Lista de Produtos</h2>
    <table border="1">
        <tr>
            <th>ID</th><th>Nome</th><th>Preço</th><th>Estoque</th><th>Ações</th>
        </tr>
        <?php while($p = $produtos->fetch_assoc()): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td>R$ <?= number_format($p['preco'],2,',','.') ?></td>
            <td><?= $p['estoque'] ?></td>
            <td>
                <a href="?del=<?= $p['id'] ?>" onclick="return confirm('Confirma?')">Excluir</a>
                <a href="carrinho.php?add=<?= $p['id'] ?>">Adicionar ao Carrinho</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="index.php">Voltar</a>
</body>
</html>