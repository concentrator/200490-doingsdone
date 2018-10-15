CREATE DATABASE doingsdone CHARACTER SET utf8 COLLATE utf8_general_ci;

USE doingsdone;

CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  created_at DATETIME NOT NULL,
  email VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  password VARCHAR(60) NOT NULL,
  contact TEXT,
  UNIQUE KEY index_email (email)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE project (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  title VARCHAR(32) NOT NULL,
  user_id INT NOT NULL,
  UNIQUE KEY index_project (user_id, title),
  FOREIGN KEY fk_project_user(user_id)
  REFERENCES user(id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE task (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  created_at DATETIME NOT NULL,
  completed_at DATETIME,
  is_done BOOLEAN DEFAULT 0 NOT NULL,
  title VARCHAR(255) NOT NULL,
  file VARCHAR(255) UNIQUE,
  deadline DATETIME,
  user_id INT NOT NULL,
  project_id INT,
  FOREIGN KEY fk_task_user(user_id)
  REFERENCES user(id),
  FOREIGN KEY fk_task_project(project_id)
  REFERENCES project(id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE INDEX index_completed ON task(completed_at, user_id);
CREATE INDEX index_title ON task(title, user_id);
CREATE INDEX index_deadline ON task(deadline, user_id);
