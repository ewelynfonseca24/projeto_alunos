

CREATE TABLE IF NOT EXISTS serie (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS responsavel (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150) NOT NULL,
  telefone VARCHAR(30),
  email VARCHAR(150)
);

CREATE TABLE IF NOT EXISTS aluno (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150) NOT NULL,
  data_nascimento DATE,
  matricula VARCHAR(50) UNIQUE,
  responsavel_id INT,
  serie_id INT,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (responsavel_id) REFERENCES responsavel(id) ON DELETE SET NULL,
  FOREIGN KEY (serie_id) REFERENCES serie(id) ON DELETE SET NULL
);

INSERT INTO serie (nome) VALUES ('1ª Série'), ('2ª Série'), ('3ª Série');
INSERT INTO responsavel (nome, telefone, email) VALUES ('Maria Silva', '11-99999-0000', 'maria@example.com'), ('João Souza', '11-98888-1111', 'joao@example.com');
