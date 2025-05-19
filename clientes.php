<?php
require_once 'config.php';

// Adicionar cliente
if(isset($_POST['add'])){
    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefone = $conn->real_escape_string($_POST['telefone']);
    $conn->query("INSERT INTO clientes (nome, email, telefone) VALUES ('$nome', '$email', '$telefone')");
    header('Location: clientes.php');
    exit;
}

// Remover cliente
if(isset($_GET['del'])){
    $id = intval($_GET['del']);
    $conn->query("DELETE FROM clientes WHERE id=$id");
    header('Location: clientes.php');
    exit;
}

// Listar clientes
$clientes = $conn->query("SELECT * FROM clientes");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Clientes</title>
</head>
<body>
    <h1>Clientes</h1>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="telefone" placeholder="Telefone">
        <button type="submit" name="add">Adicionar Cliente</button>
    </form>
    <h2>Lista de Clientes</h2>
    <table border="1">
        <tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Ações</th></tr>
        <?php while($c = $clientes->fetch_assoc()): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= htmlspecialchars($c['nome']) ?></td>
            <td><?= htmlspecialchars($c['email']) ?></td>
            <td><?= htmlspecialchars($c['telefone']) ?></td>
            <td>
                <a href="?del=<?= $c['id'] ?>" onclick="return confirm('Confirma?')">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="index.php">Voltar</a>
</body>
</html>