

CREATE TABLE `alumno` (
  `id_alumno` int(20) NOT NULL AUTO_INCREMENT,
  `legajo` int(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fechaNacimientoAlumno` date NOT NULL,
  `telefonoAlumno` varchar(50) NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_alumno`),
  KEY `id_alumno` (`id_alumno`),
  KEY `id_alumno_2` (`id_alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO alumno VALUES("1","35821","van den bosch","lucas","vandenboschlucas@hotmail.com","1992-05-18","2616394922",NULL);
INSERT INTO alumno VALUES("2","32145","Porte","Gaston","gporte@gmail.com","2019-09-09","2618586488",NULL);
INSERT INTO alumno VALUES("17","34891","Pereyra","Albana","albanapereyra@gmail.com","0000-00-00","",NULL);
INSERT INTO alumno VALUES("18","1","Sanches","Ramon","vandenboschlucas@gmail.com","1992-05-05","02616394922",NULL);
INSERT INTO alumno VALUES("19","2","Perez","Hector","vandenboschlucas@gmail.com","1992-02-01","02616394922",NULL);
INSERT INTO alumno VALUES("20","3","Aguirre","Marcos","vandenboschlucas@gmail.com","1992-05-05","02616394922",NULL);
INSERT INTO alumno VALUES("21","4","Nedved","Nicolas","vandenboschlucas@gmail.com","1992-05-05","02616394922",NULL);
INSERT INTO alumno VALUES("22","5","Mercado","Aquiles","vandenboschlucas@gmail.com","1991-05-05","02616394922",NULL);



CREATE TABLE `anotadosestado` (
  `id_anotadoestado` int(20) NOT NULL AUTO_INCREMENT,
  `fechaAnotadosEstado` date NOT NULL,
  `horaAnotadosEstado` time NOT NULL,
  `fk_estadoanotados` int(11) NOT NULL,
  `fk_detalleanotados` int(20) NOT NULL,
  PRIMARY KEY (`id_anotadoestado`),
  KEY `fk_detalleanotados` (`fk_detalleanotados`),
  KEY `fk_estadoanotados` (`fk_estadoanotados`)
) ENGINE=InnoDB AUTO_INCREMENT=297 DEFAULT CHARSET=utf8;

INSERT INTO anotadosestado VALUES("83","2019-09-21","20:16:21","2","73");
INSERT INTO anotadosestado VALUES("84","2019-09-21","20:17:17","1","73");
INSERT INTO anotadosestado VALUES("85","2019-09-21","20:17:57","2","73");
INSERT INTO anotadosestado VALUES("86","2019-09-21","20:18:01","1","73");
INSERT INTO anotadosestado VALUES("87","2019-09-21","20:18:04","2","73");
INSERT INTO anotadosestado VALUES("88","2019-09-21","20:18:07","1","73");
INSERT INTO anotadosestado VALUES("90","2019-09-21","20:19:20","1","78");
INSERT INTO anotadosestado VALUES("94","2019-09-22","22:47:03","2","73");
INSERT INTO anotadosestado VALUES("95","2019-09-22","22:54:31","1","73");
INSERT INTO anotadosestado VALUES("104","2019-09-23","00:24:43","2","73");
INSERT INTO anotadosestado VALUES("105","2019-09-23","00:24:54","1","73");
INSERT INTO anotadosestado VALUES("106","2019-09-23","00:25:07","2","73");
INSERT INTO anotadosestado VALUES("107","2019-09-23","00:25:11","1","73");
INSERT INTO anotadosestado VALUES("108","2019-09-23","00:30:26","2","73");
INSERT INTO anotadosestado VALUES("109","2019-09-23","00:31:09","1","73");
INSERT INTO anotadosestado VALUES("110","2019-09-23","00:31:23","2","73");
INSERT INTO anotadosestado VALUES("111","2019-09-23","01:33:42","1","78");
INSERT INTO anotadosestado VALUES("112","2019-09-23","12:18:57","1","73");
INSERT INTO anotadosestado VALUES("113","2019-09-23","12:19:32","2","73");
INSERT INTO anotadosestado VALUES("114","2019-09-23","12:19:41","1","73");
INSERT INTO anotadosestado VALUES("115","2019-09-23","12:23:47","2","73");
INSERT INTO anotadosestado VALUES("116","2019-09-23","12:23:50","1","73");
INSERT INTO anotadosestado VALUES("117","2019-09-23","12:24:52","2","73");
INSERT INTO anotadosestado VALUES("118","2019-09-23","12:24:55","1","73");
INSERT INTO anotadosestado VALUES("119","2019-09-23","12:25:52","2","73");
INSERT INTO anotadosestado VALUES("120","2019-09-23","12:25:55","1","73");
INSERT INTO anotadosestado VALUES("121","2019-09-23","12:27:24","2","73");
INSERT INTO anotadosestado VALUES("122","2019-09-23","12:27:27","1","73");
INSERT INTO anotadosestado VALUES("123","2019-09-23","12:28:00","2","73");
INSERT INTO anotadosestado VALUES("124","2019-09-23","12:28:03","1","73");
INSERT INTO anotadosestado VALUES("125","2019-09-23","12:31:06","2","73");
INSERT INTO anotadosestado VALUES("126","2019-09-23","12:31:11","1","73");
INSERT INTO anotadosestado VALUES("127","2019-09-23","12:33:25","2","73");
INSERT INTO anotadosestado VALUES("128","2019-09-23","12:33:29","1","73");
INSERT INTO anotadosestado VALUES("131","2019-09-28","18:02:04","2","73");
INSERT INTO anotadosestado VALUES("132","2019-09-28","18:02:18","1","73");
INSERT INTO anotadosestado VALUES("139","2019-10-12","13:19:26","2","73");
INSERT INTO anotadosestado VALUES("141","2019-10-12","13:20:18","1","73");
INSERT INTO anotadosestado VALUES("147","2019-10-12","19:52:30","4","90");
INSERT INTO anotadosestado VALUES("148","2019-10-12","19:53:03","1","91");
INSERT INTO anotadosestado VALUES("149","2019-10-14","22:15:52","2","90");
INSERT INTO anotadosestado VALUES("150","2019-10-14","22:21:14","4","91");
INSERT INTO anotadosestado VALUES("151","2019-10-20","04:14:21","1","92");
INSERT INTO anotadosestado VALUES("152","2019-10-20","04:16:48","2","92");
INSERT INTO anotadosestado VALUES("153","2019-10-20","04:23:24","1","91");
INSERT INTO anotadosestado VALUES("154","2019-10-24","12:42:16","1","93");
INSERT INTO anotadosestado VALUES("155","2019-10-24","12:42:32","1","94");
INSERT INTO anotadosestado VALUES("156","2019-10-24","12:42:56","1","95");
INSERT INTO anotadosestado VALUES("157","2019-10-24","12:43:30","1","96");
INSERT INTO anotadosestado VALUES("158","2019-10-24","12:43:43","1","97");
INSERT INTO anotadosestado VALUES("159","2019-10-24","12:43:54","1","98");
INSERT INTO anotadosestado VALUES("160","2019-10-24","12:44:08","1","99");
INSERT INTO anotadosestado VALUES("161","2019-10-24","12:44:28","1","100");
INSERT INTO anotadosestado VALUES("162","2019-10-24","12:44:39","1","101");
INSERT INTO anotadosestado VALUES("163","2019-10-24","12:47:56","1","102");
INSERT INTO anotadosestado VALUES("164","2019-10-24","12:48:22","1","103");
INSERT INTO anotadosestado VALUES("165","2019-10-24","12:48:31","1","104");
INSERT INTO anotadosestado VALUES("166","2019-10-28","16:03:20","4","93");
INSERT INTO anotadosestado VALUES("167","2019-10-28","19:02:22","4","97");
INSERT INTO anotadosestado VALUES("168","2019-10-29","08:04:34","4","104");
INSERT INTO anotadosestado VALUES("169","2019-10-29","15:01:31","4","100");
INSERT INTO anotadosestado VALUES("170","2019-10-29","15:04:00","4","96");
INSERT INTO anotadosestado VALUES("171","2019-10-29","15:04:44","1","105");
INSERT INTO anotadosestado VALUES("172","2019-10-30","19:01:49","4","95");
INSERT INTO anotadosestado VALUES("173","2019-10-31","14:00:53","4","102");
INSERT INTO anotadosestado VALUES("174","2019-10-24","15:51:10","2","94");
INSERT INTO anotadosestado VALUES("175","2019-10-24","15:51:25","1","94");
INSERT INTO anotadosestado VALUES("176","2019-10-26","12:10:00","2","105");
INSERT INTO anotadosestado VALUES("177","2019-10-26","12:10:09","2","103");
INSERT INTO anotadosestado VALUES("178","2019-10-24","17:08:52","3","94");
INSERT INTO anotadosestado VALUES("179","2019-10-29","11:02:48","5","91");
INSERT INTO anotadosestado VALUES("180","2019-10-29","20:59:28","1","106");
INSERT INTO anotadosestado VALUES("181","2019-10-29","21:03:35","2","106");
INSERT INTO anotadosestado VALUES("182","2019-10-30","12:15:14","1","107");
INSERT INTO anotadosestado VALUES("183","2019-10-31","10:36:12","1","106");
INSERT INTO anotadosestado VALUES("184","2019-10-31","10:42:02","1","105");
INSERT INTO anotadosestado VALUES("185","2019-10-31","10:47:14","1","108");
INSERT INTO anotadosestado VALUES("186","2019-10-31","10:49:44","1","109");
INSERT INTO anotadosestado VALUES("187","2019-11-01","10:57:06","2","98");
INSERT INTO anotadosestado VALUES("188","2019-11-01","10:57:16","2","99");
INSERT INTO anotadosestado VALUES("189","2019-11-01","10:57:41","2","109");
INSERT INTO anotadosestado VALUES("190","2019-11-01","20:40:35","5","101");
INSERT INTO anotadosestado VALUES("191","2019-11-01","20:40:35","5","107");
INSERT INTO anotadosestado VALUES("192","2019-11-05","16:46:20","5","108");
INSERT INTO anotadosestado VALUES("193","2019-11-05","18:47:04","1","109");
INSERT INTO anotadosestado VALUES("194","2019-11-05","18:52:27","1","110");
INSERT INTO anotadosestado VALUES("195","2019-11-05","18:56:13","2","110");
INSERT INTO anotadosestado VALUES("196","2019-11-05","18:56:28","1","111");
INSERT INTO anotadosestado VALUES("197","2019-11-05","18:59:35","1","99");
INSERT INTO anotadosestado VALUES("198","2019-11-05","19:02:58","1","110");
INSERT INTO anotadosestado VALUES("199","2019-11-06","12:30:42","1","112");
INSERT INTO anotadosestado VALUES("200","2019-11-06","12:42:39","2","110");
INSERT INTO anotadosestado VALUES("201","2019-11-06","12:51:40","1","110");
INSERT INTO anotadosestado VALUES("202","2019-11-07","11:19:06","2","110");
INSERT INTO anotadosestado VALUES("203","2019-11-07","11:21:25","2","106");
INSERT INTO anotadosestado VALUES("204","2019-11-07","11:21:29","2","99");
INSERT INTO anotadosestado VALUES("205","2019-11-07","11:21:34","2","105");
INSERT INTO anotadosestado VALUES("206","2019-11-07","11:48:22","1","113");
INSERT INTO anotadosestado VALUES("207","2019-11-07","12:10:55","2","113");
INSERT INTO anotadosestado VALUES("208","2019-11-07","12:11:49","1","114");
INSERT INTO anotadosestado VALUES("209","2019-11-07","17:28:54","1","115");
INSERT INTO anotadosestado VALUES("210","2019-11-07","17:29:28","1","116");
INSERT INTO anotadosestado VALUES("211","2019-11-07","17:30:07","1","117");
INSERT INTO anotadosestado VALUES("212","2019-11-07","17:30:46","1","118");
INSERT INTO anotadosestado VALUES("213","2019-11-07","17:31:26","1","119");
INSERT INTO anotadosestado VALUES("214","2019-11-07","17:31:53","1","105");
INSERT INTO anotadosestado VALUES("215","2019-11-05","17:02:14","4","105");
INSERT INTO anotadosestado VALUES("216","2019-11-08","15:11:38","4","111");
INSERT INTO anotadosestado VALUES("217","2019-11-08","17:11:51","4","112");
INSERT INTO anotadosestado VALUES("218","2019-11-07","18:07:01","1","120");
INSERT INTO anotadosestado VALUES("219","2019-11-07","18:46:41","2","120");
INSERT INTO anotadosestado VALUES("220","2019-11-07","18:47:01","2","117");
INSERT INTO anotadosestado VALUES("221","2019-11-07","18:47:04","2","118");
INSERT INTO anotadosestado VALUES("222","2019-11-07","19:08:39","2","119");
INSERT INTO anotadosestado VALUES("223","2019-11-07","19:13:09","1","121");
INSERT INTO anotadosestado VALUES("224","2019-11-07","19:17:27","2","121");
INSERT INTO anotadosestado VALUES("225","2019-11-07","19:59:05","1","122");
INSERT INTO anotadosestado VALUES("226","2019-11-07","20:06:55","1","123");
INSERT INTO anotadosestado VALUES("227","2019-11-07","20:08:44","2","123");
INSERT INTO anotadosestado VALUES("228","2019-11-07","20:10:17","1","123");
INSERT INTO anotadosestado VALUES("229","2019-11-07","20:12:29","2","123");
INSERT INTO anotadosestado VALUES("230","2019-11-07","20:47:28","1","123");
INSERT INTO anotadosestado VALUES("231","2019-11-07","20:48:31","1","124");
INSERT INTO anotadosestado VALUES("232","2019-11-12","15:34:39","4","122");
INSERT INTO anotadosestado VALUES("233","2019-11-09","17:41:19","1","125");
INSERT INTO anotadosestado VALUES("234","2019-11-09","17:43:59","2","125");
INSERT INTO anotadosestado VALUES("235","2019-11-09","17:46:11","1","125");
INSERT INTO anotadosestado VALUES("236","2019-11-09","17:47:52","2","125");
INSERT INTO anotadosestado VALUES("237","2019-11-09","17:49:54","1","125");
INSERT INTO anotadosestado VALUES("238","2019-11-09","17:51:43","2","125");
INSERT INTO anotadosestado VALUES("239","2019-11-09","17:52:44","1","125");
INSERT INTO anotadosestado VALUES("240","2019-11-09","17:55:32","2","125");
INSERT INTO anotadosestado VALUES("241","2019-11-09","17:56:18","1","125");
INSERT INTO anotadosestado VALUES("242","2019-11-09","17:58:19","2","125");
INSERT INTO anotadosestado VALUES("243","2019-11-09","17:59:34","1","125");
INSERT INTO anotadosestado VALUES("244","2019-11-09","18:00:46","2","125");
INSERT INTO anotadosestado VALUES("245","2019-11-09","18:03:10","1","125");
INSERT INTO anotadosestado VALUES("246","2019-11-09","18:04:59","2","125");
INSERT INTO anotadosestado VALUES("247","2019-11-09","18:08:22","1","125");
INSERT INTO anotadosestado VALUES("248","2019-11-09","18:09:27","2","125");
INSERT INTO anotadosestado VALUES("249","2019-11-09","18:09:49","1","125");
INSERT INTO anotadosestado VALUES("250","2019-11-09","18:11:39","2","125");
INSERT INTO anotadosestado VALUES("251","2019-11-09","18:12:43","1","125");
INSERT INTO anotadosestado VALUES("252","2019-11-12","15:32:12","4","125");
INSERT INTO anotadosestado VALUES("253","2019-11-14","11:50:05","1","126");
INSERT INTO anotadosestado VALUES("254","2019-11-14","12:59:24","1","127");
INSERT INTO anotadosestado VALUES("255","2019-11-14","19:09:56","1","128");
INSERT INTO anotadosestado VALUES("256","2019-11-22","10:03:34","5","127");
INSERT INTO anotadosestado VALUES("257","2019-11-22","10:03:34","5","126");
INSERT INTO anotadosestado VALUES("258","2019-11-22","10:03:35","5","128");
INSERT INTO anotadosestado VALUES("259","2019-11-29","10:34:46","5","123");
INSERT INTO anotadosestado VALUES("260","2019-11-29","10:34:46","5","124");
INSERT INTO anotadosestado VALUES("261","2019-11-29","10:35:34","1","129");
INSERT INTO anotadosestado VALUES("262","2019-11-29","10:35:43","1","130");
INSERT INTO anotadosestado VALUES("263","2019-11-29","10:35:52","1","131");
INSERT INTO anotadosestado VALUES("264","2019-11-29","10:36:01","1","132");
INSERT INTO anotadosestado VALUES("265","2019-11-29","17:33:47","5","132");
INSERT INTO anotadosestado VALUES("266","2019-11-29","17:33:48","5","130");
INSERT INTO anotadosestado VALUES("267","2019-12-04","11:02:41","5","131");
INSERT INTO anotadosestado VALUES("268","2019-12-11","23:41:53","5","129");
INSERT INTO anotadosestado VALUES("269","2019-12-13","16:52:32","1","133");
INSERT INTO anotadosestado VALUES("270","2019-12-13","17:00:45","2","133");
INSERT INTO anotadosestado VALUES("271","2019-12-13","17:00:55","1","133");
INSERT INTO anotadosestado VALUES("272","2019-12-13","17:07:40","2","133");
INSERT INTO anotadosestado VALUES("273","2019-12-13","17:12:52","1","134");
INSERT INTO anotadosestado VALUES("274","2019-12-13","17:13:24","1","135");
INSERT INTO anotadosestado VALUES("275","2019-12-13","18:13:26","1","136");
INSERT INTO anotadosestado VALUES("276","2019-12-13","18:14:37","5","136");
INSERT INTO anotadosestado VALUES("277","2019-12-13","18:15:24","1","137");
INSERT INTO anotadosestado VALUES("278","2019-12-13","18:15:53","2","137");
INSERT INTO anotadosestado VALUES("279","2020-05-27","15:58:42","5","134");
INSERT INTO anotadosestado VALUES("280","2020-05-27","15:58:42","5","135");
INSERT INTO anotadosestado VALUES("281","2020-05-30","01:24:26","1","138");
INSERT INTO anotadosestado VALUES("282","2020-05-30","01:28:36","2","138");
INSERT INTO anotadosestado VALUES("283","2020-05-30","01:38:50","1","138");
INSERT INTO anotadosestado VALUES("284","2020-06-01","14:44:07","4","138");
INSERT INTO anotadosestado VALUES("285","2020-05-30","16:13:21","1","139");
INSERT INTO anotadosestado VALUES("286","2020-06-02","16:14:34","4","139");
INSERT INTO anotadosestado VALUES("287","2020-06-01","14:00:35","1","140");
INSERT INTO anotadosestado VALUES("288","2020-06-01","14:04:18","1","141");
INSERT INTO anotadosestado VALUES("289","2020-06-04","15:50:29","1","142");
INSERT INTO anotadosestado VALUES("290","2020-06-04","15:51:04","1","143");
INSERT INTO anotadosestado VALUES("291","2020-06-04","15:54:25","1","144");
INSERT INTO anotadosestado VALUES("292","2020-06-04","15:54:41","1","145");
INSERT INTO anotadosestado VALUES("293","2020-06-04","15:54:55","1","146");
INSERT INTO anotadosestado VALUES("294","2020-06-04","15:55:09","1","147");
INSERT INTO anotadosestado VALUES("295","2020-06-04","15:55:22","1","148");
INSERT INTO anotadosestado VALUES("296","2020-06-04","15:55:35","1","149");



CREATE TABLE `asueto` (
  `id_asueto` int(20) NOT NULL AUTO_INCREMENT,
  `fechaAsueto` date NOT NULL,
  `horaDesdeAsueto` time NOT NULL,
  `horaHastaAsueto` time NOT NULL,
  `tipo` varchar(16) NOT NULL,
  PRIMARY KEY (`id_asueto`),
  UNIQUE KEY `id` (`id_asueto`)
) ENGINE=InnoDB AUTO_INCREMENT=1229 DEFAULT CHARSET=utf8;




CREATE TABLE `aula` (
  `cuerpoAula` varchar(20) NOT NULL,
  `nivelAula` int(11) NOT NULL,
  `numeroAula` varchar(20) NOT NULL,
  `id_aula` int(20) NOT NULL AUTO_INCREMENT,
  `eliminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_aula`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8;

INSERT INTO aula VALUES("1","0","2","1",NULL);
INSERT INTO aula VALUES("1","0","4","2",NULL);
INSERT INTO aula VALUES("1","1","1","113",NULL);
INSERT INTO aula VALUES("1","1","2","114",NULL);
INSERT INTO aula VALUES("1","1","11","115",NULL);
INSERT INTO aula VALUES("1","1","12","116",NULL);
INSERT INTO aula VALUES("1","1","3","117",NULL);
INSERT INTO aula VALUES("1","1","4","118",NULL);
INSERT INTO aula VALUES("1","1","5","119",NULL);
INSERT INTO aula VALUES("1","1","6","120",NULL);
INSERT INTO aula VALUES("1","1","8","121",NULL);
INSERT INTO aula VALUES("2","1","1","122",NULL);



CREATE TABLE `avisoprofesor` (
  `id_avisoprofesor` int(20) NOT NULL AUTO_INCREMENT,
  `fechaAvisoProfesor` date NOT NULL,
  `detalleDescripcion` varchar(500) NOT NULL,
  `fk_horadeconsulta` int(20) NOT NULL,
  `horaAvisoProfesor` time(5) NOT NULL,
  PRIMARY KEY (`id_avisoprofesor`),
  KEY `fk_horadeconsulta` (`fk_horadeconsulta`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;




CREATE TABLE `dedicacion` (
  `id_dedicacion` int(16) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) NOT NULL,
  `cantidadHora` int(11) NOT NULL,
  PRIMARY KEY (`id_dedicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO dedicacion VALUES("1","doble","2");
INSERT INTO dedicacion VALUES("2","simple","1");



CREATE TABLE `dedicacion_materia_profesor` (
  `id_dedicacion_materia_profesor` int(20) NOT NULL AUTO_INCREMENT,
  `fk_dedicacion` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_dedicacion_materia_profesor`) USING BTREE,
  KEY `fk_dedicacion` (`fk_dedicacion`),
  KEY `fk_materia` (`fk_materia`),
  KEY `fk_profesor` (`fk_profesor`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

INSERT INTO dedicacion_materia_profesor VALUES("58","2","8","20",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("59","2","8","19",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("60","2","9","12",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("61","2","4","13",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("62","2","10","14",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("63","2","12","16",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("64","2","13","17",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("65","2","11","15",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("66","2","8","18",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("67","2","18","22",NULL);



CREATE TABLE `departamento` (
  `id_departamento` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `fk_aula` int(20) NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_departamento`),
  KEY `id_departamento` (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO departamento VALUES("1","Sistemas","1",NULL);
INSERT INTO departamento VALUES("2","Básicas","115",NULL);
INSERT INTO departamento VALUES("4","Electrónica","1",NULL);
INSERT INTO departamento VALUES("6","Química","1",NULL);
INSERT INTO departamento VALUES("7","Electromecánica","1",NULL);



CREATE TABLE `detalleanotados` (
  `id_detalleanotados` int(20) NOT NULL AUTO_INCREMENT,
  `fechaDesdeAnotados` date NOT NULL,
  `horaDetalleAnotados` time(6) NOT NULL,
  `tema` mediumtext,
  `fk_alumno` int(20) NOT NULL,
  `fk_horadeconsulta` int(20) NOT NULL,
  PRIMARY KEY (`id_detalleanotados`),
  KEY `fk_alumno` (`fk_alumno`),
  KEY `fk_horadeconsulta` (`fk_horadeconsulta`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8;

INSERT INTO detalleanotados VALUES("140","2020-06-01","14:00:35.000000","","1","212");
INSERT INTO detalleanotados VALUES("141","2020-06-01","14:04:18.000000","Solver","17","213");
INSERT INTO detalleanotados VALUES("142","2020-06-04","15:50:29.000000","","1","215");
INSERT INTO detalleanotados VALUES("143","2020-06-04","15:51:04.000000","","2","215");
INSERT INTO detalleanotados VALUES("144","2020-06-04","15:54:25.000000","","17","215");
INSERT INTO detalleanotados VALUES("145","2020-06-04","15:54:41.000000","","18","215");
INSERT INTO detalleanotados VALUES("146","2020-06-04","15:54:55.000000","","19","215");
INSERT INTO detalleanotados VALUES("147","2020-06-04","15:55:09.000000","","20","215");
INSERT INTO detalleanotados VALUES("148","2020-06-04","15:55:22.000000","","21","215");
INSERT INTO detalleanotados VALUES("149","2020-06-04","15:55:35.000000","","22","215");



CREATE TABLE `dia` (
  `id_dia` int(20) NOT NULL AUTO_INCREMENT,
  `dia` varchar(50) NOT NULL,
  PRIMARY KEY (`id_dia`),
  KEY `id_dia` (`id_dia`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf32;

INSERT INTO dia VALUES("1","Lunes");
INSERT INTO dia VALUES("2","Martes");
INSERT INTO dia VALUES("3","Miércoles");
INSERT INTO dia VALUES("4","Jueves");
INSERT INTO dia VALUES("5","Viernes");
INSERT INTO dia VALUES("6","Sábado");



CREATE TABLE `estadoanotados` (
  `id_estadoanotados` int(20) NOT NULL AUTO_INCREMENT,
  `nombreEstado` varchar(15) NOT NULL,
  PRIMARY KEY (`id_estadoanotados`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO estadoanotados VALUES("1","Anotado");
INSERT INTO estadoanotados VALUES("2","Eliminado");
INSERT INTO estadoanotados VALUES("3","Ausente");
INSERT INTO estadoanotados VALUES("4","Presente");
INSERT INTO estadoanotados VALUES("5","Suspendido");
INSERT INTO estadoanotados VALUES("6","Reprogramado");



CREATE TABLE `falta` (
  `id_falta` int(20) NOT NULL AUTO_INCREMENT,
  `fechaFalta` date NOT NULL,
  `tipo` varchar(20) CHARACTER SET utf8 NOT NULL,
  `minutos` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `fk_horadeconsulta` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `fk_departamento` int(20) NOT NULL,
  PRIMARY KEY (`id_falta`),
  KEY `fk_horadeconsulta` (`fk_horadeconsulta`),
  KEY `fk_departamento` (`fk_departamento`),
  KEY `fk_materia` (`fk_materia`),
  KEY `fk_profesor` (`fk_profesor`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;




CREATE TABLE `fechamesa` (
  `id_fechaMesa` int(20) NOT NULL AUTO_INCREMENT,
  `fechaMesa` date NOT NULL,
  PRIMARY KEY (`id_fechaMesa`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;




CREATE TABLE `horadeconsulta` (
  `id_horadeconsulta` int(20) NOT NULL AUTO_INCREMENT,
  `fechaDesdeAnotados` date NOT NULL,
  `fechaHastaAnotados` date NOT NULL,
  `cantidadAnotados` int(50) NOT NULL,
  `estadoPresentismo` varchar(50) NOT NULL,
  `estadoVigencia` varchar(50) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `fk_horariodeconsulta` int(20) NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  PRIMARY KEY (`id_horadeconsulta`),
  KEY `fk_horariodeconsulta` (`fk_horariodeconsulta`),
  KEY `fk_materia` (`fk_materia`),
  KEY `fk_profesor` (`fk_profesor`)
) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=utf8;

INSERT INTO horadeconsulta VALUES("209","2020-06-01","2020-06-03","0","pendiente","activo","8","196","20");
INSERT INTO horadeconsulta VALUES("210","2020-06-01","2020-06-02","0","pendiente","activo","8","198","19");
INSERT INTO horadeconsulta VALUES("211","2020-06-01","2020-06-05","0","pendiente","activo","9","200","12");
INSERT INTO horadeconsulta VALUES("212","2020-06-01","2020-06-03","1","pendiente","activo","10","204","14");
INSERT INTO horadeconsulta VALUES("213","2020-06-01","2020-06-05","1","pendiente","activo","11","206","15");
INSERT INTO horadeconsulta VALUES("214","2020-06-01","2020-06-04","0","pendiente","activo","12","208","16");
INSERT INTO horadeconsulta VALUES("215","2020-06-04","2020-06-10","8","pendiente","activo","18","210","22");



CREATE TABLE `horariocursado` (
  `id_horariocursado` int(20) NOT NULL AUTO_INCREMENT,
  `HoraDesde` time NOT NULL,
  `HoraHasta` time NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `semestreAnual` varchar(50) NOT NULL,
  `fk_dia` int(20) NOT NULL,
  `fk_turno` int(20) DEFAULT NULL,
  `comision` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_horariocursado`),
  KEY `fk_dia` (`fk_dia`),
  KEY `fk_materia` (`fk_materia`),
  KEY `fk_profesor` (`fk_profesor`),
  KEY `fk_turno` (`fk_turno`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

INSERT INTO horariocursado VALUES("39","20:00:00","23:30:00","18","8","2","4",NULL,NULL);
INSERT INTO horariocursado VALUES("40","20:00:00","23:30:00","18","8","1","1",NULL,NULL);



CREATE TABLE `horariodeconsulta` (
  `id_horariodeconsulta` int(20) NOT NULL AUTO_INCREMENT,
  `hora` char(5) NOT NULL,
  `activoDesde` date NOT NULL,
  `activoHasta` date NOT NULL,
  `fk_dia` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `semestre` int(11) NOT NULL,
  `n` int(2) NOT NULL,
  `fk_aula` int(20) NOT NULL,
  PRIMARY KEY (`id_horariodeconsulta`),
  KEY `fk_dia` (`fk_dia`),
  KEY `fk_materia` (`fk_materia`),
  KEY `fk_profesor` (`fk_profesor`)
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8;

INSERT INTO horariodeconsulta VALUES("196","17:00","2020-06-01","0000-00-00","3","8","20","1","1","1");
INSERT INTO horariodeconsulta VALUES("197","17:00","2020-06-01","0000-00-00","3","8","20","2","1","1");
INSERT INTO horariodeconsulta VALUES("198","18:00","2020-06-01","0000-00-00","2","8","19","1","1","1");
INSERT INTO horariodeconsulta VALUES("199","18:00","2020-06-01","0000-00-00","2","8","19","2","1","1");
INSERT INTO horariodeconsulta VALUES("200","17:00","2020-06-01","0000-00-00","5","9","12","1","1","1");
INSERT INTO horariodeconsulta VALUES("201","17:00","2020-06-01","0000-00-00","5","9","12","2","1","1");
INSERT INTO horariodeconsulta VALUES("202","08:00","2020-06-01","0000-00-00","1","10","14","31","1","1");
INSERT INTO horariodeconsulta VALUES("203","08:00","2020-06-01","0000-00-00","1","10","14","32","1","1");
INSERT INTO horariodeconsulta VALUES("204","15:00","2020-06-01","0000-00-00","3","10","14","1","1","1");
INSERT INTO horariodeconsulta VALUES("205","15:00","2020-06-01","0000-00-00","3","10","14","2","1","1");
INSERT INTO horariodeconsulta VALUES("206","14:30","2020-06-01","0000-00-00","5","11","15","1","1","1");
INSERT INTO horariodeconsulta VALUES("207","14:30","2020-06-01","0000-00-00","5","11","15","2","1","1");
INSERT INTO horariodeconsulta VALUES("208","19:00","2020-06-01","0000-00-00","4","12","16","1","1","1");
INSERT INTO horariodeconsulta VALUES("209","19:00","2020-06-01","0000-00-00","4","12","16","2","1","1");
INSERT INTO horariodeconsulta VALUES("210","18:00","2020-06-04","0000-00-00","3","18","22","1","1","1");
INSERT INTO horariodeconsulta VALUES("211","18:00","2020-06-04","0000-00-00","3","18","22","2","1","1");



CREATE TABLE `materia` (
  `id_materia` int(20) NOT NULL AUTO_INCREMENT,
  `nombreMateria` varchar(50) NOT NULL,
  `fk_departamento` int(20) NOT NULL,
  `fk_dia` int(20) NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_materia`),
  KEY `id_materia` (`id_materia`),
  KEY `fk_dia` (`fk_dia`),
  KEY `fk_departamento` (`fk_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

INSERT INTO materia VALUES("1","Proyecto Final","1","1",NULL);
INSERT INTO materia VALUES("3","Análisis matemático","2","3",NULL);
INSERT INTO materia VALUES("4","Administración Gerencial","1","2",NULL);
INSERT INTO materia VALUES("7","quimica 1","6","3",NULL);
INSERT INTO materia VALUES("8","Diseño de Sistemas","1","4",NULL);
INSERT INTO materia VALUES("9","Modelado de procesos de negocios","1","3",NULL);
INSERT INTO materia VALUES("10","Teoría de control","1","3",NULL);
INSERT INTO materia VALUES("11","Investigación operativa","1","2",NULL);
INSERT INTO materia VALUES("12","Sistema de gestión","1","1",NULL);
INSERT INTO materia VALUES("13","Redes de información","1","1",NULL);
INSERT INTO materia VALUES("14","Análisis de sistemas","1","1",NULL);
INSERT INTO materia VALUES("15","Sistema de Representación","2","1",NULL);
INSERT INTO materia VALUES("16","Inteligencia Artificial","1","3",NULL);
INSERT INTO materia VALUES("17","Economía","1","3","1");
INSERT INTO materia VALUES("18","Administración de recursos","1","4",NULL);
INSERT INTO materia VALUES("19","Economía","2","1",NULL);
INSERT INTO materia VALUES("20","Base de Datos Avanzada","1","4","1");



CREATE TABLE `materias_alumno` (
  `fk_alumno` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  PRIMARY KEY (`fk_alumno`,`fk_materia`),
  KEY `fk_materia` (`fk_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO materias_alumno VALUES("1","1");
INSERT INTO materias_alumno VALUES("1","2");
INSERT INTO materias_alumno VALUES("1","3");
INSERT INTO materias_alumno VALUES("1","8");
INSERT INTO materias_alumno VALUES("1","12");
INSERT INTO materias_alumno VALUES("1","15");
INSERT INTO materias_alumno VALUES("2","1");
INSERT INTO materias_alumno VALUES("4","4");
INSERT INTO materias_alumno VALUES("17","1");
INSERT INTO materias_alumno VALUES("17","9");
INSERT INTO materias_alumno VALUES("17","13");
INSERT INTO materias_alumno VALUES("17","16");



CREATE TABLE `perfil` (
  `nombrePerfil` varchar(20) NOT NULL,
  `id_perfil` int(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO perfil VALUES("alumno","1");
INSERT INTO perfil VALUES("profesor","2");
INSERT INTO perfil VALUES("director","3");
INSERT INTO perfil VALUES("root","4");
INSERT INTO perfil VALUES("personal","5");
INSERT INTO perfil VALUES("administrador","6");



CREATE TABLE `persona` (
  `id_persona` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(11) NOT NULL,
  `apellido` varchar(11) NOT NULL,
  `dni` varchar(11) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO persona VALUES("1","Ulises","Fernandez","35546991","",NULL);
INSERT INTO persona VALUES("2","Root","Root","root","consultasutnfrm2019@gmail.com",NULL);



CREATE TABLE `presentismo` (
  `id_presentismo` int(20) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `horaDesde` time NOT NULL,
  `horaHasta` time NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `fk_horadeconsulta` int(20) NOT NULL,
  PRIMARY KEY (`id_presentismo`),
  KEY `fk_profesor` (`fk_profesor`),
  KEY `fk_horadeconsulta` (`fk_horadeconsulta`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;




CREATE TABLE `privilegio` (
  `nombrePrivilegio` varchar(35) NOT NULL,
  `numeroPermiso` int(11) NOT NULL,
  `id_privilegio` int(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_privilegio`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

INSERT INTO privilegio VALUES("Receso","1","1");
INSERT INTO privilegio VALUES("Feriado","2","2");
INSERT INTO privilegio VALUES("Asueto","3","3");
INSERT INTO privilegio VALUES("Mesas","4","4");
INSERT INTO privilegio VALUES("Aulas","5","5");
INSERT INTO privilegio VALUES("Departamento","6","6");
INSERT INTO privilegio VALUES("Materias","7","7");
INSERT INTO privilegio VALUES("Profesores","8","8");
INSERT INTO privilegio VALUES("Asignar Materia a Profesor","9","9");
INSERT INTO privilegio VALUES("Asignar Horario de Cursado","10","10");
INSERT INTO privilegio VALUES("Cambiar Aula de Consulta","11","11");
INSERT INTO privilegio VALUES("Alumno","12","12");
INSERT INTO privilegio VALUES("Cargo Direcotr","13","13");
INSERT INTO privilegio VALUES("Personal","14","14");
INSERT INTO privilegio VALUES("Cerrar Horas de consulta Ausentes","15","15");
INSERT INTO privilegio VALUES("Calcular Asistencia","16","16");
INSERT INTO privilegio VALUES("Backup","17","17");
INSERT INTO privilegio VALUES("Administrador","18","18");



CREATE TABLE `privilegioperfil` (
  `fk_perfil` int(20) NOT NULL,
  `fk_privilegio` int(20) NOT NULL,
  PRIMARY KEY (`fk_perfil`,`fk_privilegio`),
  KEY `fk_privilegio` (`fk_privilegio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO privilegioperfil VALUES("4","1");
INSERT INTO privilegioperfil VALUES("4","2");
INSERT INTO privilegioperfil VALUES("4","3");
INSERT INTO privilegioperfil VALUES("4","4");
INSERT INTO privilegioperfil VALUES("4","5");
INSERT INTO privilegioperfil VALUES("4","6");
INSERT INTO privilegioperfil VALUES("4","7");
INSERT INTO privilegioperfil VALUES("4","8");
INSERT INTO privilegioperfil VALUES("4","9");
INSERT INTO privilegioperfil VALUES("4","10");
INSERT INTO privilegioperfil VALUES("4","11");
INSERT INTO privilegioperfil VALUES("4","12");
INSERT INTO privilegioperfil VALUES("4","13");
INSERT INTO privilegioperfil VALUES("4","14");
INSERT INTO privilegioperfil VALUES("4","15");
INSERT INTO privilegioperfil VALUES("4","16");
INSERT INTO privilegioperfil VALUES("4","17");
INSERT INTO privilegioperfil VALUES("4","18");
INSERT INTO privilegioperfil VALUES("6","1");
INSERT INTO privilegioperfil VALUES("6","4");
INSERT INTO privilegioperfil VALUES("6","7");



CREATE TABLE `profesor` (
  `id_profesor` int(20) NOT NULL AUTO_INCREMENT,
  `legajo` varchar(20) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fk_dedicacion_materia_profesor` int(20) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_profesor`),
  KEY `fk_dedicacion_materia_profesor` (`fk_dedicacion_materia_profesor`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

INSERT INTO profesor VALUES("12","85321","Rotella","Carina","crotella@gmial.com",NULL,NULL);
INSERT INTO profesor VALUES("13","85156","Carbonari","Daniela","dcarbonari@gmail.com",NULL,NULL);
INSERT INTO profesor VALUES("14","0548","Castellanos","Cecilia","albanapereyra@gmail.com",NULL,NULL);
INSERT INTO profesor VALUES("15","12558","Roberti","Bruno","broberti@gmail.com",NULL,NULL);
INSERT INTO profesor VALUES("16","58974","Tagarelli","Sandra","albanapereyra@gmail.com",NULL,NULL);
INSERT INTO profesor VALUES("17","58963","Tonelli","Raúl","rtonelli@gmail.com",NULL,NULL);
INSERT INTO profesor VALUES("18","89335","Ghilardi","Cristian","cghilardi@gmail.com",NULL,NULL);
INSERT INTO profesor VALUES("19","58315","Poblete","Claudia","cpoblete@gmail.com",NULL,NULL);
INSERT INTO profesor VALUES("20","89532","Ruiz","Adriana","aruiz@gmail.com",NULL,NULL);
INSERT INTO profesor VALUES("21","0648","Vazquez","Alejandro","avazquez@gmail.com",NULL,NULL);
INSERT INTO profesor VALUES("22","8565","Cuenca","Julio","jcuenca@gmail.com",NULL,NULL);
INSERT INTO profesor VALUES("24","8621","Grossi","Eduardo","egrossi@gmail.com",NULL,NULL);
INSERT INTO profesor VALUES("25","8564","Correa","Claudia","ccorrea@gmail.com",NULL,NULL);
INSERT INTO profesor VALUES("26","58964","Moralejo","Raúl","rmoralejo@gmail.com",NULL,NULL);
INSERT INTO profesor VALUES("27","111","testeado","test","vandenboschlucas@gmail.com",NULL,NULL);



CREATE TABLE `turno` (
  `id_turno` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `HoraDesdeTurno` time NOT NULL,
  `HoraHastaTurno` time NOT NULL,
  PRIMARY KEY (`id_turno`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO turno VALUES("1","Mañana","08:00:00","00:00:00");



CREATE TABLE `usuario` (
  `id_usuario` int(20) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(70) NOT NULL,
  `fk_alumno` int(20) DEFAULT NULL,
  `fk_profesor` int(20) DEFAULT NULL,
  `fk_perfil` int(20) NOT NULL,
  `fk_persona` int(20) DEFAULT NULL,
  `keygen` varchar(25) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_profesor` (`fk_profesor`),
  KEY `fk_perfil` (`fk_perfil`),
  KEY `fk_alumno` (`fk_alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO usuario VALUES("6","35821","$2y$10$LTAsfQoxzhQXQOu88XBAoerUDbW7O68wNPrHz3x8gIc0Ddnyt61s6","1",NULL,"1",NULL,"");
INSERT INTO usuario VALUES("7","porte","$2y$10$LHdyKE6JxmTVqA6T.mdYPOblig4zCJw.BeUbalTk21wSG/h89uaJW","2",NULL,"1",NULL,"");
INSERT INTO usuario VALUES("8","test","$2y$10$jEshAdowgM5ekVRLD/b9YenbPegwO3aFY0vkwHU6KQ51rgBYg33ZK","4",NULL,"1",NULL,"");
INSERT INTO usuario VALUES("10","root","$2y$10$PNwqEM24Ie1UMpkA999Z8eTrPa3.WRJ6UrU7U6sWDjCYEoP.qQs8K",NULL,NULL,"4","2","");
INSERT INTO usuario VALUES("11","4625","$2y$10$BrXc50ww8zVVbEtCOezPzO.NCdcf7qVu08.WDz2byPVIOouhfOiAC",NULL,"10","2",NULL,"");
INSERT INTO usuario VALUES("12","34891","$2y$10$SpBjeTMIwch/W33G.XX3huJ4FrbCotzUWVLPpqVLwKCwY1UrrE39C","17",NULL,"1",NULL,"8a1d35e5a3e0f655605ce6408");
INSERT INTO usuario VALUES("13","85321","$2y$10$sUBOg8JC6meaxpZw21bR3OEOKZX4Ob8odqtrPBg0RfwEKqW/vQlOa",NULL,"12","2",NULL,"");
INSERT INTO usuario VALUES("14","85156","$2y$10$aDtc5akQrB1oIIoUaZxNfejKnw9TaCgQcPnMKIJpK8zq9bC/05Pki",NULL,"13","2",NULL,"");
INSERT INTO usuario VALUES("15","0548","$2y$10$YKZKDzbSYrfRTTQFfr7Eee.1sAowRKS5Jktr44D8HlOrCUut1uAaa",NULL,"14","3",NULL,"ca222acacdb2c8db21ffb5849");
INSERT INTO usuario VALUES("16","12558","$2y$10$c1uzqPUzo6ZREBLAB4tqeetYcZhjSv9pl/b/7EeuOmZ6BNfST.b.W",NULL,"15","2",NULL,"");
INSERT INTO usuario VALUES("17","58974","$2y$10$jpiXF3rYjQu6aCwdDFeBJOffYWIT0TWQetts3Sb8XhBWfXStVD0Va",NULL,"16","2",NULL,"e28e1a24e1ef0b3a209bcd00e");
INSERT INTO usuario VALUES("18","58963","$2y$10$.E/HW4nmLXMliK1WGyd8pecD.lA.HucMBRpHf5UCOuZL957SmIIpa",NULL,"17","2",NULL,"");
INSERT INTO usuario VALUES("19","89335","$2y$10$skkfywPP2LeEwv1iCPVZnOPVbN4a0L1XAwuAwHfHV3A96QZlEfqcK",NULL,"18","2",NULL,"");
INSERT INTO usuario VALUES("20","58315","$2y$10$q.k4z3y1rs77B7KVtZ06..twHWZb86jAzRdseE1hUdOZzSF2EHkum",NULL,"19","2",NULL,"");
INSERT INTO usuario VALUES("23","89532","$2y$10$9ciFrD4vAIEqYcfaSELn1uvhJQN11xEf254BA84TpJgos/cD6GSwG",NULL,"20","2",NULL,"");
INSERT INTO usuario VALUES("24","35546991","$2y$10$izXrwXDpvuZR6Zh0yT4CHuFOWqqVpyllPsVxdDPLuqvVBn5jFeOF.",NULL,NULL,"5","1","");
INSERT INTO usuario VALUES("25","0648","$2y$10$sit16d.hhW19gTBvyvvq8.vI8bSc/ChYYV7Am1UG6DpnR7WN.gt6q",NULL,"21","2",NULL,"");
INSERT INTO usuario VALUES("26","8565","$2y$10$UhhoAeydbph0TZacv4Tkpe0q/tSd320KgCOiCEH6eQzB7pQIPDExe",NULL,"22","2",NULL,"");
INSERT INTO usuario VALUES("28","8621","$2y$10$ltSJixmRTCqomdyIgASeWOVVlLY5CXOHqAZ87dSJIws5bolFS0VkW",NULL,"24","2",NULL,"");
INSERT INTO usuario VALUES("29","8564","$2y$10$bqsJsSVKJZq0zHG17j8L7OuKdiu7RwsOYSEPTJQW0BdsYnb6T64gW",NULL,"25","2",NULL,"");
INSERT INTO usuario VALUES("30","58964","$2y$10$lES23XBh.8GybQsSC1wIzO9S.12dVxtva0HpO6rPpcPGMCuzTykDm",NULL,"26","2",NULL,"");
INSERT INTO usuario VALUES("31","111","$2y$10$CS.8GyF75KZhLUC8GzMkNOgfQiuTaQ0do3Pvin5.ZI8If1Z.IQLMW",NULL,"27","3",NULL,"");
INSERT INTO usuario VALUES("32","001","$2y$10$inSwpDWaoLTIJD4Dyye7R.xadherOs6ZUUfyLGmReRoG2iYNWUUVq","18",NULL,"1",NULL,"");
INSERT INTO usuario VALUES("33","002","$2y$10$5GQLx55vbcOCdxWTuaNfk.jZgsmNq2by70Dtc6OCGtlzCwcDTwTZW","19",NULL,"1",NULL,"");
INSERT INTO usuario VALUES("34","003","$2y$10$NCHn8xHP.5p1lW566VBfxOtkaPurHGGUQtJFq7dtHVW0Dsp7wlgOG","20",NULL,"1",NULL,"");
INSERT INTO usuario VALUES("35","004","$2y$10$h/1Ni9YTPxDT9uNB0BqjhuN8yFn8d4EtnWaT9dsGQzU2oj/ao2pJq","21",NULL,"1",NULL,"");
INSERT INTO usuario VALUES("36","005","$2y$10$3fTfcdwO15w0bHX2UrYpgO3OJdywpdD4EF5VBbWotufwOSB4Hfbk6","22",NULL,"1",NULL,"");

