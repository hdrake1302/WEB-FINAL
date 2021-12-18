CREATE TABLE task (
    id int(6) unsigned NOT NULL AUTO_INCREMENT,
    managerID int(6) unsigned NOT NULL,
    staffID int(6) unsigned NOT NULL,
    title varchar(30) NOT NULL,
    description varchar(100),
    status varchar(30) DEFAULT 'new', -- "new, in progess, canceled, wating, rejected"
    rating varchar(10), -- "bad, ok, good"
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deadline TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (managerID) REFERENCES account(id),
    FOREIGN KEY (staffID) REFERENCES account(id)
);