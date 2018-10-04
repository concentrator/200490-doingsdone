CREATE DATABASE doingsdone CHARACTER SET utf8 COLLATE utf8_general_ci;

USE doingsdone;

CREATE TABLE project (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  title VARCHAR(32) UNIQUE NOT NULL,
  user_id INT NOT NULL
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE task (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  created DATE NOT NULL,
  completed DATE,
  done BOOLEAN DEFAULT 0 NOT NULL,
  title VARCHAR(255) NOT NULL,
  file VARCHAR(255) UNIQUE,
  deadline DATETIME,
  user_id INT NOT NULL,
  project_id INT NOT NULL
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  registred DATE NOT NULL,
  email VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  contact TEXT,
  UNIQUE KEY index_email (email)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE INDEX index_completed ON task(completed);
CREATE INDEX index_title ON task(title);
CREATE INDEX index_deadline ON task(deadline);
