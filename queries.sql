/* заполняем таблицу Типы контента (type_contents) данными -
список типов контента для поста*/
INSERT INTO type_contents SET
    name = 'Текст', filters_icon = 'text';
INSERT INTO type_contents (name, filters_icon)
    VALUES ('Цитата', 'quote');
INSERT INTO type_contents (name, filters_icon)
    VALUES ('Картинка', 'photo');
INSERT INTO type_contents (name, filters_icon)
    VALUES ('Видео', 'video');
INSERT INTO type_contents (name, filters_icon)
    VALUES ('Ссылка', 'link');

-- заполняем таблицу Пользователи (users) данными
-- часть данных о пользователях берём из первичного массива
INSERT INTO users (email, name, login, password, avatar_path)
    VALUES ('larisa@mail.ru', 'Лариса', 'larisa', 'secret_larisa', 'userpic-larisa-small.jpg');
INSERT INTO users (email, name, login, password, avatar_path)
    VALUES ('vlad@mail.ru', 'Владик', 'vlad', 'secret_vlad', 'userpic.jpg');
INSERT INTO users (email, name, login, password, avatar_path)
    VALUES ('viktor@mail.ru', 'Виктор', 'viktor', 'secret_viktor', 'userpic-mark.jpg');

/* заполняем таблицу Постов (posts) данными
данные берём из первичного массива */
INSERT INTO posts (user_id, type_content_id, title, content, autor_quote, show_count)
    VALUES ('1', '2', 'Цитата', 'Мы в жизни любим только раз, а после ищем лишь похожих', 'Лариса', '10');
INSERT INTO posts (user_id, type_content_id, title, content)
    VALUES ('2', '1', 'Игра престолов', 'Не могу дождаться начала финального сезона своего любимого сериала!');
INSERT INTO  posts (user_id, type_content_id, title, photo_path, show_count)
    VALUES ('3', '3', 'Наконец, обработал фотки!', 'rock-medium.jpg', '30');    
INSERT INTO posts (user_id, type_content_id, title, photo_path, show_count)
    VALUES ('1', '3', 'Моя мечта', 'coast-medium.jpg', 9);
INSERT INTO posts (user_id, type_content_id, title, link_path, show_count)
    VALUES ('2', '5', 'Лучшие курсы', 'www.htmlacademy.ru', '33');

-- заполняем таблицу Комментарии (comments) данными
INSERT INTO comments (user_id, post_id, content)
    VALUES ('1', '1', 'Лариса, ну почему же неизвестный автор? Это Сергей Есенин.');
INSERT INTO comments (user_id, post_id, content)
    VALUES ('1', '1', 'Интересная мысль).');
INSERT INTO comments (user_id, post_id, content)
    VALUES ('3', '3', 'Отлично, Виктор! С нетерпением жду новых фотографий:)');
INSERT INTO comments (user_id, post_id, content)
    VALUES ('3', '3', 'Красивая фотка!');

/* Запросы
выводим список постов с сортировкой по популярности вместе с именами авторов и типом контента */
SELECT title AS post, u.name AS author, t.name AS type, show_count AS counter
    FROM posts AS p
        INNER JOIN users AS u ON p.user_id = u.id
        INNER JOIN type_contents AS t ON p.type_content_id = t.id
            ORDER BY show_count DESC;

-- получить список постов для конкретного пользователя
SELECT title FROM posts
    WHERE user_id = 1;
SELECT title FROM posts
    WHERE user_id = 2;
SELECT title FROM posts
    WHERE user_id = 3;

-- получить список комментариев для одного поста, в комментариях должен быть логин пользователя
SELECT content, login 
    FROM comments AS c 
        INNER JOIN users AS u ON c.user_id = u.id
            WHERE post_id = 1;
SELECT content, login 
    FROM comments AS c 
        INNER JOIN users AS u ON c.user_id = u.id 
            WHERE post_id = 3;

-- добавить лайк посту
INSERT INTO posts_like (user_id, post_id) VALUES
    ('1', '2'),
    ('1', '3'),
    ('1', '5'),
    ('2', '1'),
    ('2', '4'),
    ('3', '1'),
    ('3', '5');

-- подписаться на пользователя
INSERT INTO subscriptions (user_subscriber_id, user_id) VALUES
    ('1', '2'),
    ('1', '3'),
    ('2', '3');