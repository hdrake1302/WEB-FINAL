CREATE TABLE task_record (
    id int(6) unsigned AUTO_INCREMENT NOT NULL PRIMARY KEY,
    task_id int(6) unsigned NOT NULL,
    person_id int(6) unsigned NOT NULL,
    status varchar(30) NOT NULL DEFAULT "New", -- "new, in progess, canceled, wating, rejected"
    note varchar(200), -- "note if rejected",
    file_name varchar(100),
    file varchar(200), -- "file path to the data"
    
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY(task_id) REFERENCES task(id),
    FOREIGN KEY (person_id) REFERENCES account(id)
);