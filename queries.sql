INSERT INTO user (created_at,email,name,password)
  VALUES(CURTIME(),'bizzz@inbox.ru','Дмитрий','12345'),
  (CURTIME(),'test@test.ru','Валерий','qwerty'),
  (CURTIME(),'vardan@gmail.com','Юрий','zxcvb');

INSERT INTO project (title, user_id)
  VALUES('Входящие', 1),('Учеба', 1),('Работа', 1),('Домашние дела', 1),('Авто', 1);

INSERT INTO task (created_at, title, deadline, user_id, project_id)
  VALUES(CURTIME(), 'Собеседование в IT компании', '2018-10-12', 1, 3),
  (CURTIME(), 'Выполнить тестовое задание', '2018-12-25', 1, 3),
  (CURTIME(), 'Сделать задание первого раздела', '2018-12-21', 1, 2),
  (CURTIME(), 'Встреча с другом', '2018-12-22', 1, 1),
  (CURTIME(), 'Купить корм для кота', '2018-10-06 12:00:00', 1, 4),
  (CURTIME(), 'Заказать пиццу', NULL, 1, 4);

SELECT * FROM project WHERE user_id = 1;

SELECT * FROM task WHERE project_id = 4 AND user_id = 1;

UPDATE task SET is_done = 1 WHERE id = 5;

SELECT title, deadline FROM task WHERE user_id = 1 AND  0 < TIMESTAMPDIFF(MINUTE, now(), deadline) < 1440 AND TIMESTAMPDIFF(MINUTE, now(), deadline) > 0;

UPDATE task SET title = 'Прослушать 5 лекцию' WHERE id = 2;
