CREATE TABLE department_info (
    id int(6) unsigned NOT NULL PRIMARY KEY,
    managerID int(6) unsigned,
    description varchar(1000) NOT NULL,
    roomQuantity tinyint unsigned DEFAULT 0 NOT NULL,

    FOREIGN KEY (id) REFERENCES department(id),
    FOREIGN KEY (managerID) REFERENCES account(id)
);