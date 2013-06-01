DROP TABLE IF EXISTS `#__jb_issuer`;

CREATE TABLE `#__jb_issuer` (
  `id_issuer` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(11) NOT NULL,
  `issuer_name` varchar(150) NOT NULL,
  `issuer_url` varchar(150) NOT NULL,
  `issuer_email` varchar(60) NOT NULL,
  `issuer_description` varchar(255) NOT NULL,
  `issuer_image` varchar(150) NOT NULL,
  PRIMARY KEY (`id_issuer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Issuer organization';

DROP TABLE IF EXISTS `_temp_jb_badges`;

CREATE TABLE `_temp_jb_badges` (
 `id_badge` int(11) NOT NULL AUTO_INCREMENT,
 `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
 `name` varchar(128) NOT NULL,
 `image` varchar(255) NOT NULL,
 `description` varchar(128) NOT NULL,
 `criteria_url` varchar(255) NOT NULL,
 `expires` date NOT NULL,
 `catid` int(11) NOT NULL DEFAULT '0',
 `issuerid` int(11) NOT NULL,
 `alignmentid` int(11) NOT NULL,
 `tags` varchar(150) NOT NULL,
 PRIMARY KEY  ( `id_badge` )
)
ENGINE = MyISAM
CHARACTER SET = utf8
AUTO_INCREMENT = 1
ROW_FORMAT = DYNAMIC;

INSERT INTO `_temp_jb_badges`(`catid`,
                                                  `criteria_url`,
                                                  `description`,
                                                  `expires`,
                                                  `id_badge`,
                                                  `image`,
                                                  `name`)
   SELECT `catid`,
          `criteria_url`,
          `description`,
          `expires`,
          `id_badge`,
          `image`,
          `name`
     FROM `#__jb_badges`;

DROP TABLE `#__jb_badges`;

ALTER TABLE `_temp_jb_badges` RENAME `#__jb_badges`;

DROP TABLE IF EXISTS `_temp_jb_records`;

CREATE TABLE `_temp_jb_records` (
 `id_record` int(11) NOT NULL AUTO_INCREMENT,
 `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
 `uid` varchar(13) NOT NULL,
 `evidence` varchar(200) NOT NULL,
 `recipient` varchar(128) NOT NULL,
 `identity` varchar(128) NOT NULL,
 `identity_type` varchar(20) NOT NULL,
 `salt` varchar(8) NOT NULL,
 `earnername` varchar(100) NOT NULL,
 `earneremail` varchar(100) NOT NULL,
 `badgeid` int(11) NOT NULL,
 `badgeversion` varchar(5) NOT NULL,
 `badgename` varchar(128) NOT NULL,
 `badgeimage` varchar(255) NOT NULL,
 `badgedescription` varchar(128) NOT NULL,
 `badgecriteria` varchar(255) NOT NULL,
 `badgeexpires` date NOT NULL,
 `badgeissuedon` varchar(25) NOT NULL,
 `badgeissuerorigin` varchar(150) NOT NULL,
 `badgeissuername` varchar(100) NOT NULL,
 `badgeissuerorg` varchar(100) NOT NULL,
 `badgeissuercontact` varchar(100) NOT NULL,
 `verify_type` varchar(20) NOT NULL,
 `verify_url_old_delete` varchar(200) NOT NULL,
 `transfered` tinyint(1) DEFAULT NULL,
 PRIMARY KEY  ( `id_record` )
)
ENGINE = MyISAM
CHARACTER SET = utf8
AUTO_INCREMENT = 1
ROW_FORMAT = DYNAMIC
COMMENT = 'records of earned badges';

INSERT INTO `_temp_jb_records`(`uid`,
						   `badgecriteria`,
                                                   `badgedescription`,
                                                   `badgeexpires`,
                                                   `badgeimage`,
                                                   `badgeissuedon`,
                                                   `badgeissuercontact`,
                                                   `badgeissuername`,
                                                   `badgeissuerorg`,
                                                   `badgeissuerorigin`,
                                                   `badgename`,
                                                   `badgeversion`,
                                                   `earneremail`,
                                                   `earnername`,
                                                   `evidence`,
                                                   `id_record`,
                                                   `identity`,
                                                   `salt`,
                                                   `transfered`)
   SELECT `id_record`,
	  `badgecriteria`,
          `badgedescription`,
          `badgeexpires`,
          `badgeimage`,
          `badgeissuedon`,
          `badgeissuercontact`,
          `badgeissuername`,
          `badgeissuerorg`,
          `badgeissuerorigin`,
          `badgename`,
          `badgeversion`,
          `earneremail`,
          `earnername`,
          `evidence`,
          `id_record`,
          `recipient`,
          `salt`,
          `transfered`
     FROM `#__jb_records`;

DROP TABLE `#__jb_records`;

ALTER TABLE `_temp_jb_records` RENAME `#__jb_records`;

UPDATE `#__jb_records` SET `identity_type`='email';
UPDATE `#__jb_records` SET `verify_type`='hosted';
UPDATE `#__jb_records` LEFT JOIN `#__jb_badges` on `#__jb_records`.`badgename`=`#__jb_badges`.`name` SET `#__jb_records`.`badgeid`=`#__jb_badges`.`id_badge`;






