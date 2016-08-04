# MySQL-Front 3.2  (Build 7.19)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'latin1' */;

DROP DATABASE IF EXISTS `fundec26`;
CREATE DATABASE `fundec26` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `fundec26`;
CREATE TABLE `acessousuario` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) DEFAULT NULL,
  `incluir` int(11) DEFAULT NULL,
  `consultar` int(11) DEFAULT NULL,
  `alterar` int(11) DEFAULT NULL,
  `excluir` int(11) DEFAULT NULL,
  PRIMARY KEY (`idmenu`),
  KEY `idusuarios` (`idusuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


CREATE TABLE `alocacaoturma` (
  `idturma` int(11) NOT NULL DEFAULT '0',
  `idespaco` int(11) DEFAULT NULL,
  `idhorario` int(11) DEFAULT NULL,
  `dtreg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idturma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `alunos` (
  `idalunos` int(11) NOT NULL AUTO_INCREMENT,
  `idpessoas` int(11) DEFAULT NULL,
  `dtreg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idalunos`),
  KEY `idpessoas` (`idpessoas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `avaliacao` (
  `matricula` int(11) NOT NULL DEFAULT '0',
  `av1` double(10,2) DEFAULT NULL,
  `av2` double(10,2) DEFAULT NULL,
  `idsituacao_avaliacao` varchar(11) DEFAULT NULL,
  `dtreg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `candidatos` (
  `idcandidatos` int(11) NOT NULL AUTO_INCREMENT,
  `idpessoas` int(11) DEFAULT NULL,
  `dtreg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcandidatos`),
  KEY `idpessoas` (`idpessoas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `cargos` (
  `idcargos` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`idcargos`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `cargos` VALUES (1,'PROFESSOR');
INSERT INTO `cargos` VALUES (2,'SECRETARIA ACAD MICA');
INSERT INTO `cargos` VALUES (3,'DIRETOR');
INSERT INTO `cargos` VALUES (4,'GESTOR DE UNIDADE');
INSERT INTO `cargos` VALUES (5,'SUPERVISOR EDUCACIONAL');
INSERT INTO `cargos` VALUES (6,'COORDENADOR DE CURSO');
INSERT INTO `cargos` VALUES (7,'ASSESSORIA TECNOL”GICA');

CREATE TABLE `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `to` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO `chat` VALUES (1,'babydoe','johndoe','intiui√ß√£o\nsalva√ß√£o','2016-07-27 01:00:51',0);
INSERT INTO `chat` VALUES (2,'babydoe','johndoe','na√ß√£o','2016-07-27 01:02:28',0);
INSERT INTO `chat` VALUES (3,'babydoe','johndoe','importa√ß√£o','2016-07-27 01:04:14',0);
INSERT INTO `chat` VALUES (4,'babydoe','johndoe','zdsdsd','2016-07-27 01:12:42',0);
INSERT INTO `chat` VALUES (5,'babydoe','johndoe','ora√ß√£o','2016-07-27 01:13:21',0);
INSERT INTO `chat` VALUES (6,'babydoe','johndoe','babaÁ„o','2016-07-27 01:16:39',0);
INSERT INTO `chat` VALUES (7,'babydoe','johndoe','dd','2016-07-27 01:42:25',0);
INSERT INTO `chat` VALUES (8,'babydoe','vinny','teste de pariaÁ„o','2016-07-27 01:50:18',0);
INSERT INTO `chat` VALUES (9,'babydoe','vinny','DÈbora','2016-07-27 01:50:25',0);
INSERT INTO `chat` VALUES (10,'babydoe','vinny','joana D\\\'Arc','2016-07-27 01:50:38',0);
INSERT INTO `chat` VALUES (11,'babydoe','vinny','foi','2016-07-27 01:51:27',0);
INSERT INTO `chat` VALUES (12,'babydoe','vinny','fgf','2016-07-27 01:54:23',0);
INSERT INTO `chat` VALUES (13,'babydoe','vinny','bl·bl·','2016-07-27 01:54:31',0);
INSERT INTO `chat` VALUES (14,'babydoe','vinny','hm','2016-07-27 02:09:08',0);
INSERT INTO `chat` VALUES (15,'babydoe','vinny','aee','2016-07-27 02:15:33',0);
INSERT INTO `chat` VALUES (16,'babydoe','vinny','ef','2016-07-27 02:27:58',0);
INSERT INTO `chat` VALUES (17,'babydoe','vinny','k','2016-07-27 02:56:59',0);
INSERT INTO `chat` VALUES (18,'babydoe','vinny','foi','2016-07-27 03:04:01',0);
INSERT INTO `chat` VALUES (19,'babydoe','vinny','sjscdf','2016-07-27 03:19:01',0);
INSERT INTO `chat` VALUES (20,'babydoe','vinny','ldsdkmd','2016-07-27 03:19:13',0);
INSERT INTO `chat` VALUES (21,'babydoe','vinny','zxx','2016-07-27 03:19:32',0);

CREATE TABLE `conteudo` (
  `idconteudo` int(11) NOT NULL AUTO_INCREMENT,
  `idcursos` int(11) DEFAULT NULL,
  `descricao` longtext,
  `dtreg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idconteudo`),
  KEY `idcursos` (`idcursos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `correcoes` (
  `idcorrecoes` int(11) NOT NULL AUTO_INCREMENT,
  `assunto` varchar(70) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `observacao` longtext,
  `situacao` varchar(30) DEFAULT NULL,
  `dtreg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcorrecoes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `cursos` (
  `idcursos` int(11) NOT NULL AUTO_INCREMENT,
  `idsituacao_curso` int(11) DEFAULT NULL,
  `sigla` varchar(11) DEFAULT NULL,
  `descricao` varchar(70) DEFAULT NULL,
  `carga_horaria` int(11) DEFAULT NULL,
  `idtipocurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcursos`),
  KEY `idsituacao_curso` (`idsituacao_curso`),
  KEY `idtipocurso` (`idtipocurso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `distrito` (
  `iddistrito` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`iddistrito`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `espaco` (
  `idespaco` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `capacidade` int(11) DEFAULT NULL,
  PRIMARY KEY (`idespaco`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `eventos` (
  `ideventos` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(70) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_termino` date DEFAULT NULL,
  PRIMARY KEY (`ideventos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `faq` (
  `idfaq` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(70) DEFAULT NULL,
  `resposta` varchar(70) DEFAULT NULL,
  `idusuarios` int(11) DEFAULT NULL,
  `dtreg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idfaq`),
  KEY `idusuarios` (`idusuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `frequencia` (
  `idfrequencia` int(11) NOT NULL AUTO_INCREMENT,
  `idturma` int(11) DEFAULT NULL,
  `data_frequencia` date DEFAULT NULL,
  `situacao` int(11) DEFAULT NULL,
  `dtreg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idfrequencia`),
  KEY `idturma` (`idturma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `funcionarios` (
  `idfuncionarios` int(11) NOT NULL AUTO_INCREMENT,
  `idpessoas` int(11) DEFAULT NULL,
  `idcargos` int(11) DEFAULT NULL,
  `dtreg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idfuncionarios`),
  KEY `idpessoas` (`idpessoas`),
  KEY `idcargos` (`idcargos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `horario` (
  `idhorario` int(11) NOT NULL AUTO_INCREMENT,
  `horario_inicio` varchar(20) DEFAULT NULL,
  `horario_termino` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idhorario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `logs` (
  `idlogs` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) DEFAULT NULL,
  `queryexecutada` longtext,
  `nome_tabela` varchar(50) DEFAULT NULL,
  `acao` varchar(30) DEFAULT NULL,
  `dtreg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idlogs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `lotacao` (
  `idlotacao` int(11) NOT NULL AUTO_INCREMENT,
  `idfuncionarios` int(11) DEFAULT NULL,
  `idunidade_gestao` int(11) DEFAULT NULL,
  `data_entrada` date DEFAULT NULL,
  `data_saida` date DEFAULT NULL,
  `dtreg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idlotacao`),
  KEY `idfuncionarios` (`idfuncionarios`),
  KEY `idunidade_gestao` (`idunidade_gestao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `manutencao` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `idcorrecoes` int(11) DEFAULT NULL,
  `descricao` varchar(70) DEFAULT NULL,
  `dtreg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idusuarios`),
  KEY `idcorrecoes` (`idcorrecoes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `matricula` (
  `idmatricula` int(11) NOT NULL AUTO_INCREMENT,
  `idsorteio` int(11) DEFAULT NULL,
  `idalunos` int(11) DEFAULT NULL,
  `dtreg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idmatricula`),
  KEY `idsorteio` (`idsorteio`),
  KEY `idalunos` (`idalunos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `idmodulos` int(11) DEFAULT NULL,
  `class` varchar(70) DEFAULT NULL,
  `url` varchar(70) DEFAULT NULL,
  `dtreg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idmenu`),
  KEY `idmodulos` (`idmodulos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


CREATE TABLE `modulos` (
  `idmodulos` int(11) NOT NULL AUTO_INCREMENT,
  `idsistemas` int(11) DEFAULT NULL,
  `sigla_modulo` varchar(30) DEFAULT NULL,
  `descricao` varchar(70) DEFAULT NULL,
  `dtreg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idmodulos`),
  KEY `idsistemas` (`idsistemas`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `modulos` VALUES (1,1,'Conf','ConfiguraÁ„o',NULL);

CREATE TABLE `ocorrencias` (
  `idocorrencias` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) DEFAULT NULL,
  `query_executada` longtext,
  `tabela` varchar(70) DEFAULT NULL,
  `acao` varchar(70) DEFAULT NULL,
  `situacao` varchar(50) DEFAULT NULL,
  `dtreg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idocorrencias`),
  KEY `idusuarios` (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `ocorrencias` VALUES (1,1,'','teste','teste','EM ANALISE',NULL);

CREATE TABLE `perfil` (
  `idperfil` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`idperfil`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `perfil` VALUES (1,'ADMINISTRADOR');
INSERT INTO `perfil` VALUES (2,'GESTOR UNIDADE');
INSERT INTO `perfil` VALUES (3,'DIRETOR DE EDUCA«√O');
INSERT INTO `perfil` VALUES (4,'COORDENADOR DE CURSO');
INSERT INTO `perfil` VALUES (5,'PROFESSOR');
INSERT INTO `perfil` VALUES (6,'ALUNO');

CREATE TABLE `pessoas` (
  `idpessoas` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) DEFAULT NULL,
  `sexo` varchar(11) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `telefone` int(11) DEFAULT NULL,
  `celular` int(11) DEFAULT NULL,
  `pai` varchar(70) DEFAULT NULL,
  `mae` varchar(70) DEFAULT NULL,
  `responsavel` varchar(70) DEFAULT NULL,
  `endereco` varchar(70) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  `bairro` varchar(70) DEFAULT NULL,
  `cidade` varchar(70) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `foto` varchar(11) DEFAULT NULL,
  `idusuarios` int(11) DEFAULT NULL,
  `dtreg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idpessoas`),
  KEY `idusuarios` (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `pessoas` VALUES (1,'VINÕCIUS MARQUES','M',NULL,'profvmarques@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'0000-00-00 00:00:00');
INSERT INTO `pessoas` VALUES (2,'ADRIANO CUNHA','M',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,'0000-00-00 00:00:00');

CREATE TABLE `professor` (
  `idprofessor` int(11) NOT NULL AUTO_INCREMENT,
  `idfuncionarios` int(11) DEFAULT NULL,
  `idtitulacao` int(11) DEFAULT NULL,
  `cvlattes` int(11) DEFAULT NULL,
  `dtreg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idprofessor`),
  KEY `idtitulacao` (`idtitulacao`),
  KEY `idfuncionarios` (`idfuncionarios`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `protocolo` (
  `idprotocolo` int(11) NOT NULL AUTO_INCREMENT,
  `idcandidatos` int(11) DEFAULT NULL,
  `idturma` int(11) DEFAULT NULL,
  `dtreg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idprotocolo`),
  KEY `idcandidatos` (`idcandidatos`),
  KEY `idturma` (`idturma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `sistemas` (
  `idsistemas` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(30) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idsistemas`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `sistemas` VALUES (1,'SysFundec','SISTEMA DE GEST√O ACAD MICA DOS CURSOS PROFISSIONALIZANTES');
INSERT INTO `sistemas` VALUES (2,'SIC','SERVI«O DE INFORMA«√O AO CIDAD√O');
INSERT INTO `sistemas` VALUES (3,'SOS','SISTEMA DE ORDEM DE SERVI«O');

CREATE TABLE `situacaocurso` (
  `idsituacao_curso` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`idsituacao_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `situacaoturma` (
  `idsituacao_turma` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`idsituacao_turma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `sorteio` (
  `idsorteio` int(11) NOT NULL AUTO_INCREMENT,
  `idprotocolo` int(11) DEFAULT NULL,
  `sequencia` int(11) DEFAULT NULL,
  `ordem_sorteio` int(11) DEFAULT NULL,
  `data_sorteio` date DEFAULT NULL,
  PRIMARY KEY (`idsorteio`),
  KEY `idturma` (`idprotocolo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `tipocurso` (
  `idtipocurso` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`idtipocurso`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `tipocurso` VALUES (1,'PRESENCIAL');
INSERT INTO `tipocurso` VALUES (2,'SEMI-PRESENCIAL');
INSERT INTO `tipocurso` VALUES (3,'EAD');

CREATE TABLE `titulacao` (
  `idtitulacao` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idtitulacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `turma` (
  `idturma` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) DEFAULT NULL,
  `idcursos` int(11) DEFAULT NULL,
  `horario_inicio` varchar(50) DEFAULT NULL,
  `horario_termino` varchar(50) DEFAULT NULL,
  `seg` int(11) DEFAULT NULL,
  `ter` int(11) DEFAULT NULL,
  `qua` int(11) DEFAULT NULL,
  `qui` int(11) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `sab` int(11) DEFAULT NULL,
  `dom` int(11) DEFAULT NULL,
  `idturno` int(11) DEFAULT NULL,
  `idsituacao_turma` int(11) DEFAULT NULL,
  `dtreg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idturma`),
  KEY `idcursos` (`idcursos`),
  KEY `idturno` (`idturno`),
  KEY `idsituacao_turma` (`idsituacao_turma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `turno` (
  `idturno` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idturno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `unidadegestao` (
  `idunidade_gestao` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `responsavel` varchar(11) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `bairro` varchar(70) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `celular` varchar(14) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `iddistrito` int(11) DEFAULT NULL,
  PRIMARY KEY (`idunidade_gestao`),
  KEY `iddistrito` (`iddistrito`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) DEFAULT NULL,
  `senha` varchar(30) DEFAULT NULL,
  `situacao` varchar(70) DEFAULT NULL,
  `idperfil` int(11) DEFAULT NULL,
  `dtreg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idusuarios`),
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

ALTER TABLE `conteudo`
  ADD FOREIGN KEY (`idcursos`) REFERENCES `cursos` (`idcursos`);

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

ALTER TABLE `lotacao`
  ADD FOREIGN KEY (`idfuncionarios`) REFERENCES `funcionarios` (`idfuncionarios`),
  ADD FOREIGN KEY (`idunidade_gestao`) REFERENCES `unidadegestao` (`idunidade_gestao`);

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

ALTER TABLE `professor`
  ADD FOREIGN KEY (`idtitulacao`) REFERENCES `titulacao` (`idtitulacao`),
  ADD FOREIGN KEY (`idfuncionarios`) REFERENCES `funcionarios` (`idfuncionarios`);

ALTER TABLE `protocolo`
  ADD FOREIGN KEY (`idcandidatos`) REFERENCES `candidatos` (`idcandidatos`),
  ADD FOREIGN KEY (`idturma`) REFERENCES `turma` (`idturma`);

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
