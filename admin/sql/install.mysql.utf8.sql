--
-- Structure de la table `#__jb_badges`
--

CREATE TABLE IF NOT EXISTS `#__jb_badges` (
  `id_badge` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(128) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(128) NOT NULL,
  `criteria_url` varchar(255) NOT NULL,
  `expires` date NOT NULL,
  `catid` int(11) NOT NULL DEFAULT '0',
  `issuerid` int(11) NOT NULL,
  `alignmentid` int(11) NOT NULL,
  `tags` varchar(150) NOT NULL,
  PRIMARY KEY (`id_badge`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Structure de la table `#__jb_issuer`
--

CREATE TABLE IF NOT EXISTS `#__jb_issuer` (
  `id_issuer` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(11) NOT NULL,
  `issuer_name` varchar(150) NOT NULL,
  `issuer_url` varchar(150) NOT NULL,
  `issuer_email` varchar(60) NOT NULL,
  `issuer_description` varchar(255) NOT NULL,
  `issuer_image` varchar(150) NOT NULL,
  PRIMARY KEY (`id_issuer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Issuer organization' AUTO_INCREMENT=1 ;

--
-- Structure de la table `#__jb_records`
--

CREATE TABLE IF NOT EXISTS `#__jb_records` (
  `id_record` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` varchar(13) NOT NULL,
  `evidence` varchar(200) NOT NULL COMMENT 'url that can prove badge is earned',
  `recipient` varchar(128) NOT NULL COMMENT 'hashed email',
  `identity` varchar(128) NOT NULL,
  `identity_type` varchar(20) NOT NULL,
  `salt` varchar(8) NOT NULL COMMENT 'for email hashing',
  `earnername` varchar(100) NOT NULL,
  `earneremail` varchar(100) NOT NULL,
  `badgeid` int(11) NOT NULL,
  `badgeversion` varchar(5) NOT NULL COMMENT 'openbadges API version',
  `badgename` varchar(128) NOT NULL,
  `badgeimage` varchar(255) NOT NULL COMMENT 'url for badge image',
  `badgedescription` varchar(128) NOT NULL,
  `badgecriteria` varchar(255) NOT NULL COMMENT 'url to criteria',
  `badgeexpires` date NOT NULL,
  `badgeissuedon` varchar(25) NOT NULL,
  `badgeissuerorigin` varchar(150) NOT NULL COMMENT 'issuer website',
  `badgeissuername` varchar(100) NOT NULL,
  `badgeissuerorg` varchar(100) NOT NULL,
  `badgeissuercontact` varchar(100) NOT NULL,
  `verify_type` varchar(20) NOT NULL,
  `verify_url_old_delete` varchar(200) NOT NULL,
  `transfered` tinyint(1) DEFAULT NULL COMMENT '1 if transfered to backpack',
  PRIMARY KEY (`id_record`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='records of earned badges' AUTO_INCREMENT=1 ;



--
-- Structure de la table `#__jb_validated`
--

CREATE TABLE IF NOT EXISTS `#__jb_validated` (
  `id_validated` int(11) NOT NULL AUTO_INCREMENT,
  `usermail` varchar(150) NOT NULL,
  `badgeid` int(11) NOT NULL,
  PRIMARY KEY (`id_validated`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
