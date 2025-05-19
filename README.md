# Sistema de Loja em PHP

Este projeto é um sistema simples de loja online desenvolvido em PHP, utilizando MySQL como banco de dados. Ele oferece funcionalidades de cadastro de produtos, clientes, gerenciamento de carrinho de compras e finalização de pedidos.

## Funcionalidades

- Cadastro de produtos (CRUD)
- Cadastro de clientes (CRUD)
- Adição e remoção de itens no carrinho de compras
- Finalização de compra (pedido)
- Listagem de pedidos por cliente

## Estrutura de Diretórios

```
/loja/
├── config.php
├── db.sql
├── index.php
├── produtos.php
├── clientes.php
├── carrinho.php
├── finalizar.php
```

## Configuração

1. **Banco de Dados**
   - Crie um banco de dados MySQL chamado `loja`.
   - Importe o arquivo `db.sql` para criar as tabelas necessárias.

2. **Configuração do Banco**
   - Edite o arquivo `config.php` com as credenciais do seu MySQL.

3. **Executar**
   - Coloque todos os arquivos em um servidor com suporte a PHP.
   - Acesse `index.php` pelo navegador.

## Observações

- O sistema é simples, serve como base para estudos.
- Não possui sistema de autenticação de administradores.

## Autor

- Gerado por GitHub Copilot, solicitado por @Julioclaretiano