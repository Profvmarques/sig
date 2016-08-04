# MySQL-Front 3.2  (Build 7.19)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'latin1' */;

DROP DATABASE IF EXISTS `sig`;
CREATE DATABASE `sig` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sig`;
CREATE TABLE `acessousuario` (
  `idmenu` int(11) NOT NULL auto_increment,
  `idusuarios` int(11) default NULL,
  `incluir` int(11) default NULL,
  `consultar` int(11) default NULL,
  `alterar` int(11) default NULL,
  `excluir` int(11) default NULL,
  PRIMARY KEY  (`idmenu`),
  KEY `idusuarios` (`idusuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `alunos` (
  `idalunos` int(11) NOT NULL auto_increment,
  `idpessoas` int(11) default NULL,
  `dtreg` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`idalunos`),
  KEY `idpessoas` (`idpessoas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `candidatos` (
  `idcandidatos` int(11) NOT NULL auto_increment,
  `idpessoas` int(11) default NULL,
  `dtreg` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`idcandidatos`),
  KEY `idpessoas` (`idpessoas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `cargos` (
  `idcargos` int(11) NOT NULL auto_increment,
  `descricao` varchar(70) default NULL,
  PRIMARY KEY  (`idcargos`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `cargos` VALUES (1,'PROFESSOR');
INSERT INTO `cargos` VALUES (2,'SECRETARIA ACADÊMICA');
INSERT INTO `cargos` VALUES (3,'DIRETOR');
INSERT INTO `cargos` VALUES (4,'GESTOR DE UNIDADE');
INSERT INTO `cargos` VALUES (5,'SUPERVISOR EDUCACIONAL');
INSERT INTO `cargos` VALUES (6,'COORDENADOR DE CURSO');
INSERT INTO `cargos` VALUES (7,'ASSESSORIA TECNOLÓGICA');

CREATE TABLE `correcoes` (
  `idcorrecoes` int(11) NOT NULL auto_increment,
  `assunto` varchar(70) default NULL,
  `foto` varchar(255) default NULL,
  `observacao` longtext,
  `situacao` varchar(30) default NULL,
  `dtreg` timestamp NULL default NULL,
  PRIMARY KEY  (`idcorrecoes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `cursos` (
  `idcursos` int(11) NOT NULL auto_increment,
  `idsituacao_curso` int(11) default NULL,
  `sigla` varchar(11) default NULL,
  `descricao` varchar(70) default NULL,
  `carga_horaria` int(11) default NULL,
  `idtipocurso` int(11) default NULL,
  PRIMARY KEY  (`idcursos`),
  KEY `idsituacao_curso` (`idsituacao_curso`),
  KEY `idtipocurso` (`idtipocurso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `distrito` (
  `iddistrito` int(11) NOT NULL auto_increment,
  `descricao` varchar(30) default NULL,
  PRIMARY KEY  (`iddistrito`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `eventos` (
  `ideventos` int(11) NOT NULL auto_increment,
  `descricao` varchar(70) default NULL,
  `data_inicio` date default NULL,
  `data_termino` date default NULL,
  PRIMARY KEY  (`ideventos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `faq` (
  `idfaq` int(11) NOT NULL auto_increment,
  `titulo` varchar(70) default NULL,
  `resposta` varchar(70) default NULL,
  `idusuarios` int(11) default NULL,
  `dtreg` timestamp NULL default NULL,
  PRIMARY KEY  (`idfaq`),
  KEY `idusuarios` (`idusuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `frequencia` (
  `idfrequencia` int(11) NOT NULL auto_increment,
  `idturma` int(11) default NULL,
  `data_frequencia` date default NULL,
  `dtreg` timestamp NULL default NULL,
  PRIMARY KEY  (`idfrequencia`),
  KEY `idturma` (`idturma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `funcionarios` (
  `idfuncionarios` int(11) NOT NULL auto_increment,
  `idpessoas` int(11) default NULL,
  `idcargos` int(11) default NULL,
  `dtreg` timestamp NULL default NULL,
  PRIMARY KEY  (`idfuncionarios`),
  KEY `idpessoas` (`idpessoas`),
  KEY `idcargos` (`idcargos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `logs` (
  `idlogs` int(11) NOT NULL auto_increment,
  `idusuarios` int(11) default NULL,
  `queryexecutada` longtext,
  `nome_tabela` varchar(50) default NULL,
  `acao` varchar(30) default NULL,
  `dtreg` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`idlogs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `manutencao` (
  `idusuarios` int(11) NOT NULL auto_increment,
  `idcorrecoes` int(11) default NULL,
  `descricao` varchar(70) default NULL,
  `dtreg` timestamp NULL default NULL,
  PRIMARY KEY  (`idusuarios`),
  KEY `idcorrecoes` (`idcorrecoes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `matricula` (
  `idmatricula` int(11) NOT NULL auto_increment,
  `idsorteio` int(11) default NULL,
  `idalunos` int(11) default NULL,
  `dtreg` timestamp NULL default NULL,
  PRIMARY KEY  (`idmatricula`),
  KEY `idsorteio` (`idsorteio`),
  KEY `idalunos` (`idalunos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `menu` (
  `idmenu` int(11) NOT NULL auto_increment,
  `idmodulos` int(11) default NULL,
  `class` varchar(70) default NULL,
  `url` varchar(70) default NULL,
  `dtreg` timestamp NULL default NULL,
  PRIMARY KEY  (`idmenu`),
  KEY `idmodulos` (`idmodulos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `modulos` (
  `idmodulos` int(11) NOT NULL auto_increment,
  `idsistemas` int(11) default NULL,
  `descricao` varchar(70) default NULL,
  `dtreg` timestamp NULL default NULL,
  PRIMARY KEY  (`idmodulos`),
  KEY `idsistemas` (`idsistemas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `ocorrencias` (
  `idocorrencias` int(11) NOT NULL auto_increment,
  `idusuarios` int(11) default NULL,
  `query_executada` longtext,
  `tabela` varchar(70) default NULL,
  `acao` varchar(70) default NULL,
  `dtreg` timestamp NULL default NULL,
  PRIMARY KEY  (`idocorrencias`),
  KEY `idusuarios` (`idusuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `perfil` (
  `idperfil` int(11) NOT NULL auto_increment,
  `descricao` varchar(70) default NULL,
  PRIMARY KEY  (`idperfil`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `perfil` VALUES (1,'ADMINISTRADOR');
INSERT INTO `perfil` VALUES (2,'GESTOR UNIDADE');
INSERT INTO `perfil` VALUES (3,'DIRETOR DE EDUCAÇÃO');
INSERT INTO `perfil` VALUES (4,'COORDENADOR DE CURSO');
INSERT INTO `perfil` VALUES (5,'PROFESSOR');
INSERT INTO `perfil` VALUES (6,'ALUNO');

CREATE TABLE `pessoas` (
  `idpessoas` int(11) NOT NULL auto_increment,
  `nome` varchar(70) default NULL,
  `sexo` varchar(11) default NULL,
  `nascimento` date default NULL,
  `email` varchar(70) default NULL,
  `telefone` int(11) default NULL,
  `celular` int(11) default NULL,
  `pai` varchar(70) default NULL,
  `mae` varchar(70) default NULL,
  `responsavel` varchar(70) default NULL,
  `endereco` varchar(70) default NULL,
  `numero` varchar(20) default NULL,
  `complemento` varchar(20) default NULL,
  `bairro` varchar(70) default NULL,
  `cidade` varchar(70) default NULL,
  `cep` varchar(20) default NULL,
  `foto` varchar(11) default NULL,
  `idusuarios` int(11) default NULL,
  `dtreg` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`idpessoas`),
  KEY `idusuarios` (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `pessoas` VALUES (1,'VINÍCIUS MARQUES','M',NULL,'profvmarques@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'0000-00-00 00:00:00');
INSERT INTO `pessoas` VALUES (2,'ADRIANO CUNHA','M',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,'0000-00-00 00:00:00');

CREATE TABLE `protocolo` (
  `idprotocolo` int(11) NOT NULL auto_increment,
  `idcandidatos` int(11) default NULL,
  `idturma` int(11) default NULL,
  `dtreg` int(11) default NULL,
  PRIMARY KEY  (`idprotocolo`),
  KEY `idcandidatos` (`idcandidatos`),
  KEY `idturma` (`idturma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `sistemas` (
  `idsistemas` int(11) NOT NULL auto_increment,
  `descricao` varchar(70) default NULL,
  PRIMARY KEY  (`idsistemas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `situacaocurso` (
  `idsituacao_curso` int(11) NOT NULL auto_increment,
  `descricao` varchar(70) default NULL,
  PRIMARY KEY  (`idsituacao_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `situacaoturma` (
  `idsituacao_turma` int(11) NOT NULL auto_increment,
  `descricao` varchar(70) default NULL,
  PRIMARY KEY  (`idsituacao_turma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `sorteio` (
  `idsorteio` int(11) NOT NULL auto_increment,
  `idprotocolo` int(11) default NULL,
  `sequencia` int(11) default NULL,
  `ordem_sorteio` int(11) default NULL,
  `data_sorteio` date default NULL,
  PRIMARY KEY  (`idsorteio`),
  KEY `idturma` (`idprotocolo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `tipocurso` (
  `idtipocurso` int(11) NOT NULL auto_increment,
  `descricao` varchar(70) default NULL,
  PRIMARY KEY  (`idtipocurso`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `tipocurso` VALUES (1,'PRESENCIAL');
INSERT INTO `tipocurso` VALUES (2,'SEMI-PRESENCIAL');
INSERT INTO `tipocurso` VALUES (3,'EAD');

CREATE TABLE `turma` (
  `idturma` int(11) NOT NULL auto_increment,
  `codigo` varchar(50) default NULL,
  `idcursos` int(11) default NULL,
  `horario_inicio` varchar(50) default NULL,
  `horario_termino` varchar(50) default NULL,
  `seg` int(11) default NULL,
  `ter` int(11) default NULL,
  `qua` int(11) default NULL,
  `qui` int(11) default NULL,
  `sex` int(11) default NULL,
  `sab` int(11) default NULL,
  `dom` int(11) default NULL,
  `idturno` int(11) default NULL,
  `idsituacao_turma` int(11) default NULL,
  PRIMARY KEY  (`idturma`),
  KEY `idcursos` (`idcursos`),
  KEY `idturno` (`idturno`),
  KEY `idsituacao_turma` (`idsituacao_turma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `turno` (
  `idturno` int(11) NOT NULL auto_increment,
  `descricao` varchar(30) default NULL,
  PRIMARY KEY  (`idturno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `unidadegestao` (
  `idunidade_gestao` int(11) NOT NULL auto_increment,
  `descricao` varchar(100) default NULL,
  `responsavel` varchar(11) default NULL,
  `endereco` varchar(100) default NULL,
  `bairro` varchar(70) default NULL,
  `telefone` varchar(14) default NULL,
  `celular` varchar(14) default NULL,
  `email` varchar(50) default NULL,
  `iddistrito` int(11) default NULL,
  PRIMARY KEY  (`idunidade_gestao`),
  KEY `iddistrito` (`iddistrito`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL auto_increment,
  `usuario` varchar(30) default NULL,
  `senha` varchar(30) default NULL,
  `situacao` varchar(70) default NULL,
  `idperfil` int(11) default NULL,
  `dtreg` timestamp NULL default NULL,
  PRIMARY KEY  (`idusuarios`),
  KEY `idperfil` (`idperfil`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `usuarios` VALUES (1,'vinicius','MTIzMTIz','ATIVO',1,NULL);
INSERT INTO `usuarios` VALUES (2,'adriano','MTIzMTIz','ATIVO',1,NULL);


ALTER TABLE `acessousuario`
  ADD FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`),
  ADD FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`);

ALTER TABLE `alunos`
  ADD FOREIGN KEY (`idpessoas`) REFERENCES `pessoas` (`idpessoas`);

ALTER TABLE `candidatos`
  ADD FOREIGN KEY (`idpessoas`) REFERENCES `pessoas` (`idpessoas`);

ALTER TABLE `cursos`
  ADD FOREIGN KEY (`idtipocurso`) REFERENCES `tipocurso` (`idtipocurso`),
  ADD FOREIGN KEY (`idsituacao_curso`) REFERENCES `situacaocurso` (`idsituacao_curso`);

ALTER TABLE `faq`
  ADD FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`);

ALTER TABLE `frequencia`
  ADD FOREIGN KEY (`idturma`) REFERENCES `turma` (`idturma`);

ALTER TABLE `funcionarios`
  ADD FOREIGN KEY (`idcargos`) REFERENCES `cargos` (`idcargos`),
  ADD FOREIGN KEY (`idpessoas`) REFERENCES `pessoas` (`idpessoas`);

ALTER TABLE `manutencao`
  ADD FOREIGN KEY (`idcorrecoes`) REFERENCES `correcoes` (`idcorrecoes`),
  ADD FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`);

ALTER TABLE `matricula`
  ADD FOREIGN KEY (`idalunos`) REFERENCES `alunos` (`idalunos`),
  ADD FOREIGN KEY (`idsorteio`) REFERENCES `sorteio` (`idsorteio`);

ALTER TABLE `menu`
  ADD FOREIGN KEY (`idmodulos`) REFERENCES `modulos` (`idmodulos`);

ALTER TABLE `modulos`
  ADD FOREIGN KEY (`idsistemas`) REFERENCES `sistemas` (`idsistemas`);

ALTER TABLE `ocorrencias`
  ADD FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`);

ALTER TABLE `pessoas`
  ADD FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`);

ALTER TABLE `protocolo`
  ADD FOREIGN KEY (`idturma`) REFERENCES `turma` (`idturma`),
  ADD FOREIGN KEY (`idcandidatos`) REFERENCES `candidatos` (`idcandidatos`);

ALTER TABLE `sorteio`
  ADD FOREIGN KEY (`idprotocolo`) REFERENCES `protocolo` (`idprotocolo`);

ALTER TABLE `turma`
  ADD FOREIGN KEY (`idcursos`) REFERENCES `cursos` (`idcursos`),
  ADD FOREIGN KEY (`idturno`) REFERENCES `turno` (`idturno`),
  ADD FOREIGN KEY (`idsituacao_turma`) REFERENCES `situacaoturma` (`idsituacao_turma`);

ALTER TABLE `unidadegestao`
  ADD FOREIGN KEY (`iddistrito`) REFERENCES `distrito` (`iddistrito`);

ALTER TABLE `usuarios`
  ADD FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`idperfil`);
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
