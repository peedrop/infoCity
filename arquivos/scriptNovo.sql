/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     09/12/2019 11:16:35                          */
/*==============================================================*/

/*
drop table if exists tbCidade;

drop table if exists tbColaboracao;

drop table if exists tbComentario;

drop table if exists tbEndereco;

drop table if exists tbEstado;

drop table if exists tbHistorico;

drop table if exists tbPerfil;

drop table if exists tbPlanejamento;

drop table if exists tbPlanejamentoColaboracao;

drop table if exists tbPlanejamentoUsuario;

drop table if exists tbSituacao;

drop table if exists tbTipo;

drop table if exists tbUsuario;
*/

/*==============================================================*/
/* Table: tbCidade                                              */
/*==============================================================*/
CREATE TABLE tbCidade
(
   id                   INT NOT NULL AUTO_INCREMENT,
   nome                 VARCHAR(255) NOT NULL,
   idEstado             INT NOT NULL,
   PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: tbColaboracao                                         */
/*==============================================================*/
CREATE TABLE tbColaboracao
(
   id                   INT NOT NULL AUTO_INCREMENT,
   titulo               VARCHAR(255) NOT NULL,
   descricao            VARCHAR(4000) NOT NULL,
   dataRegistro         DATETIME NOT NULL,
   latitude             NUMERIC(9,6) NOT NULL,
   longitude            NUMERIC(9,6) NOT NULL,
   rua                  VARCHAR(255) NOT NULL,
   numero               VARCHAR(255) NOT NULL,
   bairro               VARCHAR(255) NOT NULL,
   complemento          VARCHAR(255) NOT NULL,
   CEP                  VARCHAR(255) NOT NULL,
   idCidade             INT NOT NULL,
   idUsuario            INT NOT NULL,
   idTipo               INT NOT NULL,
   idSituacao           INT NOT NULL,
   PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: tbComentario                                          */
/*==============================================================*/
CREATE TABLE tbComentario
(
   id                   INT NOT NULL AUTO_INCREMENT,
   comentario           VARCHAR(4000),
   DATA                 DATETIME NOT NULL,
   avaliacao            INT NOT NULL,
   idUsuario            INT NOT NULL,
   idColaboracao        INT NOT NULL,
   PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: tbEndereco                                            */
/*==============================================================*/
CREATE TABLE tbEndereco
(
   id                   INT NOT NULL AUTO_INCREMENT,
   latitude             NUMERIC(9,6) NOT NULL,
   longitude            NUMERIC(9,6) NOT NULL,
   rua                  VARCHAR(255) NOT NULL,
   numero               VARCHAR(255) NOT NULL,
   bairro               VARCHAR(255) NOT NULL,
   complemento          VARCHAR(255) NOT NULL,
   CEP                  VARCHAR(255) NOT NULL,
   idCidade             INT NOT NULL,
   idUsuario            INT NOT NULL,
   PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: tbEstado                                              */
/*==============================================================*/
CREATE TABLE tbEstado
(
   id                   INT NOT NULL AUTO_INCREMENT,
   nome                 VARCHAR(255) NOT NULL,
   sigla                VARCHAR(255) NOT NULL,
   PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: tbHistorico                                           */
/*==============================================================*/
CREATE TABLE tbHistorico
(
   id                   INT NOT NULL AUTO_INCREMENT,
   observacao           VARCHAR(4000),
   dataRegistro         DATETIME NOT NULL,
   idColaboracao        INT NOT NULL,
   idUsuario            INT NOT NULL,
   idSituacao           INT,
   PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: tbPerfil                                              */
/*==============================================================*/
CREATE TABLE tbPerfil
(
   id                   INT NOT NULL AUTO_INCREMENT,
   nome                 VARCHAR(255) NOT NULL,
   PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: tbPlanejamento                                        */
/*==============================================================*/
CREATE TABLE tbPlanejamento
(
   id                   INT NOT NULL AUTO_INCREMENT,
   dataRegistro         DATE NOT NULL,
   horaInicio           TIME,
   horaTermino          TIME,
   observacao           VARCHAR(4000),
   flagSituacao         INT NOT NULL,
   distancia            NUMERIC(9,2) NOT NULL,
   idTipo               INT NOT NULL,
   PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: tbPlanejamentoColaboracao                             */
/*==============================================================*/
CREATE TABLE tbPlanejamentoColaboracao
(
   id                   INT NOT NULL AUTO_INCREMENT,
   dataRealizacao       DATETIME NOT NULL,
   observacao           VARCHAR(255),
   idPlanejamento       INT NOT NULL,
   idColaboracao        INT NOT NULL,
   PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: tbPlanejamentoUsuario                                 */
/*==============================================================*/
CREATE TABLE tbPlanejamentoUsuario
(
   id                   INT NOT NULL AUTO_INCREMENT,
   idPlanejamento       INT NOT NULL,
   idUsuario            INT NOT NULL,
   PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: tbSituacao                                            */
/*==============================================================*/
CREATE TABLE tbSituacao
(
   id                   INT NOT NULL AUTO_INCREMENT,
   nome                 VARCHAR(255) NOT NULL,
   PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: tbTipo                                                */
/*==============================================================*/
CREATE TABLE tbTipo
(
   id                   INT NOT NULL AUTO_INCREMENT,
   nome                 VARCHAR(255) NOT NULL,
   PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: tbUsuario                                             */
/*==============================================================*/
CREATE TABLE tbUsuario
(
   id                   INT NOT NULL AUTO_INCREMENT,
   nome                 VARCHAR(255) NOT NULL,
   email                VARCHAR(255) NOT NULL,
   senha                VARCHAR(255) NOT NULL,
   dataNascimento       DATE NOT NULL,
   sexo                 VARCHAR(1) NOT NULL,
   flagSituacao         INT NOT NULL,
   foto                 VARCHAR(255) NOT NULL,
   idPerfil             INT NOT NULL,
   PRIMARY KEY (id)
);

ALTER TABLE tbCidade ADD CONSTRAINT FK_Reference_5 FOREIGN KEY (idEstado)
      REFERENCES tbEstado (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbColaboracao ADD CONSTRAINT FK_Reference_1 FOREIGN KEY (idUsuario)
      REFERENCES tbUsuario (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbColaboracao ADD CONSTRAINT FK_Reference_13 FOREIGN KEY (idTipo)
      REFERENCES tbTipo (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbColaboracao ADD CONSTRAINT FK_Reference_15 FOREIGN KEY (idSituacao)
      REFERENCES tbSituacao (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbColaboracao ADD CONSTRAINT FK_Reference_7 FOREIGN KEY (idCidade)
      REFERENCES tbCidade (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbComentario ADD CONSTRAINT FK_Reference_17 FOREIGN KEY (idUsuario)
      REFERENCES tbUsuario (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbComentario ADD CONSTRAINT FK_Reference_18 FOREIGN KEY (idColaboracao)
      REFERENCES tbColaboracao (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbEndereco ADD CONSTRAINT FK_Reference_4 FOREIGN KEY (idUsuario)
      REFERENCES tbUsuario (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbEndereco ADD CONSTRAINT FK_Reference_6 FOREIGN KEY (idCidade)
      REFERENCES tbCidade (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbHistorico ADD CONSTRAINT FK_Reference_16 FOREIGN KEY (idSituacao)
      REFERENCES tbSituacao (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbHistorico ADD CONSTRAINT FK_Reference_2 FOREIGN KEY (idColaboracao)
      REFERENCES tbColaboracao (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbHistorico ADD CONSTRAINT FK_Reference_3 FOREIGN KEY (idUsuario)
      REFERENCES tbUsuario (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbPlanejamento ADD CONSTRAINT FK_Reference_10 FOREIGN KEY (idTipo)
      REFERENCES tbTipo (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbPlanejamentoColaboracao ADD CONSTRAINT FK_Reference_8 FOREIGN KEY (idPlanejamento)
      REFERENCES tbPlanejamento (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbPlanejamentoColaboracao ADD CONSTRAINT FK_Reference_9 FOREIGN KEY (idColaboracao)
      REFERENCES tbColaboracao (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbPlanejamentoUsuario ADD CONSTRAINT FK_Reference_11 FOREIGN KEY (idPlanejamento)
      REFERENCES tbPlanejamento (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbPlanejamentoUsuario ADD CONSTRAINT FK_Reference_12 FOREIGN KEY (idUsuario)
      REFERENCES tbUsuario (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbUsuario ADD CONSTRAINT FK_Reference_14 FOREIGN KEY (idPerfil)
      REFERENCES tbPerfil (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

