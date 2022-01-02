CREATE TABLE leave_info (
    person_id int(6) unsigned NOT NULL PRIMARY KEY,
    used_leaves tinyint unsigned DEFAULT 0,
    total_leaves tinyint unsigned DEFAULT 12,
  
    FOREIGN KEY(person_id) REFERENCES account(id)
);