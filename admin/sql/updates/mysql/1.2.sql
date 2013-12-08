--
-- Structure de la table `#__jb_articles`
--

CREATE TABLE IF NOT EXISTS `#__jb_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component` varchar(50) NOT NULL,
  `articleid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


ALTER TABLE  `#__jb_records` ADD  `userid` INT NOT NULL AFTER  `id_record` ;

