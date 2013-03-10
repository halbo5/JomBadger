
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


--
-- Structure de la table `#__ob_records`
--

CREATE TABLE IF NOT EXISTS `#__ob_records` (
  `id_record` int(11) NOT NULL AUTO_INCREMENT,
  `evidence` varchar(200) NOT NULL COMMENT 'url that can prove badge is earned',
  `recipient` int(11) NOT NULL COMMENT 'hashed email',
  `salt` varchar(8) NOT NULL COMMENT 'for email hashing',
  `earnername` varchar(100) NOT NULL,
  `earneremail` varchar(100) NOT NULL,
  `badgeversion` varchar(5) NOT NULL COMMENT 'openbadges API version',
  `badgename` varchar(128) NOT NULL,
  `badgeimage` varchar(255) NOT NULL COMMENT 'url for badge image',
  `badgedescription` varchar(128) NOT NULL,
  `badgecriteria` varchar(255) NOT NULL COMMENT 'url to criteria',
  `badgeexpires` date NOT NULL,
  `badgeissuedon` date NOT NULL,
  `badgeissuerorigin` varchar(150) NOT NULL COMMENT 'issuer website',
  `badgeissuername` varchar(100) NOT NULL,
  `badgeissuerorg` varchar(100) NOT NULL,
  `badgeissuercontact` varchar(100) NOT NULL,
  PRIMARY KEY (`id_record`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='records of earned badges' AUTO_INCREMENT=1 ;



--
-- Structure de la table `ob_badges`
--

CREATE TABLE IF NOT EXISTS `#__jb_badges` (
  `id_badge` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(128) NOT NULL,
  `criteria_url` varchar(255) NOT NULL,
  `expires` DATE NOT NULL,
  PRIMARY KEY (`id_badge`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Structure de la table `ob_validated`
--

CREATE TABLE IF NOT EXISTS `#__ob_validated` (
  `id_validated` int(11) NOT NULL AUTO_INCREMENT,
  `usermail` varchar(100) NOT NULL,
  `badgeid` int(11) NOT NULL,
  PRIMARY KEY (`id_validated`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
