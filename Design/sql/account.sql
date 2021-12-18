CREATE TABLE account (
  id int(6) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username varchar(30) NOT NULL,
  password varchar(100) NOT NULL,
  role int(6) UNSIGNED DEFAULT 1,
  activated tinyint(4) DEFAULT 0,
  token varchar(30) DEFAULT NULL,
    
  FOREIGN KEY (role) REFERENCES role(id)
)