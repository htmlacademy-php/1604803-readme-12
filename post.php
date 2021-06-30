<?php
require_once('helpers.php');
$config = require_once('config.php'); // создаём файл конфигурации
$db = $config['db']; // создаём массив из файла конфигурации для подключения к SQL
$conn = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']); //устанавливаем соединение с SQL-базой
if (!$conn) {
    $error = mysqli_connect_error();
    $contents = include_template('error.php', [
        'error' => $error
        ]);
    print($contents);
}
mysqli_set_charset($conn, "utf8"); // устанавливаем кодировку

    if (isset($_GET['id'])){    
        $id = $_GET['id'];
    
        $sql = "SELECT t.id, name, filters_icon, posts.id FROM
            type_contents AS t
                INNER JOIN posts ON t.id = posts.type_content_id
                    WHERE posts.id = $id";
        $resalt = mysqli_query($conn, $sql);
        if (!$resalt){
            $error = mysqli_error($conn);
            $contents = include_template('error.php', [
            'error' => $error
             ]);
            print($contents);
        }

        $types = mysqli_fetch_all($resalt, MYSQLI_ASSOC);
        $type = $types[0]['filters_icon'];


            switch ($type) {
                case ('text'):
                    $sql = "SELECT p.id, title, t.name, filters_icon, u.name, content, avatar_path, show_count
                    FROM posts AS p
                        INNER JOIN users AS u ON p.user_id = u.id
                        INNER JOIN type_contents AS t ON p.type_content_id = t.id
                            WHERE p.id = $id";
                        $resalt = mysqli_query($conn, $sql);
                break;
                case ('quote'):
                    $sql = "SELECT p.id, title, t.name, filters_icon, u.name, content, autor_quote, avatar_path, show_count
                    FROM posts AS p
                        INNER JOIN users AS u ON p.user_id = u.id
                        INNER JOIN type_contents AS t ON p.type_content_id = t.id
                            WHERE p.id = $id";
                        $resalt = mysqli_query($conn, $sql);
                break;
                case ('photo'):
                    $sql = "SELECT p.id, title, t.name, filters_icon, u.name, photo_path, avatar_path, show_count
                    FROM posts AS p
                        INNER JOIN users AS u ON p.user_id = u.id
                         INNER JOIN type_contents AS t ON p.type_content_id = t.id
                            WHERE p.id = $id";
                        $resalt = mysqli_query($conn, $sql);
                break;
                case ('video'):
                    $sql = "SELECT p.id, title, t.name, filters_icon, u.name, video_path, avatar_path, show_count
                    FROM posts AS p
                        INNER JOIN users AS u ON p.user_id = u.id
                        INNER JOIN type_contents AS t ON p.type_content_id = t.id
                            WHERE p.id = $id";
                        $resalt = mysqli_query($conn, $sql);
                break;
                case ('link'):
                    $sql = "SELECT p.id, title, t.name, filters_icon, u.name, link_path, avatar_path, show_count
                    FROM posts AS p
                        INNER JOIN users AS u ON p.user_id = u.id
                        INNER JOIN type_contents AS t ON p.type_content_id = t.id
                            WHERE p.id = $id";
                        $resalt = mysqli_query($conn, $sql);
                break;
            }

        if (!$resalt){
            $error = mysqli_error($conn);
            $contents = include_template('error.php', [
            'error' => $error
            ]);
            print($contents);
        }

        $big_posts = mysqli_fetch_all($resalt, MYSQLI_ASSOC);

        $page_content = include_template('blog.php', [
        'big_posts' => $big_posts,
        ]);
        
    } else {
        http_response_code(404);
        }

$layout_content = include_template ('layout.php', [
    'contents' => $page_content,
    'title' => 'readme: популярное',
    'is_auth' =>  1,
    'user_name' => 'Oleg',
]);

print($layout_content);
?>