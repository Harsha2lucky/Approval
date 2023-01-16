CREATE TABLE faculty_record (
  faculty_ID int NOT NULL AUTO_INCREMENT,
  faculty_FIRST_NAME varchar(50) NOT NULL,
  faculty_LAST_NAME varchar(50) NOT NULL,
  faculty_EMAIL varchar(50) NOT NULL,
  faculty_DEPT varchar(30) NOT NULL,
  faculty_PASSWORD varchar(50) NOT NULL,
   PRIMARY KEY(faculty_ID)
);

INSERT INTO faculty_record (faculty_ID, faculty_FIRST_NAME, faculty_LAST_NAME, faculty_EMAIL, faculty_DEPT, faculty_PASSWORD) VALUES
(1, 'Narendra', 'Kumar', 'narendra@gmail.com', 'Computer Science', '123'),
(2, 'Santosh', 'Naidu', 'santosh@gmail.com', 'Computer Science', '123'); 

CREATE TABLE project_notification (
  notification_id int NOT NULL AUTO_INCREMENT,
  project_id int NOT NULL,
  student_id int NOT NULL,
  faculty_id int NOT NULL,
  seen tinyint(1) NOT NULL DEFAULT 0,
   PRIMARY KEY(notification_id)
);

INSERT INTO project_notification (notification_id, project_id, student_id, faculty_id, seen) VALUES
(1, 1, 1, 1, 1),
(2, 4, 2, 2, 0),
(3, 2, 2, 2, 1),
(4, 3, 1, 1, 0);

CREATE TABLE project_record (
  project_ID int NOT NULL AUTO_INCREMENT,
  student_ID int NOT NULL,
  faculty_ID int NOT NULL,
  project_TITLE varchar(50) NOT NULL,
  project_YEAR int NOT NULL,
  project_PROFESSOR varchar(50) DEFAULT NULL,
  project_BATCH int NOT NULL,
  project_COURSE varchar(50) NOT NULL,
  project_COMMENT varchar(500) DEFAULT NULL,
  project_STATUS tinyint(1) NOT NULL DEFAULT 0,
  project_file varchar(100) NOT NULL,
   PRIMARY KEY(project_ID)
);

INSERT INTO project_record (project_ID, student_ID, faculty_ID, project_TITLE, project_YEAR, project_PROFESSOR, project_BATCH, project_COURSE, project_COMMENT, project_STATUS, project_file) VALUES
(1, 1, 1, 'Online auction system', 2022,'Narendra Kumar', 1, 'Data Analytics', '', 0, '../server/uploads/xyz.pdf'),
(2, 2, 2, 'Cursor movement on object motion', 2022,'Santosh Naidu', 2, 'Java', 'Work on it', 1, '../server/uploads/xyz.pdf'),
(3, 1, 1, 'Stack Zero', 2022,'Narendra Kumar', 1, 'Web Designing', 'Please consult me once', 1, '../server/uploads/xyz.pdf'),
(4, 2, 2, 'Smart Attendance System', 2022,'Santosh Naidu', 2, 'Machine Learning', NULL, 0, '../server/uploads/xyz.pdf'),
(5, 1, 1, 'Online Project Proposal',2022, 'Narendra Kumar', 3, 'PHP', ' Start Working ASAP!', 1, '../server/uploads/xyz.pdf'),
(6, 1, 1, 'Library Management System',2022, 'Narendra Kumar', 3, 'My Sql', ' ', 2, '../server/uploads/xyz.pdf');

CREATE TABLE student_faculty_chat (
  message_id int NOT NULL AUTO_INCREMENT,
  student_id int NOT NULL,
  faculty_id int NOT NULL,
  message_body varchar(400) NOT NULL,
  message_sender varchar(1) NOT NULL,
   PRIMARY KEY(message_id)
);

INSERT INTO student_faculty_chat (message_id, student_id, faculty_id, message_body, message_sender) VALUES
(1, 1, 1, 'Hello Mam!', 's'),
(2, 1, 1, 'Yes, How can I help you?', 'h'),
(3, 1, 1, 'Can You Please Guide me about The Project?', 's'),
(4, 1, 1, 'What Do you need my Help With?', 'h'),
(5, 1, 1, 'Can You please Tell me how do I do such things?', 's'),
(6, 2, 1, 'Can You please Enlighten me about your project?', 'h'),
(7, 2, 1, 'Hi Mam, how do you like my project?', 's');

CREATE TABLE student_record (
  student_ID int NOT NULL AUTO_INCREMENT,
  student_EMAIL varchar(50) NOT NULL,
  student_FIRST_NAME varchar(50) NOT NULL,
  student_LAST_NAME varchar(50) NOT NULL,
  student_PASSWORD varchar(50) NOT NULL,
  status tinyint(1) NOT NULL DEFAULT 0,
   PRIMARY KEY(student_ID)
);

INSERT INTO student_record (student_ID, student_EMAIL, student_FIRST_NAME, student_LAST_NAME, student_PASSWORD, status) VALUES
(1, 'harsha@gmail.com', 'Harsha', 'Reddy', '123', 1),
(2, 'akash@gmail.com', 'Akash', 'Bontha', '123', 1);

ALTER TABLE faculty_record
  ADD UNIQUE KEY faculty_EMAIL (faculty_EMAIL);

ALTER TABLE student_faculty_chat
  ADD FOREIGN KEY(faculty_id) REFERENCES faculty_record (faculty_ID),
  ADD FOREIGN KEY(student_id) REFERENCES student_record (student_ID);

ALTER TABLE project_notification
  ADD FOREIGN KEY(project_id) REFERENCES project_record (project_ID),
  ADD FOREIGN KEY(student_id) REFERENCES student_record (student_ID),
  ADD FOREIGN KEY(faculty_id) REFERENCES faculty_record (faculty_ID);

ALTER TABLE project_record
  ADD FOREIGN KEY(student_ID) REFERENCES student_record (student_ID);

ALTER TABLE student_record
  ADD UNIQUE KEY student_EMAIL (student_EMAIL);

COMMIT;