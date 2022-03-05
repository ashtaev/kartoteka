--Задание 1: Перечислите, чтобы вы поправили в таблицах (тип данных, название, длину - что угодно - и почему)

    -- 1. Не соответствует тип первичного ключа таблицы offices (tinyint) и внешнего ключа таблицы users (smallint)
    -- 2. Тип mediumtext слишком большой для поля name
    -- 3. KEY `office_id` (`office_id`) заменить на FOREIGN KEY (office_id) REFERENCES offices (id)

--Задание 2: Выведите имена пользователей и названия офисов, в которых они сидят

    SELECT users.name as user_name, offices.name as office_name
    FROM offices
    LEFT JOIN users on offices.id = users.office_id

--Задание 3:Выведите названия офисов, в котором сидят больше, чем один пользователь

    SELECT offices.name
    FROM offices
    LEFT JOIN users ON users.office_id = offices.id 
    GROUP BY offices.name
    HAVING COUNT(users.office_id) > 1
