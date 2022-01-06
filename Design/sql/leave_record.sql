CREATE TABLE leave_record (
    id int(6) unsigned AUTO_INCREMENT NOT NULL PRIMARY KEY,
    leave_id int(6) unsigned NOT NULL,
    description varchar(1000) NOT NULL,
    file_name varchar(200),
    file varchar(200), -- "file path to the data"
    days tinyint unsigned NOT NULL, -- "Number of days requested"
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_response DATETIME DEFAULT NULL,
    date_wanted DATE NOT NULL,
    status varchar(30) NOT NULL DEFAULT "waiting",  -- "waitting, approved, refused"
   
    FOREIGN KEY(leave_id) REFERENCES leave_info(person_id)
);