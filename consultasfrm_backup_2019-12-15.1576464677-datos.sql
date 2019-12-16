

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

INSERT INTO alumno VALUES("1","35821","van den bosch","lucas","vandenboschlucas@hotmail.com","1992-05-18","2616394922",NULL);
INSERT INTO alumno VALUES("2","32145","Porte","Gaston","gporte@gmail.com","2019-09-09","2618586488",NULL);
INSERT INTO alumno VALUES("17","34891","Pereyra","Albana","albanapereyra@gmail.com","0000-00-00","",NULL);



CREATE TABLE `anotadosestado` (
  `id_anotadoestado` int(20) NOT NULL AUTO_INCREMENT,
  `fechaAnotadosEstado` date NOT NULL,
  `horaAnotadosEstado` time NOT NULL,
  `fk_estadoanotados` int(11) NOT NULL,
  `fk_detalleanotados` int(20) NOT NULL,
  PRIMARY KEY (`id_anotadoestado`),
  KEY `fk_detalleanotados` (`fk_detalleanotados`),
  KEY `fk_estadoanotados` (`fk_estadoanotados`)
) ENGINE=InnoDB AUTO_INCREMENT=279 DEFAULT CHARSET=utf8;

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



CREATE TABLE `asueto` (
  `id_asueto` int(20) NOT NULL AUTO_INCREMENT,
  `fechaAsueto` date NOT NULL,
  `horaDesdeAsueto` time NOT NULL,
  `horaHastaAsueto` time NOT NULL,
  `tipo` varchar(16) NOT NULL,
  PRIMARY KEY (`id_asueto`),
  UNIQUE KEY `id` (`id_asueto`)
) ENGINE=InnoDB AUTO_INCREMENT=1229 DEFAULT CHARSET=utf8;

