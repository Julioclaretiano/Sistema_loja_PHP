-- Adicione o campo pagamento em pedidos
ALTER TABLE pedidos ADD COLUMN pagamento VARCHAR(20) NOT NULL DEFAULT 'Cartão';