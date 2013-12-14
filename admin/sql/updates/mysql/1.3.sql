ALTER TABLE  `#_jb_badges` ADD  `state` BOOLEAN NOT NULL DEFAULT FALSE AFTER  `asset_id` ;


--
-- Structure de la table `#__jb_goals`
--

CREATE TABLE IF NOT EXISTS `#__jb_goals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0',
  `state` boolean NOT NULL DEFAULT FALSE,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `query` varchar(255) NOT NULL,
  `operator` varchar(50) NOT NULL,
  `goal` varchar(50) NOT NULL,
  `count` boolean NOT NULL DEFAULT FALSE,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