INSERT INTO asueto VALUES("971","2019-12-30","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("972","2019-12-31","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("974","2020-01-02","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("975","2020-01-03","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("976","2020-01-04","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("977","2020-01-05","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("978","2020-01-06","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("979","2020-01-07","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("980","2020-01-08","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("981","2020-01-09","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("982","2020-01-10","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("983","2020-01-11","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("985","2020-01-13","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("986","2020-01-14","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("987","2020-01-15","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("988","2020-01-16","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("989","2020-01-17","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("990","2020-01-18","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("991","2020-01-19","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("992","2020-01-20","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("993","2020-01-21","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("994","2020-01-22","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("995","2020-01-23","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("996","2020-01-24","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("997","2020-01-25","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("998","2020-01-26","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("999","2020-01-27","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1000","2020-01-28","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1001","2020-01-29","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1002","2020-01-30","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1003","2020-01-31","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1004","2020-02-01","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1005","2020-02-02","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1006","2020-02-03","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1007","2020-02-04","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1009","2020-02-06","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1010","2020-02-07","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1011","2020-02-08","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1012","2020-02-09","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1013","2020-02-10","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1014","2020-02-11","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1015","2020-02-12","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1020","2020-02-17","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1021","2020-02-18","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1022","2020-02-19","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1023","2020-02-20","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1024","2020-02-21","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1025","2020-02-22","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1026","2020-02-23","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1027","2020-02-24","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1028","2020-02-25","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1029","2020-02-26","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1030","2020-02-27","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1031","2020-02-28","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1032","2020-02-29","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1033","2020-03-01","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1065","2020-03-01","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1070","2020-03-01","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1071","2019-10-12","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1072","2019-10-22","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1073","2019-11-18","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1074","2019-12-25","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1075","2019-12-20","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1076","2019-12-21","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1077","2019-12-22","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1078","2019-12-23","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1080","2019-12-26","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1081","2019-12-27","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1082","2019-12-28","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1083","2019-12-29","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1084","2020-02-02","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1091","2019-06-07","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1092","2019-06-08","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1093","2019-06-09","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1094","2019-06-10","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1095","2019-06-11","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1096","2019-06-12","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1097","2019-06-13","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1098","2019-06-14","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1099","2019-06-15","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1100","2019-06-16","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1101","2019-06-17","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1102","2019-06-18","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1103","2019-06-19","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1104","2019-06-20","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1105","2019-06-21","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1106","2019-06-22","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1107","2019-06-23","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1108","2019-06-24","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1109","2019-06-25","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1110","2019-06-26","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1111","2019-06-27","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1112","2019-06-28","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1113","2019-06-29","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1114","2019-06-30","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1115","2019-07-01","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1117","2019-06-06","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1118","2019-01-01","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1119","2019-01-02","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1120","2019-01-03","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1121","2019-01-04","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1122","2019-01-05","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1123","2019-01-06","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1124","2019-01-12","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1125","2019-01-11","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1126","2019-01-10","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1127","2019-01-08","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1128","2019-01-07","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1129","2019-01-14","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1130","2019-01-15","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1131","2019-01-16","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1132","2019-01-09","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1133","2019-01-17","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1134","2019-01-18","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1135","2019-01-19","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1136","2019-01-20","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1137","2019-01-13","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1138","2019-01-27","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1139","2019-01-25","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1140","2019-01-24","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1141","2019-01-23","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1142","2019-01-22","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1143","2019-01-21","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1144","2019-01-29","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1145","2019-01-30","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1146","2019-01-31","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1147","2019-01-26","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1148","2019-01-28","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1149","2025-02-16","08:00:00","23:30:00","");
INSERT INTO asueto VALUES("1150","2019-01-01","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1151","2019-01-02","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1153","2019-01-04","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1154","2019-01-05","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1156","2019-01-07","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1157","2019-01-08","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1158","2019-01-09","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1159","2019-01-10","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1160","2019-01-11","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1161","2019-01-12","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1162","2019-01-13","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1163","2019-01-14","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1164","2019-01-15","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1165","2019-01-16","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1166","2019-01-17","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1167","2019-01-18","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1168","2019-01-19","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1169","2019-01-20","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1170","2019-01-21","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1171","2019-01-22","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1172","2019-01-23","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1173","2019-01-24","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1174","2019-01-25","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1175","2019-01-26","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1176","2019-01-27","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1177","2019-01-28","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1178","2019-01-29","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1179","2019-01-30","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1180","2019-01-31","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1184","2018-01-01","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1185","2018-01-02","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1186","2018-01-03","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1187","2018-01-04","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1188","2018-01-05","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1189","2018-01-06","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1190","2018-01-07","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1191","2018-01-08","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1192","2018-01-09","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1193","2018-01-10","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1194","2018-01-11","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1195","2018-01-12","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1196","2018-01-13","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1198","2018-01-15","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1199","2018-01-16","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1200","2018-01-17","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1201","2018-01-18","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1202","2018-01-19","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1203","2018-01-20","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1204","2018-01-21","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1205","2018-01-22","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1206","2018-01-23","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1207","2018-01-24","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1208","2018-01-25","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1209","2018-01-26","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1210","2018-01-27","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1211","2018-01-28","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1212","2018-01-29","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1213","2018-01-30","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1214","2018-01-31","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1215","2018-02-01","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1216","2018-02-02","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1217","2018-02-03","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1218","2018-02-04","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1223","2019-12-08","08:00:00","23:30:00","feriado");
INSERT INTO asueto VALUES("1224","2019-01-06","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1225","2018-01-14","08:00:00","23:30:00","receso");
INSERT INTO asueto VALUES("1227","2019-01-03","08:00:00","23:30:00","receso");



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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

INSERT INTO avisoprofesor VALUES("41","2019-11-14","Llego en 10 minutos.","87","13:42:00.00000");
INSERT INTO avisoprofesor VALUES("42","2019-11-14","Llego en 10 minutos.","100","13:45:19.00000");
INSERT INTO avisoprofesor VALUES("43","2019-11-14","llego mas tarde","105","19:08:18.00000");



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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

INSERT INTO dedicacion_materia_profesor VALUES("1","1","1","2","1");
INSERT INTO dedicacion_materia_profesor VALUES("2","2","4","2",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("3","2","2","3",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("4","2","2","3",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("5","1","3","5","1");
INSERT INTO dedicacion_materia_profesor VALUES("6","1","7","6",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("7","1","7","6",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("8","1","7","6",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("9","1","7","6",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("18","1","7","10",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("19","2","9","12",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("20","2","4","13","1");
INSERT INTO dedicacion_materia_profesor VALUES("22","2","11","15",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("24","2","13","17",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("25","2","8","18",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("26","2","8","19",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("27","1","8","11",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("28","2","8","20","1");
INSERT INTO dedicacion_materia_profesor VALUES("32","2","4","21",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("33","1","1","13","1");
INSERT INTO dedicacion_materia_profesor VALUES("34","1","1","21",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("36","2","12","16",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("38","2","18","22",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("41","2","18","15",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("42","2","19","24",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("44","2","14","16",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("45","2","10","14",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("46","2","18","25",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("47","2","1","4","1");
INSERT INTO dedicacion_materia_profesor VALUES("48","1","1","4","1");
INSERT INTO dedicacion_materia_profesor VALUES("49","2","20","3",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("50","2","4","13",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("51","2","1","4",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("52","2","1","5",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("53","2","1","26",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("54","1","3","13",NULL);
INSERT INTO dedicacion_materia_profesor VALUES("55","2","8","20",NULL);



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
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;

INSERT INTO detalleanotados VALUES("90","2019-10-12","19:52:30.000000","1","2","31");
INSERT INTO detalleanotados VALUES("91","2019-10-12","19:53:03.000000","","1","31");
INSERT INTO detalleanotados VALUES("92","2019-10-20","04:14:21.000000","","1","54");
INSERT INTO detalleanotados VALUES("93","2019-10-24","12:42:16.000000","","17","58");
INSERT INTO detalleanotados VALUES("94","2019-10-24","12:42:32.000000","","17","59");
INSERT INTO detalleanotados VALUES("95","2019-10-24","12:42:56.000000","","17","66");
INSERT INTO detalleanotados VALUES("96","2019-10-24","12:43:30.000000","","17","64");
INSERT INTO detalleanotados VALUES("97","2019-10-24","12:43:43.000000","","17","60");
INSERT INTO detalleanotados VALUES("98","2019-10-24","12:43:54.000000","","17","56");
INSERT INTO detalleanotados VALUES("99","2019-10-24","12:44:08.000000","diagrama de clases","17","55");
INSERT INTO detalleanotados VALUES("100","2019-10-24","12:44:28.000000","","17","68");
INSERT INTO detalleanotados VALUES("101","2019-10-24","12:44:39.000000","","17","62");
INSERT INTO detalleanotados VALUES("102","2019-10-24","12:47:56.000000","","17","69");
INSERT INTO detalleanotados VALUES("103","2019-10-24","12:48:22.000000","","17","31");
INSERT INTO detalleanotados VALUES("104","2019-10-24","12:48:31.000000","","17","54");
INSERT INTO detalleanotados VALUES("105","2019-10-29","15:04:44.000000","clases, navegabilidad","17","74");
INSERT INTO detalleanotados VALUES("106","2019-10-29","20:59:28.000000","diagrama de secuencia","17","75");
INSERT INTO detalleanotados VALUES("107","2019-10-30","12:15:14.000000","nyquits","17","77");
INSERT INTO detalleanotados VALUES("108","2019-10-31","10:47:14.000000","","17","70");
INSERT INTO detalleanotados VALUES("109","2019-10-31","10:49:44.000000","","17","76");
INSERT INTO detalleanotados VALUES("110","2019-11-05","18:52:27.000000","formas canónicas","17","81");
INSERT INTO detalleanotados VALUES("111","2019-11-05","18:56:28.000000","","17","80");
INSERT INTO detalleanotados VALUES("112","2019-11-06","12:30:42.000000","procesos","17","79");
INSERT INTO detalleanotados VALUES("113","2019-11-07","11:48:22.000000","TP nº 2","1","83");
INSERT INTO detalleanotados VALUES("114","2019-11-07","12:11:49.000000","tp nº 3","1","76");
INSERT INTO detalleanotados VALUES("115","2019-11-07","17:28:54.000000","redes LAN","1","90");
INSERT INTO detalleanotados VALUES("116","2019-11-07","17:29:28.000000","trabajo nº 2","1","91");
INSERT INTO detalleanotados VALUES("117","2019-11-07","17:30:07.000000","armado de redes","17","90");
INSERT INTO detalleanotados VALUES("118","2019-11-07","17:30:46.000000","comunicación no verbal ","17","91");
INSERT INTO detalleanotados VALUES("119","2019-11-07","17:31:26.000000","revisar tpi nº1","17","86");
INSERT INTO detalleanotados VALUES("120","2019-11-07","18:07:01.000000","macroeconomía","17","95");
INSERT INTO detalleanotados VALUES("121","2019-11-07","19:13:09.000000","minería de datos.","17","89");
INSERT INTO detalleanotados VALUES("122","2019-11-07","19:59:05.000000","redes LAN","17","96");
INSERT INTO detalleanotados VALUES("123","2019-11-07","20:06:55.000000","minería de datos","17","100");
INSERT INTO detalleanotados VALUES("124","2019-11-07","20:48:31.000000","problemas con pentaho.","1","100");
INSERT INTO detalleanotados VALUES("125","2019-11-09","17:41:19.000000","tp nº 2.","17","107");
INSERT INTO detalleanotados VALUES("126","2019-11-14","11:50:05.000000","","17","94");
INSERT INTO detalleanotados VALUES("127","2019-11-14","12:59:24.000000","Mostrar correcciones del TP integrador nº2","17","87");
INSERT INTO detalleanotados VALUES("128","2019-11-14","19:09:56.000000","nyquits","17","105");
INSERT INTO detalleanotados VALUES("129","2019-11-29","10:35:34.000000","","17","130");
INSERT INTO detalleanotados VALUES("130","2019-11-29","10:35:43.000000","","17","122");
INSERT INTO detalleanotados VALUES("131","2019-11-29","10:35:52.000000","","17","132");
INSERT INTO detalleanotados VALUES("132","2019-11-29","10:36:01.000000","","17","115");
INSERT INTO detalleanotados VALUES("133","2019-12-13","16:52:32.000000","Solver","17","149");
INSERT INTO detalleanotados VALUES("134","2019-12-13","17:12:52.000000","minería de datos","17","155");
INSERT INTO detalleanotados VALUES("135","2019-12-13","17:13:24.000000","indicadores","1","155");
INSERT INTO detalleanotados VALUES("136","2019-12-13","18:13:26.000000","","17","147");
INSERT INTO detalleanotados VALUES("137","2019-12-13","18:15:24.000000","","17","158");



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
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

INSERT INTO falta VALUES("1","2019-10-28","Falta",NULL,"57","4","13","1");
INSERT INTO falta VALUES("2","2019-10-28","Tardanza","00:07","58","4","13","1");
INSERT INTO falta VALUES("3","2019-10-23","Tardanza","00:02","59","10","14","1");
INSERT INTO falta VALUES("4","2019-10-28","Tardanza","00:16","60","11","15","1");
INSERT INTO falta VALUES("5","2019-10-23","Falta",NULL,"61","12","16","1");
INSERT INTO falta VALUES("6","2019-10-23","Falta",NULL,"63","8","18","1");
INSERT INTO falta VALUES("7","2019-10-29","Tardanza","00:06","64","8","19","1");
INSERT INTO falta VALUES("8","2019-10-29","Falta",NULL,"65","8","18","1");
INSERT INTO falta VALUES("9","2019-10-30","Tardanza","00:20","66","8","18","1");
INSERT INTO falta VALUES("10","2019-10-30","Falta",NULL,"67","12","16","1");
INSERT INTO falta VALUES("11","2019-10-29","Tardanza","00:11","68","12","16","1");
INSERT INTO falta VALUES("12","2019-10-31","Tardanza","00:34","69","14","16","1");
INSERT INTO falta VALUES("13","2019-10-25","Falta",NULL,"56","9","12","1");
INSERT INTO falta VALUES("14","2019-10-25","Falta",NULL,"62","13","17","1");
INSERT INTO falta VALUES("15","2019-10-31","Falta",NULL,"77","10","14","1");
INSERT INTO falta VALUES("16","2019-11-05","Falta",NULL,"73","12","16","1");
INSERT INTO falta VALUES("17","2019-11-05","Falta",NULL,"78","1","13","1");
INSERT INTO falta VALUES("18","2019-11-04","Falta",NULL,"70","4","13","1");
INSERT INTO falta VALUES("19","2019-11-05","Tardanza","00:09","74","8","19","1");
INSERT INTO falta VALUES("20","2019-11-08","Tardanza","00:17","79","9","12","1");
INSERT INTO falta VALUES("21","2019-11-08","Tardanza","00:06","80","13","17","1");
INSERT INTO falta VALUES("22","2019-11-12","Falta",NULL,"90","18","22","1");
INSERT INTO falta VALUES("23","2019-11-12","Falta",NULL,"84","4","13","1");
INSERT INTO falta VALUES("24","2019-11-13","Falta",NULL,"85","4","21","1");
INSERT INTO falta VALUES("25","2019-11-13","Falta",NULL,"89","12","16","1");
INSERT INTO falta VALUES("26","2019-11-12","Falta",NULL,"92","18","15","1");
INSERT INTO falta VALUES("27","2019-11-12","Tardanza","00:54","96","18","22","1");
INSERT INTO falta VALUES("28","2019-11-12","Falta",NULL,"99","12","16","1");
INSERT INTO falta VALUES("29","2019-11-11","Falta",NULL,"102","18","15","1");
INSERT INTO falta VALUES("30","2019-11-11","Falta",NULL,"104","10","14","1");
INSERT INTO falta VALUES("31","2019-11-12","Tardanza","00:59","107","18","22","1");
INSERT INTO falta VALUES("32","2019-11-11","Falta",NULL,"108","18","25","1");
INSERT INTO falta VALUES("33","2019-11-04","Falta",NULL,"71","11","15","1");
INSERT INTO falta VALUES("34","2019-11-06","Falta",NULL,"75","8","18","1");
INSERT INTO falta VALUES("35","2019-11-13","Falta",NULL,"86","1","21","1");
INSERT INTO falta VALUES("36","2019-11-14","Falta",NULL,"87","1","21","1");
INSERT INTO falta VALUES("37","2019-11-15","Falta",NULL,"93","13","17","1");
INSERT INTO falta VALUES("38","2019-11-15","Falta",NULL,"94","9","12","1");
INSERT INTO falta VALUES("39","2019-11-08","Falta",NULL,"95","19","24","2");
INSERT INTO falta VALUES("40","2019-11-08","Falta",NULL,"97","4","13","1");
INSERT INTO falta VALUES("41","2019-11-13","Falta",NULL,"103","18","15","1");
INSERT INTO falta VALUES("42","2019-11-14","Falta",NULL,"105","10","14","1");
INSERT INTO falta VALUES("43","2019-11-13","Falta",NULL,"106","4","21","1");
INSERT INTO falta VALUES("44","2019-11-15","Falta",NULL,"109","18","25","1");
INSERT INTO falta VALUES("45","2019-11-19","Falta",NULL,"110","18","22","1");
INSERT INTO falta VALUES("46","2019-11-25","Falta",NULL,"111","11","15","1");
INSERT INTO falta VALUES("47","2019-11-14","Falta",NULL,"100","12","16","1");
INSERT INTO falta VALUES("48","2019-11-27","Falta",NULL,"112","8","18","1");
INSERT INTO falta VALUES("49","2019-11-27","Falta",NULL,"113","1","21","1");
INSERT INTO falta VALUES("50","2019-11-28","Falta",NULL,"114","1","21","1");
INSERT INTO falta VALUES("51","2019-11-27","Falta",NULL,"119","18","15","1");
INSERT INTO falta VALUES("52","2019-11-28","Falta",NULL,"120","10","14","1");
INSERT INTO falta VALUES("53","2019-11-27","Falta",NULL,"121","4","21","1");
INSERT INTO falta VALUES("54","2019-11-26","Falta",NULL,"123","18","22","1");
INSERT INTO falta VALUES("55","2019-11-29","Falta",NULL,"115","13","17","1");
INSERT INTO falta VALUES("56","2019-11-29","Falta",NULL,"117","19","24","2");
INSERT INTO falta VALUES("57","2019-11-29","Falta",NULL,"118","4","13","1");
INSERT INTO falta VALUES("58","2019-11-29","Falta",NULL,"122","18","25","1");
INSERT INTO falta VALUES("59","2019-11-29","Falta",NULL,"116","9","12","1");
INSERT INTO falta VALUES("60","2019-12-02","Falta",NULL,"124","11","15","1");
INSERT INTO falta VALUES("61","2019-12-05","Falta",NULL,"125","12","16","1");
INSERT INTO falta VALUES("62","2019-12-04","Falta",NULL,"126","8","18","1");
INSERT INTO falta VALUES("63","2019-12-04","Falta",NULL,"127","1","21","1");
INSERT INTO falta VALUES("64","2019-12-05","Falta",NULL,"128","1","21","1");
INSERT INTO falta VALUES("65","2019-12-04","Falta",NULL,"129","18","15","1");
INSERT INTO falta VALUES("66","2019-12-05","Falta",NULL,"130","10","14","1");
INSERT INTO falta VALUES("67","2019-12-04","Falta",NULL,"131","4","21","1");
INSERT INTO falta VALUES("68","2019-12-03","Falta",NULL,"132","18","22","1");
INSERT INTO falta VALUES("69","2019-12-06","Falta",NULL,"133","13","17","1");
INSERT INTO falta VALUES("70","2019-12-06","Falta",NULL,"134","19","24","2");
INSERT INTO falta VALUES("71","2019-12-06","Falta",NULL,"135","4","13","1");
INSERT INTO falta VALUES("72","2019-12-06","Falta",NULL,"136","18","25","1");
INSERT INTO falta VALUES("73","2019-12-06","Falta",NULL,"137","9","12","1");
INSERT INTO falta VALUES("74","2019-12-09","Falta",NULL,"138","11","15","1");
INSERT INTO falta VALUES("75","2019-12-10","Falta",NULL,"139","18","22","1");
INSERT INTO falta VALUES("76","2019-12-12","Falta",NULL,"140","12","16","1");
INSERT INTO falta VALUES("77","2019-12-12","Falta",NULL,"143","1","21","1");
INSERT INTO falta VALUES("78","2019-12-12","Falta",NULL,"145","10","14","1");



CREATE TABLE `fechamesa` (
  `id_fechaMesa` int(20) NOT NULL AUTO_INCREMENT,
  `fechaMesa` date NOT NULL,
  PRIMARY KEY (`id_fechaMesa`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

INSERT INTO fechamesa VALUES("56","2020-01-14");
INSERT INTO fechamesa VALUES("57","2020-01-15");
INSERT INTO fechamesa VALUES("60","2021-10-11");
INSERT INTO fechamesa VALUES("64","2019-12-02");
INSERT INTO fechamesa VALUES("65","2019-12-03");
INSERT INTO fechamesa VALUES("66","2019-12-04");
INSERT INTO fechamesa VALUES("67","2019-12-05");
INSERT INTO fechamesa VALUES("68","2019-12-06");
INSERT INTO fechamesa VALUES("69","2019-12-16");
INSERT INTO fechamesa VALUES("70","2019-12-17");
INSERT INTO fechamesa VALUES("71","2019-12-18");
INSERT INTO fechamesa VALUES("72","2019-12-19");
INSERT INTO fechamesa VALUES("73","2019-12-20");
INSERT INTO fechamesa VALUES("75","2019-11-22");



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
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8;

INSERT INTO horadeconsulta VALUES("31","2019-10-12","2019-10-22","4","activo","completo","1","65","2");
INSERT INTO horadeconsulta VALUES("40","2019-10-08","2019-10-15","0","activo","completo","1","64","2");
INSERT INTO horadeconsulta VALUES("54","2019-10-15","2019-10-29","1","activo","completo","1","64","2");
INSERT INTO horadeconsulta VALUES("55","2019-10-22","2019-10-30","0","calculado","completo","8","69","20");
INSERT INTO horadeconsulta VALUES("56","2019-10-22","2019-10-25","0","calculado","completo","9","71","12");
INSERT INTO horadeconsulta VALUES("57","2019-10-22","2019-10-28","0","calculado","completo","4","73","13");
INSERT INTO horadeconsulta VALUES("58","2019-10-22","2019-10-28","1","calculado","completo","4","75","13");
INSERT INTO horadeconsulta VALUES("60","2019-10-22","2019-10-28","1","calculado","completo","11","79","15");
INSERT INTO horadeconsulta VALUES("62","2019-10-22","2019-10-25","1","calculado","completo","13","83","17");
INSERT INTO horadeconsulta VALUES("63","2019-10-22","2019-11-01","0","calculado","completo","8","85","18");
INSERT INTO horadeconsulta VALUES("64","2019-10-22","2019-10-29","1","calculado","completo","8","87","19");
INSERT INTO horadeconsulta VALUES("65","2019-10-24","2019-10-29","0","calculado","completo","8","89","18");
INSERT INTO horadeconsulta VALUES("66","2019-10-24","2019-10-30","1","calculado","completo","8","91","18");
INSERT INTO horadeconsulta VALUES("70","2019-10-28","2019-11-04","1","calculado","completo","4","75","13");
INSERT INTO horadeconsulta VALUES("71","2019-10-28","2019-11-04","0","calculado","completo","11","79","15");
INSERT INTO horadeconsulta VALUES("72","2019-10-29","2019-11-05","0","calculado","completo","1","0","2");
INSERT INTO horadeconsulta VALUES("74","2019-10-29","2019-11-05","1","calculado","completo","8","87","19");
INSERT INTO horadeconsulta VALUES("75","2019-10-30","2019-11-06","0","calculado","completo","8","91","18");
INSERT INTO horadeconsulta VALUES("78","2019-10-22","2019-11-05","0","calculado","completo","4","65","13");
INSERT INTO horadeconsulta VALUES("79","2019-10-25","2019-11-08","1","calculado","completo","9","71","12");
INSERT INTO horadeconsulta VALUES("80","2019-10-25","2019-11-08","1","calculado","completo","13","83","17");
INSERT INTO horadeconsulta VALUES("84","2019-11-04","2019-11-12","0","calculado","completo","4","75","13");
INSERT INTO horadeconsulta VALUES("85","2019-11-07","2019-11-13","0","calculado","completo","4","98","21");
INSERT INTO horadeconsulta VALUES("86","2019-11-07","2019-11-13","0","calculado","completo","1","101","21");
INSERT INTO horadeconsulta VALUES("87","2019-11-07","2019-11-14","1","calculado","completo","1","102","21");
INSERT INTO horadeconsulta VALUES("89","2019-11-07","2019-11-13","0","calculado","completo","12","106","16");
INSERT INTO horadeconsulta VALUES("90","2019-11-07","2019-11-12","1","calculado","completo","18","108","22");
INSERT INTO horadeconsulta VALUES("92","2019-11-07","2019-11-12","0","calculado","completo","18","112","15");
INSERT INTO horadeconsulta VALUES("93","2019-11-08","2019-11-15","0","calculado","completo","13","83","17");
INSERT INTO horadeconsulta VALUES("94","2019-11-08","2019-11-15","1","calculado","completo","9","71","12");
INSERT INTO horadeconsulta VALUES("95","2019-11-07","2019-11-08","0","calculado","completo","19","114","24");
INSERT INTO horadeconsulta VALUES("96","2019-11-07","2019-11-12","1","calculado","completo","18","115","22");
INSERT INTO horadeconsulta VALUES("97","2019-11-07","2019-11-08","0","calculado","completo","4","116","13");
INSERT INTO horadeconsulta VALUES("99","2019-11-07","2019-11-12","0","calculado","completo","12","118","16");
INSERT INTO horadeconsulta VALUES("100","2019-11-07","2019-11-14","2","calculado","completo","12","119","16");
INSERT INTO horadeconsulta VALUES("102","2019-11-07","2019-11-11","0","calculado","completo","18","121","15");
INSERT INTO horadeconsulta VALUES("103","2019-11-07","2019-11-13","0","calculado","completo","18","122","15");
INSERT INTO horadeconsulta VALUES("104","2019-11-07","2019-11-11","0","calculado","completo","10","124","14");
INSERT INTO horadeconsulta VALUES("105","2019-11-07","2019-11-14","1","calculado","completo","10","125","14");
INSERT INTO horadeconsulta VALUES("106","2019-11-07","2019-11-13","0","calculado","completo","4","126","21");
INSERT INTO horadeconsulta VALUES("107","2019-11-12","2019-11-12","1","calculado","completo","18","115","22");
INSERT INTO horadeconsulta VALUES("108","2019-11-09","2019-11-11","0","calculado","completo","18","128","25");
INSERT INTO horadeconsulta VALUES("109","2019-11-09","2019-11-15","0","calculado","completo","18","129","25");
INSERT INTO horadeconsulta VALUES("110","2019-11-12","2019-11-19","0","calculado","completo","18","115","22");
INSERT INTO horadeconsulta VALUES("111","2019-11-04","2019-11-25","0","calculado","completo","11","79","15");
INSERT INTO horadeconsulta VALUES("112","2019-11-06","2019-11-27","0","calculado","completo","8","91","18");
INSERT INTO horadeconsulta VALUES("113","2019-11-13","2019-11-27","0","calculado","completo","1","101","21");
INSERT INTO horadeconsulta VALUES("114","2019-11-14","2019-11-28","0","calculado","completo","1","102","21");
INSERT INTO horadeconsulta VALUES("115","2019-11-15","2019-11-29","1","calculado","completo","13","83","17");
INSERT INTO horadeconsulta VALUES("116","2019-11-15","2019-11-29","0","calculado","completo","9","71","12");
INSERT INTO horadeconsulta VALUES("117","2019-11-08","2019-11-29","0","calculado","completo","19","114","24");
INSERT INTO horadeconsulta VALUES("118","2019-11-08","2019-11-29","0","calculado","completo","4","116","13");
INSERT INTO horadeconsulta VALUES("119","2019-11-13","2019-11-27","0","calculado","completo","18","122","15");
INSERT INTO horadeconsulta VALUES("120","2019-11-14","2019-11-28","0","calculado","completo","10","125","14");
INSERT INTO horadeconsulta VALUES("121","2019-11-13","2019-11-27","0","calculado","completo","4","126","21");
INSERT INTO horadeconsulta VALUES("122","2019-11-15","2019-11-29","1","calculado","completo","18","129","25");
INSERT INTO horadeconsulta VALUES("123","2019-11-19","2019-11-26","0","calculado","completo","18","115","22");
INSERT INTO horadeconsulta VALUES("124","2019-11-25","2019-12-02","0","calculado","completo","11","79","15");
INSERT INTO horadeconsulta VALUES("125","2019-11-14","2019-12-05","0","calculado","completo","12","119","16");
INSERT INTO horadeconsulta VALUES("126","2019-11-27","2019-12-04","0","calculado","completo","8","91","18");
INSERT INTO horadeconsulta VALUES("127","2019-11-27","2019-12-04","0","calculado","completo","1","101","21");
INSERT INTO horadeconsulta VALUES("128","2019-11-28","2019-12-05","0","calculado","completo","1","102","21");
INSERT INTO horadeconsulta VALUES("129","2019-11-27","2019-12-04","0","calculado","completo","18","122","15");
INSERT INTO horadeconsulta VALUES("130","2019-11-28","2019-12-05","1","calculado","completo","10","125","14");
INSERT INTO horadeconsulta VALUES("131","2019-11-27","2019-12-04","0","calculado","completo","4","126","21");
INSERT INTO horadeconsulta VALUES("132","2019-11-26","2019-12-03","1","calculado","completo","18","115","22");
INSERT INTO horadeconsulta VALUES("133","2019-11-29","2019-12-06","0","calculado","completo","13","83","17");
INSERT INTO horadeconsulta VALUES("134","2019-11-29","2019-12-06","0","calculado","completo","19","114","24");
INSERT INTO horadeconsulta VALUES("135","2019-11-29","2019-12-06","0","calculado","completo","4","116","13");
INSERT INTO horadeconsulta VALUES("136","2019-11-29","2019-12-06","0","calculado","completo","18","129","25");
INSERT INTO horadeconsulta VALUES("137","2019-11-29","2019-12-06","0","calculado","completo","9","71","12");
INSERT INTO horadeconsulta VALUES("138","2019-12-02","2019-12-09","0","calculado","completo","11","79","15");
INSERT INTO horadeconsulta VALUES("139","2019-12-03","2019-12-10","0","calculado","completo","18","115","22");
INSERT INTO horadeconsulta VALUES("140","2019-12-05","2019-12-12","0","calculado","completo","12","119","16");
INSERT INTO horadeconsulta VALUES("141","2019-12-04","2019-12-18","0","pendiente","activo","8","91","18");
INSERT INTO horadeconsulta VALUES("142","2019-12-04","2019-12-18","0","pendiente","activo","1","101","21");
INSERT INTO horadeconsulta VALUES("143","2019-12-05","2019-12-12","0","calculado","completo","1","102","21");
INSERT INTO horadeconsulta VALUES("144","2019-12-04","2019-12-18","0","pendiente","activo","18","122","15");
INSERT INTO horadeconsulta VALUES("145","2019-12-05","2019-12-12","0","calculado","completo","10","125","14");
INSERT INTO horadeconsulta VALUES("146","2019-12-04","2019-12-18","0","pendiente","activo","4","126","21");
INSERT INTO horadeconsulta VALUES("147","2019-12-06","2019-12-13","1","pendiente","completo","13","83","17");
INSERT INTO horadeconsulta VALUES("148","2019-12-06","2019-12-13","0","pendiente","completo","19","114","24");
INSERT INTO horadeconsulta VALUES("149","2019-12-06","2019-12-13","0","pendiente","completo","4","116","13");
INSERT INTO horadeconsulta VALUES("150","2019-12-06","2019-12-13","0","pendiente","completo","18","129","25");
INSERT INTO horadeconsulta VALUES("151","2019-12-06","2019-12-13","0","pendiente","completo","9","71","12");
INSERT INTO horadeconsulta VALUES("152","2019-12-09","2019-12-16","0","pendiente","activo","11","79","15");
INSERT INTO horadeconsulta VALUES("153","2019-12-10","2019-12-17","0","pendiente","activo","18","115","22");
INSERT INTO horadeconsulta VALUES("154","2019-12-12","2019-12-18","0","pendiente","activo","1","131","26");
INSERT INTO horadeconsulta VALUES("155","2019-12-12","2019-12-19","2","pendiente","activo","12","119","16");
INSERT INTO horadeconsulta VALUES("156","2019-12-12","2019-12-19","0","pendiente","activo","1","102","21");
INSERT INTO horadeconsulta VALUES("157","2019-12-12","2019-12-19","0","pendiente","activo","10","125","14");
INSERT INTO horadeconsulta VALUES("158","2019-12-13","2020-02-14","0","pendiente","activo","13","83","17");
INSERT INTO horadeconsulta VALUES("159","2019-12-13","2020-02-14","0","pendiente","activo","19","114","24");
INSERT INTO horadeconsulta VALUES("160","2019-12-13","2020-02-14","0","pendiente","activo","4","116","13");
INSERT INTO horadeconsulta VALUES("161","2019-12-13","2020-02-14","0","pendiente","activo","18","129","25");
INSERT INTO horadeconsulta VALUES("162","2019-12-13","2020-02-14","0","pendiente","activo","9","71","12");
INSERT INTO horadeconsulta VALUES("163","2019-12-15","2019-12-16","0","pendiente","activo","8","134","19");



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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

INSERT INTO horariocursado VALUES("1","08:00:00","08:00:00","5","3","1","1",NULL,NULL);
INSERT INTO horariocursado VALUES("3","19:00:00","22:00:00","12","9","2","3",NULL,NULL);
INSERT INTO horariocursado VALUES("4","16:00:00","17:00:00","13","4","1","2",NULL,NULL);
INSERT INTO horariocursado VALUES("5","19:00:00","22:00:00","14","10","2","1",NULL,NULL);
INSERT INTO horariocursado VALUES("6","15:00:00","16:00:00","15","11","2","3",NULL,NULL);
INSERT INTO horariocursado VALUES("7","16:00:00","19:00:00","16","12","1","3",NULL,NULL);
INSERT INTO horariocursado VALUES("8","19:00:00","22:00:00","17","13","2","5",NULL,NULL);
INSERT INTO horariocursado VALUES("9","14:00:00","19:00:00","18","8","anual","4",NULL,NULL);
INSERT INTO horariocursado VALUES("10","14:00:00","19:00:00","19","8","anual","4",NULL,NULL);
INSERT INTO horariocursado VALUES("11","18:15:00","23:00:00","11","8","anual","4",NULL,NULL);
INSERT INTO horariocursado VALUES("12","18:15:00","23:00:00","20","8","anual","4",NULL,NULL);
INSERT INTO horariocursado VALUES("13","16:00:00","19:00:00","16","12","1","3",NULL,NULL);
INSERT INTO horariocursado VALUES("14","19:00:00","22:00:00","16","14","anual","1",NULL,NULL);
INSERT INTO horariocursado VALUES("16","14:30:00","16:00:00","21","4","1","1",NULL,NULL);
INSERT INTO horariocursado VALUES("17","14:30:00","19:00:00","13","1","anual","2",NULL,NULL);
INSERT INTO horariocursado VALUES("18","14:30:00","19:00:00","21","1","anual","2",NULL,NULL);
INSERT INTO horariocursado VALUES("19","19:00:00","22:00:00","16","14","anual","3",NULL,NULL);
INSERT INTO horariocursado VALUES("20","16:00:00","19:00:00","16","12","1","3",NULL,NULL);
INSERT INTO horariocursado VALUES("21","14:30:00","19:00:00","15","18","anual","3",NULL,NULL);
INSERT INTO horariocursado VALUES("22","16:00:00","19:00:00","22","18","anual","3",NULL,NULL);
INSERT INTO horariocursado VALUES("23","14:00:00","16:00:00","23","18","anual","3",NULL,NULL);
INSERT INTO horariocursado VALUES("24","14:00:00","16:00:00","15","18","anual","2",NULL,NULL);
INSERT INTO horariocursado VALUES("25","14:00:00","16:00:00","15","18","anual","2",NULL,NULL);
INSERT INTO horariocursado VALUES("26","19:00:00","22:00:00","24","19","1","3",NULL,NULL);
INSERT INTO horariocursado VALUES("27","16:00:00","19:00:00","16","14","anual","1",NULL,NULL);
INSERT INTO horariocursado VALUES("28","19:00:00","22:00:00","16","14","anual","4",NULL,NULL);
INSERT INTO horariocursado VALUES("29","19:00:00","22:00:00","14","10","2","2",NULL,NULL);
INSERT INTO horariocursado VALUES("30","14:00:00","16:00:00","25","18","anual","3",NULL,NULL);
INSERT INTO horariocursado VALUES("31","17:00:00","19:00:00","4","1","anual","2",NULL,NULL);
INSERT INTO horariocursado VALUES("32","19:00:00","22:00:00","4","1","anual","2",NULL,NULL);
INSERT INTO horariocursado VALUES("33","17:00:00","19:00:00","5","1","anual","2",NULL,NULL);
INSERT INTO horariocursado VALUES("34","19:00:00","22:00:00","5","1","anual","2",NULL,NULL);
INSERT INTO horariocursado VALUES("35","17:00:00","19:00:00","26","1","anual","2",NULL,NULL);



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
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8;

INSERT INTO horariodeconsulta VALUES("62","08:00","2019-10-12","2019-11-07","1","1","2","1","1","1");
INSERT INTO horariodeconsulta VALUES("63","08:00","2019-10-12","2019-11-07","4","1","2","1","2","2");
INSERT INTO horariodeconsulta VALUES("64","08:00","2019-10-12","0000-00-00","2","1","4","2","1","114");
INSERT INTO horariodeconsulta VALUES("65","08:00","2019-10-12","2019-11-07","4","1","2","2","2","2");
INSERT INTO horariodeconsulta VALUES("66","08:00","2019-10-12","2019-11-07","2","1","2","31","1","2");
INSERT INTO horariodeconsulta VALUES("67","08:00","2019-10-12","2019-11-07","2","1","2","32","1","1");
INSERT INTO horariodeconsulta VALUES("68","17:00","2019-10-22","0000-00-00","3","8","20","1","1","1");
INSERT INTO horariodeconsulta VALUES("69","17:00","2019-10-22","0000-00-00","3","8","20","2","1","1");
INSERT INTO horariodeconsulta VALUES("70","17:00","2019-10-22","2019-12-15","5","9","12","1","1","1");
INSERT INTO horariodeconsulta VALUES("71","17:00","2019-10-22","0000-00-00","5","9","12","2","1","1");
INSERT INTO horariodeconsulta VALUES("72","16:45","2019-10-22","2019-10-22","1","4","13","1","1","1");
INSERT INTO horariodeconsulta VALUES("73","16:45","2019-10-22","2019-10-22","1","4","13","2","1","1");
INSERT INTO horariodeconsulta VALUES("74","15:45","2019-10-22","0000-00-00","1","4","13","1","1","1");
INSERT INTO horariodeconsulta VALUES("75","15:45","2019-10-22","2019-11-07","1","4","13","2","1","1");
INSERT INTO horariodeconsulta VALUES("78","19:00","2019-10-22","0000-00-00","1","11","15","1","1","1");
INSERT INTO horariodeconsulta VALUES("79","19:00","2019-10-22","0000-00-00","1","11","15","2","1","1");
INSERT INTO horariodeconsulta VALUES("82","15:00","2019-10-22","0000-00-00","5","13","17","1","1","1");
INSERT INTO horariodeconsulta VALUES("83","15:00","2019-10-22","0000-00-00","5","13","17","2","1","1");
INSERT INTO horariodeconsulta VALUES("84","18:00","2019-10-22","2019-10-24","3","8","18","1","1","1");
INSERT INTO horariodeconsulta VALUES("85","18:00","2019-10-22","2019-10-24","3","8","18","2","1","1");
INSERT INTO horariodeconsulta VALUES("86","17:00","2019-10-22","2019-12-15","2","8","19","1","1","1");
INSERT INTO horariodeconsulta VALUES("87","17:00","2019-10-22","2019-12-15","2","8","19","2","1","1");
INSERT INTO horariodeconsulta VALUES("88","18:00","2019-10-24","2019-10-24","1","8","18","1","1","1");
INSERT INTO horariodeconsulta VALUES("89","19:00","2019-10-24","2019-10-24","2","8","18","2","1","1");
INSERT INTO horariodeconsulta VALUES("90","18:00","2019-10-24","0000-00-00","2","8","18","1","1","1");
INSERT INTO horariodeconsulta VALUES("91","19:00","2019-10-24","0000-00-00","3","8","18","2","1","1");
INSERT INTO horariodeconsulta VALUES("97","11:00","2019-11-07","0000-00-00","1","4","21","1","1","1");
INSERT INTO horariodeconsulta VALUES("98","14:00","2019-11-07","2019-11-07","3","4","21","2","1","1");
INSERT INTO horariodeconsulta VALUES("99","20:00","2019-11-07","0000-00-00","3","1","21","1","1","1");
INSERT INTO horariodeconsulta VALUES("100","15:00","2019-11-07","0000-00-00","4","1","21","1","2","1");
INSERT INTO horariodeconsulta VALUES("101","20:00","2019-11-07","0000-00-00","3","1","21","2","1","1");
INSERT INTO horariodeconsulta VALUES("102","15:00","2019-11-07","0000-00-00","4","1","21","2","2","1");
INSERT INTO horariodeconsulta VALUES("105","14:00","2019-11-07","0000-00-00","3","12","16","1","1","121");
INSERT INTO horariodeconsulta VALUES("106","14:00","2019-11-07","2019-11-07","3","12","16","2","1","1");
INSERT INTO horariodeconsulta VALUES("107","17:00","2019-11-07","0000-00-00","2","18","22","1","1","115");
INSERT INTO horariodeconsulta VALUES("108","19:00","2019-11-07","2019-11-07","2","18","22","2","1","1");
INSERT INTO horariodeconsulta VALUES("109","16:00","2019-11-07","0000-00-00","2","18","23","1","1","1");
INSERT INTO horariodeconsulta VALUES("111","16:00","2019-11-07","0000-00-00","2","18","15","1","1","117");
INSERT INTO horariodeconsulta VALUES("112","16:00","2019-11-07","2019-11-07","2","18","15","2","1","1");
INSERT INTO horariodeconsulta VALUES("113","15:00","2019-11-07","0000-00-00","5","19","24","1","1","121");
INSERT INTO horariodeconsulta VALUES("114","15:00","2019-11-07","0000-00-00","5","19","24","2","1","121");
INSERT INTO horariodeconsulta VALUES("115","15:30","2019-11-07","0000-00-00","2","18","22","2","1","1");
INSERT INTO horariodeconsulta VALUES("116","14:30","2019-11-07","0000-00-00","5","4","13","2","1","1");
INSERT INTO horariodeconsulta VALUES("118","15:30","2019-11-07","2019-11-07","2","12","16","2","1","1");
INSERT INTO horariodeconsulta VALUES("119","19:00","2019-11-07","0000-00-00","4","12","16","2","1","1");
INSERT INTO horariodeconsulta VALUES("120","16:00","2019-11-10","0000-00-00","5","18","23","2","1","1");
INSERT INTO horariodeconsulta VALUES("121","16:00","2019-11-07","2019-11-07","1","18","15","2","1","1");
INSERT INTO horariodeconsulta VALUES("122","19:00","2019-11-07","0000-00-00","3","18","15","2","1","1");
INSERT INTO horariodeconsulta VALUES("123","08:00","2019-11-07","0000-00-00","1","10","14","1","1","1");
INSERT INTO horariodeconsulta VALUES("124","14:00","2019-11-07","2019-11-07","1","10","14","2","1","1");
INSERT INTO horariodeconsulta VALUES("125","14:00","2019-11-07","0000-00-00","4","10","14","2","1","1");
INSERT INTO horariodeconsulta VALUES("126","13:00","2019-11-07","0000-00-00","3","4","21","2","1","1");
INSERT INTO horariodeconsulta VALUES("127","08:00","2019-11-09","0000-00-00","1","18","25","1","1","114");
INSERT INTO horariodeconsulta VALUES("128","16:00","2019-11-09","2019-11-09","1","18","25","2","1","1");
INSERT INTO horariodeconsulta VALUES("129","16:00","2019-11-09","0000-00-00","5","18","25","2","1","1");
INSERT INTO horariodeconsulta VALUES("130","19:00","2019-12-12","0000-00-00","3","1","26","1","1","1");
INSERT INTO horariodeconsulta VALUES("131","19:00","2019-12-12","0000-00-00","3","1","26","2","1","1");
INSERT INTO horariodeconsulta VALUES("132","16:00","2019-12-15","0000-00-00","5","9","12","1","1","1");
INSERT INTO horariodeconsulta VALUES("133","14:00","2019-12-15","0000-00-00","1","8","19","1","1","1");
INSERT INTO horariodeconsulta VALUES("134","15:00","2019-12-15","0000-00-00","1","8","19","2","1","1");



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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO presentismo VALUES("21","2019-10-15","00:50:52","00:50:56","2","40");
INSERT INTO presentismo VALUES("22","2019-10-28","16:02:25","16:03:36","13","58");
INSERT INTO presentismo VALUES("23","2019-10-28","19:01:38","19:02:29","15","60");
INSERT INTO presentismo VALUES("24","2019-10-29","08:00:27","08:04:42","2","54");
INSERT INTO presentismo VALUES("25","2019-10-29","15:01:12","15:01:42","16","68");
INSERT INTO presentismo VALUES("26","2019-10-29","15:03:00","15:04:06","19","64");
INSERT INTO presentismo VALUES("27","2019-10-30","19:01:38","19:01:58","18","66");
INSERT INTO presentismo VALUES("28","2019-10-31","14:00:44","14:00:57","16","69");
INSERT INTO presentismo VALUES("29","2019-10-30","17:02:49","17:08:57","0","59");
INSERT INTO presentismo VALUES("30","2019-10-30","17:08:31","00:00:00","20","55");
INSERT INTO presentismo VALUES("31","2019-11-05","17:01:40","17:02:18","19","74");
INSERT INTO presentismo VALUES("32","2019-11-08","15:11:10","15:11:48","17","80");
INSERT INTO presentismo VALUES("33","2019-11-08","17:11:40","17:11:59","12","79");
INSERT INTO presentismo VALUES("34","2019-11-12","15:32:41","15:38:13","22","96");
INSERT INTO presentismo VALUES("35","2019-11-12","15:31:50","15:32:33","22","107");



CREATE TABLE `privilegio` (
  `nombrePrivilegio` varchar(35) NOT NULL,
  `numeroPermiso` int(11) NOT NULL,
  `id_privilegio` int(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_privilegio`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

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

