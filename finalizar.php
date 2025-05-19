<?php
require_once 'config.php';

if(isset($_POST['finalizar']) && isset($_POST['cliente_id']) && count($_SESSION['carrinho'])){
    $cliente_id = intval($_POST['cliente_id']);
    $pagamento = isset($_POST['pagamento']) ? $conn->real_escape_string($_POST['pagamento']) : 'Cartão';

    // Criar pedido com método de pagamento
    $conn->query("INSERT INTO pedidos (cliente_id, pagamento) VALUES ($cliente_id, '$pagamento')");
    $pedido_id = $conn->insert_id;

    // Adicionar itens
    foreach($_SESSION['carrinho'] as $id => $qtd){
        $produto = $conn->query("SELECT * FROM produtos WHERE id=$id")->fetch_assoc();
        $preco = $produto['preco'];
        $conn->query("INSERT INTO pedido_itens (pedido_id, produto_id, quantidade, preco_unitario) VALUES ($pedido_id, $id, $qtd, $preco)");
        // Baixa no estoque
        $conn->query("UPDATE produtos SET estoque=estoque-$qtd WHERE id=$id");
    }

    // Limpar carrinho
    $_SESSION['carrinho'] = [];

    echo "<p>Pedido realizado com sucesso! <br>Método de pagamento: <b>".htmlspecialchars($pagamento)."</b><br><a href='index.php'>Voltar</a></p>";
} else {
    header('Location: carrinho.php');
    exit;
}
?>