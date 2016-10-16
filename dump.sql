-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `publish_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `author_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES ('1', 'Android-sjef: Neste uke vil bli snakket om i flere år', 'Den 4. oktober letter Google på sløret for hva vi har i vente fra selskapet fremover. Og skal vi to Android-sjefen Hiroshi Lockheimer så vil det som dukker opp bli husket som en av de store dagene i selskapets historie. \r\n\r\nVia Twitter sammenligner han nemlig det kommende arrangementet med en av de største nyhetene fra selskapet noensinne. \r\n\r\n– På denne dagen for åtte år siden lanserte vi den første versjonen av Android. Jeg har en følelse av at vi om åtte år vil snakke om 4. oktober 2016, sier Lockheimer.  ', '2016-09-10 19:00:00', '2');
INSERT INTO `articles` VALUES ('2', 'Diskré Beebox-S har ambisjoner om å innta stua di', 'I dette tiåret har vi for alvor sett at små datamaskiner også kan ha muskler. Takket være mer energieffektive prosessorer slipper vi også vifteløsninger som får en liten PC til å høres ut som en hårføner.', '2016-09-01 13:00:00', '4');
INSERT INTO `articles` VALUES ('3', 'Apple Watch knuser fremdeles smartklokke-konkurrentene', '\r\nDet finnes nå mange forskjellige smartklokker å velge mellom på markedet, og mange av dem er vesentlig rimeligere enn Apples modeller. Likevel er det fremdeles få som kan konkurrere med Apple Watch. Det melder blant andre PhoneArena.', '2016-09-12 14:00:00', '1');
INSERT INTO `articles` VALUES ('4', 'Lift lader smartklokken din mens den svever i løse luften', '\r\nVi meldte tidligere denne måneden om en Kickstarter-finansiert mobillader som lader mobilen i løse luften, og nå har et tilsvarende konsept for smartklokker dukket opp på det samme nettstedet. Navnet på den nye Kickstarter-finansierte smartklokke-laderen er Lift.\r\n\r\n', '2016-08-24 12:00:00', '1');
INSERT INTO `articles` VALUES ('5', 'Slik ser den endelige utgaven av Nikes selvknytende sko ut', 'I forbindelse med jubiléet til «Tilbake til fremtiden II» ble det i fjor vist frem et par ekte prototyper av de selvknytende skoene som Michael J. Fox bruker i filmen. Senere kom det frem at Nike har laget et salgbart produkt av prototypen, og nå kommer de faktisk på markedet for alvor.', '2016-09-22 16:10:00', '3');

-- ----------------------------
-- Table structure for authors
-- ----------------------------
DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors` (
  `author_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of authors
-- ----------------------------
INSERT INTO `authors` VALUES ('1', 'Kristine', 'Bjørvik');
INSERT INTO `authors` VALUES ('2', 'Tobias', 'Risdal');
INSERT INTO `authors` VALUES ('3', 'Louise', 'Bjørnøy');
INSERT INTO `authors` VALUES ('4', 'Leon', 'Hagen');
