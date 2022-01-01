CREATE TABLE account_info (
  id int(6) UNSIGNED NOT NULL PRIMARY KEY,
  firstname varchar(30) NOT NULL,
  lastname varchar(30) NOT NULL,
  email varchar(50) DEFAULT NULL,
  phone varchar(30) DEFAULT NULL,
  avatar varchar(200) -- avatar image path
  department int(6) unsigned NOT NULL,
    
  FOREIGN KEY (id) REFERENCES account(id),
  FOREIGN KEY (department) REFERENCES department(id)
)