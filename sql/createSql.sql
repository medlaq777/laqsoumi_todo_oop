create database todo_oop;
USE todo_oop;

CREATE TABLE IF NOT EXISTS users (
  user_id int NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(255) NOT NULL,
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  role enum('user','admin') DEFAULT 'user',
  PRIMARY KEY (user_id),
  UNIQUE KEY username (username),
  UNIQUE KEY email (email)
) 


// Create tasks table

CREATE TABLE tasks (
  task_id int NOT NULL AUTO_INCREMENT,
  title varchar(100) NOT NULL,
  description text,
  status varchar(20) DEFAULT 'todo',
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (task_id),
  CONSTRAINT tasks_chk_2 CHECK (status IN ('todo','doing','done'))
) 

// Create usertasks table

CREATE TABLE  usertasks (
  id int NOT NULL AUTO_INCREMENT,
  user_id int DEFAULT NULL,
  task_id int DEFAULT NULL,
  assigned_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY user_id (user_id),
  KEY task_id (task_id),
  CONSTRAINT usertasks_ibfk_1 FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE,
  CONSTRAINT usertasks_ibfk_2 FOREIGN KEY (task_id) REFERENCES tasks (task_id) ON DELETE CASCADE
) 


// Create tags table

CREATE TABLE tags (
  id_tags int NOT NULL AUTO_INCREMENT,
  NAME varchar(25) DEFAULT NULL,
  PRIMARY KEY (id_tags),
  UNIQUE KEY NAME (NAME)
) 


// Create tagstasks table

CREATE TABLE  tagstasks (
  id int NOT NULL AUTO_INCREMENT,
  tags_id int DEFAULT NULL,
  tasks_id int DEFAULT NULL,
  PRIMARY KEY (id),
  KEY tags_id (tags_id),
  KEY tasks_id (tasks_id),
  CONSTRAINT tagstasks_ibfk_1 FOREIGN KEY (tags_id) REFERENCES tags (id_tags) ON DELETE CASCADE,
  CONSTRAINT tagstasks_ibfk_2 FOREIGN KEY (tasks_id) REFERENCES tasks (task_id) ON DELETE CASCADE
)


// insertion 


INSERT INTO users (username, email, password, role) VALUES 
('admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('user1', 'user1@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('user2', 'user2@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

INSERT INTO tasks (title, description, status) VALUES 
('Complete project proposal', 'Write and submit the project proposal for the new client', 'todo'),
('Review code changes', 'Go through the pull requests and provide feedback', 'doing'),
('Update documentation', 'Update the user manual with the latest features', 'done'),
('Fix login bug', 'Investigate and fix the issue with user login on mobile devices', 'todo'),
('Prepare presentation', 'Create slides for the upcoming team meeting', 'doing');

INSERT INTO usertasks (user_id, task_id) VALUES 
(2, 1),
(2, 2),
(3, 3),
(2, 4),
(3, 5);

INSERT INTO tags (NAME) VALUES 
('basic'),
('feature'),
('bug'),

INSERT INTO tagstasks (tags_id, tasks_id) VALUES 
(1, 1),
(2, 1),
(1, 4),
(2, 3),
(3, 5);