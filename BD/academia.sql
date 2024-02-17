CREATE TABLE usuario (
  idusuario INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NULL,
  email VARCHAR(100) NULL,
  senha VARCHAR(100) NULL,
  perfil VARCHAR(50) NULL,
  sexo CHAR(1) NULL,
  celular VARCHAR(20) NULL,
  telefone VARCHAR(20) NULL,
  logradouro VARCHAR(100) NULL,
  numero VARCHAR(10) NULL,
  complemento VARCHAR(100) NULL,
  bairro VARCHAR(80) NULL,
  cidade VARCHAR(80) NULL,
  uf VARCHAR(2) NULL,
  cep VARCHAR(30) NULL,
  situacao CHAR(1) NULL,
  tipo VARCHAR(11) NULL,
  PRIMARY KEY(idusuario)
);

CREATE TABLE modalidade (
  idmodalidade INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  descritivo VARCHAR(100) NULL,
  situacao CHAR(1) NULL,
  PRIMARY KEY(idmodalidade)
);

CREATE TABLE professor (
  idprofessor INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  usuario_idusuario INTEGER UNSIGNED NOT NULL,
  curriculo TEXT NULL,
  PRIMARY KEY(idprofessor),
  INDEX professor_FKIndex1(usuario_idusuario),
  FOREIGN KEY(usuario_idusuario)
    REFERENCES usuario(idusuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE aluno (
  idaluno INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  usuario_idusuario INTEGER UNSIGNED NOT NULL,
  lesao CHAR(1) NULL,
  descricao_lesao TEXT NULL,
  deficiencia CHAR(1) NULL,
  descricao_deficiencia TEXT NULL,
  PRIMARY KEY(idaluno),
  INDEX aluno_FKIndex1(usuario_idusuario),
  FOREIGN KEY(usuario_idusuario)
    REFERENCES usuario(idusuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE faixa (
  idfaixa INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  modalidade_idmodalidade INTEGER UNSIGNED NOT NULL,
  descritivo VARCHAR(100) NULL,
  sequencia INTEGER UNSIGNED NULL,
  PRIMARY KEY(idfaixa),
  INDEX faixa_FKIndex1(modalidade_idmodalidade),
  FOREIGN KEY(modalidade_idmodalidade)
    REFERENCES modalidade(idmodalidade)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE horario (
  idhorario INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  modalidade_idmodalidade INTEGER UNSIGNED NOT NULL,
  professor_idprofessor INTEGER UNSIGNED NOT NULL,
  horario_inicio TIME NULL,
  horario_fim TIME NULL,
  dia_semana INT NULL,
  situacao CHAR(1) NULL,
  PRIMARY KEY(idhorario),
  INDEX horario_FKIndex1(professor_idprofessor),
  INDEX horario_FKIndex2(modalidade_idmodalidade),
  FOREIGN KEY(professor_idprofessor)
    REFERENCES professor(idprofessor)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(modalidade_idmodalidade)
    REFERENCES modalidade(idmodalidade)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE usuario_modalidade (
  idusuario_modalidade INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  faixa_idfaixa INTEGER UNSIGNED NOT NULL,
  modalidade_idmodalidade INTEGER UNSIGNED NOT NULL,
  usuario_idusuario INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(idusuario_modalidade),
  INDEX usuario_modalidade_FKIndex1(usuario_idusuario),
  INDEX usuario_modalidade_FKIndex2(modalidade_idmodalidade),
  INDEX usuario_modalidade_FKIndex3(faixa_idfaixa),
  FOREIGN KEY(usuario_idusuario)
    REFERENCES usuario(idusuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(modalidade_idmodalidade)
    REFERENCES modalidade(idmodalidade)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(faixa_idfaixa)
    REFERENCES faixa(idfaixa)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE matricula (
  idmatricula INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  modalidade_idmodalidade INTEGER UNSIGNED NOT NULL,
  horario_idhorario INTEGER UNSIGNED NOT NULL,
  aluno_idaluno INTEGER UNSIGNED NOT NULL,
  data_matricula DATE NULL,
  data_validade DATE NULL,
  situacao CHAR(1) NULL,
  PRIMARY KEY(idmatricula),
  INDEX matricula_FKIndex1(aluno_idaluno),
  INDEX matricula_FKIndex2(horario_idhorario),
  INDEX matricula_FKIndex3(modalidade_idmodalidade),
  FOREIGN KEY(aluno_idaluno)
    REFERENCES aluno(idaluno)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(horario_idhorario)
    REFERENCES horario(idhorario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(modalidade_idmodalidade)
    REFERENCES modalidade(idmodalidade)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE frequencia (
  idfrequencia INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  matricula_idmatricula INTEGER UNSIGNED NOT NULL,
  presenca CHAR(1) NULL,
  data_aula DATE NULL,
  PRIMARY KEY(idfrequencia),
  INDEX frequencia_FKIndex1(matricula_idmatricula),
  FOREIGN KEY(matricula_idmatricula)
    REFERENCES matricula(idmatricula)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE aula_teste (
  idaula_teste INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  horario_idhorario INTEGER UNSIGNED NOT NULL,
  nome VARCHAR(100) NULL,
  sexo CHAR(1) NULL,
  email VARCHAR(100) NULL,
  celular VARCHAR(20) NULL,
  telefone VARCHAR(20) NULL,
  data_aula DATE NULL,
  observacao TEXT NULL,
  situacao CHAR(1) NULL,
  PRIMARY KEY(idaula_teste),
  INDEX aula_teste_FKIndex1(horario_idhorario),
  FOREIGN KEY(horario_idhorario)
    REFERENCES horario(idhorario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);


