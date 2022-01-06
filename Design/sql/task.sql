CREATE TABLE task (
    id int(6) unsigned NOT NULL AUTO_INCREMENT,
    manager_id int(6) unsigned NOT NULL,
    staff_id int(6) unsigned NOT NULL,
    title varchar(100) NOT NULL,
    description varchar(1000),
    status varchar(30) DEFAULT 'New', -- "new, in progess, canceled, wating, rejected"
    rating varchar(10), -- "bad, ok, good"
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deadline DATETIME NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (manager_id) REFERENCES account(id),
    FOREIGN KEY (staff_id) REFERENCES account(id)
);