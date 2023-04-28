CREATE TABLE colaborador (
    id int PRIMARY KEY,
    nome varchar(255),
    cpf varchar(14),
    email varchar(255),
    senha varchar(255)
);

CREATE TABLE participante (
    id int PRIMARY KEY,
    nome varchar(255),
    email varchar(255),
    senha varchar(255),
    idade int
);

CREATE TABLE evento (
    id int PRIMARY KEY,
    data date,
    hora time,
    local varchar(255),
    tipo_esporte varchar(255),
    faixa_etaria int,
    fk_colaborador_id int,
    FOREIGN KEY (fk_colaborador_id) REFERENCES colaborador(id) ON DELETE CASCADE
);

CREATE TABLE administrador (
    id int PRIMARY KEY,
    nome varchar(255),
    senha varchar(255)
);

CREATE TABLE valida (
    fk_colaborador_id int,
    fk_administrador_id int,
    FOREIGN KEY (fk_colaborador_id) REFERENCES colaborador(id) ON DELETE RESTRICT,
    FOREIGN KEY (fk_administrador_id) REFERENCES administrador(id) ON DELETE RESTRICT
);

CREATE TABLE inscricao_participante (
    fk_participante_id int,
    fk_evento_id int,
    FOREIGN KEY (fk_participante_id) REFERENCES participante(id) ON DELETE SET NULL,
    FOREIGN KEY (fk_evento_id) REFERENCES evento(id) ON DELETE SET NULL
);

CREATE TABLE inscricao_colaborador (
    fk_colaborador_id int,
    fk_evento_id int,
    FOREIGN KEY (fk_colaborador_id) REFERENCES colaborador(id) ON DELETE SET NULL,
    FOREIGN KEY (fk_evento_id) REFERENCES evento(id) ON DELETE SET NULL
);