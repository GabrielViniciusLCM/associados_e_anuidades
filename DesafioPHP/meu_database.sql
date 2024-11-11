-- Tabela de Associados
CREATE TABLE associados (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    cpf VARCHAR(11) UNIQUE NOT NULL,
    data_filiacao DATE NOT NULL
);

-- Tabela de Anuidades
CREATE TABLE anuidades (
    id SERIAL PRIMARY KEY,
    ano INT NOT NULL,
    valor DECIMAL(10, 2) NOT NULL
);

-- Tabela de Pagamentos
CREATE TABLE pagamentos (
    id SERIAL PRIMARY KEY,
    associado_id INT REFERENCES associados(id) ON DELETE CASCADE,
    anuidade_id INT REFERENCES anuidades(id) ON DELETE CASCADE,
    pago BOOLEAN DEFAULT FALSE
);
