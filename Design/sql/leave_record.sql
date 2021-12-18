CREATE TABLE leave_record (
    id int(6) unsigned AUTO_INCREMENT NOT NULL PRIMARY KEY,
    leave_id int(6) unsigned NOT NULL,
    description varchar(100),
    file varchar(100), -- "file path to the data"
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status varchar(30) NOT NULL DEFAULT "waiting",  -- "waitting, approved, refused"
   
    FOREIGN KEY(leave_id) REFERENCES leave_info(id)
);