# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: gene.rnet.missouri.edu (MySQL 5.0.95)
# Database: iKnow
# Generation Time: 2015-09-30 02:10:07 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Admin`;

CREATE TABLE `Admin` (
  `adminid` int(11) NOT NULL,
  `username` varchar(45) NOT NULL default '',
  `password` varchar(45) NOT NULL default '',
  `email` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`adminid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Category`;

CREATE TABLE `Category` (
  `catid` int(11) NOT NULL,
  `name` varchar(45) default NULL,
  `describe` varchar(45) default NULL,
  `pic` longblob,
  PRIMARY KEY  (`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Category` WRITE;
/*!40000 ALTER TABLE `Category` DISABLE KEYS */;

INSERT INTO `Category` (`catid`, `name`, `describe`, `pic`)
VALUES
	(1,'推拿按摩','推拿按摩',''),
	(2,'刮痧火罐','刮痧火罐',NULL),
	(3,'汗蒸浴场','汗蒸浴场',NULL),
	(4,'足疗养生','足疗养生',NULL),
	(5,'中医康复','中医康复',NULL),
	(6,'疾病调理','疾病调理',NULL);

/*!40000 ALTER TABLE `Category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Comment`;

CREATE TABLE `Comment` (
  `orderid` int(11) unsigned NOT NULL auto_increment,
  `massaid` varchar(20) NOT NULL default '',
  `date` datetime NOT NULL,
  `content` varchar(300) NOT NULL default '',
  `stars` enum('1','2','3') NOT NULL default '3',
  PRIMARY KEY  (`orderid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Customer`;

CREATE TABLE `Customer` (
  `phone` varchar(20) NOT NULL default '',
  `password` varchar(20) NOT NULL default '',
  `signupdate` date NOT NULL,
  `Country` varchar(5) NOT NULL default '',
  PRIMARY KEY  (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Customer` WRITE;
/*!40000 ALTER TABLE `Customer` DISABLE KEYS */;

INSERT INTO `Customer` (`phone`, `password`, `signupdate`, `Country`)
VALUES
	('1','1','0000-00-00','86'),
	('11','11','0000-00-00','86'),
	('111','111','2015-09-13','1'),
	('111www','111','2015-09-13','1'),
	('123','123','2015-09-26',''),
	('5733978648','1','2015-09-26',''),
	('5734890253','111','2015-09-17',''),
	('5738082219','1234','2015-09-17',''),
	('5738087671','1234567','2015-09-17',''),
	('6268981388','gggggg','2015-09-19',''),
	('www','111','2015-09-13','1');

/*!40000 ALTER TABLE `Customer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Has_Service
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Has_Service`;

CREATE TABLE `Has_Service` (
  `hsid` int(11) NOT NULL COMMENT '\n',
  `masaid` varchar(20) NOT NULL default '',
  `serviceid` int(11) NOT NULL,
  PRIMARY KEY  (`hsid`),
  KEY `massagist_idx` (`masaid`),
  KEY `service_idx` (`serviceid`),
  CONSTRAINT `HSmassagist` FOREIGN KEY (`masaid`) REFERENCES `Massagist` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `HSservice` FOREIGN KEY (`serviceid`) REFERENCES `Service` (`serviceid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Has_Service` WRITE;
/*!40000 ALTER TABLE `Has_Service` DISABLE KEYS */;

INSERT INTO `Has_Service` (`hsid`, `masaid`, `serviceid`)
VALUES
	(0,'1',1),
	(1,'1',2),
	(2,'1',3),
	(3,'2',1),
	(4,'3',1),
	(5,'2',2),
	(6,'2',4),
	(7,'3',5),
	(8,'4',6),
	(9,'4',3),
	(10,'5',4),
	(11,'6',2),
	(12,'6',7),
	(13,'4',7),
	(15,'5',8),
	(16,'2',8);

/*!40000 ALTER TABLE `Has_Service` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Massagist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Massagist`;

CREATE TABLE `Massagist` (
  `phone` varchar(20) NOT NULL default '',
  `password` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Massagist` WRITE;
/*!40000 ALTER TABLE `Massagist` DISABLE KEYS */;

INSERT INTO `Massagist` (`phone`, `password`)
VALUES
	('1','1'),
	('2','2'),
	('3','3'),
	('4','4'),
	('5','5'),
	('6','6');

/*!40000 ALTER TABLE `Massagist` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table MassagistDetail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `MassagistDetail`;

CREATE TABLE `MassagistDetail` (
  `phone` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL default '',
  `stars` enum('1','2','3') NOT NULL default '3',
  `shopid` int(11) NOT NULL,
  `pic` varchar(200) NOT NULL default '',
  `intro` varchar(500) NOT NULL default '',
  `level` enum('M','H','E') NOT NULL default 'M',
  PRIMARY KEY  (`phone`),
  KEY `mstore_idx` (`shopid`),
  CONSTRAINT `mdphone` FOREIGN KEY (`phone`) REFERENCES `Massagist` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mdshop` FOREIGN KEY (`shopid`) REFERENCES `Shop` (`shopid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `MassagistDetail` WRITE;
/*!40000 ALTER TABLE `MassagistDetail` DISABLE KEYS */;

INSERT INTO `MassagistDetail` (`phone`, `name`, `stars`, `shopid`, `pic`, `intro`, `level`)
VALUES
	('1','赵文斌','3',1,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/mat1.jpg','擅长治疗中风、颈椎病、手脚麻木等心脑血管疾病，各种内科、妇科疑难疾病的中西医结合治疗','H'),
	('2','谢文松','2',2,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/mat2.jpg','中医体质辨识，更年期调理，膏方调理，健康指导，汗证，虚劳，失眠，肥胖等。','M'),
	('3','尚洪涛','3',3,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/mat3.jpg','三级甲等医院工作，从事中西医结合临床10年，擅长中医治疗疑难杂症。肝病中西医结合治疗。','E'),
	('4','王金海','3',4,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/mat4.jpg','医学博士，擅长中医药治疗慢性胃炎，胃溃疡，肠易激综合征。','M'),
	('5','孟永斌','2',1,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/mat5.jpg','三擅长从心理价中医药辨证论治综合疗法治疗内科多种疑难杂症，包括内科消化系统，心血管系统，呼吸系统等身心疾病。','M'),
	('6','高明亮','3',2,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/mat6.jpg','中医内科，风湿病，类风湿关节炎，复发性口腔溃疡，强直性脊柱炎，系统性红斑狼疮，颈椎腰椎病，脑血管疾病，妇科、儿科，内分泌疾病等。','M');

/*!40000 ALTER TABLE `MassagistDetail` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL default '',
  `content` varchar(2000) NOT NULL default '',
  `pic` varchar(100) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;

INSERT INTO `news` (`id`, `title`, `content`, `pic`)
VALUES
	(1,'六种腹痛会要命，千万不可小视','几乎每个人都经历过腹痛，但大多认为“忍一忍、揉一揉，做个热敷就过去了”。甚至有些中老年人因腹痛进了医院，如果医生开心电图、腹部CT等检查，还要埋怨医生“乱开检查，没医德”。其实，腹痛是急诊科最常见的就诊原因，也是一项最复杂的临床症状。老年人腹痛更是严重疾病的信号，一旦误诊误治还可能危及生命。以下六种十分凶险的疾病都可以出现腹痛。\n<br>\n大约有8%的急性心肌梗死患者，在早期可表现为突发上腹部剧痛，伴有恶心呕吐，局部可有或无压痛，容易误诊为胃及十二指肠溃疡急性穿孔、急性胆囊炎等。所以，既往有冠心病、心绞痛病史的中老年病人，如果突然出现上腹剧痛，一定要警惕急性心肌梗死的可能。\n<br>\n心绞痛的疼痛可位于胸骨下段、左心前区或上腹部，放射至颈、下颌、左肩胛部或右前胸，疼痛可很快消失或仅有左前胸不适、发闷感，与活动相关，休息可以缓解。少数会表现为静息性上腹痛，很容易误诊为急性胃肠炎。\n<br>\n腹痛、腹胀、在腹部可触及','http://gene.rnet.missouri.edu/iKnow/img/disc/disc_img1.jpeg'),
	(2,'[秋季养生食谱]之杂骨菌菇汤]','杂骨菌菇汤，里面放了少量的枸杞子，枸杞滋补肝肾、益精明目。平日多喝菌类的汤，可以有效的给身体排毒，清理肠胃。\n<br>\n准备食材：<br>\n排骨100克、金针菇1小把、草菇2个、平菇2个、口蘑2个、枸杞6颗、姜3片、葱1根、料酒2茶匙、盐1茶匙、白胡椒粉少许。\n<br>\n做法：<br>\n步骤1：把菌菇等材料洗净切好，葱洗干净切成葱花。<br>\n步骤2：将菌菇放盐水里泡十分钟，再捞出沥干水分。<br>\n步骤3：杂骨用水冲洗干净，焯水后捞出用流动的水冲洗干净。放入锅中，倒入足够量的水，放姜片、料酒，中火煮开后转小火，盖上盖子炖半个小时左右。<br>\n步骤4：锅里杂骨汤炖的差不多了，开盖，把菌菇和枸杞子放入锅中，盖上盖子继续炖半小时左右。<br>\n步骤5：加盐和白胡椒粉调味，撒上葱花就可以了。','http://gene.rnet.missouri.edu/iKnow/img/disc/disc_img2.jpeg'),
	(3,'治疗口腔溃疡的九个小秘方','很多人都可能发生过口腔溃疡，一般而言，口腔内出现的溃疡95%是复发性口腔溃疡(俗称口疮)，它是最常见的口腔黏膜疾病，与龋齿、牙周病一样也是最常见的口腔疾病之一。在口腔里任何一个部位都可能发生溃疡，甚至舌头上都可能发生，具有红、黄、凹、痛四个特点。<br>\n　　红——开始只是一个圆形或者椭圆形的白点，慢慢扩大，周围的黏膜变成红色。<br>\n　　黄——过了一两天后，由于纤维素渗出，中间白色的溃疡变成黄色。<br>\n　　凹——四周黏膜稍微高点，溃疡中心部位凹进去。<br>\n　　痛——由于存在炎症，疼痛明显。<br>\n\n　　治疗口腔溃疡秘方<br>\n\n　　漱口法<br>\n　　1、姜水漱口<br>\n　　口腔溃疡用热姜水漱口，每日2~3次，一般6~9次溃疡面即可收敛。<br>\n　　2、浓茶漱口<br>\n　　用浓茶漱口，因茶中含有多种维生素，能防治各种炎症，对口腔溃疡面的康复，有一定辅助治疗作用。<br>\n　　3、萝卜藕汁<br>\n　　取生萝卜2只，鲜藕一段洗净捣烂绞汁去渣，用汁含漱，每日3次，连用4天可见效。<br>\n　　维生素<br>\n　　4、维生素E<br>\n　　用针刺破维生素E胶丸，将药液挤出涂于口腔溃疡处，保留1分钟，每日用药4次，于饭后及睡觉前用，一般3天可愈。<br>\n　　5、维生素B2<br>\n　　将维生素B2研为细粉状，用适量香油调匀，做成稀糊状，涂于溃疡表面，每日4～6次。具有不苦，不涩，味香，无刺激性，止痛等良好功效。连用2～3天，口腔溃疡可获愈。<br>\n　　6、维生素C片<br>\n　　将维生素C药片压成面，涂在患处，一两次就有效。也可将维生素C研成粉末状，若系小溃疡，仅需取少许敷于患处即可;若溃疡面较大，则应先轻轻刮除溃疡面渗出物，然后再敷药粉。每日用药2～3次，溃疡小者用药1～2次即愈，溃疡大者用药2～3次，疼痛可显著减轻，2～3天溃疡面即可痊愈。<br>\n\n　　药敷法<br>\n　　7、冰糖<br>\n　　口腔溃疡时，在口里含几块冰糖，有一定疗效。<br>\n　　8、云南白药粉<br>\n　　用消毒棉签蘸云南白药粉末敷患处，一般用药3天后可愈合。<br>\n　　9、冰硼散<br>\n　　将冰硼散粉末，涂于患处，1~2次就有效。<br>\n　　医生忠告，复发性口腔溃疡的患者应注意口腔卫生，避免损伤口腔黏膜，同时保持心情舒畅、充足的睡眠，不要过度劳累。<br>','http://gene.rnet.missouri.edu/iKnow/img/disc/disc_img3.jpeg'),
	(4,'长期间有这些习惯对身体很不好','都市人工作、生活繁忙，有些不良习惯会导致自己的身体产生不良影响，众惠生活小编或多或少也有些不良习惯，呜呜~问题来了，究竟哪些习惯是不好呢？众惠生活小编在网上搜到一些资讯，居然发现有些看似好的习惯，原来居然是坏的！！这一定要和各位分享一下！<br>\n \n      对身体不利的习惯如果长期发展下去危害极大，说严重点相当于慢性自杀。如果你有下面这些不好的习惯，那么请从今天起慢慢用心去改正吧！<br>\n \n      一、长时间热水泡脚<br>\n \n      大家都知道泡脚对身体有好处，也能解乏，可是长时间热水泡脚不仅会影响血液流量且没有传说中那些治病的功效，最重要的是可能影响睡眠，严重还会危及生命。经常会有新闻报道泡热水脚猝死、泡脚时长影响健康等。所以这类行为大家要避免。泡脚水温不宜过高，且时间不应超过20分钟。<br>\n \n      二、跷二郎腿<br>\n \n      跷二郎腿在工作生活中都会经常见到。但长期跷二郎腿对身体危害很大的！它会影响到男性生殖健康，很容易导致神经压迫症，因重心不稳还会导致脊椎问题，经常跷二郎腿还会导致O型腿的产生。恢复正确坐姿对身体很重要。<br>\n \n      三、冷水洗头<br>\n \n      很多人都喜欢用凉水洗头，但凉水洗头会对身体造成伤害，冷水通过头皮刺激到大脑，经常冷水洗头会导致长期头疼等症状。用冷水洗头不利于新陈代谢，还会导致女孩子经期腹痛等症状。<br>\n \n      四、不盖马桶盖冲厕所<br>\n \n      很多人在如厕后直接冲水，没有盖马桶盖的习惯，殊不知冲水时马桶内的瞬间气旋最高可以将病菌带到6米的高空中，并且病菌的悬浮时间可达几个小时之久。所以不盖马桶盖的行为要尽量改正。<br>\n \n      五、用洗衣机洗内衣<br>\n \n      内衣不可在洗衣机中洗涤，应单独手洗，否则容易造成交叉感染。外衣上的颗粒粉尘细菌等与内衣的各种汗液残留物细菌造成交叉感染，对人体危害可想而知。<br>\n \n      六、睡前玩手机<br>\n \n      都说睡眠时间应该满足7--8小时才有利健康。现在很多年轻人，睡眠时间不仅不足7小时，且睡前玩手机已经成为了他们的习惯。这种行为不仅会导致睡眠质量差，还会直接导致记忆力下降，情绪也会受到影响。长此以往对身体健康危害很大。<br>\n \n      七、吃饭速度过快<br>\n \n      随着生活节奏的加快，很多人的吃饭速度也越来越快，吃饭太快会对消化系统造成极大负担，很容易导致胃痛胃胀，增加肥胖几率。试着慢慢降低你的吃饭速度吧。<br>\n \n      大家要注意自己身体哦！<br>','http://gene.rnet.missouri.edu/iKnow/img/disc/disc_img4.jpeg'),
	(5,'健胃、补血、清肺、养阴、补肾应有尽有,建议收藏留作补时用!','通过药材与食物的搭配，借助药材的药效提高汤的营养价值及食用功效。不同的药材有不同的功效，在选用药材时应注意药性，选对药材，才能达到调养身体的目的。<br>\n\n淮山药<br>\n\n1、性味归经】：味甘，性平。归脾，肺，肾经。<br>\n\n2、【功效】：补脾养胃，生津益肺，补肾涩精。其保健作用得机理是可根据身体的需要转化为雄性激素或雌性激素，补充由于衰老和疾病造成的激素失调，从而使人保持旺盛的精力，增强抵御疾病的能力，加速受损组织的修复，并能预防和减缓恶性肿瘤、糖尿病、动脉硬化、心脏病、肥胖、老年痴呆症等。<br>\n\n三七<br>\n\n1、【功能与主治】散瘀止血，消肿定痛。用于咯血，吐血，衄血，便血，崩漏，外伤出血，胸腹刺痛，跌扑肿痛。<br>\n\n2、【食用功效】有益气养血、治疗崩漏、产后虚弱、自汗、盗汗、有滋阳强壮作用。也治疗老年人的头风痛、腰肌酸软无力等症。<br>\n\n枸杞<br>\n\n1、【功能与主治】:滋补肝肾，益精明目。用于虚劳精亏，腰膝酸痛，眩晕耳鸣，内热消渴，血虚萎黄，目昏不明。<br>\n\n黄芪<br>\n\n1、【功能与主治】：补气固表，利尿托毒，排脓，敛疮生肌。用于气虚乏力，食少便溏，中气下陷，久泻脱肛，便血崩漏，表虚自汗，气虚水肿，痈疽难溃，久溃不敛，血虚痿黄，内热消渴;慢性肾炎蛋白尿，糖尿病。蜜制黄芪益气补中。用于气虚乏力，食少便溏。<br>\n\n山楂<br>\n\n1、【功能与主治】消食健胃，行气散瘀。用于肉食积滞，胃脘胀满，泻痢腹痛，瘀血经闭，产后瘀阻，心腹刺痛，疝气疼痛;高脂血症。焦山楂消食导滞作用增强。用于肉食积滞，泻痢不爽。<br>\n\n当归<br>\n\n1、【功能与主治】补血活血，调经止痛、润肠通便。用于血虚萎黄，眩晕心悸，月经不调，经闭痛经，虚寒腹痛，肠燥便秘，风湿痹痛，跌扑损伤，痈疽疮疡。酒当归活血通经。用于经闭痛经，风湿痹痛，跌扑损伤。<br>\n\n天麻<br>\n\n天麻天麻润而不燥，主入肝经，长于平肝息风，凡肝风内动、头目眩晕之症，不论虚实，均为要药。<br>\n\n1、平肝息风。天麻质润多液，能养血息风，可治疗血虚肝风内动的头痛、眩晕，亦可用于小儿惊风、癫痫、破伤风。<br>\n2、祛风止痛。用于风痰引起的眩晕、偏正头痛、肢体麻木、半身不遂。<br>\n\n南沙参<br>\n\n1、【功能主治】养阴清肺，化痰益气。用于肺热燥咳、阴虚劳嗽、干咳痰粘、气阴不足、烦热口干。<br>\n\n北沙参<br>\n\n1、【性味】甘苦淡，凉。<br>\n\n2、【归经】 入肺、脾经。<br>\n\n3、【功能主治】 养阴清肺，益胃生津。用于肺热燥咳、劳嗽痰血、热病津伤口渴。<br>\n\n石斛<br>\n\n养阴生津、增强体质、补益脾胃、护肝利胆、清虚热、强筋壮骨、抑制肿瘤、明亮眼目、延年益寿。<br>\n\n芡实<br>\n1、【药性】甘、涩，平。归脾、肾经。<br>\n\n2、【功效】益肾固精，健脾止泻，除湿止带。<br>\n\n玉竹<br>\n\n1、【性味归经】，味甘，性平。归肺;胃经。<br>\n\n2、【功效主治】滋阴润肺;养胃生津。燥咳;劳嗽;热病阴液耗伤之咽干口渴;内热消渴;阴虚外感;头昏眩晕;筋脉挛痛。<br>\n\n陈皮<br>\n\n1、【性味归经】温;辛、苦;归脾、肺经。<br>\n\n2、【功能主治】调中带滞、顺气消痰、宣通五脏。<br>\n\n桂圆<br>\n\n补益心脾，养血安神。用于气血不足、心悸怔忡、健忘失眠、血虚萎黄。<br>\n\n百合<br>\n\n1、【功能主治】养阴润肺，清心安神。用于阴虚久咳，痰中带血，虚烦惊悸，失眠多梦，精神恍惚。具有养阴润肺止咳功效，用于肺阴虚的燥热咳嗽，痰中带血，如百花膏。治肺虚久咳，劳嗽咯血，如百合固金汤。具有清心安神功效，用于热病余热未清，虚烦惊悸，失眠多梦等。药用时煎服，10～30g。清心宜生用，润肺蜜炙用。<br>\n\n2、【功效】养阴清热，滋补精血。<br>\n\n玉米须<br>\n\n玉米须味甘、淡，性平;归肾、肝、胆经;质轻渗降;具有利尿消肿，平肝利胆的功效;主治水肿，小便淋沥，黄疸，胆囊炎，胆结石，高血压病，糖尿病，乳汁不通。有利尿降压功能。<br>\n\n红豆<br>\n\n1、【性能】味甘，性平。能健脾利湿，散血，解毒。<br>\n\n2、【用途】用于水肿、脚气;产后缺乳，腹泻、黄疸或小便不利;痔疮，肠痈。<br>\n\n杏仁<br>\n\n富含蛋白质、脂肪、糖类、胡萝卜素、B族维生素、维生素C、维生素P以及钙、磷、铁等营养成分。其性苦微温，有小毒，滋润养肺通便。适用于阴虚肺热、咳嗽、咽干舌燥、大便干结者。<br>\n\n罗汉果<br>\n\n其性甘凉，清热润肺止咳通便。<br>','http://gene.rnet.missouri.edu/iKnow/img/disc/disc_img5.jpeg'),
	(6,'测试地图','<ol><li><p>C<sup>2D</sup>D<sub>2</sub>&nbsp;<br/></p></li></ol><p><span style=\"background-color: rgb(255, 255, 0);\">DDDDD</span><br/></p><ol><li>NUM2<br/><p></p></li><li>NUM3</li><li>NUM4</li></ol><p><a href=\"http://XUYIHAN.COM.CN\" target=\"_self\" title=\"XUYIHAN.COM.CN\">XUYIHAN.COM.CN</a></p><p><img src=\"http://img.baidu.com/hi/jx2/j_0057.gif\" _src=\"http://img.baidu.com/hi/jx2/j_0057.gif\"/></p><p><img src=\"http://ueditor.baidu.com/server/umeditor/upload/demo.jpg\" _src=\"http://ueditor.baidu.com/server/umeditor/upload/demo.jpg\"/></p><hr/><p><br/></p>',NULL);

/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Order`;

CREATE TABLE `Order` (
  `orderid` int(11) unsigned NOT NULL auto_increment,
  `customerid` varchar(20) NOT NULL default '',
  `massaid` varchar(20) NOT NULL default '',
  `serviceid` int(11) NOT NULL,
  `qty` int(11) NOT NULL default '1',
  `time` datetime default NULL,
  `promotion` varchar(45) default NULL,
  `status` enum('UNPAID','UNCOMMET','DONE','WARN') NOT NULL default 'WARN',
  `amount` decimal(10,2) NOT NULL,
  `unitprice` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`orderid`),
  KEY `customer_foreignkey` (`customerid`),
  KEY `massagist_foreignkey` (`massaid`),
  KEY `serviced_foreignkey` (`serviceid`),
  KEY `promotion_foreignkey` (`promotion`),
  CONSTRAINT `customer_foreignkey` FOREIGN KEY (`customerid`) REFERENCES `Customer` (`Phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `massagist_foreignkey` FOREIGN KEY (`massaid`) REFERENCES `Massagist` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `promotion_foreignkey` FOREIGN KEY (`promotion`) REFERENCES `Promotion` (`Promotionid`),
  CONSTRAINT `serviced_foreignkey` FOREIGN KEY (`serviceid`) REFERENCES `Service` (`serviceid`)
) ENGINE=InnoDB AUTO_INCREMENT=23424 DEFAULT CHARSET=utf8;

LOCK TABLES `Order` WRITE;
/*!40000 ALTER TABLE `Order` DISABLE KEYS */;

INSERT INTO `Order` (`orderid`, `customerid`, `massaid`, `serviceid`, `qty`, `time`, `promotion`, `status`, `amount`, `unitprice`)
VALUES
	(23423,'1','1',1,1,'2015-09-05 00:00:00',NULL,'UNPAID',13.66,12.00);

/*!40000 ALTER TABLE `Order` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Promotion
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Promotion`;

CREATE TABLE `Promotion` (
  `Promotionid` varchar(45) NOT NULL default '',
  `value` float default NULL,
  `valid` tinyint(1) default NULL,
  PRIMARY KEY  (`Promotionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Recommand_massagist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Recommand_massagist`;

CREATE TABLE `Recommand_massagist` (
  `massagistid` varchar(45) NOT NULL default '',
  `shopname` varchar(100) NOT NULL default '',
  `name` varchar(45) NOT NULL default '',
  `stars` enum('1','2','3') NOT NULL default '3',
  `intro` varchar(500) NOT NULL default '',
  `pic` varchar(200) NOT NULL default '',
  `latitude` double NOT NULL,
  `longtitude` double NOT NULL,
  PRIMARY KEY  (`massagistid`),
  CONSTRAINT `Remassagist` FOREIGN KEY (`massagistid`) REFERENCES `Massagist` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Recommand_massagist` WRITE;
/*!40000 ALTER TABLE `Recommand_massagist` DISABLE KEYS */;

INSERT INTO `Recommand_massagist` (`massagistid`, `shopname`, `name`, `stars`, `intro`, `pic`, `latitude`, `longtitude`)
VALUES
	('1','东方力道中医推拿院','赵文斌','3','擅长治疗中风、颈椎病、手脚麻木等心脑血管疾病，各种内科、妇科疑难疾病的中西医结合治疗','http://gene.rnet.missouri.edu/iKnow/img/mathumb/mat1.jpg',39.913489,116.456523),
	('2','妙手笔私人养生会所','谢文松','2','中医体质辨识，更年期调理，膏方调理，健康指导，汗证，虚劳，失眠，肥胖等。','http://gene.rnet.missouri.edu/iKnow/img/mathumb/mat2.jpg',39.904211,116.407395),
	('3','京洛保健会馆(京洛按摩)','尚洪涛','1','三级甲等医院工作，从事中西医结合临床10年，擅长中医治疗疑难杂症。肝病中西医结合治疗。','http://gene.rnet.missouri.edu/iKnow/img/mathumb/mat3.jpg',38.9111454,-92.313238399999);

/*!40000 ALTER TABLE `Recommand_massagist` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Recommand_news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Recommand_news`;

CREATE TABLE `Recommand_news` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(100) NOT NULL default '',
  `content` varchar(2000) NOT NULL default '',
  `pic` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `Recommand_news` WRITE;
/*!40000 ALTER TABLE `Recommand_news` DISABLE KEYS */;

INSERT INTO `Recommand_news` (`id`, `title`, `content`, `pic`)
VALUES
	(1,'身知道联手7大名医专家推出VIP定制服务','2015年10月28日，按爽1.0新版本APP正式上线，成功完成对0.1版本的迭代与功能升级。与身知道0.1版本相比，身知道全新1.0版APP及微信服务号不仅完全保留广受好评的上门预约及到店服务两大功能模块，还针对企业家、商务人士、行业精英、高级白领等高端人群开通名医专家预约诊疗VIP定制服务。','http://gene.rnet.missouri.edu/iKnow/img/slide/slide1.jpg'),
	(2,'中秋放大价，福利提前送','秋高气爽，花好月圆，正是一年好中秋。值此佳节身知道暖心让利，为各大城市青年白领备足了好礼，周二套餐秒杀已拉开序幕，月圆人更圆，让我们的健康美丽陪伴您享团圆。','http://gene.rnet.missouri.edu/iKnow/img/slide/slide2.jpg');

/*!40000 ALTER TABLE `Recommand_news` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Recommand_service
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Recommand_service`;

CREATE TABLE `Recommand_service` (
  `serviceid` int(11) NOT NULL,
  `shopname` varchar(100) NOT NULL default '',
  `servicename` varchar(45) NOT NULL default '',
  `price` decimal(10,2) NOT NULL,
  `pic` varchar(200) NOT NULL default '',
  `latitude` double NOT NULL,
  `longtitude` double NOT NULL,
  PRIMARY KEY  (`serviceid`),
  CONSTRAINT `R-serviced` FOREIGN KEY (`serviceid`) REFERENCES `Service` (`serviceid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Recommand_service` WRITE;
/*!40000 ALTER TABLE `Recommand_service` DISABLE KEYS */;

INSERT INTO `Recommand_service` (`serviceid`, `shopname`, `servicename`, `price`, `pic`, `latitude`, `longtitude`)
VALUES
	(1,'东方力道中医推拿院','单人全身精油按摩',98.00,'http://gene.rnet.missouri.edu/iKnow/img/servicethumb/shop01.jpg',39.913489,116.456523),
	(2,'妙手笔私人养生会所','经络调理SPA套餐',89.00,'http://gene.rnet.missouri.edu/iKnow/img/servicethumb/shop02.jpg',39.904211,116.407395),
	(3,'京洛保健会馆(京洛按摩)','单人经络保健/生姜足道',109.00,'http://gene.rnet.missouri.edu/iKnow/img/servicethumb/shop03.jpg',38.9111454,-92.313238399999);

/*!40000 ALTER TABLE `Recommand_service` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Service
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Service`;

CREATE TABLE `Service` (
  `serviceid` int(11) NOT NULL,
  `shopid` int(11) NOT NULL,
  `name` varchar(45) NOT NULL default '',
  `shortdesc` varchar(200) NOT NULL default '',
  `price` decimal(10,2) NOT NULL,
  `funcdesc` varchar(1000) NOT NULL default '',
  `intro` varchar(1000) NOT NULL default '',
  `catid` int(11) NOT NULL,
  `price_high` decimal(10,2) NOT NULL,
  `price_expert` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`serviceid`),
  KEY `category_idx` (`catid`),
  KEY `sstore_idx` (`shopid`),
  CONSTRAINT `category` FOREIGN KEY (`catid`) REFERENCES `Category` (`catid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sshop` FOREIGN KEY (`shopid`) REFERENCES `Shop` (`shopid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Service` WRITE;
/*!40000 ALTER TABLE `Service` DISABLE KEYS */;

INSERT INTO `Service` (`serviceid`, `shopid`, `name`, `shortdesc`, `price`, `funcdesc`, `intro`, `catid`, `price_high`, `price_expert`)
VALUES
	(1,1,'单人全身精油按摩','改善体质虚弱，增强免疫力',98.00,'天医方艾灸馆小儿保健灸主要针对体质虚弱、免疫力较低的3-8岁宝宝。运用艾灸，保护好阳气，提升孩童的抵抗力。喜欢中式保健的父母们，带上你的宝宝来感受神奇的传统艾灸调理','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',1,108.00,118.00),
	(2,2,'经络调理SPA套餐','浴足+妙手经典足道+足底行罐+腿部通经活络+颈肩部按摩',89.00,'浴足：独家研制的五行草本汤泡脚，彻底放送足部，促进足部血液循环，彻底放松身体，能改善睡眠质量。 妙手经典足道：采用足底反射法，人体全身的组织器官在脚部都有相对应的反射点，通过按摩刺激足部相应的反射点，调整身体，从而达到消除疲劳。对于老年人顽固性睡眠不足、消化不良等都有缓解的作用。<br>足底行罐：去风去湿，去除体内的寒气，刺激足底反射区，改善脏腑功能。 腿部通经活络：消除疲劳酸痛等。 颈肩部按摩：疏解痉挛，消肿散瘀。适用于落枕、颈项强痛、肩部疼痛、劳损等。','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',2,99.00,109.00),
	(3,3,'单人经络保健/生姜足道','颈肩不适 腰背疼痛 腰肌劳损调理',109.00,'为腰背不适等症状者推出的服务项目，由专业理疗师上门为您缓解不适、解决健康问题。<br>服务功效：缓解疼痛、放松肌肉、解除痉挛、消解压力，增强局部血液循环，改善身体状态。<br>服务部位：“颈肩”和“腰背“任选其一，具体可以和理疗师协商。','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',3,119.00,129.00),
	(4,4,'精品艾灸套餐','拨经通络+专家咨询评估+制定个性化调理方案+奇艾悬炙90分钟',156.00,'我们会根据不同的人群特点以及问题采用相应的方案，由调理师及专家进行具体操作： 或以拨经通络，以专业的按摩手法打开陈年郁结，犹去黄河之淤堵，除管道之沉疴，散交通之拥堵，使气脉通畅，经络无阻； 或以蕲艾悬灸，温化您体内的积聚的阴寒固结，犹寒冰渐消，似春回大地，阳光普照，使全身充满生机，气机流畅； 或以刮痧拔罐，透肌表之余邪，活肌肉之僵固，犹拨云见月，雾霾尽去，似板结厚土，顿时松软，使气血滋润于肌肤，容颜若处子。','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',4,166.00,176.00),
	(5,1,'单人悬灸调理','肩、颈、背、腰、腹部（任选两个部位）养生灸法',128.00,'我们会根据不同的人群特点以及问题采用相应的方案，由调理师及专家进行具体操作： 或以拨经通络，以专业的按摩手法打开陈年郁结，犹去黄河之淤堵，除管道之沉疴，散交通之拥堵，使气脉通畅，经络无阻； 或以蕲艾悬灸，温化您体内的积聚的阴寒固结，犹寒冰渐消，似春回大地，阳光普照，使全身充满生机，气机流畅； 或以刮痧拔罐，透肌表之余邪，活肌肉之僵固，犹拨云见月，雾霾尽去，似板结厚土，顿时松软，使气血滋润于肌肤，容颜若处子。','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',1,138.00,148.00),
	(6,3,'单人高级中式推拿','头+肩颈+背腰+胸腹+上、下肢',178.00,'有针对性的调理困扰自己的脊椎相关的体征、免疫力下降的体征、胃肠功能紊乱引起的体征、及男女生理功能障碍引起的体征，真正呵护您的健康','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',2,188.00,198.00),
	(7,5,'单人助眠安神调理','明经堂单人助眠安神调理90分钟，免费WiFi，免费停车位！',298.00,'明经堂助眠安神调理，以传统特有的子午流注法为依据，充分利用生命与时间学，于戌时（晚7点—9点）心包经气血 时期，亥时（晚9点—11点）三焦经气血 时期，进行心包经与三焦经的经穴按摩调理，达到补虚泻实，调整脏腑阴阳，安神定志的目的。','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',5,328.00,358.00),
	(8,5,'泰式按摩套餐','鲜花足浴、保健指压、芳香精油开穴、热石温热穴位渗透、毛巾热敷、腿部精油开穴、热石温热穴位渗透、毛巾热敷',238.00,'鲜花足浴、保健指压、芳香精油开穴、热石温热穴位渗透、毛巾热敷、腿部精油开穴、热石温热穴位渗透、毛巾热敷','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',5,258.00,288.00);

/*!40000 ALTER TABLE `Service` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Shop
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Shop`;

CREATE TABLE `Shop` (
  `shopid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL default '',
  `latitude` double NOT NULL,
  `longtitude` double NOT NULL,
  `phone` varchar(20) NOT NULL default '',
  `address` varchar(200) NOT NULL default '',
  `pic` varchar(200) default NULL,
  `opentime` time NOT NULL,
  `closetime` time NOT NULL,
  PRIMARY KEY  (`shopid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Shop` WRITE;
/*!40000 ALTER TABLE `Shop` DISABLE KEYS */;

INSERT INTO `Shop` (`shopid`, `name`, `latitude`, `longtitude`, `phone`, `address`, `pic`, `opentime`, `closetime`)
VALUES
	(1,'东方力道中医推拿院',39.913489,116.456523,'+8601065005739','双井富力城B区1号楼-115','http://gene.rnet.missouri.edu/iKnow/img/servicethumb/shop01.jpg','08:00:00','22:00:00'),
	(2,'妙手笔私人养生会所',39.904211,116.407395,'+8601085173909','朝阳门内大街288号凯德华玺1号楼328室','http://gene.rnet.missouri.edu/iKnow/img/servicethumb/shop02.jpg','10:00:00','24:00:00'),
	(3,'京洛保健会馆(京洛按摩)',38.9111454,-92.313238399999,'+8601085861578','慈云寺远洋天地59号楼104室','http://gene.rnet.missouri.edu/iKnow/img/servicethumb/shop03.jpg','09:00:00','23:00:00'),
	(4,'正气堂中医养生馆',39.903642,116.432518,'+8601067175105','东城区 西花市大街17号（正气堂二楼）(国瑞城东区)','http://gene.rnet.missouri.edu/iKnow/img/servicethumb/shop04.jpg','09:00:00','21:00:00'),
	(5,'明经堂中医诊疗机构',39.977473,116.484681,'+86 01084567010',' 朝阳区 东四环将台西路9-10-A号(近东四环霄云桥向东300米)','http://gene.rnet.missouri.edu/iKnow/img/servicethumb/shop05.jpg','09:30:00','21:30:00');

/*!40000 ALTER TABLE `Shop` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
