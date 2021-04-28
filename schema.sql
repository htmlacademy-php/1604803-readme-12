CREATE DATABASE readme
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;
USE readme;
CREATE TABLE users (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(128) NOT NULL UNIQUE,
    name VARCHAR(128) NOT NULL,
    password CHAR(64) NOT NULL,
    avatar_path VARCHAR(255),
    INDEX(name(20))
);
CREATE TABLE type_contents (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name CHAR(64),
    filters_icon CHAR(64)
);
CREATE TABLE posts (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNSIGNED,
    type_content_id INT UNSIGNED,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    title VARCHAR(255),
    content TEXT,
    autor_quote VARCHAR(255),
    photo_path VARCHAR(255),
    video_path VARCHAR(255),
    link_path VARCHAR(255),
    show_count INT UNSIGNED,
    like_count INT UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (type_content_id) REFERENCES type_contents(id),
    INDEX(title(20))
);
CREATE TABLE comments (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNSIGNED,
    post_id INT UNSIGNED,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    content TEXT,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (post_id) REFERENCES posts (id)
);
CREATE TABLE posts_like (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNSIGNED,
    post_id INT UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (post_id) REFERENCES posts (id)
);
CREATE TABLE subscriptions (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_subscriber_id INT UNSIGNED,
    user_id INT UNSIGNED,
    FOREIGN KEY (user_subscriber_id) REFERENCES users (id),
    FOREIGN KEY (user_id) REFERENCES users (id)
);
CREATE TABLE messages (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_sender_id INT UNSIGNED,
    user_recipient_id INT UNSIGNED,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    content TEXT,
    FOREIGN KEY (user_sender_id) REFERENCES users (id),
    FOREIGN KEY (user_recipient_id) REFERENCES users (id)
);
CREATE TABLE hashtags (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);