--
-- 資料表結構 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表結構 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `articleid` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `view` bigint(20) NOT NULL,
  PRIMARY KEY (`articleid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;