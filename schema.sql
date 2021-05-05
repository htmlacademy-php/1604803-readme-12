CREATE DATABASE readme
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;
USE readme;
CREATE TABLE users (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    email VARCHAR(128) NOT NULL UNIQUE,
    name VARCHAR(128) NOT NULL UNIQUE,
    login VARCHAR(128) NOT NULL UNIQUE,
    password CHAR(64) NOT NULL,
    avatar_path VARCHAR(255)
);
CREATE TABLE type_contents (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name CHAR(64) NOT NULL UNIQUE,
    filters_icon CHAR(64) NOT NULL UNIQUE
);
CREATE TABLE posts (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    type_content_id INT UNSIGNED NOT NULL,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    title VARCHAR(255),
    content TEXT,
    autor_quote VARCHAR(255),
    photo_path VARCHAR(255),
    video_path VARCHAR(255),
    link_path VARCHAR(255),
    show_count INT UNSIGNED DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (type_content_id) REFERENCES type_contents(id),
    FULLTEXT (title,content)
);
CREATE TABLE comments (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    post_id INT UNSIGNED NOT NULL,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    content TEXT,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (post_id) REFERENCES posts (id)
);
CREATE TABLE posts_like (
    PRIMARY KEY (user_id, post_id),
    user_id INT UNSIGNED NOT NULL,
    post_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (post_id) REFERENCES posts (id)
);
CREATE TABLE subscriptions (
    PRIMARY KEY (user_subscriber_id, user_id),
    user_subscriber_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_subscriber_id) REFERENCES users (id),
    FOREIGN KEY (user_id) REFERENCES users (id)
);
CREATE TABLE messages (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    is_read INT UNSIGNED DEFAULT 0,
    user_sender_id INT UNSIGNED NOT NULL,
    user_recipient_id INT UNSIGNED NOT NULL,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    content TEXT,
    FOREIGN KEY (user_sender_id) REFERENCES users (id),
    FOREIGN KEY (user_recipient_id) REFERENCES users (id)
);
CREATE TABLE hashtags (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    post_id INT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL UNIQUE,
    FOREIGN KEY (post_id) REFERENCES posts (id)
);