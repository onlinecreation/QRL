CREATE TABLE IF NOT EXISTS qrl_settings (
  last_number bigint(20) unsigned NOT NULL DEFAULT '0',
  KEY last_number (last_number)
);

CREATE TABLE IF NOT EXISTS qrl_urls (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  url text NOT NULL,
  code varchar(20) NOT NULL DEFAULT '',
  date_added datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (id),
  UNIQUE KEY code (code),
  KEY alias (alias)
);

INSERT INTO qrl_settings (last_number) VALUES
(1);