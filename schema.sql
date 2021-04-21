CREATE DATABASE readme
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;
USE readme;
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email CHAR(128) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    password CHAR(64) NOT NULL,
    avatar_path VARCHAR(255)
);
CREATE TABLE posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNSIGNED,
    type_content_id INT UNSIGNED,
    hashtag_id INT UNSIGNED,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    title VARCHAR(255),
    content TEXT,
    autor_quote VARCHAR(255),
    photo_path VARCHAR(255),
    video_path VARCHAR(255),
    link_path VARCHAR(255),
    show_count INT UNSIGNED,
    like_count INT UNSIGNED
);
CREATE TABLE comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNSIGNED,
    post_id INT UNSIGNED,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    content TEXT
);
CREATE TABLE posts_like (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNSIGNED,
    post_id INT UNSIGNED
);
CREATE TABLE subscriptions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_subscriber_id INT UNSIGNED,
    user_id INT UNSIGNED
);
CREATE TABLE messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_sender_id INT UNSIGNED,
    user_recipient_id INT UNSIGNED,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    content TEXT
);
CREATE TABLE hashtags (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);
CREATE TABLE type_contents (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name CHAR(64),
    filters_icon CHAR(64)
);
CREATE INDEX user ON users(id);
CREATE INDEX post ON posts(id);
CREATE INDEX comment ON comments(id);